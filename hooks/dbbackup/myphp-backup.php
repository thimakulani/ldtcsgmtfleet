<?php
	/**
     * MySQL Backup script for AppGini
		* Adjusted for AppGini by Olaf Nöhring (https://datenbank-projekt.de)
		* added $run_pass for script security
        * added code to use AppGini database connection 
        * @version 2.0 
        * backup code was changed to use https://github.com/ifsnop/mysqldump-php (instead of https://github.com/daniloaz/myphp-backup)
        *   this results in a speed change: 
        *       testbackup 
        *           php myadmin 17 MB uncompressed
        *           daniloaz = 24 MB uncompressed in about 3 minutes (fails on defect VIEWS, and outputs VIEWS as table data with INSERT INTO...),
        *           new version (mysqldump-php): 3 seconds, 13 MB uncompressed (GZIP 1.2 MB, BZIP2: 0.8 MB).
        *   Note: ALL tables and data are exiting in the backup
        * changed sturcture of code: Settings are on top now
        * new compression method possible. Now: NONE (outputs text file), GZIP and BZIP2
        * 
        * Define your settings in between START SETTINGS and END SETTINGS. No other changes are needed.
        *
        * The script will delete an existing backup file before creating a new one. This is done to prevent growing and growing backup files.
        *
        *
		* @version 1.2 (used code from github.com/daniloaz/myphp-backup and www.daniloaz.com/en/using-php-to-backup-mysql-databases/)
		* added BACKUP_FILENAME_COMPLETE as pre-created filename
		* added deleting of old version of the backup file BACKUP_FILENAME_COMPLETE. This was needed, as backups grew larger and larger instead of replacing when using BACKUP_CYCLE 'wH' for example		
		* @version 1.1 (used code from github.com/daniloaz/myphp-backup and www.daniloaz.com/en/using-php-to-backup-mysql-databases/)
		* added BACKUP_FILEPREFIX (default: config.php $host variable)
		* added BACKUP_CYCLE. Use this to define a filename deducted from the current date (see definition). You can also use 'timestamp' to have a timestamp.
		* 
	*/


error_reporting(E_ALL);
echo "start " . date("Y-m-d H:i:s", time()) ."<br />";

// START Define database parameters here - based on AppGini Settings
require('../../config.php');
define("DB_USER", $dbUsername);
define("DB_PASSWORD", $dbPassword);
define("DB_NAME", $dbDatabase);
define("DB_HOST", $dbServer);
// END Define database parameters here - based on AppGini Settings

####################################################
#####        START SETTINGS             ############
####################################################

/**
 * Define password that is needed to run this file.
 * Leave empty ('') to have no access password
 */
$run_pass = '';             //Set your desired password that is needed to run the backup here

// BACKUP_CYCLE: How many backups do you want to create? Values:
//  timestamp = create a new backup each time with a timestamp (keep unlimited backups, you will need to remove old ones by hand)
//  weekday (su, 0 .. sat 6), w
//  week (01-53), W
//  hour (00-24), H
//  day (01-31), d
//  month (01-12), m
define("BACKUP_CYCLE", 'wH');                   // if you want some date/time in your filename. you can also set 'timestamp'
define("BACKUP_FILENAME",  get_backup_filename(BACKUP_CYCLE)); 

define("BACKUP_DIR", './sql_backup');           // where to create the backup file
define('BACKUP_FILEPREFIX', $host . "_");       // this is part of the filename  

define("BACKUP_COMPRESSION", 'GZIP');          // Use one of the following: NONE | GZIP | BZIP2 | 

//Define your backup filename, end with .sql. If you define to create a GZIP or BZIP2 version, that extension will automatically be added
$backup_filename_complete = BACKUP_FILEPREFIX . DB_NAME . '-' . BACKUP_FILENAME .'.sql';

####################################################
##### END SETTINGS, NOTHING TO DO BELOW ############
####################################################

// Check if run_pass was correct
if ($run_pass <> '') {
    $chk_pass = isset($_GET['pw']) ? $_GET['pw'] : '';
    if ($chk_pass !== $run_pass) {
        die("Wrong password for this file.");
    }
}


/**
 * Return the filename according to settings
 */
function get_backup_filename($backup_cycle = 'timestamp')
{
    switch ($backup_cycle) {
        case 'timestamp':
            $bkup_filename = date("Ymd_His", time());
            break;
        default:
            $bkup_filename = date($backup_cycle, time());
    }
    return $bkup_filename;
}

// mysql backup script from https://github.com/ifsnop/mysqldump-php
//for instructions, see: https://github.com/ifsnop/mysqldump-php
include_once(dirname(__FILE__) . '/Mysqldump/Ifsnop/Mysqldump/Mysqldump.php');
use Ifsnop\Mysqldump as IMysqldump;

$dumpSettings = array(
    'include-tables' => array(),
    'exclude-tables' => array(),
    'default-character-set' => IMysqldump\Mysqldump::UTF8,             
    'no-data' => false,
    'add-drop-table' => true,
    'single-transaction' => true,
    'lock-tables' => true,
    'add-locks' => true,
    'extended-insert' => true,
    'disable-foreign-keys-check' => true,
    'skip-triggers' => false,
    'add-drop-trigger' => true,
    'databases' => true,
    'add-drop-database' => true,
    'hex-blob' => true
);


//START create useful filename
switch (BACKUP_COMPRESSION) {
    case 'BZIP2':
        $dumpSettings['compress'] = IMysqldump\Mysqldump::BZIP2; 
        $ext = '.bz2';
        break;
    case 'GZIP':
        $dumpSettings['compress'] = IMysqldump\Mysqldump::GZIP; 
        $ext = '.gz';        
        break;
    default:
        $dumpSettings['compress'] = IMysqldump\Mysqldump::NONE; 
        $ext = '';        
        break;
}

$backup_filename_complete .= $ext;
//END create useful filename

//remove old file first
@unlink ($backup_filename_complete);


//do database dump, see https://github.com/ifsnop/mysqldump-php
$dump_database = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
$dump = new Ifsnop\Mysqldump\Mysqldump($dump_database, DB_USER, DB_PASSWORD, $dumpSettings);
$dump->start(BACKUP_DIR . '/' . $backup_filename_complete);

echo "created " . BACKUP_DIR . '/' . $backup_filename_complete . "<br />";
echo "done " . date("Y-m-d H:i:s", time()) ."<br />";
?>