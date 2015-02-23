<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property integer $uid
 * @property string $firstname
 * @property string $lastname
 * @property string $nickname
 * @property string $avatar
 * @property integer $gender
 * @property integer $calendar
 * @property string $birth
 * @property string $birthyear
 * @property string $birthmonth
 * @property string $birthday
 * @property string $blood
 * @property integer $marry
 * @property string $email
 * @property string $phone
 * @property integer $qq
 * @property string $alipay
 * @property string $job
 * @property string $companyname
 * @property string $companyaddress
 * @property integer $primaryschool
 * @property integer $middleschool
 * @property integer $highschool
 * @property integer $university
 * @property string $country
 * @property integer $province
 * @property integer $manicipal
 * @property integer $village
 * @property integer $county
 * @property integer $homeprovince
 * @property integer $homemanicipal
 * @property integer $homecounty
 * @property integer $homevillage
 * @property string $addressdetail
 * @property string $homeaddressdetail
 *
 * The followings are the available model relations:
 * @property User $u
 * @property Region $homemanicipal0
 * @property Region $homecounty0
 * @property Region $homevillage0
 * @property College $middleschool0
 * @property College $highschool0
 * @property College $university0
 * @property Region $province0
 * @property Region $manicipal0
 * @property Region $village0
 * @property Region $county0
 * @property Region $homeprovince0
 */
class Profile extends CActiveRecord
{
	
	//性别
	const GENDER_MALE = 1;
	const GENDER_FEMAIL = 2;
	const GENDER_UNKNOWN = 3;
	
	//婚姻状态
	const MARRY_MARRIED = 1;
	const MARRY_UNMARRIED = 0;
	
	//血型
	const BLOOD_A = 'A';
	const BLOOD_B = 'B';
	const BLOOD_O = 'O';
	
