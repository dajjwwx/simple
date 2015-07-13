<?php

/**
 * This is the model class for table "{{books}}".
 *
 * The followings are the available columns in table '{{books}}':
 * @property integer $id
 * @property integer $sid
 * @property integer $bid
 * @property integer $price
 * @property integer $owner
 *
 * The followings are the available model relations:
 * @property BookShelf $shelf
 * @property User $owner
 * @property BookDetailInfo $info
 */
class Books extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{books}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, bid, owner', 'required'),
			array('sid, bid, price, owner', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sid, bid, price, owner', 'safe', 'on'=>'search'),
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
			'shelf' => array(self::BELONGS_TO, 'BookShelf', 'sid'),
			'owner' => array(self::BELONGS_TO, 'User', 'owner'),
			'info' => array(self::BELONGS_TO, 'BookDetailInfo', 'bid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid' => 'Sid',
			'bid' => 'Bid',
			'price' => 'Price',
			'owner' => 'Owner',
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
		$criteria->compare('sid',$this->sid);
		$criteria->compare('bid',$this->bid);
		$criteria->compare('price',$this->price);
		$criteria->compare('owner',$this->owner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbLibaray;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * 最近更新图书
	 * @param number $num
	 */
	public function recentUpdates($num = 8)
	{
		$criteria = new CDbCriteria(array(
				'order'=>'id DESC',
				'limit'=>$num,		
		));
		
		return self::model()->findAll($criteria);
	}
	
	
	/**
	 * 更新图书信息
	 * @param integer $sid
	 * @param integer $bid
	 * @param string $price
	 */
	public function updateBook($sid, $bid, $price = null)
	{
		$model = Books::model()->find(array(
				'condition'=>'sid = :sid AND bid = :bid',
				'params'=>array(
						':sid'=>$sid,
						':bid'=>$bid
				)				
			)
		);	
		if (!$model) {
			$model = new Books();
			$model->sid = $sid;
			$model->bid = $bid;
			$model->owner = Yii::app()->user->id;
		}		
		if (!is_null($price)) {
			$model->price = $price;
		}		
		if(!$model->save())
		{
			UtilHelper::dump($model->errors);
		}	
	}
}
