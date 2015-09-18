<?php
class UtilValidator
{
    /**
     * 函数名称：isChinese
     * 简要描述：检查是否输入为汉字 
     * 输入：string
     * 输出：boolean
     **/
     public static function isChinese($str)
     {
		$words = UtilHelper::chineseSplit($str);
		foreach ($words as $word)
		{
			if (ord($word) < 224 || ord($word) > 240)
				return false;
		}
		
		return true;
     }
     
 	public static function similarCompare($str1,$str2){
		
		//$str1        = "四川省成都市15街23号";
		//$str2        = "四川省成都市15街yyy号";
        
        $str1 = trim($str1);// str_replace(' ','',$str1);
        $str2 = trim($str2); //str_replace(' ','',$str2);
		 
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
		 
		//echo "相似度:".$va."%";
		return $va;
	}
}
?>