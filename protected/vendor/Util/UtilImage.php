<?php
class UtilImage
{           
	
	public static function image()
	{
		header("Content-type: image/png");
		
		$src = './public/folder.png';
		
		$src_im = imagecreatefrompng($src);
		
		list($src_w,$src_h) = getimagesize($src);
		
		$dst_im = imagecreatetruecolor(600, 800);
		list($dst_w,$dst_h) = array(imagesx($dst_im),imagesy($dst_im));
		
		
		$color_1 = imagecolorallocatealpha($dst_im, 255, 255, 255, 127);
		
		$black = imagecolorallocate($dst_im, 0, 0, 0);
		imagefill($dst_im, $x, $y, $color_1);
		
		$logo = imagecreatefrompng('./public/images/logo.png'); // transparent PNG
		
		$logo = imagerotate($logo, 25, $color_1);
		
		$logo_w = imagesx($logo);
		$logo_h = imagesy($logo);
		
		imagecopy($dst_im, $logo, 450, 740, 0, 0, $logo_w, $logo_h);

//	    imageSetTile ($dst_im, $dst_bg);
//	    imageFilledRectangle ($dst_im, 500, 500, 550,600, IMG_COLOR_TILED);
		

		
		
		$dst_x = $dst_y = $src_x = $src_y = 0;
		
		$dst_x = -150;
		$dst_y = 120;
		
		//实现图片的缩放
//		imagecopyresampled($img_2, $img_1, 0, 0, 0, 0, 600, 800, $src_w, $src_h);
		
		//实现图片的裁剪
		imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);

		$fontfile = './public/upload/fonts/wanjinyan.ttf';
		
		$text = '你好，我一是个中国人，你应该不知道我中以，我现在不是历国';
		
		$info = UtilString::strSplit($text, 11);
		
		$size = 20; $angle = 0; $x = 150; $y = 200;
				

		
		foreach ($info as $line){
			
		$red = 255;
		$green = 20;
		$blue = 100;
		
		$color = imagecolorallocate($dst_im, $red, $green, $blue);
		

		$y += 30;
		
		
		imagettftext($dst_im, $size, $angle, $x, $y, $color, $fontfile, $line);		
			
		}

		
		

		
//		$this->write_multiline_text($dst_im, 20, imagecolorallocatealpha($dst_im,  255, 0, 255, 20), $fontfile, $text, 300, 300, 100);
	
		
		
		imagepng($dst_im);
		
		imagedestroy($dst_im);
		
		imagedestroy($src_im);
		
		
	}
	

	/**
	 * 生成用户生成图片的临时文件
	 * Enter description here ...
	 * @param unknown_type $extension
	 * @param unknown_type $isRelative
	 */	
	public static function getUserTempImageName($isRelative = true, $extension = 'jpg')
	{
		$path = '/public/upload/tmp/image-'.Yii::app()->user->id.'.'.$extension;
		
		if($isRelative){
			$path = '.'.$path;
			
			if (!file_exists($path)){			
				UtilFile::createDir(dirname($path));				
			}
		}		
		
		return $path;
		
	}
	
	
	
	/**
	 * 验证所给的链接图片是否存在
	 * 注：此处的图片链接只能验证是否在本地存在，网络的图片并没有给
	 * 此方法公供广告内容显示
	 */
	public static function imageExists($image)
	{	
		
		if (substr($image, 0, 1) == '/'){
			
			$image = '.'.$image;
				
			if(!file_exists($image)){
				return false;
			}
		
		}	
		elseif(substr($image, 0, 4) == 'http')
		{
			return UtilHttpRequest::remoteFileExists($image);				
		}
		
		return true;
		
	}
	
}