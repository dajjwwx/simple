<?php
/**
 * @copyright (c) 2014 Blue Jobs <zclandxy@gmail.com>
 * @link http://www.yuekegu.com
 * @version 1.0
 * @date 2014/3/18
 * @license http://www.yuekegu.com/lisence
 * @description Define the FileModel fields
 * 
 ***************************************************************************************************************
 *
 *说明：此类作为一个辅助的文件信息保存的基类，要实现类的复用，常常需要在APPlication的Model中建立一个适配的方法
 *		用于转换数据。例建立一个File类,要想在File类中使用此类，则要在File类中建立一个数据转换方法
 *
 **************************************************************************************************************
 *
 * 使用流程：
 * 1.实例化fileModel:$filemodel = new FileModel();
 * 2.
 * 
 *********************************************************************************************************************
 * 
 * Classes List:
 *     class ThumbHandler
 *     class UtilFile
 *     
 *********************************************************************************************************************
 * 
 * Functions List:
 * 
 *     //设置获取文件地址的基本参数
 *     public function setDefaultValue($created, $links, $extension) 
 *     
 *     //获取文件地址
 *     protected function generateOriginFilePath($path, $isUploadPath=true, $isThumb=true,  $width=210)
 *     
 *     //获取文件地址或缩略图地址
 *     public function generateFilePath($path=null, $isUploadPath=true, $isThumb=true, $thumbOption=array())
 *     
 *     //此方法用于生成所需要图片
 *     protected function getPerfectImage($source,$destination,$width,$height,$border=1,$isMask=false,$masksrc='',$maskpos=4)
 * 
 **************************************************************************************************************************** 
 * History：
 *
 */
class FileModel
{
	public $id;			//主键id
	
	//文件原始属性
	public $name;		//文件原始名称
	public $created;	//文件添加时间
	public $extension;	//文件扩展名
	public $size;		//文件大小
	public $mine;		//文件Mimetype
	
	//附加属性
	public $pid;		//文件分类ID
	public $owner;		//文件所有者
	public $filetype;	//文件类型：
	public $hits;		//文件点击量
	public $links;		//文件链接名称 
	public $status;		//文件状态
	public $iscomment;	//文件是否允许评论
	public $tag;		//文件标签
	public $remark;		//文件备注
	
	
	public $server;	//文件服务器，此属性用于远程存取文件
	
	

	/**
	 * ******************************************************************************
	 * 获取文件链接名称 
	 * 注意：在获取链接名之前，应该设置文件的上传时间[created]以及文件名[name]属性 
	 * ******************************************************************************
	 */	
	public function getLinkName()
	{
		
		if (is_null($this->links)){
			$this->links = md5(date('ymdhis', $this->created).$this->name);
		}				
		return $this->links;
	}
	
	
	
