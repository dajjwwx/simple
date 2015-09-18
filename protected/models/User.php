<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property integer $role
 * @property integer $created
 * @property integer $lastlogin
 *
 * The followings are the available model relations:
 * @property Category[] $categories
 */
class User extends CActiveRecord
{
	
	const ROLE_SUPER = 0;		//超级用户
	const ROLE_ADMIN = 1;		//系统管理员
	const ROLE_NORMAL = 2;		//一般用户
	const ROLE_VIP = 3;			//对于某些收费项目只有VIP用户才能使用，一般用户不能
	const ROLE_FORBIDEN = 4;	//禁用帐户
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('role, created, lastlogin', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'min'=>5, 'max'=>50),
			array('salt', 'length', 'max'=>10),
			array('password', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, salt, role, created, lastlogin', 'safe', 'on'=>'search'),
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
			'categories' => array(self::HAS_MANY, 'Category', 'uid'),
			'profiles'=>array(self::HAS_ONE,'Profile','uid'),
			'favor'=>array(self::HAS_MANY,'Favor','uid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' =>Yii::t('basic', 'UserName'),
			'password' =>Yii::t('basic','Password') ,
			'salt' => Yii::t('basic', 'Salt'),
			'role' => Yii::t('basic', 'Role'),
			'created' => Yii::t('basic','Created'),
			'lastlogin' => Yii::t('basic', 'Lastlogin'),
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('created',$this->created);
		$criteria->compare('lastlogin',$this->lastlogin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function checkPassword()
	{
		if (!$this->hasErrors())
		{
			if (strpos($this->username, $this->password)){
				$this->addError('password', '用户密码不能含有与用户名相同的字符');
			}
		}
	
	}
	
	public function getRoleName($id)
	{
		switch ($id){
			case self::ROLE_ADMIN:
				return Yii::t('basic','Administrator');
				break;
			case self::ROLE_NORMAL:
				return Yii::t('basic','Normal');
				break;
			case self::ROLE_SUPER:
				return Yii::t('basic','Super');
				break;
			case self::ROLE_VIP:
				return Yii::t('basic','VIP');
				break;
			case self::ROLE_FORBIDEN:
				return Yii::t('basic','Forbiden');
				break;
		}
	}
	
	public function generateRoleList()
	{
		return array(
				self::ROLE_NORMAL => self::getRoleName(self::ROLE_NORMAL),
				self::ROLE_VIP => self::getRoleName(self::ROLE_VIP),
				self::ROLE_ADMIN => self::getRoleName(self::ROLE_ADMIN),
				self::ROLE_SUPER => self::getRoleName(self::ROLE_SUPER),
				self::ROLE_FORBIDEN=>self::getRoleName(self::ROLE_FORBIDEN)
		);
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}
	
	public function hashPassword($password,$salt){
		return md5($salt.$password);
	}
	
	public function generateSalt()
	{
		$salt = md5($this->username.$this->created);
		$salt = substr($salt, 5, 5);
		return $salt;
	}
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->created = time();
				$this->lastlogin = $this->created;
				$this->salt = $this->generateSalt();
				$this->password = $this->hashPassword($this->password, $this->salt);
				$this->role = self::ROLE_NORMAL;
			}
			else
			{
				$this->lastlogin = time();
			}
			return true;
		}
		else
			return false;
	}
}
