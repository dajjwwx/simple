<?php
class UtilUbb {
	
	
	public static function url2Link($url, $isShortUrl = true) {
		
        if($isShortUrl){
            $link = $url;
        } else{
           $link = UtilHttpRequest::shortUrl($url); 
        }
        
					
		$link = CHtml::link($link, $link,array('title'=>$url,'target'=>'_blank'));
			
		return $link;
	}
    
    public static function showOneImage($content){
        
        $html = '';
        
        $result = self::getContentImages($content);
        
        UtilHelper::writeToFile($result);
        
        //取图片中了的第一张
        $id = $result[2][0];
        //获取图片的缩略图
        
        $model = File::model()->findByPk($id);
        
        
        //UtilHelper::dump($model->attributes);
        
        //File::model()->generateThumb($model,120,'image',0);
        
        //$html .= File::model()->getFileByModel($model, 'image', 120,$model->name,array('onclick'=>'uu.image.imagePlayer($(this));'),0);

        //$image = File::model()->getFileByModel($model, 'image', 120,$model->name,array('class'=>''),0);
        
        if($model){
            
            $src1 = File::model()->generateFileName($model, 'image', false, 120);
            $src2 = File::model()->generateFileName($model, 'image', false);
            
        } else {
            $src1 = $src2 = $result[1][0];
        }
        
        $image = CHtml::image($src1);

        $html .= CHtml::link($image, $src2,array('class'=>'miniImg artZoom','rel'=>$src2));
        
        $html .= '<div class="hide">'. implode('|:|', $result[1]) . '</div>';
        
        
        $pattern = '/\[IMG\s*src=(.*?)\s*id=(.*?)\s*\](.*?)\[\/IMG\]/';
        
        $content = preg_replace($pattern, '', $content);
        
        //$content = preg_replace($pattern, '<img class="image-show" src="\1" />', $content);
        
        return $content.'<br />'.$html;
        
        
        
    }
    
    public static function getContentImages($content){
        $pattern = '/\[IMG\s*src=(.*?)\s*id=(.*?)\s*\](.*?)\[\/IMG\]/';
        
        preg_match_all($pattern, $content, $matches);
        
        //UtilHelper::dump($matches);
        
        //$content = preg_replace($pattern, '<img class="image-show" src="\1" />', $content);
        
        return $matches;
        
    }
    
    public static function showEmotion($content){
        
        //$content = '真是太好了[E]tsj/t_0040.gif[/E][E]tsj/t_0040.gif[/E]';
        $pattern = '/\[E\](.+?)\[\/E\]/is';
        
        //$replaecontent = 'jx2/j_0016.gif|bobo/b_0028.gif|';
        
        $content = preg_replace($pattern, '<img src="/public/images/emotion/\1" />',$content);
        
        return $content;
    }
	
}

?>