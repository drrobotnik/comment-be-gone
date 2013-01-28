#!/usr/bin/php -q
<?php

/**
* Cleans out comments
*/
class ClearComments {

	public $clean_dir_name = "clean";
	public $curr_dir = '';
	public $clean_dir = '';

	function __construct(){
		$shell_dir = shell_exec('pwd');
		$this->curr_dir = filter_var($shell_dir, FILTER_SANITIZE_URL);
		$this->clean_dir = $this::createCleanDir();
		$this::createCleanFiles();

	}

	private function createCleanDir(){
		$clean_dir = $this->curr_dir.'/'.$this->clean_dir_name;

		if(is_dir($clean_dir)){
			shell_exec('rm -rf '.$clean_dir);
		}
		shell_exec('mkdir '.$clean_dir);
		$result = $clean_dir;
		return $result;
	}

	private function createCleanFiles(){
		$list = shell_exec('ls *.php');
		$list_array = explode('
',$list);
		$list = array_filter($list_array);
		foreach($list as $file){
			$filestr = file_get_contents($file);
			//$newFile = $this->clean_dir.'/'.$file;
			$newStr  = '';
			$commentTokens = array(T_COMMENT);

			if (defined('T_DOC_COMMENT'))
				$commentTokens[] = T_DOC_COMMENT; // PHP 5
			if (defined('T_ML_COMMENT'))
				$commentTokens[] = T_ML_COMMENT;  // PHP 4

			$tokens = token_get_all($filestr);

			foreach ($tokens as $token) {
				if (is_array($token)) {
					if (in_array($token[0], $commentTokens))
						continue;
					$token = $token[1];
				}
				$newStr .= $token;
			}
			$finalStr = preg_replace('/<!--(?!<!)[^\[>].*?-->/', '', $newStr);
			file_put_contents($file, $finalStr);
		}
	}
}

new ClearComments();