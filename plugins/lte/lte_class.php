<?php
	include(dirname(__FILE__).'/../plugins-resources/loader.php');

	class lte_class extends AppGiniPlugin{
		/* add any plugin-specific properties here */
		
		public function __construct($config = array()){
			parent::__construct($config);
			
			/* add any further plugin-specific initialization here */
		}
		
		/* add any further plugin-specific methods here */
                
                /**
		 * Injects provided code to a file
		 * @param $file_path the full path of the file
		 * @param $find_function name of the extras function to inject code into
		 * @param $code the [PHP] code to inject to the file
		 * @param $location 'top' injects code directly after function declaration line
		 *                  'bottom' injects code directly before the last return statement in the
		 *                           function or before the ending curly bracket if no return statement
		 *                           found before it.
		 *                  >>>> 'bottom' is not yet supported -- only 'top' is supported now.
		 * @return true on success, false on failure
		 */

		public function add_to_file($file_path, $find_function = false, $code, $location = 0){
			/* Check if file exists and is writable */
			$file_code = @file_get_contents($file_path);
                        if (filesize($file_path)>0){
                            if(!$file_code) return $this->error('add_to_file', 'Unable to access file: '.$file_path);
                        }
			
                        /* Find extra function */
                        if ($find_function){
                                $search = '/('.$find_function.')/' ;
                                preg_match_all($search, $file_code, $matches, PREG_OFFSET_CAPTURE);
                                if(count($matches) < $location + 1) {
                                        return $this->error('add_to_file', 'Could not determine correct function location');
                                }
                                /* start position of extra function */
                                $hf_position = $matches[0][$location][1];

                                /* position of next function, or EOF position if this is the last function in the file */
                                $nf_position = strlen($file_code);
                                preg_match_all('/(<!-- group and IP address -->)/', $file_code, $matches, PREG_OFFSET_CAPTURE, $hf_position + 10);
                                if(count($matches)) $nf_position = $matches[0][0][1];
                                /* extras function code */
                                $old_function_code = substr($file_code, $hf_position, $nf_position - $hf_position);
                        }else{
                                $old_function_code = substr($file_code, 0);
                        }


                        /* Checks $code is not already in there */
                        if(strpos($old_function_code, $code) !== false) {
                                return $this->error('add_to_file', 'Code already exists');
                        }

                        /* insert $code and save */
                        $code_comment = "/* Inserted by {$this->title} on " . date('Y-m-d h:i:s') . " */";
                        $new_code ="\n\t\t<?php {$code_comment} ?>\n\t\t{$code}\n\t\t<?php /* End of {$this->title} code */ ?>\n";

                        $new_function_code = preg_replace(
                                "/".makeSafe($find_function)."/" ,
                                $new_code,
                                $old_function_code, 
                                1
                        );
                        if(!$new_function_code) return $this->error('add_to_file', 'Error while injecting code');
                        if($new_function_code == $old_function_code) return $this->error('add_to_file', 'Nothing changed');

                        $file_code = substr_replace($file_code, $new_function_code,$hf_position + strlen($find_function) ,0);
                        if(!@file_put_contents($file_path, $file_code)) return $this->error('add_to_file', 'Could not save changes');
				
			return true;
                }
                
                /**
		 * Loads a given view, passing the given data to it
		 * @param $view the path of a php file to be loaded
		 * @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
		 * @return the output of the parsed view as a string
		 */
		public function group_view($view, $groups=false){
			if(!is_file($view)) return $this->error('view', "'{$view}' is not a file");

			ob_start();
			@include($view);
			$out = ob_get_contents();
			ob_end_clean();

			return $out;
		}
	}
