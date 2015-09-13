<?php

/** 
 * 通用的UserModel类
 * 
 * @author Administrator
 * @since 2014/7/26
 * 
 */
class UserModel {
	
	private $id;				//用户ID
	private $name;			//用户名
	private $password;	//用户密码
	private $salt;			//加密随机字符
	private $created;		//用户创建时间
	private $lastlogin;		//最后一次登录时间
	private $rold;			//用户角色
	private $remark;		//用户备注
	
	
	/**
	 * **************************************************************
	 * @todo 验证用户密码是否匹配
	 * ***************************************************************
	 * @param string $password
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}
	
	/**
	 * *****************************************************************
	 * @todo 为用户的密码加密
	 * *****************************************************************
	 * @param string $password
	 * @param string $salt
	 * @return string
	 */
	private function hashPassword($password,$salt){
		return md5($salt.$password);
	}
	
	/**
	 * **************************************************************************
	 * @todo 随机生成加密字符
	 * *************************************************************************
	 * @return string;
	 */
	private function generateSalt()
	{
		$salt = md5($this->name.$this->created);
		$salt = substr($salt, 5, 5);
		return $salt;
	}
	
}

?>