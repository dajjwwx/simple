<?php
/**
 * 参照网络资源地址：
 * http://www.cnblogs.com/phperbar/archive/2011/07/29/2120660.html
 * 
 * 爬虫程序--原型
 */

class SimpleCrawler
{
	/**
	 * 从给定的URL获取HTML内容
	 * 
	 * @param string $url
	 * @return string
	 */
	private function _getUrlContent($url)
	{
		$handler = fopen($url, "r");
		if($handler)
		{
			$content = stream_get_contents($handler,1024*1024);
			return $content;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * 从HTML内容中筛选链接
	 * @param string $content
	 * @return array
	 */
	private function _filterUrl($content)
	{

		$reg_tag_a = '/<[a|A].*?href=[\'\"]{0,1}([^>\'\"\ ]*).*?>/';
		$result = preg_match_all($reg_tag_a, $content, $matches);
		
		if ($result)
		{
			return $matches[1];
		}
	}
	
	/**
	 * 修正相对路径
	 * @param unknown_type $base_url
	 * @param unknown_type $url_list
	 */
	private function _reviseUrl($base_url, $url_list)
	{
		
		$url_info = parse_url($base_url);
		$base_url = $url_info["scheme"].'://';
		if ($url_info["user"] && $url_info["pass"])
		{
			$base_url .= $url_info["user"].":".$url_info["pass"]."@";
		}
		$base_url .= $url_info["host"];
		if ($url_info["port"])
		{
			$base_url .= ":".$url_info["port"];
		}
		$base_url .= $url_info["path"];
		
//		print_r($base_url);

//		print_r($url_list);
//		
//	
//		die();
		
		if (is_array($url_list))
		{
			foreach($url_list as $url)
			{
				if(preg_match('/http/', $url))
				{
					$result[] = $url;
				}
				elseif(substr($url, 0,1) == '/')
				{
					$real_url = $base_url.$url;
					$result[] = $real_url;
				}
				elseif (substr($url, 0,1) == '.')
				{
					$real_url = $base_url.substr($url, 1, strlen($url));
					$result[] = $real_url;
				}
			}
			
			return $result;
		}
		else 
		{
			return ;
		}	
		
	}
	
	public function fetch($url)
	{
		$content = $this->_getUrlContent($url);
		
		if ($content)
		{
			$url_list = $this->_filterUrl($content);
			$url_list = $this->_reviseUrl($url, $url_list);
			
			if ($url_list)
			{
				return $url_list;
			}
			else 
			{
				return ;
			}
		}
		else
		{
			return;
		}
	}	
	
}
