<?php
class UtilColor
{
	/**
	 * 16进制颜色转换为RGB色值
	 * @method hex2rgb
	 */
	public static function hex2rgb($hexColor) {	
		$color = str_replace('#', '', $hexColor);
		if (strlen($color) > 3) {
			$rgb = array(
			'red' => hexdec(substr($color, 0, 2)),
			'green' => hexdec(substr($color, 2, 2)),
			'blue' => hexdec(substr($color, 4, 2))
			);
		} else {
			$color = str_replace('#', '', $hexColor);
			$r = substr($color, 0, 1) . substr($color, 0, 1);
			$g = substr($color, 1, 1) . substr($color, 1, 1);
			$b = substr($color, 2, 1) . substr($color, 2, 1);
			$rgb = array(
				'red' => hexdec($r),
				'green' => hexdec($g),
				'blue' => hexdec($b)
			);
		}
		
		return $rgb;
	}
	
	
}
?>