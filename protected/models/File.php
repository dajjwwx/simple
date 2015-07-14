<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property integer $id
 * @property integer $pid
 * @property integer $status
 * @property integer $iscomment
 * @property integer $hits
 * @property integer $islocal
 * @property string $server
 * @property string $name
 * @property string $tag
 * @property integer $filetype
 * @property integer $owner
 * @property integer $created
 * @property integer $size
 * @property string $extension
 * @property string $mine
 * @property string $links
 * @property string $remark
 * 
 * The followings are the available model relations:
 * @property Category $category
 * @property User $owner
 * @property Profile[] $avatar
 */
class File extends CActiveRecord
{
	
	//local file or not
	const FILE_ISLOCAL = 1;
	const FILE_ISREMOTE = 0;	
	
	//file allow comment or not
	const FILE_COMMENT_ALLOW = 1;
	const FILE_COMMENT_CANCEL = 0;
	
	//file type	
	//特别说明：如果需要在添加同类型的分类，分类编号修改后面的编号，如再添加一个娱乐视频分类，则分类编号为31

	const FILE_TYPE_BLOG = 10;				//博客系统分类上传的文件
	const FILE_TYPE_GALLERY = 20;		//相册系统分类
	const FILE_TYPE_VIDEO_EDU = 30;	//教学视频分类
	const FILE_TYPE_LAB = 40;				//实验项目分类
	const FILE_TYPE_BRAINSTROMING = 50;		//头脑风暴分类
	const FILE_TYPE_AVATAR = 60;			//头像分类
	const FILE_TYPE_BOOKS = 70;			//图书共享
	const FILE_TYPE_GAOKAO = 80;		//高考模块
	
	//file status
	const FILE_STATUS_RECYCLING = 0;	//放入回收站
	const FILE_STATUS_DRAFT = 1;	//草稿
	const FILE_STATUS_PUBLISHED = 2;	//发布
	const FILE_STATUS_ACHIVE = 3;	//文件存档	
	
	//file server
	const FILE_SERVER_LOCAL = 'local';	//本地存储
	const FILE_SERVER_QINIU = 'qiniu';	//七牛存储服务
	const FILE_SERVER_BAIDU = 'baidu';	//百度云存储服务
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, hits, islocal, name, filetype, owner, created, size, extension, mine, links', 'required'),
			array('pid, status, iscomment, hits, islocal, filetype, owner, created, size', 'numerical', 'integerOnly'=>true),
			array('server', 'length', 'max'=>50),
			array('name, tag, extension, links', 'length', 'max'=>500),
			array('mine', 'length', 'max'=>200),
			array('remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, status, iscomment, hits, islocal, server, name, tag, filetype, owner, created, size, extension, mine, links, remark', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
// 				'avatar' => array(self::BELONGS_TO, 'Profile', 'avatar'),
				'category' => array(self::BELONGS_TO, 'Category', 'pid'),
				'owner' => array(self::BELONGS_TO, 'User', 'owner'),
				'avatar' => array(self::HAS_ONE, 'Profile', 'avatar'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'status' => 'Status',
			'iscomment' => 'Iscomment',
			'hits' => 'Hits',
			'islocal' => 'Islocal',
			'server' => 'Server',
			'name' => 'Name',
			'tag' => 'Tag',
			'filetype' => 'filetype',
			'owner' => 'Owner',
			'created' => 'Created',
			'size' => 'Size',
			'extension' => 'extension',
			'mine' => 'Mine',
			'links' => 'Links',
			'remark' => 'Remark',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('status',$this->status);
		$criteria->compare('iscomment',$this->iscomment);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('islocal',$this->islocal);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('filetype',$this->filetype);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('created',$this->created);
		$criteria->compare('size',$this->size);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('mine',$this->mine,true);
		$criteria->compare('links',$this->links,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * File和FileModel之间的数据转换
	 *******************************************************************
	 * @param File $file
	 * @param FileModel $filemodel
	 */
	public function attributeAdapter(File $model)
	{
		$filemodel = new FileModel();
		$filemodel->name = $model->name;
		$filemodel->created = $model->created;
		$filemodel->extension = $model->extension;
	
		$filemodel->links = $model->links;
	
		$filemodel->server = $model->server;
	
		if ($model->links == ''){
			$filemodel->links = $filemodel->getLinkName();
		}
		return $filemodel;
	}
	
	/**
	 * 获取文件来源
	 * @param int $filetype
	 * @return string
	 */
	public function getFileIsLocal($filetype)
	{
		switch ($filetype){
			case self::FILE_ISLOCAL:
				return "LOCAL";
				break;
			case self::FILE_ISREMOTE:
				return "REMOTE";
				break;
			default:
				return "NULL";
				break;
		}
	}
	
	
	/**
	 * 设置文件服务器
	 * @param string $server
	 */
	public function setFileServer($server)
	{
		$this->server = $server;
	}
	
	/**
	 * 获取文件服务器
	 */
	public function getServer()
	{
		$this->setFileServer(Yii::app()->params->fileServer);
	
		return $this->server;
	}
	
}
