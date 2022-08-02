<link href="https://unpkg.com/tabulator-tables@5.1.8/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.1.8/dist/js/tabulator.min.js"></script>
<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../lib.php");
    include("$hooks_dir/../header.php");
     
    /* grant access to all logged users */
    $mi = getMemberInfo();
    
    if(!$mi['username'] || $mi['username'] == 'guest'){
        echo "Access denied";
        exit;
    }

    $query = sql("SELECT * FROM `log_sheet`", $eo); //Change this line to use your desired table
    
    $json_array = array();  
        while($row = mysqli_fetch_assoc($query))  
        {  
            $json_array[] = $row;
        }  
    $json = json_encode($json_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>

<div id="table"></div>
<script>
  var tabledata = <?php echo $json;?>;

  var table = new Tabulator("#table", {
      data:tabledata,           //load row data from array
      layout:"fitColumns",      //fit columns to width of table
      responsiveLayout:"hide",  //hide columns that dont fit on the table
      pagination:"local",       //paginate the data
      paginationSize:7,         //allow 7 rows per page of data
      movableColumns:true,      //allow column order to be changed
      resizableRows:true,       //allow row order to be changed
      // groupBy:"dept",       //allow row order to be changed
      autoColumns:true, //create columns from data field names
  });

</script>