<?php
/**
 *
 * @author Administrator
 *        
 */
class BookFactory {

	/**
	 */
	private function __construct() {

	}
	
	public static function book($from, $isbn)
	{
		
		if ($from == 'douban') {
			return new DouBanBookInfo($isbn);
		}
		
	}
	
	
	
		
}

?>