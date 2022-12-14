<?php

include 'tables_config_lte.php';
include 'groups_config_lte.php';

$groups = get_table_groups();
$i=0;
foreach ($groups as $grp => $tables) {
    # code...
    $tlink = '';
    if ($grp !== "None") {
        // code...
        $i++;
        $collapse=($i==1)?'':'collapsed-card';
        $gn = str_replace(" ", "_", $grp);
        $group_hpd=$cjson[$gn . '_hpd'] ? $cjson[$gn . '_hpd'] : 'default';
        $group_cc=$cjson[$gn . '_cc'] ? $cjson[$gn . '_cc'] : 'primary';
        if($group_hpd=="default"){
            $linkstop = '<h5 class="mb-2 mt-4">' . $grp . '</h5>
            <div class="row">';
        }
        else{
        $linkstop = '<div class="col-md-12">
        <div class="card card-'.$group_cc.' '.$collapse.'">
          <div class="card-header">
            <h3 class="card-title">'.$grp.'</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body"><div class="row">';
        }
        foreach ($tables as $tn) {
            $json = json_encode(get_tables_info(true));
            $decode = json_decode($json);
            $table_title = $decode->$tn->Caption;
            $tableIcon = $decode->$tn->tableIcon;
            $sql_from = get_sql_from($tn, false, true);
            $count_records = ($sql_from ? sqlValue("select count(1) from " . $sql_from) : 0);
            $jtt = str_replace(" ", "_", $table_title);
            $card_color = $djson[$jtt . '_color'] ? $djson[$jtt . '_color'] : 'primary';
            $card_icon = $djson[$jtt . '_icon'] ? $djson[$jtt . '_icon'] : 'default';
            $card_fa = $djson[$jtt . '_fa'] ? $djson[$jtt . '_fa'] : 'fa fa-trophy';
            $card_hidden = $djson[$jtt . '_hidden_hp'] ? $djson[$jtt . '_hidden_hp'] : '';
            $show_icon = ($card_icon == 'default') ? '<i> <img src="' . $tableIcon . '"></i>' : '<i class="' . $card_fa . '"></i>';
            /* hide current card in homepage? */
            if (strpos($card_hidden, $group) === false) {
                $tlink .= ' <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-' . $card_color . '">
                <div class="inner">
                    <h3>' . number_format($count_records) . '</h3>
    
                    <p>' . $table_title . '</p>
                </div>
                <div class="icon">
                    ' . $show_icon . '
                </div>
                <a href="appginilte_view.php?page=' . $tn . '_view.php?Embedded=true" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>';
            }
        }
        if($group_hpd=="default"){
            $linksbottom = '</div>';
        }
        else{
        $linksbottom = '</div></div></div></div>';
        }
        echo empty($tlink)?'': $linkstop . $tlink . $linksbottom;
    } else {
        foreach ($tables as $tn) {
            $json = json_encode(get_tables_info(true));
            $decode = json_decode($json);
            $table_title = $decode->$tn->Caption;
            $tableIcon = $decode->$tn->tableIcon;
            $sql_from = get_sql_from($tn, false, true);
            $count_records = ($sql_from ? sqlValue("select count(1) from " . $sql_from) : 0);
            $jtt = str_replace(" ", "_", $table_title);
            $card_color = $djson[$jtt . '_color'] ? $djson[$jtt . '_color'] : 'primary';
            $card_icon = $djson[$jtt . '_icon'] ? $djson[$jtt . '_icon'] : 'default';
            $card_fa = $djson[$jtt . '_fa'] ? $djson[$jtt . '_fa'] : 'fa fa-trophy';
            $card_hidden = $djson[$jtt . '_hidden_hp'] ? $djson[$jtt . '_hidden_hp'] : '';
            $show_icon = ($card_icon == 'default') ? '<i> <img src="' . $tableIcon . '"></i>' : '<i class="' . $card_fa . '"></i>';
            /* hide current card in homepage? */
            if (strpos($card_hidden, $group) === false) {
                $tlink .= ' <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-' . $card_color . '">
                <div class="inner">
                    <h3>' . number_format($count_records) . '</h3>
    
                    <p>' . $table_title . '</p>
                </div>
                <div class="icon">
                    ' . $show_icon . '
                </div>
                <a href="appginilte_view.php?page=' . $tn . '_view.php?Embedded=true" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>';
            }
        }
        echo '<div class="row">' . $tlink . '</div>';
    }
}
