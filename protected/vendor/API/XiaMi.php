<?php
class XiaMi{
    
    public $total;      //结果集条数
    
    public $page = 1;   //当前页
    
    public $result;     //搜索结果集
    
    public function __construct($key, $page = 1){
        
        $search = $this->search($key, $page);
        
        $this->total = $search->total;
        $this->result = $search->results;
        
    }
    
    public function search($key,$page=1){
        
        $key = urlencode($key);
        
        $url = 'http://www.xiami.com/app/nineteen/search/key/'.$key.'/page/'.$page.'?r='.rand();
        
        $content = file_get_contents($url);
        
        $content = json_decode($content);
        
        return $content;
        
/**
 *         echo "<table>";
 *         echo "<tr><td>ID</td><td>Name</td><td>A_ID</td><td>A_Name</td><td>Album ID</td><td>Album Name</td></tr>";
 *         foreach($content->results as $item){
 *             echo "<tr>";
 *             foreach($item as $v){
 *                 echo "<td>".urldecode($v)."</td>";
 *             }
 *             echo "</tr>";
 *         }
 *         echo "</table>";
 *         UtilHelper::dump($content);
 */
    } 
    
    public static function generatePager($page){
        
        
        
    }
}
?>