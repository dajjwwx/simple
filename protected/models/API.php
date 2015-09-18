<?php
class API extends CActiveRecord
{
	/**
	 * @var integer $id
	 * @soap
	 */
	public $id;
	
	/**
	 * @var string title
	 * @soap
	 */
	public $title;
}