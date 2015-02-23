<?php

/**
 * This is the model class for table "{{region}}".
 *
 * The followings are the available columns in table '{{region}}':
 * @property integer $id
 * @property string $region
 * @property integer $uid
 * @property integer $pid
 * @property integer $forerunner
 *
 * The followings are the available model relations:
 * @property Profile[] $profiles
 * @property Profile[] $profiles1
 * @property Profile[] $profiles2
 * @property Profile[] $profiles3
 * @property Profile[] $profiles4
 * @property Profile[] $profiles5
 * @property Profile[] $profiles6
 * @property Profile[] $profiles7
 */
class Region extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{region}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region, uid, pid', 'required'),
			array('uid, pid, forerunner', 'numerical', 'integerOnly'=>true),
			array('region', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, region, uid, pid, forerunner', 'safe', 'on'=>'search'),
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
			'profiles' => array(self::HAS_MANY, 'Profile', 'homemanicipal'),
			'profiles1' => array(self::HAS_MANY, 'Profile', 'homecounty'),
			'profiles2' => array(self::HAS_MANY, 'Profile', 'homevillage'),
			'profiles3' => array(self::HAS_MANY, 'Profile', 'province'),
			'profiles4' => array(self::HAS_MANY, 'Profile', 'manicipal'),
			'profiles5' => array(self::HAS_MANY, 'Profile', 'village'),
			'profiles6' => array(self::HAS_MANY, 'Profile', 'county'),
			'profiles7' => array(self::HAS_MANY, 'Profile', 'homeprovince'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'region' => 'Region',
			'uid' => 'Uid',
			'pid' => 'Pid',
			'forerunner' => 'Forerunner',
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
		$criteria->compare('region',$this->region,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('forerunner',$this->forerunner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Region the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getRegionModel($id)
	{
		return self::model()->findByPk($id);
	}
	
	public function getRegion($id)
	{
		return self::getRegionModel($id)->region;
	}
	
	/**
	 * *****************************************************
	 * 获取所有省份
	 * ****************************************************
	 * @param int $pid
	 * @return multitype:NULL
	 */
	public function generateProvince($pid)
	{
		$result = array();
	
		$region = Region::model()->findAll(array(
				'condition'=>'pid = '.$pid
		));
	
		foreach ($region as $data)
		{
			$result[$data->id] = $data->region;
		}
	
		return $result;
	}
	
	/**
	 * *********************************************************************
	 * 生成地址连接
	 * *******************************************************
	 * @param int $id
	 * @param string $link
	 * @param array $htmlOptions
	 * @param string $addMore
	 * @return string
	 */
	public function generateRegionLinks($pid, $link=null,$htmlOptions=array(),$addMore=true)
	{
		$links = '';
	
		$result = array();
	
		$result = self::generateProvince($pid);
	
		foreach ($result as $key=>$value)
		{
			$htmlOptions['id'] = $key;
			$links .= CHtml::link($value,array($link,'id'=>$key), $htmlOptions);
		}
	
		//		UtilHelper::writeToFile($links);
		if ($addMore)
			$links .= '<br />如果这里没有你需要的地址，点这里'.CHtml::link('添加','javascript:void();',array('style'=>'border:none;','onclick'=>'addRegion();return false;') );
			
		return $links;
	
	
	}
}