	//日历
	const CALENDAR_SOLOR = 1;
	const CALENDAR_LUNOR = 2;
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{profile}}';
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
			array('uid, gender, calendar, marry, qq, primaryschool, middleschool, highschool, university, province, manicipal, village, county, homeprovince, homemanicipal, homecounty, homevillage', 'numerical', 'integerOnly'=>true),
			array('firstname', 'length', 'max'=>20),
			array('lastname, nickname, birth, phone, country', 'length', 'max'=>50),
			array('avatar', 'length', 'max'=>256),
			array('birthyear', 'length', 'max'=>4),
			array('birthmonth, birthday', 'length', 'max'=>2),
			array('blood', 'length', 'max'=>10),
			array('email, alipay', 'length', 'max'=>100),
			array('job, companyaddress', 'length', 'max'=>500),
			array('companyname, addressdetail, homeaddressdetail', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, firstname, lastname, nickname, avatar, gender, calendar, birth, birthyear, birthmonth, birthday, blood, marry, email, phone, qq, alipay, job, companyname, companyaddress, primaryschool, middleschool, highschool, university, country, province, manicipal, village, county, homeprovince, homemanicipal, homecounty, homevillage, addressdetail, homeaddressdetail', 'safe', 'on'=>'search'),
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
// 			'avatarModel'=>array(self::HAS_ONE, 'File', 'id'),
			'avatarModel' => array(self::BELONGS_TO, 'File', 'avatar'),
			'avatars'=>array(self::HAS_MANY, 'File', 'id'),
			'homemanicipal0' => array(self::BELONGS_TO, 'Region', 'homemanicipal'),
			'homecounty0' => array(self::BELONGS_TO, 'Region', 'homecounty'),
			'homevillage0' => array(self::BELONGS_TO, 'Region', 'homevillage'),
			'middleschool0' => array(self::BELONGS_TO, 'College', 'middleschool'),
			'highschool0' => array(self::BELONGS_TO, 'College', 'highschool'),
			'university0' => array(self::BELONGS_TO, 'College', 'university'),
			'province0' => array(self::BELONGS_TO, 'Region', 'province'),
			'manicipal0' => array(self::BELONGS_TO, 'Region', 'manicipal'),
			'village0' => array(self::BELONGS_TO, 'Region', 'village'),
			'county0' => array(self::BELONGS_TO, 'Region', 'county'),
			'homeprovince0' => array(self::BELONGS_TO, 'Region', 'homeprovince'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'firstname' => Yii::t('basic','Firstname'),
			'lastname' => Yii::t('basic','Lastname'),
			'nickname' => Yii::t('basic','Nickname'),
			'avatar' => Yii::t('basic','Avatar'),
			'gender' => Yii::t('basic','Gender'),
			'calendar' => Yii::t('basic','Calendar'),
			'birth' => Yii::t('basic','Birth'),
			'birthyear' => Yii::t('basic','Year'),
			'birthmonth' => Yii::t('basic','Month'),
			'birthday' => Yii::t('basic','Day'),
			'blood' => Yii::t('basic','Blood'),
			'marry' => Yii::t('basic','Marry'),
			'email' => Yii::t('basic','Email'),
			'phone' => Yii::t('basic','Phone'),
			'qq' => Yii::t('basic','QQ'),
			'alipay' =>Yii::t('basic', 'Alipay'),
			'job' => Yii::t('basic','Job'),
			'companyname' => Yii::t('basic','Company Name'),
			'companyaddress' => Yii::t('basic','Company Address'),
			'primaryschool' =>Yii::t('basic', 'Primary School'),
			'middleschool' => Yii::t('basic','Middle School'),
			'highschool' => Yii::t('basic','High School'),
			'university' => Yii::t('basic','University'),
			'country' => Yii::t('basic','Country'),
			'province' => Yii::t('basic','Province'),
			'manicipal' => Yii::t('basic','Manicipal'),
			'village' => Yii::t('basic','Village'),
			'county' => Yii::t('basic','County'),
			'homeprovince' => Yii::t('basic','Home Province'),
			'homemanicipal' => Yii::t('basic','Home Manicipal'),
			'homecounty' => Yii::t('basic','Home County'),
			'homevillage' => Yii::t('basic','Home Village'),
			'addressdetail' =>Yii::t('basic', 'Address Detail'),
			'homeaddressdetail' => Yii::t('basic','Home Address Detail'),
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('calendar',$this->calendar);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('birthyear',$this->birthyear,true);
		$criteria->compare('birthmonth',$this->birthmonth,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('blood',$this->blood,true);
		$criteria->compare('marry',$this->marry);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq);
		$criteria->compare('alipay',$this->alipay,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('companyaddress',$this->companyaddress,true);
		$criteria->compare('primaryschool',$this->primaryschool);
		$criteria->compare('middleschool',$this->middleschool);
		$criteria->compare('highschool',$this->highschool);
		$criteria->compare('university',$this->university);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('manicipal',$this->manicipal);
		$criteria->compare('village',$this->village);
		$criteria->compare('county',$this->county);
		$criteria->compare('homeprovince',$this->homeprovince);
		$criteria->compare('homemanicipal',$this->homemanicipal);
		$criteria->compare('homecounty',$this->homecounty);
		$criteria->compare('homevillage',$this->homevillage);
		$criteria->compare('addressdetail',$this->addressdetail,true);
		$criteria->compare('homeaddressdetail',$this->homeaddressdetail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * *********************************************
	 * 获取日历名称
	 * **************************************************
	 * @param int $type
	 * @return 
	 */
	public function getCalendarType($type)
	{
		switch ($type)
		{
			case self::CALENDAR_LUNOR:
				return Yii::t('basic', 'Lunor Calendar');
				break;
			case self::CALENDAR_SOLOR:
				return Yii::t('basic','Solor Calendar');
				break;
		}
	}
	
	/**
	 * ****************************************
	 * 获取日历列表
	 * *******************************************
	 * @return array
	 */
	public function generateCalendarList()
	{
		return array(
			self::CALENDAR_LUNOR=>self::getCalendarType(self::CALENDAR_LUNOR),
			self::CALENDAR_SOLOR=>self::getCalendarType(self::CALENDAR_SOLOR)	
		);
	}
	
	/**
	 * **********************************************************
	 * 获取性别名称
	 * **********************************************************
	 * @param int $type
	 * @return 
	 */
	public function getGendarType($type)
	{
		switch ($type)
		{
			case self::GENDER_MALE:
				return Yii::t('basic','Male');
				break;
			case self::GENDER_FEMAIL:
				return Yii::t('basic','Female');
				break;
			case self::GENDER_UNKNOWN:
				return Yii::t('basic','Unkown');
				break;
		}
	}
	
	/**
	 * 生成性别列表
	 * @return array
	 */
	public function generateGenderList()
	{
		return array(
			self::GENDER_MALE=>self::getGendarType(self::GENDER_MALE),
			self::GENDER_FEMAIL=>self::getGendarType(self::GENDER_FEMAIL),
			self::GENDER_UNKNOWN=>self::getGendarType(self::GENDER_UNKNOWN)	
				
		);
	}
	
	/**
	 * ***********************************************************
	 * 获取婚姻状态名称
	 * *******************************************************
	 * @param int $type
	 * @return string
	 */
	public function getMarryType($type)
	{
		switch ($type)
		{
			case self::MARRY_MARRIED:
				return Yii::t('basic','Married');
				break;
			case self::MARRY_UNMARRIED:
				return Yii::t('basic','Unmarried');
				break;
		}
	}
	
	/**
	 * ***************************************************************
	 * 生成婚姻状况列表
	 * ***************************************************************
	 * @return array
	 */
	public function generateMarryList()
	{
		return array(
				self::MARRY_MARRIED=>self::getMarryType(self::MARRY_MARRIED),
				self::MARRY_UNMARRIED=>self::getMarryType(self::MARRY_UNMARRIED)
		);
	}
	
	/**
	 * 生成血型列表
	 * @return multitype:string
	 */
	public function generateBloodList()
	{
		return array(
				self::BLOOD_A,
				self::BLOOD_B,
				self::BLOOD_O
		);
	}
	
	
	/**
	 * 根据用户ID获取用户头像路径
	 * @param int $id
	 * @param int $size
	 */
	public function getUserAvatarPath($id, $size = 60)
	{
	
		$path = '';
	
		$user = User::model()->findByPk($id);

	
		if ($user->profiles)
		{				
			if ($user->profiles->birthyear)
				$path = UtilHelper::getZodiacPath($user->profiles->birthyear);
				
			if ($user->profiles->avatar)
			{				
				$model = $user->profiles->avatarModel;
				$path = File::model()->attributeAdapter($model)->generateAvatarPath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>$size));	
			}				
		}
		else
			$path = Yii::app()->params->defaultAvatarPath;
			
	
		return $path;
	}
	
	//根据用户获取用户头像
	public function getUserAvatar($id, $htmlOptions = array(),$size =60, $alt = '')
	{
		$path = self::getUserAvatarPath($id,$size);
		if ($size)
			$htmlOptions['style'] = 'width:'.$size.'px';
	
		return CHtml::image($path, $alt, $htmlOptions);
	}
	
	public function getUserAddress($id, $separate = "&nbsp;&nbsp;")
	{
		$model = User::model()->findByPk($id);
	
		$result = '';
	
		if($model->profiles)
		{
			//			if ($model->profiles->province)
				//				$result .= Region::model()->getRegion($model->profiles->province).'&nbsp;&nbsp;';
				//			if ($model->profiles->manicipal)
					//				$result .= Region::model()->getRegion($model->profiles->manicipal).'&nbsp;&nbsp;';
					//			if ($model->profiles->county)
						//				$result .= Region::model()->getRegion($model->profiles->county).'&nbsp;&nbsp;';
						//			if ($model->profiles->village)
							//				$result .= Region::model()->getRegion($model->profiles->village);
			if ($model->profiles->addressdetail)
				$address = explode('-', $model->profiles->addressdetail);
			else
			{
				$address = array(
						$model->profiles->province,
						$model->profiles->manicipal,
						$model->profiles->county,
						$model->profiles->village
				);
			}
				
			$i = 1;
			foreach ($address as $region)
			{
				$result .= Region::model()->getRegion($region);
	
				if ($i < count($address)-1)
				{
					$result .= $separate;
				}
	
				$i++;
			}
	
				
		}
		else
			$result .='地址不详';
		return $result;
	}
	
	public function getUserHomeAddress($id)
	{
		$model = User::model()->findByPk($id);
	
		$result = '';
	
		if($model->profiles)
		{
			$address = explode('-', $model->profiles->homeaddressdetail);
				
			foreach ($address as $region)
			{
				$result .= Region::model()->getRegion($region).'&nbsp;&nbsp;';
			}
		}
		else
			$result .='地址不详';
		return $result;
	}
}
