<?php

/**
 * This is the model class for table "{{coursepaper}}".
 *
 * The followings are the available columns in table '{{coursepaper}}':
 * @property integer $id
 * @property integer $province
 * @property integer $course
 * @property integer $paper
 * @property string $year
 *
 * The followings are the available model relations:
 * @property Paper $coursepaper
 * @property Region $province
 */
class CoursePaper extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{coursepaper}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province, course, paper, year', 'required'),
			array('province, course, paper', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, province, course, paper, year', 'safe', 'on'=>'search'),
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
			'coursepaper' => array(self::BELONGS_TO, 'Paper', 'paper'),
			'province' => array(self::BELONGS_TO, 'Region', 'province'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'province' => Yii::app()->getModule('gaokao')->t('gaokao','Province'),
			'course' => Yii::app()->getModule('gaokao')->t('gaokao','Course'),
			'paper' => Yii::app()->getModule('gaokao')->t('gaokao','Paper'),
			'year' => Yii::app()->getModule('gaokao')->t('gaokao','Year'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('province',$this->province);
		$criteria->compare('course',$this->course);
		$criteria->compare('paper',$this->paper);
		$criteria->compare('year',$this->year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbGaokao;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Coursepaper the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
