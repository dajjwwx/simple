<?php

/**
 * This is the model class for table "{{gaokao}}".
 *
 * The followings are the available columns in table '{{gaokao}}':
 * @property integer $id
 * @property integer $course
 * @property string $year
 * @property string $province
 * @property integer $fid
 *
 * The followings are the available model relations:
 * @property Simplebase.sbFile $f
 */
class Gaokao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gaokao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbGaokao;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gaokao}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course, year, province, fid', 'required'),
			array('course, fid', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4),
			array('province', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course, year, province, fid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'file' => array(self::BELONGS_TO, 'File', 'fid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'course' => Yii::app()->getModule('gaokao')->t('gaokao','Course'),
			'year' => Yii::app()->getModule('gaokao')->t('gaokao','Year'),
			'province' => Yii::app()->getModule('gaokao')->t('gaokao','Province'),
			'fid' => 'Fid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('course',$this->course);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('fid',$this->fid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCoursesList()
	{
		$courses = $this->getCourses();
		
		$list = array(
			''=>'科目'
		);		
		
		for($i=0; $i < sizeof($courses); $i++)
		{
			$list[$courses[$i]['id']] = $courses[$i]['course'];
		}
		
		return $list;
	}
	
	public function getCourses()
	{
		$config =  Yii::getPathOfAlias('gaokao.config.courses').'.php';		
		$courses = require_once $config;	
		return $courses;				
	}
	
	public function getYearsList()
	{
		$list = array();
		$years = $this->getYears();
		foreach($years as $K=>$year)
		{
			$list[$year] = $year;
		}
		
		return $list;
	}
	
	public function getYears()
	{
		$years = array_reverse(range(2006,date('Y')));
		return $years;
	}
	
	
	
}