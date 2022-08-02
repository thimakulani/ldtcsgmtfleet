<?php
    define('PREPEND_PATH', '../');
    include(PREPEND_PATH."lib.php");
    include(PREPEND_PATH."header.php");

    $table_perms = getTablePermissions('gmt_fleet_register'); //Change your table name here ********************
    if(!$table_perms['view']) die('// Access denied!');

    $query = sql("SELECT * FROM gmt_fleet_register", $eo); //Change your table name here ********************
    
    $json_array = array();  
    while($row = mysqli_fetch_assoc($query))  
    {  
        $data[] = $row;
    }  
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?> 

<link href="https://unpkg.com/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>

<body>
	<div class="input-group">
		<select class="form-control form-control-sm" id="exportSelector">
			<option value="">Export as...</option>
			<option value="print"> PRINT</option>
			<option value="csv"> CSV</option>
			<option value="xlsx"> XLS</option>
			<option value="json"> JSON</option>
			<option value="pdf"> PDF</option>
			<option value="view"> View PDF</option>
		</select>
	</div>
	<div id="table"></div>
</body>

<script>
    var tabledata = <?php echo $json;?>;
    var table = new Tabulator("#table", {
			data:tabledata,
			reactiveData:true,
			height: "auto",
			paginationSize: 30,
			paginationSizeSelector:[50,100,200],
			clipboard:true,
			clipboardPasteAction:"replace",
			clipboardCopyConfig:{
				columnHeaders:false,
				columnGroups:false,
				rowGroups:false,
				columnCalcs:false,
				dataTree:false,
				formatCells:false,
			},
			printAsHtml:true,
			printStyled:true,
			printConfig:{
				columnHeaders:true,
				columnGroups:false,
				rowGroups:true,
				columnCalcs:false,
				dataTree:false,
				formatCells:true,
			},
			layout:"fitColumns",
			responsiveLayout:"collapse",
			initialSort:[
				{column:"done", dir:"desc"},
			],
			pagination:"local",
			groupStartOpen:false,
			groupToggleElement:"header",
			movableColumns: true,
					autoColumns:true, 
			});

			var activities = document.getElementById("exportSelector")
			activities.addEventListener("change", function() {
				if(activities.value == "print") {
					table.print(false, true)
				}
				if(activities.value == "csv") {
					table.download("csv", "data.csv")
				}
				if(activities.value == "json") {
					table.download("json", "data.json")
				}
				if(activities.value == "xlsx") {
					table.download("xlsx", "data.xlsx", {sheetName:"Data Export"})
				}
				if(activities.value == "pdf") {
					table.download("pdf", "data.pdf")
				}
				if(activities.value == "view") {
					table.downloadToTab("pdf", "data.pdf")
				}
			});

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<style type="text/css" media="print">
	@page { size: landscape; }
</style>