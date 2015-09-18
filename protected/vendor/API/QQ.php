<?php
class QQ {
	
	private $sdk;
	private $params;
	
	public function __construct()
	{
		$qq = Yii::app()->params['qq'];
		$appid = $qq['appid'];
		$appkey = $qq['appkey'];
		$server_name = $qq['server_name'];
		$openid = $qq['openid'];
		$openkey = $qq["openkey"];
		$pf = $qq['pf'];
		
		$this->params = array(
				'openid' => $openid,
				'openkey' => $openkey,
				'pf' => $pf,
		);
		
		$this->sdk = new OpenApiV3($appid, $appkey);
		$this->sdk->setServerName($server_name);
		
		$ret = $this->get_user_info($this->sdk, $openid, $openkey, $pf);
		print_r("===========================\n");
		print_r($ret);
		
	}
	
	private function getParams()
	{
		
	}
	
	public function getUserInfo()
	{
// 		$params = array(
// 				'openid' => $openid,
// 				'openkey' => $openkey,
// 				'pf' => $pf,
// 		);
		
		$script_name = '/v3/user/get_info';
		return $this->sdk->api($script_name, $this->params,'post');		
	}
	
	
	private  function __init()
	{
		
	}

	
	/**
	 * 获取好友资料
	 *
	 * @param object $sdk OpenApiV3 Object
	 * @param string $openid openid
	 * @param string $openkey openkey
	 * @param string $pf 平台
	 * @return array 好友资料数组
	*/
	function get_user_info($sdk, $openid, $openkey, $pf)
	{
		$params = array(
				'openid' => $openid,
				'openkey' => $openkey,
				'pf' => $pf,
		);
	
		$script_name = '/v3/user/get_info';
		return $sdk->api($script_name, $params,'post');
	
	
	}
	
}

?>