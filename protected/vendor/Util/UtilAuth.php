<?php
class UtilAuth
{
	public static function getAuthLinks($text, $url, $htmlOptions=array())
	{
		if (!Yii::app()->user->isGuest)
		{
			return CHtml::link($text, $url, $htmlOptions);
		}
	}
    
    public static function isLogin($id = null)
    {
        if(isset($id))
            return !Yii::app()->user->isGuest && Yii::app()->user->id == $id;
        else
            return !Yii::app()->user->isGuest;
            
    }
	
	
	public static function authBlockBegin()
	{
		ob_start();
		ob_implicit_flush(false);
	}
	
	public static function authBlockEnd()
	{
		
		
		if (!Yii::app()->user->isGuest)
		{
			$output = ob_get_contents();;
		}
		
		ob_end_clean();
		
	
		
		echo $output;
	}
}
?>