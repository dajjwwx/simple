<?php
/**
 * Enter description here ...
 * @author Administrator
 *
 */
class UtilPicture
{
	
	private static $_dst_im = null;
	
	private static $_imgs = array();
	
	private function _getOutputFileMimetype($filename='./public/image.png')
	{
		return CFileHelper::getMimeType($filename);
	}
	
	private function _outputImage($filename)
	{
		$ext = CFileHelper::getExtension($filename);

		switch ($ext)
		{
			case 'jpg':
				return imagejpeg(self::$_dst_im);
				break;
			case 'png':
				return imagepng(self::$_dst_im);
			case 'gif':
				return imagegif(self::$_dst_im);
		}		
	}
	
	public static function _createImage($filename)
	{
		$ext = CFileHelper::getExtension($filename);

		switch ($ext)
		{
			case 'jpg':
				return imagecreatefromjpeg($filename);
				break;
			case 'png':
				return imagecreatefrompng($filename);
			case 'gif':
				return imagecreatefromgif($filename);
		}
		
	}
	
	/**
	 * 	//注：只有一个背景
	 *'background'=>array(
	 *		'width'=>600,//图片宽度
	 *		'height'=>800,//图片高度
	 *		'color'=>'#FFFFFF',//背景颜色
	 *		'alpha'=>80,
	 *	),
	 * Enter description here ...
	 * @param $option
	 */
	
	private static function _backgroundSettings($option = array())
	{
				
		extract($option);
		
		extract(UtilColor::hex2rgb($color));
		//设置图片的大小
		self::$_dst_im = imagecreatetruecolor($width, $height);
		$bg_color = imagecolorallocatealpha(self::$_dst_im, $red, $green, $blue, $alpha);
		imagefill(self::$_dst_im, 0, 0, $bg_color);
		
		
		
	}
	

	
	/*******************************************************************
	 * 为背景图片添加一些辅助图片 
	 *******************************************************************
	 * 	'option'=>array(
	 * 		'filename'=>'/public/image/image.jpg',
	 *		'dst_x'=>0,
	 *		'dst_y'=>0,
	 *		'src_x'=>0,
	 *		'src_y'=>0,
	 *		'src_w'=>100,
	 *		'src_h'=>100,
	 *		'rotate'=>array(
	 *			'angle'=>20,
	 *			'color'=>'#FFF'
	 *		)
	 *	)
	 * 
	 * @param array $options
	 */
	
	private static function _addImage($options = array())
	{
		extract($options);
		
		$i = count(self::$_imgs);
		
		$img = 'img_'.$i;
		
		
		
		$img = self::_createImage($filename);
		self::$_imgs[] = $img;
		
		list($src_w, $src_h) = getimagesize($filename);
		
// 		UtilHelper::dump($options);
		die();
		
		imagecopy(self::$_dst_im, $img, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
	}
	
	
	/***********************************************************************************
	 * 
	 * 为图片添加文字内容
	 * 
	 * *********************************************************************************
	 * 	'option'=>array(
	 *		'text'=>'Hello everyone',	//文字内容	
	 *		'size'=>20,		//文字大小
	 *		'angle'=>20,	//旋转角度
	 *		'color'=>'#000000',	//颜色
	 *		'x'=>100,	//开始位置横坐标
	 *		'y'=>100,	//开始位置的纵坐标
	 *		'fontfile'=>'./public/hiti.ttf',	//字体
	 *		'split'=>11,	//文字断行分割长度
	 *		'indent'=>30	//行距
	 *	)
	 * @param array() $options
	 */	
	private static function _addText($options = array())
	{
		extract($options);
		
		//注：如是数组数组不完整，则不再继续执行下在的程序，-->>感觉没有正常工作--<<		
		if ($size == '' || $angle=='' || $x=='' || $y=='' || $font_color=='' || $fontfile=='' || $text =='') return '';
		
		
		extract(UtilColor::hex2rgb($color));	
		
		
		$font_color = imagecolorallocate(self::$_dst_im, $red, $green, $blue);
		
		//特别注明：在应用主题时使用array_merge_recusive会使一个数组的值附加在前一个数组的后面，所以这里为了使用更新后的数组，使用array_pop得到需要的新文本内容
		if (is_array($text))
			$text = array_pop($text);
			
		
		$info = UtilString::strSplit($text, $split);
		

		
		foreach ($info as $line){
			
			$y += $indent;		
			
			imagettftext(self::$_dst_im, $size, $angle, $x, $y, $font_color, $fontfile, $line);		
			
		}
		
	}
	
	private static function _init($options=array())
	{
		foreach ($options as $option)
		{
			
			//因为数组数据在传递的过程中使用json_encode和json_decode转化成的stdClass的对象，现在使用强制转换为数组类型
			$option = (array)$option;
			
			if ($option['type'] == 'background')
				self::_backgroundSettings($option);
			elseif ($option['type'] == 'text')
				self::_addText($option);
			elseif ($option['type'] == 'image')
				self::_addImage($option);
			
		}
		
//		self::_backgroundSettings($options['background']);
//
//		
//		foreach ($options['image'] as $image)
//			self::_addImage($image);
//			
//		foreach ($options['text'] as $text)
//			self::_addText($text);
		
	}
	
	//注销所有使用的image
	private static function _destroy()
	{
		
		foreach (self::$_imgs as $_img)
			imagedestroy($_img);
		
		imagedestroy(self::$_dst_im);
		
	}
	
	public static function render($options = array(),$output=false)
	{
		header('Content-type: image/jpg');
				
		self::_init($options);
		
		$filename = UtilImage::getUserTempImageName();

		
		$output?imagepng(self::$_dst_im, $filename):imagepng(self::$_dst_im);
		
		self::_destroy();
		
	}
	
}
?>