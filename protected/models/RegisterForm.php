<?php
class RegisterForm extends CFormModel
{
	
	//User Model
	public $email;
	public $password;
	public $repassword;	

	public $agree;	
	public $verifyCode;



	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('email, password, repassword, agree', 'required'),
			// rememberMe needs to be a boolean
			array('email', 'unique', 'className'=>'Profile'),
			array('email', 'length', 'min'=>5, 'max'=>20),
			array('password', 'length', 'min'=>5, 'max'=>20),
			array('password', 'checkPassword'),
			array('agree', 'boolean'),
			array('verifyCode' , 'captcha' , 'allowEmpty' => !CCaptcha::checkRequirements()),
			// password needs to be authenticated
			array('repassword', 'compare', 'compareAttribute'=>'password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email' => '用户邮箱',
			'password' => '用户密码',
			'repassword' => '确认密码',
			'verifyCode' => '输入验证码',
			'agree'=>'同意悦珂谷的'.CHtml::link('使用协议',Yii::app()->createUrl('/site/term')).'及'.CHtml::link('服务规则',Yii::app()->createUrl('/site/service')),
		);
	}
	
	public function getUserName()
	{
		$username = explode('@', $this->email);
		return $username[0];
	}	
	public function checkPassword()
	{
		if (!$this->hasErrors())
		{
			if (strpos($this->password, $this->getUserName()))
				$this->addError('password', '密码不能含有与用户名相同的文字');
		}
	}
	
	public function checkRepassword()
	{
		if (!$this->hasErrors())
		{
			if ($this->password != $this->repassword)
				$this->addError('repassword', '两次密码输入不一致!');
		}
	}	

	public function register()
	{		
		if (!$this->hasErrors())
		{
			if (!$this->agree)
				$this->addError('agree', '不好意思，只有同意我们的使用协议书才能使用本站提供的信息');		
			else
			{
				$model = new User();
				
				$model->username = $this->getUserName();
				$model->password = $this->password;				
				
				if ($model->save())
				{
					$profile = new Profile();
					$profile->uid = $model->id;
					$profile->email = $this->email;
					
					$profile->save();
					
					return $model;
				}
				else
				{
					return $model->errors;
					return false;
				}				
			}
		}
		

	}


	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->getUserName(),$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}