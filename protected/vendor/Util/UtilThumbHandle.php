<?php
class UtilThumbHandle 
{
	private  $t;
	
	public function __construct($src)
	{	
		$this->t = new ThumbHandler();
		
		$this->t->setSrcImg($src);
	}
	
	public function getSrcImgWidth()
	{
		return $this->t->getSrcImgWidth();
	}
	
	/**
	 * ***************************************************************************
	 * @todo 生成图片等比例的缩略图
	 * ***************************************************************************
	 * @uses 
	 * $desinfo = array(
	 * 		'width'=>210,
	 * 		'path'=>''
	 * );
	 * $t = new UtilThumbHandle($src);
	 * $t->createThumbnail($desinfo);
	 * ****************************************************************************
	 * @param mixed $desinfo
	 */
	public function createThumbnail($desinfo=array())
	{
		$width = $desinfo['width'];
		
		$this->t->setCutType(1);//指明为手工裁切
		$this->t->setDstImg($desinfo['path']);
		
		$w = $this->t->getSrcImgWidth();
		$h = $this->t->getSrcImgHeight();
		
		//宽度缩放比例
		$num = ($width/$w)*100;
		
		$this->t->createImg($num);
	}
	
	/**
	 * ***********************************************************************
	 * @todo 从图片中间截取一个最大的正方形图像，然后进行缩放
	 * ***********************************************************************
	 * @param mixed $desinfo
	 */
	public function createAvatar($desinfo=array())
	{
		$this->t->setCutType(1);//这一句就OK了
		$this->t->setDstImg($desinfo['path']);		
		
		$this->t->createImg($desinfo['width'],$desinfo['width']);
	}
	
	/**
	 * **********************************************************************
	 * @todo 手工截图
	 * **********************************************************************
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see ThumbHandler::createImg()
	 */
	function createImg($desinfo, $src_x, $src_y, $src_w, $src_h, $cuttype=2)
	{

		$this->t->setCutType($cuttype);//指明为手工裁切
		$this->t->setSrcCutPosition($src_x, $src_y);// 源图起点坐标
		$this->t->setRectangleCut($src_w, $src_h);// 裁切尺寸
		$this->t->setImgDisplayQuality(90);
		$this->t->setDstImg($desinfo['path']);
		$this->t->createImg($desinfo['width'], $desinfo['height']);		
	}
	
	function deleteImg($src)
	{
		if (file_exists($src))
			unlink($src);
	}
}