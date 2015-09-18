<?php
		
//		require 'Zend/Mail/Protocol/Smtp/Auth/Login.php';
//        require_once 'Zend/Mail.php';
//        require_once 'Zend/Mail/Transport/Smtp.php';
//
//      $config = array(
//			'auth' => 'login',
//          'username' => 'zclandxy',
//          'password' => 'zclandxy5424346',
//          'ssl' => 'SSL'
//         );
//		$config = array(
//			'auth' => 'login',
//			'username' => 'admin@yuekegu.com',
//			'password' => 'zclandxy5424346'
//		);
//
//        $transport = new Zend_Mail_Transport_Smtp('smtp.yuekegu.com', $config);
//        
//		
//		$model=new ContactForm;
//		if(isset($_POST['ContactForm']))
//		{
//			$model->attributes=$_POST['ContactForm'];
//			
//			$mail = new Email();
//			$mail->mail_body = $model->body;
//			$mail->mail_email = $model->email;
//			$mail->mail_name = $model->name;
//			$mail->mail_subject = $model->subject;
//			$mail->mail_created = time();
//			$mail->mail_ip = ip2long(Yii::app()->request->getUserHostAddress());
//			
//			echo UtilTools::getClientIp();
//			
//			UtilTools::dump($_SERVER);
//			UtilTools::dump($mail->attributes);
//			
//			Yii::app()->end();
		
//			if($model->validate() && $mail->save())
//			{
//				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
//				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);

//				if($mail->save())
//				{
//					$mail = new Zend_Mail('UTF-8');
//					
//					$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
//					
//			        $mail->setBodyHtml($model->email.'<br />'.$model->body);
//			        $mail->setFrom('admin@yuekegu.com', $model->name);
//			        $mail->addTo(Yii::app()->params['mail'], Yii::app()->params['author']);
//					$mail->addTo('dajjwwx@163.com', 'Receiver');
//			        $mail->setSubject($model->subject);
//			        $mail->send($transport);					
//				}	        
//		        
//				
//				
//				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//				$this->refresh();
//			}
//		}



Yii::import('common.Libaray.*');

require_once 'Zend/Mail/Protocol/Smtp/Auth/Login.php';
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Protocol/Smtp.php';
require_once 'Zend/Mail/Transport/Smtp.php';

class UtilMail
{
	private static $_config = array(
		'auth' => 'login',
		'username' => 'admin@yuekegu.com',
		'password' => 'zclandxy5424346',
		'ssl'=>'ssl'
	);
	
	/**
	 * ********************************************************
	 * @todo 使用Zend_Mail发送邮件
	 * *********************************************************
	 * @param string $to
	 * @param string $subject
	 * @param string $message
	 */
	public static function sendMail($to, $subject, $message)
	{

        $transport = new Zend_Mail_Transport_Smtp('smtp.yuekegu.com', self::$_config);
        
        $mail = new Zend_Mail('UTF-8');
					
		$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
					
		$mail->setBodyHtml($message);
		$mail->setFrom('admin@yuekegu.com', Yii::app()->name);
//		$mail->addTo(Yii::app()->params['mail'], Yii::app()->params['author']);
		if (is_array($to)) {
			foreach ($to as $email){
				$mail->addTo($email);
			}
		}
		else 
		{
			$mail->addTo($email);
		}
		
		$mail->setSubject($subject);
		$mail->send($transport);
		
		UtilHelper::writeToFile($mail, 'a+');
	}
	
	public function gotoMail($mail) {
		
		$temp=explode('@',$mail);
		$t=strtolower($temp[1]);
	
		if ($t=='163.com') {
			return 'mail.163.com';
		} else if ($t=='vip.163.com') {
			return 'vip.163.com';
		} else if ($t=='126.com') {
			return 'mail.126.com';
		} else if ($t=='qq.com' || $t=='vip.qq.com' || $t=='foxmail.com') {
			return 'mail.qq.com';
		} else if ($t=='gmail.com') {
			return 'mail.google.com';
		} else if ($t=='sohu.com') {
			return 'mail.sohu.com';
		} else if ($t=='tom.com') {
			return 'mail.tom.com';
		} else if ($t=='vip.sina.com') {
			return 'vip.sina.com';
		} else if ($t=='sina.com.cn' || $t=='sina.com') {
			return 'mail.sina.com.cn';
		} else if ($t=='tom.com') {
			return 'mail.tom.com';
		} else if ($t=='yahoo.com.cn' || $t=='yahoo.cn') {
			return 'mail.cn.yahoo.com';
		} else if ($t=='tom.com') {
			return 'mail.tom.com';
		} else if ($t=='yeah.net') {
			return 'www.yeah.net';
		} else if ($t=='21cn.com') {
			return 'mail.21cn.com';
		} else if ($t=='hotmail.com') {
			return 'www.hotmail.com';
		} else if ($t=='sogou.com') {
			return 'mail.sogou.com';
		} else if ($t=='188.com') {
			return 'www.188.com';
		} else if ($t=='139.com') {
			return 'mail.10086.cn';
		} else if ($t=='189.cn') {
			return 'webmail15.189.cn/webmail';
		} else if ($t=='wo.com.cn') {
			return 'mail.wo.com.cn/smsmail';
		} else if ($t=='139.com') {
			return 'mail.10086.cn';
		} else {
			return '';
		}
	}
}
?>