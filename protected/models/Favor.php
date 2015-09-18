<?php

/**
 * This is the model class for table "{{favor}}".
 *
 * The followings are the available columns in table '{{favor}}':
 * @property integer $id
 * @property string $food
 * @property string $movie
 * @property string $music
 * @property string $tourism
 * @property string $books
 * @property string $sports
 * @property string $stars
 * @property string $games
 * @property string $digital
 * @property string $others
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property User $u
 */
class Favor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{favor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('food, movie, music, tourism, books, sports, stars, games, digital, others', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, food, movie, music, tourism, books, sports, stars, games, digital, others, uid', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'food' => Yii::t('basic', 'Food'),
			'movie' => Yii::t('basic','Movie'),
			'music' => Yii::t('basic','Music'),
			'tourism' => Yii::t('basic','Tourism'),
			'books' => Yii::t('basic','Books'),
			'sports' => Yii::t('basic','Sports'),
			'stars' => Yii::t('basic','Stars'),
			'games' =>Yii::t('basic', 'Games'),
			'digital' => Yii::t('basic','Digital'),
			'others' =>Yii::t('basic', 'Others'),
			'uid' => 'Uid',
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
		$criteria->compare('food',$this->food,true);
		$criteria->compare('movie',$this->movie,true);
		$criteria->compare('music',$this->music,true);
		$criteria->compare('tourism',$this->tourism,true);
		$criteria->compare('books',$this->books,true);
		$criteria->compare('sports',$this->sports,true);
		$criteria->compare('stars',$this->stars,true);
		$criteria->compare('games',$this->games,true);
		$criteria->compare('digital',$this->digital,true);
		$criteria->compare('others',$this->others,true);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Favor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
