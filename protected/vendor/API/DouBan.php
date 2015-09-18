<?php
class DouBan 
{
    public static function searchMusic($q='',$tag='',$start=0,$count=10)
    {
              
        $url = 'https://api.douban.com/v2/music/search/q/'.$q.'/tag/'.$tag.'/start/'.$start.'/count/'.$count;
        
        $content = file_get_contents($url);
        
        echo $content;
    }
    
    /**
     * ********************************************************************
     *Description: 获取利用豆瓣API根据ISBN取图书信息.
     **********************************************************************
     */
    // 取Book信息
    public static function getBookData($isbn) {
    	$url = "https://api.douban.com/v2/book/isbn/:".$isbn;
    
    	$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    	$result = curl_exec($curl);
    	curl_close($curl);
    
    	$book_array = json_decode($result, true);
    	
    	UtilHelper::dump($book_array);
    
   
    }
}
?>