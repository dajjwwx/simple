<?php
/**
 *
 * @author Administrator
 *        
 */
class LibarayDbActiveRecord extends CActiveRecord {
	
		public function getDbConnection(){
			return Yii::app()->dbLibaray;
		}

}

?>