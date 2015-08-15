<?php

/**
 * This is the model class for table "{{paper}}".
 *
 * The followings are the available columns in table '{{paper}}':
 * @property integer $id
 * @property string $name
 * @property string $year
 * @property string $provinces
 *
 * The followings are the available model relations:
 * @property Coursepaper[] $coursepapers
 * @property Gaokao[] $gaokaos
 */
class Paper extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{paper}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, year, provinces', 'required'),
			array('name, provinces', 'length', 'max'=>50),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, year, provinces', 'safe', 'on'=>'search'),
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
			'coursepapers' => array(self::HAS_MANY, 'Coursepaper', 'paper'),
			'gaokaos' => array(self::HAS_MANY, 'Gaokao', 'paper'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::app()->getModule('gaokao')->t('gaokao','Name'),
			'year' => Yii::app()->getModule('gaokao')->t('gaokao','Year'),
			'provinces' => Yii::app()->getModule('gaokao')->t('gaokao','Provinces'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('provinces',$this->provinces,true);

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
	 * @return Paper the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getPaperName($id)
	{
		return self::model()->findByPk($id)->name;
	}

	public function getPapers($year)
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'year = :year',
			'params'=>array(
				':year'=>$year
			)
		));

		$model = self::model()->findAll($criteria);

		return $model;
	}


}
