<?php
class ShortUrl {
	
	
	function shortserver($sid) 
	{
		if ($sid==0) {
			return 'http://goo.gl';
		} else if ($sid==1) {
			return 'http://bit.ly';
		} else if ($sid==3) {
			return 'http://t.cn';
		} else {
			
		}
	}
	
	function getShortenUrl($server,$url)
	{
		if ($server=='goo.gl') {
			return $this->shortenGoogleUrl($url);
		} else if ($server=='bit.ly') {
			//测试不能正常工作			
			$urljs=file_get_contents('http://api.bit.ly/v3/shorten?login=hjoeson&apiKey=R_8ad3e9c52c8a7d6eeb397acd2f4bd90e&longUrl='.urlencode($url).'&format=json');
			$urls=json_decode($urljs,true);
			return $urls['data']['url'];
		} else if ($server=='t.cn') {
			
			$url = 'http://api.weibo.com/2/short_url/shorten.json?source=211160679&url_long='.urlencode($url);
			//$urljs = file_get_contents($url);
		
			$urljs = UtilHttpRequest::snoopyFetchRemoteUrl($url);
			
			$url=json_decode($urljs,true);
			return $url['urls'][0]['url_short'];
		} elseif ($server == 'sina.com') {
			return $this->shortenSinaUrl($url);
		}
	}
	
	
	function shortenSinaUrl($long_url)
	{
		$apiKey='1234567890';//要修改这里的key再测试哦
		$apiUrl='http://api.t.sina.com.cn/short_url/shorten.json?source='.$apiKey.'&url_long='.$long_url;
		$response= file_get_contents($apiUrl);
		$json= json_decode($response);
		return $json[0]->url_short;
	}
	
	
	function shortenGoogleUrl($long_url)
	{
		$apiKey = 'API-KEY'; //Get API key from : http://code.google.com/apis/console/
		$postData = array('longUrl' => $long_url, 'key' => $apiKey);
		$jsonData = json_encode($postData);
		$curlObj = curl_init();
		curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		$response = curl_exec($curlObj);
		curl_close($curlObj);
		$json = json_decode($response);
		return $json->id;
	}

}

?>