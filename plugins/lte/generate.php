<?php
// 
// Author: Alejandro Landini
// generate.php 15/11/19
// toDo:        *complete install inctructions
// revision:
// 
//

include(dirname(__FILE__) . "/header.php");
$lte_class = new lte_class(array(
        'title' => 'Landini AdminLTE Template',
        'name' => 'AdminLTE Template',
        'logo' => 'template.png',
        'output_path' => $_REQUEST['path']
    ));

// validate project name
if (!isset($_GET['axp']) || !preg_match('/^[a-f0-9]{32}$/i', $_GET['axp'])) {
	echo "<br>".$lte_class->error_message('Project file not found.');
	exit;
}
$projectFile = '';
$xmlFile = $lte_class->get_xml_file($_GET['axp'], $projectFile);

//-------------------------------------------------------------------------------------
//path check 
	try{
		if (!isset( $_POST['path'])){
			throw new RuntimeException('This page has expired');
		}
		
		$path = rtrim(trim($_POST['path']), '\\/');
		if (! is_dir($path)){
			throw new RuntimeException('Invalid path');
		}
		

		if ( ! ( file_exists("$path/lib.php") && file_exists("$path/db.php") && file_exists("$path/index.php") ) ){
			throw new RuntimeException('The given path is not a valid AppGini project path');
		}
		
		if (! is_writable($path."/hooks")){
			throw new RuntimeException('The hooks folder of the given path is not writable');
		}
		
		if (! is_writable($path."/resources")){
			throw new RuntimeException('The resources folder of the given path is not writable');
		}
	} catch (RuntimeException $e){
			echo "<br>".$lte_class->error_message($e->getMessage());
			exit;
	}
//-------------------------------------------------------------------------------------

$write_to_hooks = ($_REQUEST['dont_write_to_hooks'] == 1 ? false : true);

?>

<div class="bs-docs-section row">
    <h1 class="page-header"><img src="template.png" style="height: 1em;"> AdminLTE tenmplate for AppGini</h1>
    <p class="lead"><a href="./index.php">Projects</a> > <a href="./project.php?axp=<?php echo $_GET['axp']; ?>"><?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?></a> > <a href="./output-folder.php?axp=<?php echo $_GET['axp'] ?>">  Select output folder</a> > Enabling Landini AdminLTE
	</p>

</div>

<h4>Progress log</h4>

<?php
	$lte_class->progress_log->add("Output folder: $path", 'text-info');

	//coping resources folders
	
	$lte_class->progress_log->ok();
	$lte_class->progress_log->line();

	//coping files
    $lte_class->progress_log->add("<b>Copying new files for '" . substr( $projectFile , 0 , strrpos( $projectFile , ".")) . "' project:</b>");
        
	$source_class = dirname(__FILE__) . '/app-resources/config.json';
	$dest_class = $path.'/LTE/config.json';
	$lte_class->copy_file($source_class, $dest_class, true);	
	
	// $source_class = dirname(__FILE__) . '/app-resources/mpi.js';
	// $dest_class = $path.'/hooks/mpi.js';
	// $lte_class->copy_file($source_class, $dest_class, true);	
	
	// $source_class = dirname(__FILE__) . '/app-resources/mpi.php';
	// $dest_class = $path.'/hooks/mpi.php';
	// $lte_class->copy_file($source_class, $dest_class, true);	
	
	// $source_class = dirname(__FILE__) . '/app-resources/mpi_AJAX.php';
	// $dest_class = $path.'/hooks/mpi_AJAX.php';
	// $lte_class->copy_file($source_class, $dest_class, true);	
	
	// $source_class = dirname(__FILE__) . '/app-resources/mpi_template.html';
	// $dest_class = $path.'/hooks/mpi_template.html';
	// $lte_class->copy_file($source_class, $dest_class, true);
        
	// $source_class = dirname(__FILE__) . '/app-resources/no_image.png';
	// $dest_class = $path.'/images/no_image.png';
	// $lte_class->copy_file($source_class, $dest_class, true);
		
	$files = ['header', 'footer', 'home'];

	$extra_function = false;
	$code='
	<?php
	//enable LTE Admin
	//TODO: verificar si exite el archivo primero antes de incluirlo
	include_once "LTE/config_lte.php";
	if (getLteStatus()){
		$fn = basename(__FILE__, ".php"); 
		include_once("LTE/".$fn."_lte.php");
		return;
	}
	?>
	';
	foreach($files as $fn){
		$file_path= $path . "/$fn.php" ;
        $res = $lte_class->add_to_file($file_path, $extra_function , $code);
	
        if($res){
                $lte_class->progress_log->add("Installed code into '{$file_path}'.", 'text-success spacer');
        }else{
            $error = $lte_class->last_error();

            if($error == 'Code already exists'){
                    $lte_class->progress_log->add("Skipped installing to '{$file_path}', code is already installed.", 'text-warning spacer');
            }else{
                    $lte_class->progress_log->add("Failed to install code '{$file_path}': {$error}", 'text-danger spacer');
                    $lte_class->progress_log->add($install_instructions, 'spacer');
            }
        }
		
	};
		
	echo $lte_class->progress_log->show();
?>

<center>
	<a style="margin:20px;" href="index.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-home" ></span>   Start page</a>
	<a style="margin:20px;" href="../../LTE/jsonedit.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-cog" ></span>   Edit Enviroment</a>
</center>

<script>	
	$j( function(){

		$j("#progress").height( $j(window).height() - $j("#progress").offset().top - $j(".btn-success").height() - 100 );

		//add resize event
		$j( window ).resize(function() {
		   $j("#progress").height( $j(window).height() - $j("#progress").offset().top - $j(".btn-success").height() - 100 );
		});

	});
</script>

<?php include(dirname(__FILE__) . "/footer.php"); ?>