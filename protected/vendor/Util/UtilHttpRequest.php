<?php
class UtilHttpRequest extends CHttpRequest
{
	public function init()
	{
		parent::init();
	}
	
	// 说明：获取完整URL
	public static function getCurrentUrl()
	{
	    $pageURL = 'http';
	
	    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
	    {
	        $pageURL .= "s";
	    }
	    $pageURL .= "://";
	
	    if ($_SERVER["SERVER_PORT"] != "80")
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	    }
	    else
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;
	}
	
	//使用Snoopy获取远程URL内容
    
	public static function snoopyFetchRemoteUrl($url)
	{
		$snoopy = new Snoopy();
		$snoopy->fetch($url);
		return $snoopy->results;
	}
	
	//获取Short Url
	public static function shortUrl($url)
	{
		
		$server = Yii::app()->params->shortUrlServer;
		
		$short = new ShortUrl();
		return $short->getShortenUrl($server, $url);
	}
    
   	public static function jfsockopen($hostname, $port, $errno, $errstr, $timeout) {
		$fp = false;

		if(function_exists('fsockopen')) {
			@$fp = fsockopen($hostname, $port, $errno, $errstr, $timeout);
		} elseif(function_exists('pfsockopen')) {
			@$fp = pfsockopen($hostname, $port, $errno, $errstr, $timeout);
		}

		return $fp;
	}
    
    //获取远程URL内容
    public static function fetchRemoteUrl($url, $limit = 10485760 , $post = '', $cookie = '', $bysocket = false,$timeout=5,$agent="") {
    	if(ini_get('allow_url_fopen') && !$bysocket && !$post) {
    		$fp = @fopen($url, 'r');
    		$s = $t = '';
    		if($fp) {
    			while ($t=@fread($fp,2048)) {
    				$s.=$t;
    			}
    			fclose($fp);
    		}
    		if($s) {
    			return $s;
    		}
    	}
    
    	$return = '';
    	$agent=$agent?$agent:"Mozilla/5.0 (compatible; Googlebot/2.1; +http:/"."/www.google.com/bot.html)";
    	$matches = parse_url($url);
    	$host = $matches['host'];
    	$script = $matches['path'].($matches['query'] ? '?'.$matches['query'] : '').($matches['fragment'] ? '#'.$matches['fragment'] : '');
    	$script = $script ? $script : '/';
    	$port = !empty($matches['port']) ? $matches['port'] : 80;
    	if($post) {
    		$out = "POST $script HTTP/1.1\r\n";
    		$out .= "Accept: */"."*\r\n";
    		$out .= "Referer: $url\r\n";
    		$out .= "Accept-Language: zh-cn\r\n";
    		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
    		$out .= "Accept-Encoding: none\r\n";
    		$out .= "User-Agent: $agent\r\n";
    		$out .= "Host: $host\r\n";
    		$out .= 'Content-Length: '.strlen($post)."\r\n";
    		$out .= "Connection: Close\r\n";
    		$out .= "Cache-Control: no-cache\r\n";
    		$out .= "Cookie: $cookie\r\n\r\n";
    		$out .= $post;
    	} else {
    		$out = "GET $script HTTP/1.1\r\n";
    		$out .= "Accept: */"."*\r\n";
    		$out .= "Referer: $url\r\n";
    		$out .= "Accept-Language: zh-cn\r\n";
    		$out .= "Accept-Encoding: none\r\n";
    		$out .= "User-Agent: $agent\r\n";
    		$out .= "Host: $host\r\n";
    		$out .= "Connection: Close\r\n";
    		$out .= "Cookie: $cookie\r\n\r\n";
    	}
    
    	$fp = self::jfsockopen($host, $port, $errno, $errstr, $timeout);
    
    	if(!$fp) {
    		return false;
    	} else {
    		fwrite($fp, $out);
    		$return = '';
    		while(!feof($fp) && $limit > -1) {
    			$limit -= 8192;
    			$return .= @fread($fp, 8192);
    			if(!isset($status)) {
    				preg_match("|^HTTP/[^\s]*\s(.*?)\s|",$return, $status);
    				$status=$status[1];
    				if($status!=200) {
    					return false;
    				}
    			}
    		}
    		fclose($fp);
    				preg_match("/^Location: ([^\r\n]+)/m",$return,$match);
    		if(!empty($match[1]) && $location=$match[1]) {
    			if(strpos($location,":/"."/")===false) {
    				$location=dirname($url).'/'.$location;
    			}
    			$args=func_get_args();
    			$args[0]=$location;
    			return call_user_func_array("dfopen",$args);
    		}
    		if(false!==($strpos = strpos($return, "\r\n\r\n"))) {
    			$return = substr($return,$strpos);
    			$return = preg_replace("~^\r\n\r\n(?:[\w\d]{1,8}\r\n)?~","",$return);
    			if("\r\n\r\n"==substr($return,-4)) {
    				$return = preg_replace("~(?:\r\n[\w\d]{1,8})?\r\n\r\n$~","",$return);
    			}
    		}
    
    		return $return;
    	}
    }
    
    public static function simpleLocalize($url, $target)
    {
        //$content = self::snoopyFetchRemoteUrl($url);
        $content = self::fetchRemoteUrl($url);
        
        if(!is_dir(dirname($target)))
            UtilFile::createDir(dirname($target));
            
        file_put_contents($target,$content);
        
    }
    
    /**
     * 此方法用来验证远程文件是否存在
     * @param string $url
     */
    public static function remoteFileExists($url)
    {
    	$curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_NOBODY, true); 
	    $result = false;
	    $res = curl_exec($curl); 
		if ($res !== false){
			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			if($statusCode == 200) {
				$result = true;
			}
		}
		curl_close($curl);
		return $result;
    }
    

    
   	/**
	 * @todo 远程文件本地化
	 * @param unknown_type $url
	 */
	public static function resourceLocalize($filename, $target='./public/favorite/')
	{
//		$filename = 'http://a.hiphotos.baidu.com/ting/pic/item/dcc451da81cb39db2a8f6ce2d0160924ab183032.jpg';
		
		$header = get_headers($filename,1);
		
//		UtilHelper::dump($header);
		
//		echo strpos($header[0],'OK');
		
		if ( strpos($header[0],'OK') < 0)
		{
			echo '远程文件不存在';
            die();
		}else{
			
			$pathinfo = pathinfo($filename);
			
			$target = $target.$pathinfo['basename'];
			
//			UtilHelper::createFolder(dirname($target));
			
//    		UtilHelper::dump($pathinfo);
            
            $pathinfo['size'] = $header['Content-Length'];
            $pathinfo['mime'] = $header['Content-Type'];
			
			$content = file_get_contents($filename);
			if(file_put_contents($target, $content))
            {
                $pathinfo['state'] = "OK";
                
                return $pathinfo;  
            }
		}	
	} 
}