<?php

/**
 * This is the model class for table "{{book_info}}".
 *
 * The followings are the available columns in table '{{book_info}}':
 * @property integer $id
 * @property string $title
 * @property string $origin_title
 * @property string $subtitle
 * @property string $pubdate
 * @property string $isbn10
 * @property string $isbn13
 * @property string $author
 * @property string $image
 * @property string $summary
 * @property string $tags
 * @property string $catelog
 * @property string $binding
 * @property string $translator
 * @property integer $pages
 * @property string $publisher
 * @property string $alt_title
 * @property string $author_intro
 * @property string $price 
 *
 * The followings are the available model relations:
 * @property Books[] $books
 */
class BookDetailInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{book_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,  isbn13', 'required'),
// 			array('title, subtitle', 'length', 'max'=>50),
// 			array('origin_title, author, translator', 'length', 'max'=>128),
// 			array('isbn10,  alt_title', 'length', 'max'=>255),
			array('isbn13', 'length', 'max'=>32),
// 			array('image', 'length', 'max'=>256),
// 			array('price', 'length', 'max'=>10),
// 			array('catelog, author_intro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, origin_title, subtitle, pubdate, isbn10, isbn13, author, image, summary, tags, catelog, binding, translator, pages, publisher, alt_title, author_intro, price', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Books', 'bid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'origin_title' => 'Origin Title',
			'subtitle' => 'Subtitle',
			'pubdate' => 'Pubdate',
			'isbn10' => 'Isbn10',
			'isbn13' => 'Isbn13',
			'author' => 'Author',
			'image' => 'Image',
			'summary' => 'Summary',
			'tags' => 'Tags',
			'catelog' => 'Catelog',
			'binding' => 'Binding',
			'translator' => 'Translator',
			'pages' => 'Pages',
			'publisher' => 'Publisher',
			'alt_title' => 'Alt Title',
			'author_intro' => 'Author Intro',
			'price' => 'Price',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('origin_title',$this->origin_title,true);
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('pubdate',$this->pubdate,true);
		$criteria->compare('isbn10',$this->isbn10,true);
		$criteria->compare('isbn13',$this->isbn13,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('catelog',$this->catelog,true);
		$criteria->compare('binding',$this->binding,true);
		$criteria->compare('translator',$this->translator,true);
		$criteria->compare('pages',$this->pages);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('alt_title',$this->alt_title,true);
		$criteria->compare('author_intro',$this->author_intro,true);
		$criteria->compare('price',$this->price,true);

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
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function addBookInfo($isbn)
	{
		$bookinfo = new DouBanBookInfo($isbn);	

		$model = BookInformation::model()->find(array(
				'condition'=>'isbn13 = :isbn13',
				'params'=>array(
					':isbn13'=>$isbn		
				)
		));
		
		if ($model) {
			return $model;
		} else {		
			$this->title = $bookinfo->_title;
			$this->origin_title = $bookinfo->_origin_title;	
			$this->pubdate = $bookinfo->_pubdate;		
			$this->isbn10 = $bookinfo->_isbn10;
			$this->isbn13 = $bookinfo->_isbn13;
			$this->author = $bookinfo->_author;
			$this->image = $bookinfo->_image;
			$this->summary = $bookinfo->_summary;
			$this->tags = $bookinfo->_tags;
			$this->catelog = $bookinfo->_catelog;;
			$this->binding = $bookinfo->_binding;
			$this->translator = $bookinfo->_translator;
			$this->pages = $bookinfo->_pages;
			$this->publisher = $bookinfo->_publisher;
			$this->alt_title = $bookinfo->_alt_title;
			$this->author_intro = $bookinfo->_author_intro;
			$this->price = floatval($bookinfo->_price);
			
			if (!$this->save()) {
				UtilHelper::writeToFile($this->errors,'a+');
			} else {
				return $this;
			}

		}
	}
	
	
}
