<?php
use Libaray\Util\UtilString;

/**
 * 此程序开发的目的在于提供博客的自动备份功能
 * @author Administrator
 *
 */
class _UtilAutoSave {
	
	//检查当前信息是否与文件内容相似
	function checkSimilar($similarArr){
		foreach ($similarArr as $data){
			if($data > 90){
				return true;
			}
		}
		return false;
	}
	

	
	//读取存档文件信息
	function ReadAchive($file)
	{
		 
		if (!file_exists($file))
			die("[Error:{'file is not exists'}]");
		 
		$data = file_get_contents($file);
		//    	echo $data;
		$dataArr = explode('|#-#-#-#|', $data);
		//    	var_dump($dataArr);		 
		 
		$result = array();
		//    	echo "<br />";
		foreach ($dataArr as $arr){
			$pos = strpos($arr,':');
			$key = substr($arr, 0, $pos);
			$value = substr($arr, $pos+1,strlen($arr));
			//    		echo $key.'=>'.$value."<br />";
	
			$matches = array();
			//			$str = "Article[arc_created]:2011-05-02 03\:40\:33";
			$pattern = "/([A-Za-z]+)\[(\w+_\w+)\]/";
			preg_match($pattern, $key, $matches);
				
			$value = str_replace('\:', ':', $value);
			$value = str_replace('\;', ';', $value);
				
			$result[$matches[1]][$matches[2]]= $value;
		}
		 
		 
		return $result;
	}
	
	//获取所有存档文件信息
	public function getAllAchiveInfo()
	{
		$achiveInfo = array();
		$path = '.'.Yii::app()->params['autoSavePath'];
		$dir = dir($path);
		$i = 0;
		while (false !== ($entry = $dir->read())) {
			if(!($entry == '.' || $entry == '..')){
				$file =  $dir->path.$entry;
				$achiveInfo[] = $this->ReadAchive($file);
				$achiveInfo[$i]['Article']['id'] = substr($entry,0,strpos($entry, '.'));
				$i++;
			}
		}
		 
		return $achiveInfo;
	}
	
