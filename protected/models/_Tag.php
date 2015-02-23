<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property integer $id
 * @property string $name
 * @property integer $frequecy
 * @property integer $tid
 * @property integer $ico
 *
 * The followings are the available model relations:
 * @property File $ico0
 */
class Tag extends CActiveRecord
{
	
	const TAG_FAVORITE = 1;	//兴趣
	const TAG_STAR = 2;		//明星
	const TAG_FOOD = 3;		//食物
	const TAG_MOVIE = 4;	//影视
	const TAG_MUSIC = 5;	//音乐
	const TAG_SPORT = 6;	//运动
	const TAG_BOOK = 7;		//书籍
	const TAG_DIGIT = 8;	//数码
	const TAG_GAME = 9;		//游戏
	const TAG_TOURISM = 10;	//旅游
	const TAG_OTHER = 12; 	//其他
	
	const TAG_FEELING = 11;	//心情
	const TAG_ADVERTISEMENT = 13; //广告
	
	const TAG_TEMPLATE_STYLE = 14; //广告模板风格
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, frequecy, tid', 'required'),
			array('frequecy, tid, ico', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, frequecy, tid, ico', 'safe', 'on'=>'search'),
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
			'ico0' => array(self::BELONGS_TO, 'File', 'ico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'frequecy' => 'Frequecy',
			'tid' => 'Tid',
			'ico' => 'Ico',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('frequecy',$this->frequecy);
		$criteria->compare('tid',$this->tid);
		$criteria->compare('ico',$this->ico);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @todo 根据标签别名获取标签所属类型
	 * @uses archiver/updatefavoirte
	 * @param unknown_type $cname
	 */
	public function getTagTypeByCname($cname)
	{
		switch ($cname)
		{
			case 'favoriteStar':
				return self::TAG_STAR;
			case 'favoriteMusic':
				return self::TAG_MUSIC;
			case 'favoriteMovie':
				return self::TAG_MOVIE;
			case 'favoriteDigital':
				return self::TAG_DIGIT;
			case 'favoriteGames':
				return self::TAG_GAME;
			case 'favoriteTourism':
				return self::TAG_TOURISM;
			case 'favoriteOther':
				return self::TAG_OTHER;
			case 'favoriteSports':
				return self::TAG_SPORT;
			case 'favoriteBooks':
				return self::TAG_BOOK;
			case 'favoriteFood':
				return self::TAG_FOOD;
			case 'advertisement';
			return self::TAG_ADVERTISEMENT;
			case 'felling':
				return self::TAG_FEELING;
					
		}
	}
	
	/**
	 * 获取格式化标签
	 * 供给archive/favorite,archiver/efavorite使用
	 * @param int $type
	 * @param int $limit
	 * @param int $offset
	 * @param array $htmlOptions
	 * @param string $url
	 */
	public function getTags($type, $limit = 10, $offset=20, $htmlOptions=array('class'=>'selected btn btn-default btn-xs'),$url='javascript:void();')
	{
		$cacheId = 'getTags_'.$type.'_'.$offset;
	
		$result = Yii::app()->cache->get($cacheId);
	
		if ($result === false)
		{
			if (!isset($htmlOptions['class']))
				$htmlOptions['class'] = 'select';
				
			$criteria = new CDbCriteria();
			$criteria->condition = 'tid = '.$type;
			$criteria->limit = $limit;
			$criteria->offset = $offset;
				
			$model = Tag::model()->findAll($criteria);
				
			if ($model == null)
			{
				$criteria->offset = 0;
				$model = Tag::model()->findAll($criteria);
				return '没有了～';
			}
				
				
				
			foreach ($model as $tag)
			{
				$htmlOptions['id'] = 'tag-'.$tag->id;
				$result .= CHtml::link($tag->name,$url, $htmlOptions);
				//			$result .= '<span>'.$tag->name.'</span>';
	
			}
	
			Yii::app()->cache->set($cacheId, $result, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{tag}} WHERE tid = {$type}"));
		}
	
		UtilHelper::writeToFile($result);
	
		return $result;
			
	}
	
	/**
	 *
	 * @todo 生成标签链接
	 * @uses archiver/efavorite
	 * @param string $string
	 * @param string $pre
	 * @param string $end
	 * @param string $separator
	 * @param string $url
	 * @param array $htmlOptions
	 */
	public function generateTags($string,$pre = '',$end = '',$separator = '',$url='javascript:void();',$htmlOptions=array('class'=>'selected btn btn-default btn-xs','onclick'=>'back($(this))','style'=>'display:inline-block;'))
	{
		$result = '';
	
		$tags = explode(',', $string);
		
		if ($tags[count($tags)-1] == '') {
			array_pop($tags);
		}		
	
		foreach ($tags as $tag)
		{
			$result .= CHtml::link($pre.$tag.$end, $url, $htmlOptions).$separator;
		}
	
		return $result;
	}
	
	/**
	 * @todo 根据增减数组信息创建新标签，或更新标签使用频率
	 * @uses archiver/updatefavoirte
	 * @param unknown_type $info
	 */
	public function saveTag($info)
	{
	
		foreach ($info as $tag)
		{
			$type = $tag['type'];
			$add = $tag['add'];
			$minus = $tag['minus'];
				
			foreach ($add as $item)
			{
				$model = self::findTagByName($item, $type);
	
				if ($model == null)
				{
					self::createTag($item, $type);
				}
				else
				{
					$model->frequecy++;
					$model->save();
				}
			}
				
			foreach ($minus as $item)
			{
				$model = self::findTagByName($item, $type);
	
				$model->frequecy--;
				$model->save();
			}
				
	
		}
	}
	
	public function findTagByName($name,$type)
	{
		$model = Tag::model()->find(array(
				'condition'=>'name = :name AND tid = :type',
				'params'=>array(
						':name'=>$name,
						':type'=>$type
				)
		));
	
		return $model;
	}
	
	public function createTag($tag,$type)
	{
		$model = new Tag();
		$model->name = $tag;
		$model->tid = $type;
		if (!$model->save())
			echo CHtml::errorSummary($model);
	}
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->frequecy = 1;
			}
			return true;
		}
		else
			return false;
	}
}
