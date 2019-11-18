<?php
	include(dirname(__FILE__) . '/header.php');

	// validate project name
	if (!isset($_REQUEST['axp']) || !preg_match('/^[a-f0-9]{32}$/i', $_REQUEST['axp'])){
		echo '<br>' . $lte_class->error_message('Project file not found.');
		exit;
	}
	
	$axp_md5 = $_REQUEST['axp'];
	$projectFile = '';
	$xmlFile = $lte_class->get_xml_file($axp_md5, $projectFile);
//-----------------------------------------------------------------------------------------
?>

<script>
	var project = <?php echo json_encode($xmlFile); ?>;
	var axp_md5 = <?php echo json_encode($axp_md5); ?>; 
	
	function get_caption( table , field_name ){
		
		if( field_name === undefined ){
			for ( var key in project.table ) {
				if ( project.table[key].name === table ) {
					return project.table[key].caption; 
				}
			} 
		} 
		
		var table_fields = project.table[table].field;
		
		for (var key in table_fields ) {
			if ( table_fields[key].name == field_name ) {
				return table_fields[key].caption; 
			}
		}
	}
	
	
	function get_field_index(table_index, field_name ){
		var table_fields = project.table[table_index].field;
		
		for (var key in table_fields ) {
			if ( table_fields[key].name == field_name ) return key; 	
		}
		return false;
	}
	
	function is_lookup_field(table_index, field_name){
		
		var field_index = get_field_index(table_index, field_name );
		if( field_index === false ) return false ;
		
		if( typeof project.table[table_index].field[field_index].parentTable!="string" ){
			return false;
		}
		
		return true;
	}
	
	//get lookup table
	function get_lookup_table(table_index, field_name){
		var field_index = get_field_index(table_index, field_name);
		return project.table[table_index].field[field_index].parentTable;
		 
	}
	
	//get lookup value
	
	function get_lookup_value(table_index, field_name){
	
		var field_index = get_field_index(table_index, field_name);
		return project.table[table_index].field[field_index].parentCaptionField;
		 
	}
	
	function get_table_index(table_name){
		for ( var key in project.table ) {
				if ( project.table[key].name === table_name) {
					return parseInt( key ); 
				}
			}
	}
	
	function get_group_function_caption( group_function) {
		var aggregate_functions = {'Average':'avg','Count':'count','Sum':'sum','Maximum':'max','Minimum':'min'};
		
		for ( var key in aggregate_functions ) {
				if (aggregate_functions[key] == group_function) {
					return key ;
				} 
			}	
	}
	
	
	function get_table_ancestors( table , callback ){
		var table_ancestors	= {};
		if(window.AppGini === undefined) window.AppGini = {};
		AppGini.get_table_ancestors = AppGini.get_table_ancestors || {};
		
		if(AppGini.get_table_ancestors[table] != undefined){
			processTableAncestors(table, callback);
			return;
		}

		/* Send ajax request to update the node */
		$j.ajax({
			url: 'table-ancestors-ajax.php?axp=' + axp_md5 + '&table_name=' + table_name,
			success: function(data){
				AppGini.get_table_ancestors[table] = JSON.parse(data);
				processTableAncestors(table, callback);
			}
		});
	}
	
	function processTableAncestors(table, callback){
		$j('#group-table').empty();
		$j('#group-table').append($j("<option></option>").attr("value", '').text('')); 
		$j.each(AppGini.get_table_ancestors[table], function(index, value) {   
			$j('#group-table').append($j("<option></option>").attr("value", value).text(value)); 
			if(typeof(callback) == 'function'){ callback(); }
		});
	}

	function fill_label_field(table){
		$j( '#label' ).empty();
		var labels = {};
		var table_fields = [];
		var tables = project[ "table" ];
	
		/* Detects the type of the passed parmeter and retrives it's fields  */
		if( typeof table == 'string' ){	
			for( var i = 0 ; i < tables.length ; i++ ){
				if( tables[i]["name"] == table ){
					table_fields = tables[i]["field"];
				}
			}
		}else{
			table_fields = tables[table]["field"];
		}
		
		/* Loop over table fields and categoriez them */
		
		for( var j = 0; j < table_fields.length ; j++ ){
			labels[ table_fields[j]["caption"] ] = table_fields[j]["name"];
		}

		/* update labels select */
		$j( '#label' ).append( $j("<option></option>" ).attr( "value" , '' ).text('')); 
		$j.each( labels , function( key , value ) { 
			$j( '#label' ).append( $j( "<option></option>" ).attr( "value" , value ).text( key ) ); 
		});			
	}
	
	$j(function(){
		var table = $j('#group-table').val();
		
		/* Triggring Add and Edit Modal Events */
	 	$j('#group-table').on('change',function(){
	
			var table=$j('#group-table').val();
			var selected_table_name=project["table"][selected_table]["name"];
			$j('#label').empty();
			fill_label_field(table);
		}); 
				
		$j('#report-title').keyup(function(){
			if($j(this).val() != '') $j('#title-validation').addClass('hidden');
		});
		
		$j('#label').change(function(){
			if($j(this).val() != '') $j('#label-validation').addClass('hidden');
		});
	})
</script>

<div class="page-header row">
	<h1><img src="template.mid.png" style="height: 1em;"> Landini AdminLTE Enable for AppGini</h1>
	<h1>
		<a href="./index.php">Projects</a> &gt; <?php echo substr($projectFile, 0, -4); ?>
		<a href="output-folder.php?axp=<?php echo $axp_md5; ?>" class="pull-right btn btn-success btn-lg col-md-3 col-xs-12"><span class="glyphicon glyphicon-play"></span>  Enable template</a>
		<div class="clearfix"></div>
	</h1>
</div>

<div class="row">
	<div class="col-md-4"> 
		<h3>Tables groups list</h3>
		<?php 
		$resources_dir = dirname(__FILE__);
		$groups=explode(",",$lte_class->project_xml->groups);
		echo $lte_class->group_view("{$resources_dir}/views/group-list.php",$groups);
		$tables = $xmlFile->table;
		?>
	</div>
	<div class="col-md-8">
		<?php 
		$resources_dir = dirname(__FILE__);
		$groups=explode(",",$lte_class->project_xml->groups);
		echo $lte_class->group_view("{$resources_dir}/views/enviroment.php",$groups);
		?>
	</div>
</div>


<style>
	.panel tr:first-child th, .panel tr:first-child td {
		border-top: none !important;
	}
	.panel-title{ font-weight: bold; }
</style>

<?php
include(dirname(__FILE__) . '/footer.php'); ?>
