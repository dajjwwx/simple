<?php

/**
 *
 * @author Administrator
 *        
 */
class DouBanBookInfo extends BookInformation {
	
	protected  $_from = 'https://api.douban.com/v2/book/isbn/:';
	
	/* !CodeTemplates.overridecomment.nonjd!
	 * @see BookInfo::init()
	 */
	protected function init() {
		// TODO 自动生成的方法存根
		
		$bookinfo = $this->getData();
		
		//UtilHelper::writeToFile($bookinfo,'a+');
		
		$this->_title = $bookinfo->title;
		$this->_origin_title = $bookinfo->origin_title;
		$this->_pubdate = $bookinfo->pubdate;
		$this->_isbn10 = $bookinfo->isbn10;
		$this->_isbn13 = $bookinfo->isbn13;
		$this->_author = $bookinfo->author;
		$this->_author = $this->getAuthor();
		$this->_image = $bookinfo->image;
		$this->_summary = $bookinfo->summary;
		$this->_tags = $this->tagsToString($bookinfo->tags);
		$this->_catelog = $bookinfo->catelog;
		$this->_binding = $bookinfo->binding;
		$this->_translator = $bookinfo->translator;
		$this->_translator = $this->getTranslator();
		$this->_pages = $bookinfo->pages;
		$this->_publisher = $bookinfo->publisher;
		$this->_alt_title = $bookinfo->alt_title;
		$this->_author_intro = $bookinfo->author_intro;
		$this->_price = $bookinfo->price;
		
		UtilHelper::writeToFile($this,'a+');
		
	}
	
	public function getUrl()
	{
		return $this->_from.$this->getIsbn13();
	}
	
	public function getTranslator()
	{
		$result = '';
		foreach ($this->_translator as $k=>$translator) {
			$result .= $translator.',';
		}
		return substr($result,0,strlen($result)-1);
	}
	
	public function getAuthor()
	{		
		$authors = $this->_author;
				
		if (!$authors) 	return '';
		
		$result = '';
		foreach ($authors as $k=>$author)	{
			$result .= $author.',';
		}
		
		return substr($result,0,strlen($result)-1);
		
		
	}
	
	public static function getLargeImage($url)
	{
		return str_replace('/mpic/', '/lpic/', $url);
	}
	
	public static function getSmallImage($url)
	{
		return str_replace('/mpic/', '/spic/', $url);
	}
	
	public function tagsToString($tags)
	{
		
		if (!$tags) {
			return '';
		}
		
		$result = '';		
		
		foreach ($tags as $k=>$tag){
			$result .= $tag->name.',';
		}
		
		return $result;
		
	}

	
	
	
}

?>