	/**
	 **********************************************************************
	 *
	 *设置获取文件地址的基本参数
	 *
	 *****************************************************************
	 * @param int $created
	 * @param string $links
	 * @param string $extension
	 */
	public function setDefaultValue($created, $links, $extension)
	{
		
		$this->created = $created;
		$this->links = $links;
		$this->extension = $extension;	

	}

	
	/**
	 * **************************************************************
	 *根据不同的server 获取文件路径
	 * *****************************************************************
	 * @param string $folder
	 * @param string $isUploadPath
	 * @param string $isThumb
	 * @param array $thumbOption
	 * @return string
	 */
	public function getFilePath($folder = null, $isUploadPath=true, $isThumb=true,$thumbOption=array('width'=>210))
	{		
		if (is_null($folder)) {
			$folder = Yii::app()->params->uploadMediaPath;
		}
		
		
		//此处使用FileModel的generateFilePath与File的generateFilePath在数据转换方面有出入
		//2014/6/28 14:02
		$file = $this->generateFilePath($folder, $isUploadPath, $isThumb, $thumbOption);
		
		if ($this->server == 'local') {
			$file = $this->generateFilePath($folder, $isUploadPath, $isThumb, $thumbOption);
			return $file;
		}
		elseif ($this->server == 'qiniu')
		{
			$file = $this->generateFilePath($folder, false, false, $thumbOption);

			if($isUploadPath)
			{
				return $file;
			}
			else
			{
				$qiniu = new \API\QiNiu();			
				return $qiniu->getFilePath($file);
			}
			
			

			// $key = $qiniu->getKey($this,$folder);
			// if ($isThumb) {
			// 	return $qiniu->getImageLinks($key,$thumbOption['width']);
			// }
			// else 
			// {
			// 	return $qiniu->getFileLinks($key);
				
			// }
			
		}
		elseif ($this->server == 'baidu') 
		{
			$key = pathinfo($file, PATHINFO_BASENAME);
		}
		

		
	}
	
	
	/**
	 * ************************************************
	 * 获取文件地址
	 * ***********************************************
	 * 
	 * 思路：
	 * 1.得到基本路径path
	 * 2.判断是否为相对路径，是则再次验证本地图片路径是否存在，不存在则生成路径
	 * 
	 * 注意：
	 * 1.在使用此方法前，请判断此类是否已经实例化，并相应字段是否不为空
	 *  
	 * *********************************************
	 * 
	 * Usage:		
	 * $model = File::model()->findByPk(9);
	 * $file = new FileModel();
	 * $file->created = $model->created;
	 * $file->extension = 'jpg';
	 * $file->links = $model->name;	 
	 * 
	 * echo $file->generateOriginFilePath(Yii::app()->params['uploadPath']['advertisement'],false,true,300);
	 * 
	 * ************************************************************
	 * @param string  $path
	 * @param boolean $isUploadPath
	 * @param boolean $isThumb
	 * @return string
	 */	
	protected function generateOriginFilePath($path, $isUploadPath=true, $isThumb=true,  $width=210)
	{		

		$filepath = $path;
		
		$destination = '';
		
		//The original image
		$destination .=  $filepath.date('Y',$this->created).'/'.date('m',$this->created).'/'.date('d',$this->created).'/'.$this->getLinkName();
		
		// UtilHelper::writeToFile($destination,'a+',__LINE__,__FILE__);
		
		//此处有修改，原因是可能能生成链接，但文件已经不存在
// 		if (!file_exists('./'.$destination.'.'.$this->extension	)) {
// 			return Yii::app()->params['missingFolderThumbPath'];
// 		}
			
		if($isThumb)
		{							 
			$destination .= '_thumb_'.$width.'.'.$this->extension;	
		}
		else 
		{
			$destination .= '.'.$this->extension;		
		}			
		
		if($isUploadPath)
		{			
			$destination = '.'.$destination;
			
			if(!file_exists($destination))
			{
				UtilFile::createDir(dirname($destination));
			}
		}
				
		return $destination;		
	}

	
	
