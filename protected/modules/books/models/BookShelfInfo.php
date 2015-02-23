<?php

/**
 * This is the model class for table "{{shelf_info}}".
 *
 * The followings are the available columns in table '{{shelf_info}}':
 * @property integer $id
 * @property string $introduce
 * @property integer $image
 * @property integer $sid
 *
 * The followings are the available model relations:
 * @property BookShelf $shelf
 * @property SbFile $folder
 */
class BookShelfInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shelf_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid', 'required'),
			array('id, image, sid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, introduce, image, sid', 'safe', 'on'=>'search'),
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
			'shelf' => array(self::BELONGS_TO, 'BookShelf', 'sid'),
			'folder' => array(self::BELONGS_TO, 'File', 'image'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'introduce' => 'Introduce',
			'image' => 'Image',
			'sid' => 'Sid',
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
		$criteria->compare('introduce',$this->introduce,true);
		$criteria->compare('image',$this->image);
		$criteria->compare('sid',$this->sid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbLibaray;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookShelfInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * 
	 * @param integer $id		//书店ID
	 * @param mixed $info		//书店相关信息
	 */
	public function updateShelfInfo($id, $info=array())
	{
		
		$model = self::model()->findByAttributes(array(
				'sid'=>$id
		));
		
		if (!$model) {
			$model = new BookShelfInfo();
			$model->sid = $id;
		}		
		if (isset($info['introduce'])) {
			$model->introduce = $info['introduce'];
		}
		
		if (isset($info['image'])) {
			$model->image = $info['image'];
		}	
		
		if ($model->save()) {
			return $model;
		}
		else 
		{
			UtilHelper::dump($model->errors);
		}		
		
	} 
	
	//根本BOOK_ID获取书库封面
	public function getBookShelfFolderByBookId($id,$width=null)
	{
		$sid = Books::model()->findByPk($id)->sid;
		return self::getBookShelfFolder($sid, $width);
	}
	
	//获取书店封面
	public function getBookShelfFolder($id, $width=null)
	{
		$model = self::updateShelfInfo($id);		
		$file = $model->folder;		
		if ($file)
		{
			if(is_null($width))
			{
				return File::model()->attributeAdapter($file)->getFilePath(Yii::app()->params['uploadBooksPath'],false,false);
			}
			else 
			{
				return File::model()->attributeAdapter($file)->getFilePath(Yii::app()->params['uploadBooksPath'],false,true,array('width'=>$width));
			}			
		} 
		else
		{
			return '/public/image/books/bookshelf.jpg';
		}	

	}
	
	//获取书店封面所有展示图
	public function getFolderList($id)
	{
		$files = File::model()->findAll(array(
			'condition'=>'filetype = :filetype AND pid = :pid',	
			'order'=>'id DESC',
			'params'=>array(
				':filetype'=>File::FILE_TYPE_BOOKS,
				':pid'=>$id		
			)
		));		
		$i = 0;
		foreach ($files as $folder)
		{
			$album[$i]['id'] = $folder->id;
			$album[$i]['src'] = File::model()->attributeAdapter($folder)->getFilePath(Yii::app()->params['uploadBooksPath'],false,true,array('width'=>150)).'?';
			$i++;
		}		
		return $album;
		
	}
	

	
}
