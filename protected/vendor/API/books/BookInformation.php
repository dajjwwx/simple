<?php
/**
 * 
 * @author Administrator
 *
 */
abstract class BookInformation
{
	
	private $_from;		//信息来源
	
	private $_title;			//书名
	private $_origin_title;		//书原名
	private $_subtitle;	//副书名
	private $_pubdate;	//出版时间
	private $_isbn10;		//ISBN10
	private $_isbn13;		//ISBN13
	private $_author;		//作者
	private $_image;		//封面图片
	private $_summary;	//简介
	private $_tags;			//标签
	private $_catelog;		//
	private $_binding;		//装订
	private $_translator;		//翻译
	private $_pages;		//页数
	private $_publisher;		//出版社
	private $_alt_title;		//
	private $_author_intro;		//作者简介
	private $_price;		//价格
	
	public function __construct($isbn)
	{
		$this->_isbn13 = $isbn;
		
		$this->init();
	}
	
	
	/**
	 * 设置图片信息
	 */
	protected abstract function init();

	public function getData()
	{
		$url = $this->getUrl();
		$bookinfo = file_get_contents($url);		
		$bookinfo = json_decode($bookinfo);
		return $bookinfo;
	}
	
	public function getUrl()
	{
		return $this->_from.$this->getIsbn13();
	}

	/**
	 * @return $_title
	 */
	public function getTitle() {
		return $this->_title;
	}

	/**
	 * @return $_origin_title
	 */
	public function getOrigin_title() {
		return $this->_origin_title;
	}

	/**
	 * @return $_subtitle
	 */
	public function getSubtitle() {
		return $this->_subtitle;
	}

	/**
	 * @return $_pubdate
	 */
	public function getPubdate() {
		return $this->_pubdate;
	}

	/**
	 * @return $_isbn10
	 */
	public function getIsbn10() {
		return $this->_isbn10;
	}

	/**
	 * @return $_isbn13
	 */
	public function getIsbn13() {
		return $this->_isbn13;
	}

	/**
	 * @return $_author
	 */
	public function getAuthor() {
		return $this->_author;
		

	}

	/**
	 * @return $_image
	 */
	public function getImage() {
		return $this->_image;
	}

	/**
	 * @return $_summary
	 */
	public function getSummary() {
		return $this->_summary;
	}

	/**
	 * @return $_tags
	 */
	public function getTags() {
		return $this->_tags;
	}

	/**
	 * @return $_catelog
	 */
	public function getCatelog() {
		return $this->_catelog;
	}

	/**
	 * @return $_binding
	 */
	public function getBinding() {
		return $this->_binding;
	}

	/**
	 * @return $_translator
	 */
	public function getTranslator() {
		return $this->_translator;
	}

	/**
	 * @return $_pages
	 */
	public function getPages() {
		return $this->_pages;
	}

	/**
	 * @return $_publisher
	 */
	public function getPublisher() {
		return $this->_publisher;
	}

	/**
	 * @return $_alt_title
	 */
	public function getAlt_title() {
		return $this->_alt_title;
	}

	/**
	 * @return $_author_intro
	 */
	public function getAuthor_intro() {
		return $this->_author_intro;
	}

	/**
	 * @return $_price
	 */
	public function getPrice() {
		return $this->_price;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setTitle($_title) {
		$this->_title = $_title;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setOrigin_title($_origin_title) {
		$this->_origin_title = $_origin_title;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setSubtitle($_subtitle) {
		$this->_subtitle = $_subtitle;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setPubdate($_pubdate) {
		$this->_pubdate = $_pubdate;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setIsbn10($_isbn10) {
		$this->_isbn10 = $_isbn10;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setIsbn13($_isbn13) {
		$this->_isbn13 = $_isbn13;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setAuthor($_author) {
		$this->_author = $_author;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setImage($_image) {
		$this->_image = $_image;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setSummary($_summary) {
		$this->_summary = $_summary;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setTags($_tags) {
		$this->_tags = $_tags;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setCatelog($_catelog) {
		$this->_catelog = $_catelog;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setBinding($_binding) {
		$this->_binding = $_binding;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setTranslator($_translator) {
		$this->_translator = $_translator;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setPages($_pages) {
		$this->_pages = $_pages;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setPublisher($_publisher) {
		$this->_publisher = $_publisher;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setAlt_title($_alt_title) {
		$this->_alt_title = $_alt_title;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setAuthor_intro($_author_intro) {
		$this->_author_intro = $_author_intro;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setPrice($_price) {
		$this->_price = $_price;
	}	
	
}
?>