	/**
	 * 获取文件地址或缩略图地址
	 ***********************************************************************
	 *
	 * Usage1:		
	 * 		$model = File::model()->findByPk(9);
	 * 		$file = new FileModel();
	 * 		$file->created = $model->created;
	 * 		$file->extension = 'jpg';
	 * 		$file->links = $model->name;
	 *  
	 * 		$file->generateFilePath(Yii::app()->params['uploadPath']['advertisement'], $isUploadPath = false, $isThumb = true);
	 * 
	 * Usage2:
	 * 	 	$model = File::model()->findByPk(9);
	 *		$path = Yii::app()->params['uploadPath']['advertisement'];
	 *		echo File::model()->attributeAdapter($model)->generateFilePath($path,false,true);
	 **************************************************************************
	 * Notice:
	 * 在获取图片缩略图地址时务必要令
	 * $isUploadPath = false
	 * $isThumb = true
	 * 
	 * 
	 * 特别注意：
	 * 
	 * 在生成缩略图的选项说明
	 * $thumbOption['forceReload']
	 *----此参数用于强制重新生成缩略图
	 *
	 * $thumbOption['onlyPath'] 
	 * ----此参数用于生成缩略图路径时是否要查看缩略图是否存在，默认为false，即要检查
	 * ----特别感受，感觉添加此参数并没有太大用处，因为把$isUploadPath设为true，自然不会去生成图片,此参数仅仅是让该方法多了一个选择，即使$isUploadPath为false,也只会生成缩略图路径，而不会自动的去生成缩略图
	 *
	 ***************************************************************************
	 * @param boolean $isUploadPath
	 * @param boolean $isThumb
	 * @param string $path
	 * @return string
	 */
	public function generateFilePath($path=null, $isUploadPath=true, $isThumb=true, $thumbOption=array())
	{
		$defaultOption = array('width'=>210,'height'=>2000,'border'=>1,'isMask'=>false,'masksrc'=>'./public/images/logo.png','maskpos'=>4,'forceReload'=>false,'onlyPath'=>false);
		
		// UtilHelper::writeToFile($defaultOption);
		
		$thumbOption = array_merge($defaultOption,$thumbOption);
		
		// UtilHelper::writeToFile($thumbOption,'a+');
	   
       	extract($thumbOption); 
     
       	//检查是否要生成缩略图，路径是否为相对路径，并且是否只生成缩略图路径
	   	if($isThumb && (!$isUploadPath) && (!$onlyPath))
       	{       
            $source = $this->generateOriginFilePath($path, true, false);         
       
            $target = $this->generateOriginFilePath($path, true, true,  $width);
            
            // UtilHelper::writeToFile($target,'a+');

            if(file_exists($source))
            {
                 if(!file_exists($target) || $forceReload)
                {
                    $this->getPerfectImage($source, $target,$width, $height,$border,$isMask,$masksrc,$maskpos);
                }               
            }
            else
            {
                
//                return '';
            }        
       	}   
            
        $destination = $this->generateOriginFilePath($path, $isUploadPath, $isThumb,  $width); 
       
        return $destination;
        		
	}
	
	/**
	 * 根据已经生成的150像素的缩略图生成其他大小的缩略图
	 * @param string $path
	 * @param string $isUploadPath
	 * @param string $isThumb
	 * @param array $thumbOption
	 * @return string
	 */
	public function generateAvatarPath($path=null, $isUploadPath=true, $isThumb=true, $thumbOption=array())
	{
		$defaultOption = array('width'=>60,'height'=>2000,'border'=>1,'isMask'=>false,'masksrc'=>'./public/images/logo.png','maskpos'=>4,'forceReload'=>false);
	
		$thumbOption = array_merge($defaultOption,$thumbOption);
	
		extract($thumbOption);
		 
		if($isThumb && !$isUploadPath)
		{
			$source = $this->generateOriginFilePath($path, true, true, 150);
			 
			$target = $this->generateOriginFilePath($path, true, true,  $width);
	
			if(file_exists($source))
			{
				if(!file_exists($target) || $forceReload)
				{
					$this->getPerfectImage($source, $target,$width, $height,$border,$isMask,$masksrc,$maskpos);
				}
			}
			else
			{
	
				//                return '';
			}
		}
	
		$destination = $this->generateOriginFilePath($path, $isUploadPath, $isThumb,  $width);
		 
		return $destination;
	
	}
	
    /**
     *********************************************************************************
     * 
     * 此方法用于生成所需要图片
     * 
     **********************************************************************************
     * @param string $src	本地源图片地址
     * @param string $des	本地目标地址
     * @param int $width	目标图片宽度
     * @param int $height	目标图片高度
     * @param int $border	目标图片
	 * @param boolean $isMask	是否加水印
	 * @param string $masksrc	水印图片地址
	 * @param int $maskpos	水印位置
	 * @return 
	 */
	protected function getPerfectImage($source,$destination,$width,$height,$border=1,$isMask=false,$masksrc='',$maskpos=4)
	{

		try {
			
			$t = new ThumbHandler();
			$t->setSrcImg($source);
			$t->setImgDisplayQuality(90);
			$t->setCutType(1);//指明为手工裁切
			$t->setDstImg($destination);
			
			$w = $t->getSrcImgWidth();
			$h = $t->getSrcImgHeight();
            
            		
			//宽度缩放比例
			$percent = floatval($width/$w)*100;

     		if($isMask){
     			$t->setMaskImg($masksrc);
     			$t->setMaskPosition($maskpos);
     			$t->setMaskImgPct(30);			
     		}
            
            $t->createImg($percent);
			
		}catch(CException $e){
			echo $e->getTraceAsString();
		}
	}
	
}