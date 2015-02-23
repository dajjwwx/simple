<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $flashvar
 * @property string $flashimg
 * @property string $videoimg
 * @property string $host
 * @property string $title
 * @property integer $group
 * @property integer $order
 * @property integer $frequency
 * @property integer $pubdate
 * @property integer $moddate
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property SbCategory $group0
 */
class Video extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flashvar, flashimg, videoimg, host, title, frequency, pubdate, moddate', 'required'),
			array('group, order, frequency, pubdate, moddate', 'numerical', 'integerOnly'=>true),
			array('flashvar, flashimg, videoimg, title', 'length', 'max'=>255),
			array('host', 'length', 'max'=>50),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, flashvar, flashimg, videoimg, host, title, group, order, frequency, pubdate, moddate, description', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'pid'),
			'group0' => array(self::BELONGS_TO, 'SbCategory', 'group'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'flashvar' => 'Flashvar',
			'flashimg' => 'Flashimg',
			'videoimg' => 'Videoimg',
			'host' => 'Host',
			'title' => 'Title',
			'group' => 'Group',
			'order' => 'Order',
			'frequency' => 'Frequency',
			'pubdate' => 'Pubdate',
			'moddate' => 'Moddate',
			'description' => 'Description',
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
		$criteria->compare('flashvar',$this->flashvar,true);
		$criteria->compare('flashimg',$this->flashimg,true);
		$criteria->compare('videoimg',$this->videoimg,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('group',$this->group);
		$criteria->compare('order',$this->order);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('pubdate',$this->pubdate);
		$criteria->compare('moddate',$this->moddate);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->videoDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
