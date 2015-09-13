<?php

class CommonLoader {

	static function load($classname) {

		$dirs = array('API','API/books','Helper','Models','Util','Libaray/Zend','Helper/Search/Analyzer');

		foreach($dirs as $dir){
			
			$directories = explode('_', $classname);
			
			$filename = array_pop($directories);//获取类文件名
			
			$filepath = $filename.'.php';
			
			if (is_array($directories) && (count($directories)>0)){
				
				$dirpath = '';
				
				foreach ($directories as $direcotry){
					if ($direcotry){
						$dirpath .= $direcotry.'/';
					}
					
				}
				
				$filepath = $dirpath.$filename.'.php';
				
			}

			$filepath =dirname(__FILE__).'/'.$dir.'/'.$filepath;

			if(is_file($filepath)){
				// echo $filepath;
				return require_once $filepath;
			}

		}
	}


	public static function loadQiniu($class)
	{
		$filename = dirname(__FILE__).'/API/'.str_replace('\\', '/', $class).'.php';

		if(file_exists($filename)){
			include_once $filename;
			// echo "找到了，$filename ~\n";
		}
		// else
		// {
		// 	echo "客官，我们努力找到了，$filename 没有哦:~\n";
		// }

		$filename = dirname(__FILE__).'/'.str_replace('\\', '/', $class).'.php';

		if(file_exists($filename)){
			include_once $filename;
			// echo "找到了，$filename ~\n";
		}
		// else
		// {
		// 	echo "客官，我们努力找到了，$filename 没有哦:~\n";
		// }
	}

	

}
spl_autoload_register(array('CommonLoader','load'));
spl_autoload_register(array('CommonLoader','loadQiniu'));

include_once __DIR__.'/API/Qiniu/functions.php';


?>
