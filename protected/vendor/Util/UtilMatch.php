<?php
class UtilMatch
{
	public static $pattern = array(
		'img'=>'/<img\s+[^>]*\s*src\s*=\s*([\'\"]?)([^\'\">\s]*)\\1\s*[^>]*>/i',
		'link'=>'',
		'telephone'=>'/^1[3,4,5,8]{1}[0-9]{1}[0-9]{8}$/',
		'email'=>'/^([a-z0-9_\-\.]+)@(([a-z0-9]+[_\-]?)\.)+[a-z]{2,3}$/i'
	);
	
	/**
	 * 验证是否为手机号码
	 ************************************************************** 
	 * @param int $phonenum
	 */
	public static function isTelephoneNumber($phonenum)
	{
		return preg_match(self::$pattern['telephone'], $phonenum);
	}
	
	/**
	 * 验证是否为电子邮箱
	 ********************************************************************** 
	 * @param $email
	 */
	public static function isEmail($email)
	{
		return preg_match(self::$pattern['email'],$email);		
	}
	
	
	
	
	/**
	 * 查看当前内容是否含有图片
	 * @param string $subject
	 */
	public static function hasImage($subject)
	{
		return preg_match(self::$pattern['img'], $subject);

	}
	
	/**
	 * 返回当前内容中第一张图片的图片链接信息
	 * @param unknown_type $subject
	 */
	public static function getFirstImageInfo($subject)
	{
		$result = self::getAllImages($subject);
		
		foreach ($result as $image)
		{
			if (UtilImage::imageExists($image)){
				return $image;
			}
		}
		
		return false;

	}
	
	/**
	 * 返回当前内容中所有的图片链接信息
	 * @param string $subject
	 * @return array()
	 */
	public static function getAllImages($subject)
	{
		preg_match_all(self::$pattern['img'], $subject, $matches);
		
		return $matches[2];
	}
	
	/**
	 * 返回当前内容中的所有图片链接信息
	 * @return json
	 */
	public static function getAllImageInfo($subject)
	{
		
		$result = self::getAllImages($subject);
		return json_encode($result);
		
	}
	
	
}