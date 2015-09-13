<?php
class CVideo {
    public function getvideo($type_data) {
        $link = $type_data;
        $parseLink = parse_url($link);
        if(preg_match("/(youku.com|youtube.com|5show.com|ku6.com|sohu.com|mofile.com|sina.com.cn|tudou.com|yinyuetai.com|xiami.com|56.com)$/i", $parseLink['host'], $hosts)) {
            $flashinfo = $this->getflashinfo($link, $hosts[1]);
        }
        if ($flashinfo['flashvar']) {
            $typedata['flashvar']  = $flashinfo['flashvar'];
            $typedata['flashimg']  = $flashinfo['img'];
            $typedata['host']      = $hosts[1];
            $typedata['source']    = $type_data;
            $typedata['title']     = $flashinfo['title'];
        }
        return $typedata;
    }
	
	private function get_host($str){
		$list=array(
			"sina.com.cn",
			"youku.com",
			"tudou.com",
			"ku6.com",
			"sohu.com",
			"mofile.com",
			"youtube.com",
			"5show.com",
			"yinyuetai.com",
			"xiami.com",
			"56.com",
		);
		foreach($list as $v){
			if(strpos($str,$v)>0){
				$re= substr($str,strpos($str,$v),100);
				break;
			}
		}
		return $re;
	}

    //判断富媒体
    public function ismedialine($stringlink) {
		$stringlink=str_replace('&amp;','&',$stringlink);
        $vidoLink = parse_url($stringlink);
        $vido_host = $this->get_host($vidoLink['host']);
        $ReturnMusic = preg_match("/\.(mp3|wma)$/i", $stringlink);
        $ReturnHost = preg_match("/(youku\.com|youtube\.com|5show\.com|ku6\.com|sohu\.com|mofile\.com|sina\.com.cn|tudou\.com|yinyuetai\.com|xiami\.com|56\.com)$/i", $vido_host);
		preg_match_all("/(.*)\?m=vote(\&a=index|)\&vid=([0-9]*)/i", $stringlink,$ReturnVote);
        return array('music'=>$ReturnMusic,'video'=>$ReturnHost,'vote'=>intval($ReturnVote[3][0]));
    }

	//获取flash信息
    private function getflashinfo($link,$host) {
        
//        $ss = microtime(true);
        
        $return='';
 		if(extension_loaded("zlib")){
 			$content = file_get_contents("compress.zlib://".$link);//获取
         }
 		if(!$content) {
 			$content = file_get_contents($link);//有些站点无法获取
 		}
//			$content = UtilHttpRequest::snoopyFetchRemoteUrl($link);
 //       $content = UtilHttpRequest::fetchRemoteUrl($link);
        
//        $ee = microtime(true);
        
//        echo $ee-$ss;
        
		if('youku.com' == $host) {
            preg_match('/http:\/\/profile\.live\.com\/badge\/\?[^"]+/i', $content, $share_url);
            preg_match('/id\_(\w+)\.html/', $share_url[0], $flashvar);
            preg_match('/screenshot=([^"&]+)/', $share_url[0], $img);
            preg_match('/title=([^"&]+)/', $share_url[0], $title);
            if (!empty($title[1])) {
                $title[1] = urldecode($title[1]);
            } else {
                preg_match("/<title>(.*?)<\/title>/i",$content,$title);
            }
        } elseif('ku6.com' == $host)  {
            preg_match("/\/([\w\-\.]+)\.html/",$link,$flashvar);
			//preg_match("/<span class=\"s_pic\">(.*?)<\/span>/i",$content,$img);
			preg_match("/cover: \"(.+?)\"/i", $content, $img);
            preg_match("/<title>(.*?)<\/title>/i",$content,$title);
            $title[1] = iconv("GBK","UTF-8",$title[1]);
        } elseif('sina.com.cn' == $host) {
            preg_match("/vid=(.*?)\/s\.swf/",$content,$flashvar);
            preg_match("/pic\:[ ]*\'(.*?)\'/i",$content,$img);
            preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        }  elseif('tudou.com' == $host) {
			preg_match('~acode\s*[\:\=]\s*[\"\']([\w\d\-\_]+)[\"\']~s',$content,$flashvar);
			if (!$defaultIid) {
				preg_match('~lcode\s*[\:\=]\s*[\"\']([\w\d\-\_]+)[\"\']~s',$content,$flashvar);
			}
			if (!$defaultIid) {
				preg_match('~icode\s*[\:\=]\s*[\"\']([\w\d\-\_]+)[\"\']~s',$content,$flashvar);
			}
			if($flashvar){
                preg_match("/<title>(.*?)<\/title>/i",$content,$title);
				preg_match('~pic\s*[\:\=]\s*[\"\']([^\"\']+?)[\"\']~s',$content,$img);
				$title[1] = iconv("GBK","UTF-8",$title[1]);
			}
        } elseif('youtube.com' == $host) {
			preg_match('/http:\/\/www.youtube.com\/watch\?v=([^\/&]+)&?/i',$link,$flashvar);
            preg_match("/<link itemprop=\"thumbnailUrl\" href=\"(.*?)\">/i", $content, $img);
            preg_match("/<title>(.*?)<\/title>/", $content, $title);
        } elseif('sohu.com' == $host) {
            preg_match("/vid=\"(.*?)\"/", $content, $flashvar);
            preg_match('/cover="([^"]+)";/', $content, $img);
            preg_match("/<title>(.*?)<\/title>/", $content, $title);
            $title[1] = iconv("GBK","UTF-8",$title[1]);
        } elseif('mofile.com' == $host) {
            preg_match("/\/([\w\-]+)\.shtml/",$link,$flashvar);
            preg_match("/thumbpath=\"(.*?)\";/i",$content,$img);
            preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        } elseif('yinyuetai.com' == $host) {
            preg_match("/video\/([\w\-]+)$/",$link,$flashvar);
            preg_match("/<meta property=\"og:image\" content=\"(.*)\"\/>/i",$content,$img);
            preg_match("/<meta property=\"og:title\" content=\"(.*)\"\/>/i",$content,$title);
        } elseif('xiami.com' == $host) {
			preg_match("/470304_([0-9]+)\/singlePlayer/i",$link,$flashvar);
            $img[1]='';
            $title[1]='';
        } elseif('56.com' == $host) {
			preg_match("#/v_(\w+)\.html#", $link, $flashvar);//http://www.56.com/u82/v_ODUyNDg1NzU.html
			if (!$flashvar) {
				preg_match("#vid-(\w+)\.html#", $link, $flashvar);//http://www.56.com/w32/play_album-aid-11016619_vid-ODUzMjE5MDU.html
			}
			if ($flashvar) {
				$getlink="http://vxml.56.com/json/{$flashvar[1]}/?src=out";
				$retval = curl_get($getlink);
				if ($retval) {
					$json = json_decode($retval, true);
					$img[1] = $json['info']['img'];
					$title[1] = $json['info']['Subject'];
				}
			}
		}
        $return['flashvar'] = $flashvar[1];
        $return['img']   = $img[1];
        $return['title'] = $title[1];
        return $return;
    }
}
