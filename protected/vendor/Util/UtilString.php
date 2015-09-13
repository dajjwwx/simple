<?php
/**
 *  @author Administrator
 *  @name UtilString
 *  @todo 实现一些常用的字符串处理方法
 *  @author 冷月十三<zclandxy@gmail.com>
 *  @copyright	悦珂工作室<http://lab.yuekegu.com>
 *  
 *  ****************************************************************************
 *  Method List：
 *  UtilString::similarCompare($str1,$str2);	//计算字符串相似度
 *  
 *  
 *
 */
class UtilString {
	
	/**
	 * 计算字符串相似度
	 * @param unknown_type $str1
	 * @param unknown_type $str2
	 * @return number
	 */
	public static function similarCompare($str1,$str2){
	
		//		$str1        = "四川省成都市15街23号";
		//		$str2        = "四川成都15街yyy号";
			
		$cncharnum1        = preg_match_all("/[\xB0-\xF7][\xA1-\xFE]/", $str1,$zharr1);
		$ennum1                = preg_match_all("/[0-9a-zA-Z]+/", $str1,$enarr1);
		$newArray1        = array_merge($zharr1[0],$enarr1[0]);
			
		$cncharnum2        = preg_match_all("/[\xB0-\xF7][\xA1-\xFE]/", $str2,$zharr2);
		$ennum2                = preg_match_all("/[0-9a-zA-Z]+/", $str2,$enarr2);
		$newArray2        = array_merge($zharr2[0],$enarr2[0]);
			
		$num1        = count($newArray1);
		$num2        = count($newArray2);
		$num        = $num1>$num2?$num1:$num2;
			
		$result = array_intersect($newArray1, $newArray2);
		$va                = count($result)/$num*100;
			
		//		echo "相似度:".$va."%";
		return $va;
	}
	
	
	/**
	 *	Cut an ASCII string containing the english words into an array
	 * @param string $str
	 * @return array a single word of the ASCII string
	 */
	public static function chineseSplit($str)
	{
		//$str="x个小姑娘去kfc吃chicken，飞刀已出手，nobody看到什么时候出手的，Mr'Li手中仍握着那个木雕，但刀已不在noanymore";
	
		$ascLen=strlen($str);
	
		for($i;$i<$ascLen;$i++){
	
			$c=ord(substr($str,0,1));
	
			if(ord(substr($str,0,1)) >252)
				$p = 5;
			elseif($c > 248)
			$p = 4;
			elseif($c > 240)
			$p = 3;
			elseif($c > 224)
			$p = 2;
			elseif($c > 192)
			$p = 1;
			else
				$p = 0;
	
			$truekey=substr($str,0,$p+1);
	
			if($truekey===false){
				break;
			}
	
			$splikey[]=$truekey;
	
			$str=substr($str,$p+1);
	
		}
	
		return $splikey;
	}
	

	/**
	 * ****************************************************************
	 * @todo 獲取字符串長度
	 * **************************************************************
	 * @param string $str
	 * @return number
	 */
	public static function strlenUtf8($str) {
		$i = 0;
		$count = 0;
		$len = strlen ($str);
		while ($i < $len) {
			$chr = ord ($str[$i]);
			$count++;
			$i++;
			if($i >= $len) break;
			if($chr & 0x80) {
				$chr <<= 1;
				while ($chr & 0x80) {
					$i++;
					$chr <<= 1;
				}
			}
		}
		return $count;
	}
	
	
	/*
	
	* 中文截取，支持gb2312,gbk,utf-8,big5
	* @param string $str 要截取的字串
	* @param int $start 截取起始位置
	* @param int $length 截取长度
	* @param string $charset utf-8|gb2312|gbk|big5 编码
	* @param $suffix 是否加尾缀	
	*/	
	public static function strSlice($str, $start=0, $length=50, $charset="utf-8", $suffix=true)	
	{	
		if(function_exists("mb_substr"))	
		{	
			if(mb_strlen($str, $charset) <= $length) return $str;	
			$slice = mb_substr($str, $start, $length, $charset);	
		}	
		else	
		{	
			$re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re['gbk']     = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re['big5']     = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all($re[$charset], $str, $match);
			if(count($match[0]) <= $length) return $str;
			$slice = join("",array_slice($match[0], $start, $length));
		}
	
		if($suffix) return $slice."…";
		return $slice;
	
	}
	
	/**
	 * 去除Html标签，空格以及换行符
	 * 
	 */ 
	public static function pureString($string)
	{
		$string = strip_tags($string);		
		$string = str_replace(array(" ","　","&nbsp;","\n","\n\t"),array(),$string);
		$string = preg_replace('/\s*/','',$string);
		return $string;
	}
	
	/**
	 * *****************************************************************************
	 * @todo 去除Html标签后进行字符串截取
	 * *******************************************************************************
	 * @param string $str
	 * @param int $start
	 * @param int $length
	 * @param string $charset
	 * @param boolean $suffix
	 * @return string
	 */
	public static function pureStrSlice($str, $start=0, $length=50, $charset="utf-8", $suffix=true)
	{
		$str = self::pureString($str);
		$str = self::strSlice($str,$start, $length, $charset, $suffix); 
		return $str;
	}
	
	/**
	 * *******************************************************************
	 * @todo 此方法实现中文字符的分段
	 * ********************************************************************
	 * @param $string
	 * @param $length
	 */
	public static function strSplit($string, $length=10) 
	{ 
	     $strlen = mb_strlen($string); 
	     while ($strlen) { 
	         $array[] = mb_substr($string,0,$length,"UTF-8"); 
	         $string = mb_substr($string,$length,$strlen,"UTF-8"); 
	         $strlen = mb_strlen($string); 
	     } 
	     return $array; 
	 } 
	 
	 /**
	  * ********************************************************
	  * @todo 实现字符的分段
	  * ********************************************************
	  * @param string $string
	  * @param int $lenght
	  * @param string $glue
	  */
	 public static function chunkSplit($string,$length,$glue)
	 {
	 	if (empty($string)) return false;
	 	$pieces = self::strSplit($string,$length);
	 	return implode($glue, $pieces);
	 }
	 
	 
	 /**

	  */
	 
	 /**
	  * ********************************************************************
	  * @todo  在进行pureString后把字符串分段
	  * *********************************************************************
	  * @param string $string
	  * @param int $length
	  * @return string
	  */
	 public static function pureStringSplit($string,$length=10)
	 {
	 	$string = self::pureString($string);
	 	return self::strSplit($string, $length);
	 }
	
	public static function multiArraySearch($needle, $haystackArray)
	{
		$Key;
		foreach($haystackArray as $key => $value){
			if(is_array($value)){
				$value = array_search($needle, $value);
	
				if(!empty($value)){//needle is found
					$Key = $key;
					break;
				}
			}
		}
	
		return $Key;
	}
}

?>