	/***
	 * //获取已经保存的文件，比较得出相似度，如果相似度超过90，并且当前准备保存的内容长度大小获取文件 内容长度，则更换文件内容,否则重新生成新的备份文件。
	*/
	public function saveAsFile()
	{
		// 		$this->layout='application.modules.admin.views.layouts.default';
		 
		//    	$message1 = <<<MESS
		//    	Article[arc_title]:強迫|#-#-#-#|Article[arc_content]:<span style="font-family\: arial, 宋体, sans-serif\; font-size\: 14px\; line-height\: 24px\; ">吕紫剑于1893年(光绪十九年)生于湖北宜昌，原<a target="_blank" href="http\://baike.baidu.com/view/2310.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">八卦掌</a>掌门。自称从小跟随母亲学习武术，后来拜<a target="_blank" href="http\://baike.baidu.com/view/1942567.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">江英</a>为师，稍大就读于湖北国医学堂。</span><div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div><br><div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　后来开办了“渝丹紫剑武术馆”和“吕紫剑骨伤科诊所”。他出版了《中国武当内家拳法》《八卦养生法》等著作。自己创编了“八卦浑元养生功”。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　2000年获全国健康老人金牌，被国家体育总局、武术管理中心，命名为：“中国武林泰斗”、“长江大侠”、国家武术九段。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　2005年10月18日在第五届武当太极拳联谊会和赵堡（何氏）太极拳联谊会担任评委。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　现系武当武术联合会名誉会长。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　据中国武术协会主席李杰介绍，中国武术段位制实施以来，曾相继向长期工作在武术教学和训练岗位的5位著名武术家授予了九段段位。真的愛你，吕紫剑是第一位获得九段的民间武术家。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　2007年1月24日成为全球最年长男性,。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　2009年1月2日成为全球最年长者，到今年他已经117岁了<div class="text_pic" style="border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(232, 232, 232)\; border-right-color\: rgb(232, 232, 232)\; border-bottom-color\: rgb(232, 232, 232)\; border-left-color\: rgb(232, 232, 232)\; background-image\: initial\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: rgb(246, 246, 246)\; padding-top\: 5px\; padding-right\: 5px\; padding-bottom\: 3px\; padding-left\: 5px\; margin-top\: 5px\; margin-right\: 5px\; margin-bottom\: 5px\; margin-left\: 5px\; text-align\: center\; float\: right\; position\: relative\; width\: 200px\; visibility\: visible\; background-position\: initial initial\; background-repeat\: initial initial\; "><a class=" pic-handle" title="查看图片" href="http\://baike.baidu.com/image/0ef211246fb27f6ac89559cb" target="_blank" style="text-decoration\: none\; color\: rgb(19, 110, 194)\; background-image\: url(http\://img.baidu.com/img/baike/s/zoom.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; width\: 14px\; height\: 14px\; font-size\: 0px\; line-height\: 0\; display\: block\; position\: absolute\; right\: 4px\; bottom\: 4px\; border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(246, 246, 246)\; border-right-color\: rgb(246, 246, 246)\; border-bottom-color\: rgb(246, 246, 246)\; border-left-color\: rgb(246, 246, 246)\; background-position\: 0px 0px\; background-repeat\: no-repeat no-repeat\; ">&nbsp;\;&nbsp;\;</a><a href="http\://baike.baidu.com/image/0ef211246fb27f6ac89559cb" target="_blank" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "><img class="editorImg nslog\:1232" title="" src="http\://imgsrc.baidu.com/baike/abpic/item/0ef211246fb27f6ac89559cb.jpg" style="border-top-width\: 0px\; border-right-width\: 0px\; border-bottom-width\: 0px\; border-left-width\: 0px\; border-style\: initial\; border-color\: initial\; display\: block\; " alt=""></a><p class="pic-info" style="margin-top\: 3px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 20px\; padding-bottom\: 0px\; padding-left\: 0px\; color\: rgb(102, 102, 102)\; font-size\: 12px\; font-weight\: normal\; word-wrap\: break-word\; word-break\: break-all\; font-style\: normal\; line-height\: 18px\; min-height\: 18px\; ">&nbsp;\;&nbsp;\;</p></div>。<div class="bpctrl" style="height\: 30px\; line-height\: 30px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div><h2 class="headline-1 bk-sidecatalog-title" style="margin-top\: 0px\; margin-right\: 0px\; margin-bottom\: 10px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 6px\; padding-left\: 0px\; font-size\: 18px\; font-weight\: bold\; line-height\: 24px\; border-bottom-width\: 1px\; border-bottom-style\: solid\; border-bottom-color\: rgb(222, 223, 225)\; clear\: both\; "><span class="text_edit editable-title" data-edit-id="108139\:108139\:2" style="font-size\: 12px\; float\: right\; display\: block\; margin-top\: 10px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; color\: rgb(51, 102, 204)\; font-weight\: normal\; "><a href="http\://baike.baidu.com/view/108139.htm#" class="nslog\:1019" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; height\: 15px\; line-height\: 16px\; background-image\: url(http\://img.baidu.com/img/baike/s/edit.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; display\: block\; width\: 50px\; padding-left\: 18px\; background-position\: 0% 50%\; background-repeat\: no-repeat no-repeat\; ">编辑本段</a></span><a name="2" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">个人自述</span></h2>　　吕紫剑在自述中写道，他与霍元甲，杜心武同一个时期的人物，与杜心武把酒言欢与冯玉祥是拜把子兄<div class="text_pic" style="border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(232, 232, 232)\; border-right-color\: rgb(232, 232, 232)\; border-bottom-color\: rgb(232, 232, 232)\; border-left-color\: rgb(232, 232, 232)\; background-image\: initial\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: rgb(246, 246, 246)\; padding-top\: 5px\; padding-right\: 5px\; padding-bottom\: 3px\; padding-left\: 5px\; margin-top\: 5px\; margin-right\: 5px\; margin-bottom\: 5px\; margin-left\: 5px\; text-align\: center\; float\: right\; position\: relative\; width\: 200px\; visibility\: visible\; background-position\: initial initial\; background-repeat\: initial initial\; "><a class=" pic-handle" title="查看图片" href="http\://baike.baidu.com/image/263e802f6c3cb0611f3089ab" target="_blank" style="text-decoration\: none\; color\: rgb(19, 110, 194)\; background-image\: url(http\://img.baidu.com/img/baike/s/zoom.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; width\: 14px\; height\: 14px\; font-size\: 0px\; line-height\: 0\; display\: block\; position\: absolute\; right\: 4px\; bottom\: 4px\; border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(246, 246, 246)\; border-right-color\: rgb(246, 246, 246)\; border-bottom-color\: rgb(246, 246, 246)\; border-left-color\: rgb(246, 246, 246)\; background-position\: 0px 0px\; background-repeat\: no-repeat no-repeat\; ">&nbsp;\;&nbsp;\;</a><a href="http\://baike.baidu.com/image/263e802f6c3cb0611f3089ab" target="_blank" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "><img class="editorImg nslog\:1232" title="吕紫剑近照" src="http\://imgsrc.baidu.com/baike/abpic/item/263e802f6c3cb0611f3089ab.jpg" style="border-top-width\: 0px\; border-right-width\: 0px\; border-bottom-width\: 0px\; border-left-width\: 0px\; border-style\: initial\; border-color\: initial\; display\: block\; " alt=""></a><p class="pic-info" style="margin-top\: 3px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 20px\; padding-bottom\: 0px\; padding-left\: 0px\; color\: rgb(102, 102, 102)\; font-size\: 12px\; font-weight\: normal\; word-wrap\: break-word\; word-break\: break-all\; font-style\: normal\; line-height\: 18px\; min-height\: 18px\; ">吕<wbr style="font-style\: normal\; font-weight\: normal\; ">紫<wbr style="font-style\: normal\; font-weight\: normal\; ">剑<wbr style="font-style\: normal\; font-weight\: normal\; ">近<wbr style="font-style\: normal\; font-weight\: normal\; ">照<wbr style="font-style\: normal\; font-weight\: normal\; "></p></div>弟，袍哥会大哥，利用自己的势力把洋人的轮船赶出长江的势力范围，曾还与霍元甲一起在上海抵抗日本势力，与日本武士比武杀死3个日本武士，多次抵抗日本势力（遭日本人暗杀——老婆死了自己逃过一劫），曾一掌把马歇尔的拳师打死，由蒋介石亲点国民党总教头，（蒋介石身边的十三太保都是其弟子）当过国民党的少将。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　解放战争后没有去台湾，一直劳改到70年代末才放出来，曾任陪都重庆南北武术家联盟会会长、陪都重庆卫戊司令部少将国术教官、重庆市中医协会主席、四川省武圣会会长、任国术研究所所长，等等。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1982年获全国武术精英赛雄狮金奖，1984年峨眉山拳师邀请赛特别金奖，1985年任国际功法联盟总会会长，1994年任国际气功协会首席顾问，2000年获全国健康老人金牌，被国家体育总局、武术管理中心，命名为：“中国武林泰斗”、“长江大侠”、国家武术九段。耳聪目明、身手矫健，现系武当武术联合会名誉会长。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　由于专长伤骨专科，在津、汉、渝等地行医，治人无数。他性情豪爽，行侠仗义，现授徒甚众，自己有紫剑武馆，下有八大掌门，第一大掌门是以王清华为首，都各有自己的事业。已成为国内外知名人士。1986年，他被国际气功学会聘为首席顾问。同年还获聘美国加州武当武术开发中心总顾问、副董事长。国武术段位制实施以来，曾相继向长期工作在武术教学和训练岗位的5位著名武术家授予了九段段位。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　吕紫剑老先生生于光绪19年，即1893年，湖北宜昌人士。多年来，深居简出的他从不愿过分张扬，只是偶尔参加一些和老年人有关的活动，而他与霍元甲曾有过的多年交往的经历更是鲜为人知。<sup style="margin-left\: 2px\; color\: rgb(51, 102, 204)\; cursor\: pointer\; ">[1]</sup><a name="ref_[1]" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><div class="bpctrl" style="height\: 30px\; line-height\: 30px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div><h2 class="headline-1 bk-sidecatalog-title" style="margin-top\: 0px\; margin-right\: 0px\; margin-bottom\: 10px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 6px\; padding-left\: 0px\; font-size\: 18px\; font-weight\: bold\; line-height\: 24px\; border-bottom-width\: 1px\; border-bottom-style\: solid\; border-bottom-color\: rgb(222, 223, 225)\; clear\: both\; "><span class="text_edit editable-title" data-edit-id="108139\:108139\:3" style="font-size\: 12px\; float\: right\; display\: block\; margin-top\: 10px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; color\: rgb(51, 102, 204)\; font-weight\: normal\; "><a href="http\://baike.baidu.com/view/108139.htm#" class="nslog\:1019" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; height\: 15px\; line-height\: 16px\; background-image\: url(http\://img.baidu.com/img/baike/s/edit.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; display\: block\; width\: 50px\; padding-left\: 18px\; background-position\: 0% 50%\; background-repeat\: no-repeat no-repeat\; ">编辑本段</a></span><a name="3" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">人物外号</span></h2><h3 class="headline-2 bk-sidecatalog-title" style="margin-top\: 15px\; margin-right\: 0px\; margin-bottom\: 5px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 0px\; padding-left\: 0px\; font-size\: 16px\; font-family\: Arial\; line-height\: 22px\; clear\: both\; "><a name="3_1" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">“长江大侠”</span></h3>　　上个世纪30年代，上海是中国最重要的的商品集散地和转运港口，长江航线的水路运输航线也是中国当时最重要的经济<div class="text_pic" style="border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(232, 232, 232)\; border-right-color\: rgb(232, 232, 232)\; border-bottom-color\: rgb(232, 232, 232)\; border-left-color\: rgb(232, 232, 232)\; background-image\: initial\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: rgb(246, 246, 246)\; padding-top\: 5px\; padding-right\: 5px\; padding-bottom\: 3px\; padding-left\: 5px\; margin-top\: 5px\; margin-right\: 5px\; margin-bottom\: 5px\; margin-left\: 5px\; text-align\: center\; float\: right\; position\: relative\; width\: 165px\; visibility\: visible\; background-position\: initial initial\; background-repeat\: initial initial\; "><a class=" pic-handle" title="查看图片" href="http\://baike.baidu.com/image/8474fbdd6eb77bf077c63863" target="_blank" style="text-decoration\: none\; color\: rgb(19, 110, 194)\; background-image\: url(http\://img.baidu.com/img/baike/s/zoom.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; width\: 14px\; height\: 14px\; font-size\: 0px\; line-height\: 0\; display\: block\; position\: absolute\; right\: 4px\; bottom\: 4px\; border-top-width\: 1px\; border-right-width\: 1px\; border-bottom-width\: 1px\; border-left-width\: 1px\; border-top-style\: solid\; border-right-style\: solid\; border-bottom-style\: solid\; border-left-style\: solid\; border-top-color\: rgb(246, 246, 246)\; border-right-color\: rgb(246, 246, 246)\; border-bottom-color\: rgb(246, 246, 246)\; border-left-color\: rgb(246, 246, 246)\; background-position\: 0px 0px\; background-repeat\: no-repeat no-repeat\; ">&nbsp;\;&nbsp;\;</a><a href="http\://baike.baidu.com/image/8474fbdd6eb77bf077c63863" target="_blank" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "><img class="editorImg nslog\:1232" title="" src="http\://imgsrc.baidu.com/baike/abpic/item/8474fbdd6eb77bf077c63863.jpg" style="border-top-width\: 0px\; border-right-width\: 0px\; border-bottom-width\: 0px\; border-left-width\: 0px\; border-style\: initial\; border-color\: initial\; display\: block\; " alt=""></a><p class="pic-info" style="margin-top\: 3px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 20px\; padding-bottom\: 0px\; padding-left\: 0px\; color\: rgb(102, 102, 102)\; font-size\: 12px\; font-weight\: normal\; word-wrap\: break-word\; word-break\: break-all\; font-style\: normal\; line-height\: 18px\; min-height\: 18px\; ">&nbsp;\;&nbsp;\;</p></div>命脉。当时在长江航线有十几家外国轮船公司，而民族产业只有民生航运公司一家。外国轮船公司在长江航线上横冲直撞，数百吨位乃至上千吨位的大船在航线上全速前进，丝毫不顾忌在航线附近作业的中国渔民的生命财产安全，船体及其掀起的巨浪撞翻、掀翻中国渔船、货船的事件时有发生，以牺牲中国人生命财产的代价换来了它们的“高航速、高效率”，也使顾忌重重的民族产业民生航运公司到了破产的边缘。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　经人介绍，民生航运公司的董事长找到吕紫剑先生，请他想办法。怀着一腔爱国热血的吕紫剑和朋友们四处奔走呐喊呼吁，号召人们不坐外国船，同时将外籍轮船上的中国领航员、水手等中方人员都召集到了民生航运公司旗下，外国航运公司彻底停运。气急败坏的外国航运公司重金招来日本著名武士、浪人首领三井秀夫向吕紫剑发出挑战，扬言要在拳台上当场打死他。吕为维护<a target="_blank" href="http\://baike.baidu.com/view/4952820.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">民生轮船公司</a>的利益，接受了挑战，在爱国将领冯玉祥等人的作证下，与三井秀夫立下生死契约，在宜昌校军场决斗，将对方打得口吐鲜血，一雪“东亚病夫”之国耻。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　中国人胜了！万众沸腾，民生航运公司当场聘请吕紫剑为公司副董事长。可是淡泊名利的吕紫剑婉言谢绝，但提出了一个条件：今后凡是持有他亲写路条的穷苦人找到民生航运公司乘船，公司要免收票款，并在到达目的地后送盘缠5块大洋，从此“长江大侠”吕紫剑先生的威名便传遍了大江南北。<h3 class="headline-2 bk-sidecatalog-title" style="margin-top\: 15px\; margin-right\: 0px\; margin-bottom\: 5px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 0px\; padding-left\: 0px\; font-size\: 16px\; font-family\: Arial\; line-height\: 22px\; clear\: both\; "><a name="3_2" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">当代“张三丰”</span></h3>　　对今天的我们来说，武当<a target="_blank" href="http\://baike.baidu.com/view/9691.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">张三丰</a>早已成为历史中的传奇，但与津门大侠霍元甲、关东大侠杜心武并称清末民初三大侠的吕紫剑吕老前辈却是今日现实中的一个传奇。他那116岁的人生岁月则演绎了一个世纪的传奇。传奇诞生的年代是上个世纪再上个世纪。清光绪19年，即1893年10月15日，吕紫剑出生在当时的湖北宜昌，那是当时一个在当地颇负盛名的武术世家。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1900年，吕紫剑7岁，他便开始随母亲习武。跟母亲学了5年武艺，吕紫剑进步神速。故此，1905年，吕紫剑12岁那年，家人决定让其跟从武当名师李国操习武，俗话说“学无止境”，痴迷武学的吕紫剑次年又来到峨眉山，与神掌李长叶结为师徒。算起来吕紫剑总共三次上峨眉山向神掌李长叶学武，跟其学艺时间长达8年。他从神掌李长叶处学成“游身<a target="_blank" href="http\://baike.baidu.com/view/2653062.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">八卦连环掌</a>”，日后还成为其第三代传人。除了神掌李长叶外，武当的紫霄道长徐本善也是吕紫剑一生中很重要的一位师父。在跟随李长叶学八卦掌期间，吕紫剑还曾经上过武当山拜师，拜在紫霄道长门下习内家拳。在吕紫剑习武20年后，他终于学有所成。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1920年，南京雨花台举办武术擂台，当时已27岁的吕紫剑一举夺得了武术大会擂台冠军。这标志着吕紫剑结束了拜师学习的生涯，开始自立于武林之中。吕紫剑的武术新人生是从行侠仗义开始的。其实，从年少时起，吕紫剑就心怀行侠仗义的习武宗旨。现在终得名师传授武术及中国医术的吕紫剑，自然满怀抱负要大干一场。今日每当吕紫剑回首当年，总不免神采飞扬地说：“学功夫不仅可以强身健体，更重要的是可以除暴安良！”而他也的确以武功为中国人挣回了面子。蒋介石对吕紫剑的名声有所耳闻，派人将吕紫剑请去，并决定聘请他担任镖师，同时授其少将国术主任教官之职。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1945年，吕紫剑一生中的另一件重要事件发生了。狂妄异常。他在重庆摆下了擂台，扬言要打败所有的中国人。此人虽狂妄，可手中倒的确有些真功夫。所以虽然挑战的好手不少，可一时间，都一一败在了汤姆·约翰的手下。于是汤姆·约翰更狂妄到无以复加的地步，不仅口出狂言，称中国功夫不过如此，更十分张狂地侮辱中国人为“东亚病夫”。吕紫剑获悉这一情况后大怒，于是找到蒋介石要求与此美国狂徒比武。在取得蒋介石及马歇尔同意后，吕紫剑与汤姆·约翰签下比武生死状，在重庆南山上一决高下。当时许多人听说后都十分为他担心，更有人劝他放弃比武。但他都付之一笑。最终，两人比武的结果是，吕紫剑以八卦掌将汤姆·约翰打倒，3日后汤姆·约翰在送往国外救治的飞机飞行途中因重伤不治身亡。吕紫剑为中国人出了一口气。<div class="bpctrl" style="height\: 30px\; line-height\: 30px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div><h2 class="headline-1 bk-sidecatalog-title" style="margin-top\: 0px\; margin-right\: 0px\; margin-bottom\: 10px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 6px\; padding-left\: 0px\; font-size\: 18px\; font-weight\: bold\; line-height\: 24px\; border-bottom-width\: 1px\; border-bottom-style\: solid\; border-bottom-color\: rgb(222, 223, 225)\; clear\: both\; "><span class="text_edit editable-title" data-edit-id="108139\:108139\:4" style="font-size\: 12px\; float\: right\; display\: block\; margin-top\: 10px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; color\: rgb(51, 102, 204)\; font-weight\: normal\; "><a href="http\://baike.baidu.com/view/108139.htm#" class="nslog\:1019" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; height\: 15px\; line-height\: 16px\; background-image\: url(http\://img.baidu.com/img/baike/s/edit.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; display\: block\; width\: 50px\; padding-left\: 18px\; background-position\: 0% 50%\; background-repeat\: no-repeat no-repeat\; ">编辑本段</a></span><a name="4" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">武术生涯</span></h2>　　光阴如梭，时间飞逝，几十年里吕紫剑一直以医术为人治病，同时设立武馆，传授武当功夫。据估计，如今仅内地由他教出的武当徒弟就已经逾五六千人，这些徒弟又授徒，算起来现在已传授至了第五代，徒子徒孙真的不计其数。虽然他人在四川，但他的徒弟甚至远达<a target="_blank" href="http\://baike.baidu.com/view/2607.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">香港</a>，其中最出名的要算香港天罡气功第三代掌门人马志富。自幼年起学习武当功夫的马志富，少时跟从师傅张影晴学天罡气功，一学便是30多年，现为天罡气功第三代掌门人。他最近两年才拜吕紫剑为师，学习八卦掌。在吕紫剑授徒过程中，常常有人尊少林，贬武当。其实古语有云“北宗少林、南尊武当”，少林及武当这两家的上乘武功各有其独到之处，若要比试武功，未必能分出胜负。马志富表示，少林功夫是硬功，武当则是以静制动、刚柔并重、快如闪电、慢如抽丝。少林功夫是外家功夫，少林派人一看其外表便知是练武之人；但武当派人则真人不露相，只有运气发功时才露出其内家功夫。马志富获得吕老前辈的真传，专心习练八卦掌。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　在马志富眼中，吕紫剑是一个很严厉的师父：“他将山上的教法带了下来。为怕我分心，习武期间不准我接触外界社会，比如看电影什么的都不允许。凌晨3点就要我起床，练功到早晨7点。”不过，马志富说一点也不觉得辛苦，难得有缘获得吕师傅的武功真传，必定用心学习，日后定要将学来的武术发扬光大。眼下，吕紫剑希望将来有机会在香港开设武馆授徒，将他的武功带到香港。在访港的几天里他发觉香港人甚少运动，他为此劝诫：“从前用刀用枪，武功可以保护自己；现在武功虽然抵挡不住枪林弹雨，但却可以强身健体。”救人无数养生有术 其实人们往往只知道吕紫剑有身好功夫，却很少有人知道其医术同样十分高明。早在1929年，为抗议当时<a target="_blank" href="http\://baike.baidu.com/view/8484.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">国民党</a>“废止中医案”，他被选为中医医疗组组长，与西医博士马立任的西医组进行百日医疗比赛，最后获胜。在马志富眼中，吕紫剑是一个很严厉的师父：“他将山上的教法带了下来。为怕我分心，习武期间不准我接触外界社会，比如看电影什么的都不允许。凌晨3点就要我起床，练功到早晨7点。”不过，马志富说一点也不觉得辛苦，难得有缘获得吕师傅的武功真传，必定用心学习，日后定要将学来的武术发扬光大。眼下，吕紫剑希望将来有机会在香港开设武馆授徒，将他的武功带到香港。在访港的几天里他发觉香港人甚少运动，他为此劝诫：“从前用刀用枪，武功可以保护自己；现在武功虽然抵挡不住枪林弹雨，但却可以强身健体。”救人无数养生有术 其实人们往往只知道吕紫剑有身好功夫，却很少有人知道其医术同样十分高明。早在1929年，为抗议当时<a target="_blank" href="http\://baike.baidu.com/view/8484.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">国民党</a>“废止中医案”，他被选为中医医疗组组长，与西医博士马立任的西医组进行百日医疗比赛，最后获胜。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　抗战期间，他在重庆与国民党爱国将领冯玉祥过往甚密，结为金兰之好，曾任国民党军事委员会总裁侍从室少将国术教官。1939年，当时的国民党六战区司令官高参礼勋股骨及坐骨粉碎性骨折，接受吕紫剑的治疗后，两个月内痊愈归队。解放后，吕老辈更是用他良好的医术救了不少人。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1950年后，他曾蒙冤30年。改革开放的春风，催发了他的第二个春天。1979年被选为市政协委员。凭着长年习练不辍的武艺和医术，他在重庆开设了“渝丹紫剑武术馆”和“吕紫剑骨伤科诊所”（如今还存在），并在全国各地办武馆数十处，授徒几千人，在港台和美、日、法及东南亚一带均有众多高徒。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　1986年，他被国际气功学会聘为首席顾问。同年还获聘美国加州武当武术开发中心总顾问、副董事长。他于2005年10月18日在第五届武当太极拳联谊会和赵保太极拳联谊会与重庆自然门掌门周文富共同担任评委。如今，吕紫剑在继承武当派各代宗师的内功心法后，将之融会贯通，自创了“八卦混元养生功法”。练功练了逾百年，吕紫剑悟出了养生之道，所以虽已年届116岁，却仍神采奕奕。老人的长寿让许多人羡慕，故此有不少人来请教个中真经，他则如实相告。“早上要吃得饱，中午要吃得好，晚上要吃得少。”好一个养生真经。吕紫剑通常早上6时起床，练习八卦掌约1小时便吃早餐。早点包括4只鸡蛋、4个馒头、2个大包，还有一大杯豆浆。他还特意叮嘱千万不要吃含脂肪的食物，尤其是肥猪肉，以免堵塞血管；瘦肉可以吃，但不能吃太多；糖亦不应吃，要多吃清淡食物如蔬菜；充足睡眠不可缺少，每日必定睡8小时。吕紫剑平日在家会将麦子磨成粉末用来冲茶，又从不吃海鲜。家人跟随他学武及饮食习惯，各人均十分长寿，3名子女现时分别为94、86及84岁，他的第三任妻子今年86岁，仍然体健。<div class="spctrl" style="height\: 14px\; line-height\: 14px\; font-size\: 12px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div>　　据中国武术协会主席李杰介绍，中国武术段位制实施以来，曾相继向长期工作在武术教学和训练岗位的5位著名武术家授予了九段段位。吕紫剑是第一位获得九段的民间武术家。过去一直认为像吕紫剑这样的大侠只会在武侠小说的情节中出现，但不曾想在这个现实世界中，真的有这样一位传奇的<a target="_blank" href="http\://baike.baidu.com/view/1435203.htm" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; ">武林高手</a>隐于闹市之中。<div class="bpctrl" style="height\: 30px\; line-height\: 30px\; overflow-x\: hidden\; overflow-y\: hidden\; "></div><h2 class="headline-1 bk-sidecatalog-title" style="margin-top\: 0px\; margin-right\: 0px\; margin-bottom\: 10px\; margin-left\: 0px\; padding-top\: 0px\; padding-right\: 0px\; padding-bottom\: 6px\; padding-left\: 0px\; font-size\: 18px\; font-weight\: bold\; line-height\: 24px\; border-bottom-width\: 1px\; border-bottom-style\: solid\; border-bottom-color\: rgb(222, 223, 225)\; clear\: both\; "><span class="text_edit editable-title" data-edit-id="108139\:108139\:5" style="font-size\: 12px\; float\: right\; display\: block\; margin-top\: 10px\; margin-right\: 0px\; margin-bottom\: 0px\; margin-left\: 0px\; color\: rgb(51, 102, 204)\; font-weight\: normal\; "><a href="http\://baike.baidu.com/view/108139.htm#" class="nslog\:1019" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; height\: 15px\; line-height\: 16px\; background-image\: url(http\://img.baidu.com/img/baike/s/edit.gif)\; background-attachment\: initial\; background-origin\: initial\; background-clip\: initial\; background-color\: initial\; display\: block\; width\: 50px\; padding-left\: 18px\; background-position\: 0% 50%\; background-repeat\: no-repeat no-repeat\; ">编辑本段</a></span><a name="5" style="text-decoration\: underline\; color\: rgb(19, 110, 194)\; "></a><span class="headline-content">世界第一寿星</span></h2>|#-#-#-#|Article[arc_state]:3|#-#-#-#|Article[arc_iscomment]:1|#-#-#-#|Article[arc_created]:2011-05-02 03\:40\:33|#-#-#-#|Article[arc_tags]:|#-#-#-#|Article[arc_cids]:|#-#-#-#|categoryName:|#-#-#-#|Article[arc_cid]:1|#-#-#-#|
		//MESS;
	
		//获取Post过来的信息内容
		if(isset($_POST['message'])){
			$message = $_POST['message'];
				
			$time = time();
				
			//所有存档文件与获取信息的相似度数组
			$similarArr = array();
	
			 
			$dir = dir('.'.Yii::app()->params['autoSavePath']);
			//	    	echo "Handler:".$dir->handle."\n";
			//	    	echo "Path:".$dir->path."\n";
			while (false !== ($entry=$dir->read())) {
				if(!($entry=='.'||$entry=="..")){
					$path = $dir->path.'/'.$entry;
					if(file_exists($path)){
	
						//获取保存的文件内容
						$data = file_get_contents($path);
	
						//比较文件内容与信息，得出相似度
						$similar = UtilString::similarCompare($data,$message);
	
						$similarArr[] = $similar;
	
						if($similar>90){
							//判断文件是否可写
							if(is_writable($path)){
								//								echo $similar.'/'.$path."我可以寫";
								//比较内容长度
								if(UtilTools::strlen_utf8($message)>UtilTools::strlen_utf8($data)){
									if(file_put_contents($path, $message)){
										echo "保存更新成功";
									}
									//									$similardata = $data;
										
										
								}else {
									//									$similardata = "備份文件更大，所以不保存";
								}
									
							}
						}
	
					}
				}
			}
	
			if(!$this->checkSimilar($similarArr)){
				$filename = '.'.Yii::app()->params->autoSavePath.date('ymdhis',$time).".asv";
				$fp = fopen($filename, "w+");
				fwrite($fp, $message);
				fclose($fp);
	
				echo "自动保存";
			}
		}
		 
		//    	$this->render('ttt',array(
		//    		'message'=>$message1,
		//    		'data'=>$similardata
		//    	));
	   
	}
	
}

?>