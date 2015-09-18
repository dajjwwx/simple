<?php
class UtilTags {
	
	/**
	 * 根据词频，分析出内容的标签
	 * @param unknown_type $content
	 * @return array
	 */
	public static function getTagsArray($content, $length = 5)
	{
		return UtilSearch::phpAnalysis($content, $length);
	} 

	/**
	 * 根据词频，分析出内容的标签
	 * @param unknown_type $content
	 * @return string
	 */
	public static function getTags($content, $length = 5)
	{
		return trim(implode(',', UtilSearch::phpAnalysis($content, $length)));
	}
	
	
}

?>