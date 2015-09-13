<?php
/**
 * 此类用于过滤提交的内容，如果含有非法的关键词则不能正常提交
 */
 
class UtilFilter
{
	
	public static function filter($content)
	{
		$start = microtime(true);
		
		$badwords = self::getFilters();
		
		$replace = '^_^'; //<span class="ico ico_penguin"><span>';
		
		$replacement = array_combine($badwords, array_fill(0, count($badwords) , $replace));
		
		$result = strtr($content, $replacement);
		
		$result = self::replaceLinks($result);
		
		$end = microtime(ture);
		
		echo $end - $start;
		return $result;
				
	}
	
	public static function replaceLinks($content)
	{
		

		
//		$pattern = "/(http?|https?|ftp?|ftps?)\:\/\/([\w+\.]+\.[\w+]{2,3})([\w-.?=%&_\/:]*)/i";
		$pattern = '/(http|https|ftp|ftps)?\:?\/?\/?([\w]+\.[\w-.]+)([\w-.?=%&_\/:]*)/i';
// 		$pattern = '~(?:https?\:\/\/)((?:[A-Za-z0-9\_\-]+\.)+[A-Za-z0-9\:]{1,10}|localhost)(?:\/[\w\d\/=\?%\-\&_\~\`\@\[\]\:\+\#\.]*(?:[^\<\>\'\"\n\r\t\s\x7f-\xff])*)?~';
		
		//	$content = preg_replace($pattern,"[URL]$0[/URL]" ,$content);
		
		$content = preg_replace_callback($pattern,array('UtilFilter','ubblink'),$content);
		
		return $content;
		
	}
	
	public static function ubblink($matches)
	{
		$url = $matches[0];
				
		return UtilUbb::url2Link($url);		
	}
	
	//链接过滤
	public static function cleanLink($html) {
	    $html = preg_replace('`((?:https?|ftp?|http):\/\/([a-zA-Z0-9-.?=&_\/:]*)/?)`si','',$html);
	    return($html);
	}
	
	/**
	 * 
	 * @param unknown_type $content
	 * @return number|boolean
	 * @deprecated
	 */
    public static function contentFilter($content)
    {
        $start = microtime(true);
    	
        $filters = self::getFilters();
        
        foreach($filters as $filter)
        {
            $pattern = self::generateFilterString($filter);

            preg_match($pattern,$content,$matches);
            
            if(!empty($matches))
                return -1;
            
            
        }
        
        $end = microtime(ture);
        
        echo $end - $start;
        
        return true;       

    }
    
    /**
     * 字符串变成数组
     */
    public static function strSplit($string)
    {
        # Split at all position not after the start: ^ 
        # and not before the end: $ 
        return preg_split('/(?<!^)(?!$)/u', $string ); 

    }
    
    public static function generateFilterString($filter)
    {
        $result = '';
        $filter = self::strSplit($filter);
        
        for($i=0;$i<count($filter);$i++)
        {
            $result .= $filter[$i].'\s*';
        }
       
        return '/'.$result.'/i';
    }
    
    public static function getFilters()
    {
        return Yii::app()->params->filters;
    }
}
?>