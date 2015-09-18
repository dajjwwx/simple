<?php

/**
 * This is the model class for table "{{blog}}".
 *
 * The followings are the available columns in table '{{blog}}':
 * @property integer $id
 * @property string $cids
 * @property string $title
 * @property integer $iscomment
 * @property integer $isrecommend
 * @property integer $ctype
 * @property integer $author
 * @property integer $hits
 * @property integer $pubdate
 * @property integer $modify
 * @property string $tags
 * @property integer $status
 * @property string $content
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property Cids[] $cids
 * @property Comments $comment
 */
class Blog extends CActiveRecord
{
	
	const STATUS_LOCK		= 0; 	//锁定，未通过审核
	const STATUS_PUBLISHED	= 1; 	//发布
	const STATUS_ACHIVE		= 2; 	//存档
	const STATUS_DRIFT 		= 3;	//存草稿
	const STATUS_TRASH      = 4;    //回收站
	
	const COMMENT_ALLOW	= 1;		//允许评论
	const COMMENT_CANCEL = 0;		//取消评论
	
	const RECOMMEND_ALLOW = 1;		//允许推荐
	const RECOMMEND_CANCEL = 0;		//取消推荐
	
	const CONTENT_STORY = 1;		//Story
	const CONTENT_PAGE = 0;		//Page
	
	private static $_items=array();
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{blog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cids, title, iscomment, isrecommend, ctype, status, content', 'required'),
			array('iscomment, isrecommend, ctype, author, hits, pubdate, modify, status', 'numerical', 'integerOnly'=>true),
			array('cids', 'length', 'max'=>20),
			array('title', 'length', 'max'=>50),
			array('tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cids, title, iscomment, isrecommend, ctype, author, hits, pubdate, modify, tags, status, content', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'User', 'author'),
			'cids' => array(self::HAS_MANY, 'Cids', 'bid'),
			'comment'=>array(self::HAS_MANY,'Comment', 'cid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cids' => Yii::t('blog','Categories'),
			'title' => Yii::t('blog','Title'),
			'iscomment' => Yii::t('blog','Allow Comments'),
			'isrecommend' => Yii::t('blog','Allow Recommend'),
			'ctype' => Yii::t('blog','Content Type'),
			'author' => Yii::t('blog','Author'),
			'hits' => Yii::t('blog','Hits'),
			'pubdate' => Yii::t('blog','Publish Date'),
			'modify' => Yii::t('blog','Modify Date'),
			'tags' => Yii::t('blog','Tags'),
			'status' => Yii::t('blog','Status'),
			'content' => Yii::t('blog','Content'),
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
		$criteria->compare('cids',$this->cids,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('iscomment',$this->iscomment);
		$criteria->compare('isrecommend',$this->isrecommend);
		$criteria->compare('ctype',$this->ctype);
		$criteria->compare('author',$this->author);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('pubdate',$this->pubdate);
		$criteria->compare('modify',$this->modify);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbBlog;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Blog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getNewsStatus($status)
	{
		switch ($status) {
			case self::STATUS_ACHIVE:
				return Yii::t('blog','ACHIVE');
				break;
			case self::STATUS_DRIFT:
				return Yii::t('blog','DRIFT');
				break;
			case self::STATUS_LOCK:
				return Yii::t('blog','LOCK');
				break;
			case self::STATUS_PUBLISHED:
				return Yii::t('blog','PUBLISHED');
				break;
		}
	}
	
	public function generateStatusDropdownList()
	{
		return array(
				self::STATUS_PUBLISHED=>$this->getNewsStatus(self::STATUS_PUBLISHED),
				self::STATUS_LOCK=>$this->getNewsStatus(self::STATUS_LOCK),
				self::STATUS_ACHIVE=>$this->getNewsStatus(self::STATUS_ACHIVE),
				self::STATUS_DRIFT=>$this->getNewsStatus(self::STATUS_DRIFT),
				
		);
	}
	
	public function getContentType($type)
	{
		switch ($type){
			case self::CONTENT_PAGE:
				return Yii::t('blog', 'PAGE');
				break;
			case self::CONTENT_STORY:
				return Yii::t('blog', 'STORY');
				break;
		}
		
	}
	
	public function generateContentTypeDropdownList()
	{
		return array(
				self::CONTENT_STORY=>self::getContentType(self::CONTENT_STORY),
				self::CONTENT_PAGE=>self::getContentType(self::CONTENT_PAGE),
				
		);
	}
	
	public function getCommentStatus($status)
	{
	
		switch ($status) {
			case self::COMMENT_ALLOW:
				return Yii::t('blog','ALLOW');
				break;
			case self::COMMENT_CANCEL:
				return Yii::t('blog','CANCEL');
				break;
	
		}
	}
	
	public function generateCommentStatusDropdownList()
	{
		return array(
				self::COMMENT_ALLOW=>self::getCommentStatus(self::COMMENT_ALLOW),
				self::COMMENT_CANCEL=>self::getCommentStatus(self::COMMENT_CANCEL)
		);
	}
	public function getRecommendStatus($status)
	{
	
		switch ($status) {
			case self::RECOMMEND_ALLOW:
				return Yii::t('blog','ALLOW');
				break;
			case self::RECOMMEND_CANCEL:
				return Yii::t('blog','CANCEL');
				break;
	
		}
	}
	
	public function generateRecommendStatusDropdownList()
	{
		return array(				
				self::RECOMMEND_ALLOW=>self::getCommentStatus(self::RECOMMEND_ALLOW),
				self::RECOMMEND_CANCEL=>self::getCommentStatus(self::RECOMMEND_CANCEL),
					
		);
	}
	
	public function getPreviewNews($id)
	{
		$model = self::model()->find('id < :id ORDER BY id DESC',array(':id'=>$id));
		return $model;
	}
	
	public function getNextNews($id)
	{
		$model = self::model()->find('id > :id ORDER BY id ASC',array(':id'=>$id));
		return $model;
	}
	
	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->modify = time();
				$this->pubdate = time();
				$this->author = Yii::app()->user->id;
	
				$this->hits = 0;
			}
			else
				$this->modify = time();
			return true;
		}
		else
			return false;
	}
}
