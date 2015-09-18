<?php

/** 
 * @author Administrator
 * 
 */
class UtilDate {
	
	/**
	 * ******************************************************************
	 * @todo 格式化时间
	 * *****************************************************************
	 * @param int $time
	 * @return string
	 */
	public static function timeFormat($time) {
		$ntime=time()- $time;
		
		if ($ntime<60)
			return("刚才");
		elseif ($ntime<3600)
			return(intval($ntime/60)."分钟前");
		elseif ($ntime<3600*24)
			return(intval($ntime/3600)."小时前");
		elseif ($ntime<3600*24*365)
			return (gmdate('m-d',$time));
		else
			return(gmdate('Y-m-d H:i',$time));
	}
}
?>