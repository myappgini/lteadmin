<?php if(!isset($this)) die("You can't call this file directly."); 

$user_group = strtolower($user_data["group"]);
?>
<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>plugins/lte/app-resources/jsonedit/jsonedit.css">
<script src="<?php echo PREPEND_PATH; ?>plugins/lte/app-resources/jsonedit/jquery.jeditable.js"></script>
<script src="<?php echo PREPEND_PATH; ?>plugins/lte/app-resources/jsonedit/jquery.contextMenu.js"></script>
<script src="<?php echo PREPEND_PATH; ?>plugins/lte/app-resources/jsonedit/jsonedit.js"></script>
<script>
	$j(function() {

		$j('#json_editor').html('');

		json_editor('json_editor', $j('.jsoninput').val());

		// add the jquery editing magic
		apply_editlets();

		$j('.jsoninput').click(function() {
			$j(this).focus();
			$j(this).select();
		});
		setTimeout(function(){
			save_ws('json_editor','<?php echo PREPEND_PATH; ?>'+'plugins/lte/app-resources/'+'jsonsave.php'); 
		}, 2000);
	});
</script>
<div class="json-edit">
	<div class="box">
		<div class="box-header">
			<div class="col-lg-4">
				<a class="btn btn-app" onclick="load_from_box('jsonglobals');" title="reset to last changues">
					<i class="fa fa-repeat" ></i> Reset
				</a>
				<a class="btn btn-app" onclick="save_ws('json_editor','<?php echo PREPEND_PATH; ?>'+'plugins/lte/app-resources/'+'jsonsave.php'); " title="save changues to server">
						<i class="fa fa-save"></i> Save
				</a>
			</div>
			<div class="callout callout-success col-lg-8">
				<h4>Editing Application varibles and icon group</h4>
				<p>
					.. Delete nodes (right click to delete)<br>
					.. Add nodes (options below a container)
				</p>
			</div>
		</div>
		<div class="box-body">
			<div>
				<textarea id="jsonglobals" rows="20" cols="30" class="jsoninput" hidden>
							<?php
							//$iconsGroups = '"Icon Groups":{"logins":"fa fa-table"}';
							$globalsEnv = json_decode(file_get_contents(PREPEND_PATH."plugins/lte/app-resources/config-globals.json"));
							foreach($groups as $gr){
								if ($gr == 'None') continue;
								$a[$gr] = "fa fa-table";
							}
							$iconsGroups['Icon Groups'] =$a;
							$res[] = $globalsEnv ;
							$res[] = $iconsGroups;
							echo json_encode($res,true);

							?>
				</textarea>
			</div>
			<div >
				<div id="json_editor" data-role="myjson"></div>
			</div>
		</div>

	</div>
</div>
<!-- END visible area//-->
<div style="display:none">
	<div data-type="object"></div>
	<div data-type="array"></div>
</div>