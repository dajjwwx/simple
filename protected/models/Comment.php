<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property integer $cid
 * @property integer $pid
 * @property integer $uid
 * @property integer $ctype
 * @property integer $status
 * @property string $author
 * @property string $email
 * @property string $website
 * @property string $agent
 * @property string $ip
 * @property string $content
 * @property integer $pubdate
 *
 * The followings are the available model relations:
 * @property User $u
 * @property SbgBlog $c
 * @property Comment $p
 * @property Comment[] $comments
 */
class Comment extends CActiveRecord
{
	
	const COMMENT_PUBLISHED = 1;
	const COMMENT_TRASH = 2;
	const COMMENT_LOCK = 3;
	
	const COMMENT_TYPE_BLOG = 1;
	
	
	public $verifyCode;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctype,author, email,  content', 'required'),
			array('cid, pid, uid, ctype, status, pubdate', 'numerical', 'integerOnly'=>true),
			array('author, ip', 'length', 'max'=>30),
			array('email, website', 'length', 'max'=>50),
			array('agent, content', 'length', 'max'=>255),
			// verifyCode needs to be entered correctly
// 			array('verifyCode', 'captcha', 'allowEmpty'=>(!CCaptcha::checkRequirements())&&Yii::app()->user->isGuest),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cid, pid, uid, ctype, status, author, email, website, agent, ip, content, pubdate', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
			'blog' => array(self::BELONGS_TO, 'Blog', 'cid'),
			'parent' => array(self::BELONGS_TO, 'Comment', 'pid'),
			'comments' => array(self::HAS_MANY, 'Comment', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cid' => 'Cid',
			'pid' => 'Pid',
			'uid' => 'Uid',
			'ctype' => 'Ctype',
			'status' => Yii::t('basic','Status'),
			'author' => Yii::t('basic','NickName'),
			'email' => Yii::t('basic','Email'),
			'website' => Yii::t('basic','Website'),
			'agent' => Yii::t('basic','Agent'),
			'ip' => 'Ip',
			'content' => Yii::t('basic','Content'),
			'pubdate' => Yii::t('basic','Pubdate'),
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
		$criteria->compare('cid',$this->cid);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('ctype',$this->ctype);
		$criteria->compare('status',$this->status);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('pubdate',$this->pubdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getCommentStatus($status)
	{
		switch ($status) {
			case self::COMMENT_PUBLISHED:
				return Yii::t('basic','PUBLISHED');
				break;
			case self::COMMENT_LOCK:
				return Yii::t('basic','LOCK');
				break;
			case self::COMMENT_TRASH:
				return Yii::t('basic','TRASH');
				break;
		}
	}
	
	public function generateCommentStateDropdownList()
	{
		return array(
				self::COMMENT_PUBLISHED => self::getCommentStatus(self::COMMENT_PUBLISHED),
				self::COMMENT_LOCK => self::getCommentStatus(self::COMMENT_LOCK),
				self::COMMENT_TRASH => self::getCommentStatus(self::COMMENT_TRASH)
		);
	}
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->agent = $_SERVER['HTTP_USER_AGENT'];
				$this->ip = Yii::app()->request->userHostAddress;
				$this->pubdate = time();
				$this->status = self::COMMENT_LOCK;
				if (!Yii::app()->user->isGuest) {
					$this->uid = Yii::app()->user->id;
				}
			}
			return true;
		}
		else
			return false;
	}
}
