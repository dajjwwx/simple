<?php
class UtilContent
{
	
	/**
	 * 此方法专为flexSlider插件过滤太小图片而设计
	 * @todo 验证是否是本地图片是否存在，并返回图片的宽度
	 * @param $image
	 */
	public static function sliderImageSize($image)
	{
		
		$info = 0;		
		
		if (UtilImage::imageExists($image))
		{
		    if ( substr($image , 0, 1) == "/" ) {
	            $image = ".".$image;
	        }			
			
			$info = getimagesize($image);
			
			return $info[0];
		}
		
		return false;
		
	}
	
	/**
	 ****************************************************************
	 * 此程序专为LazyLoad插件准备数据，
	 * 将要输出的内容中的图片格式化为src="/public/images/lazyloading.gif" 
	 * 然后再添加一个data-original属性指向图片的真实地址
	 * *************************************************************
	 * @param unknown_type $subject
	 * 
	 */
	public static function replaceSrcForLazyLoad($content)
	{

		$pattern = '/<img\s+[^>]*\s*src\s*=\s*([\'\"]?)([^\'\">\s]*)\\1\s*[^>]*>/i';
		
		$replacement = '<img src="/public/images/lazyloading.gif" data-original="\2" />';
		
		$content = preg_replace($pattern, $replacement, $content);
		
		return $content;
	}
	
}
?>