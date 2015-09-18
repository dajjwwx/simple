<?php

/**
 * This is the model class for table "{{gaokao}}".
 *
 * The followings are the available columns in table '{{gaokao}}':
 * @property integer $id
 * @property integer $course
 * @property string $year
 * @property integer $paper
 * @property integer $fid
 * @property integer $pid
 *
 * The followings are the available model relations:
 * @property Gaokao $paper
 * @property Gaokao $paperkey
 * @property Paper $papername
 * @property File $file
 */
class Gaokao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gaokao}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course, year, paper, fid', 'required'),
			array('course, paper, fid, pid', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, course, year, paper, fid, pid', 'safe', 'on'=>'search'),
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
			'paper' => array(self::BELONGS_TO, 'Gaokao', 'pid'),	//上传试题
			'paperkey' => array(self::HAS_ONE, 'Gaokao', 'pid'),	//上传试题答案
			'papername' => array(self::BELONGS_TO, 'Paper', 'paper'),	//试卷名称
			'file' => array(self::BELONGS_TO, 'File', 'fid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'course' => Yii::app()->getModule('gaokao')->t('gaokao','Course'),
			'year' => Yii::app()->getModule('gaokao')->t('gaokao','Year'),
			'paper' => Yii::app()->getModule('gaokao')->t('gaokao','Paper'),
			'fid' => 'Fid',
			'pid' => 'Pid',
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
		$criteria->compare('course',$this->course);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('paper',$this->paper);
		$criteria->compare('fid',$this->fid);
		$criteria->compare('pid',$this->pid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbGaokao;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gaokao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * 删除上传的文件及Gaokao表中相关数据
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function deletePaper($model)
	{
		// $model = Gaokao::model()->findByPk($id);
		if($model)
		{
			//找到文件删除
			$folder = Yii::app()->params->uploadGaoKaoPath;
			$targetFile = File::model()->deleteFile($model->fid, $folder);	

			$model->delete();//删除Gaokao相关数据

			return true;		
		}

		return false;


	}
	


	public function getCourseName($id)
	{
		$courses = $this->getCourses();
		return $courses[$id-1]['course'];
	}
	
	public function getCoursesList()
	{
		$courses = $this->getCourses();

		if(func_num_args()==0){
			$list = array(
				''=>'科目'
			);					
		}
		

		
		for($i=0; $i < sizeof($courses); $i++)
		{
			$list[$courses[$i]['id']] = $courses[$i]['course'];
		}
		
		return $list;
	}

	/**
	 * [返回查询province时的like语句]
	 * @param  [int] $province
	 * @return [string]  $or 
	 */
	public function provinceLike($province)
	{
		$or = 'provinces = '.$province. ' OR ' ;
		$or .= 'provinces LIKE \'%,'.$province.',%\' OR ';
		$or .= 'provinces LIKE \'%,'.$province.'\' OR ';
		$or .= 'provinces LIKE \''.$province.',%\'';

		return $or;
	}

	/**
	 * 试卷是否已经存在
	 * @param  [int] $paper
	 * @param  [int] $course  
	 * @param  [int] $year  
	 * @return [bool]
	 */
	public function getPaperExists($paper,$course,$year)
	{
		
		$condition ='course = :course AND year = :year AND paper = :paper';
		$params = array(
			':course'=>$course,
			':year'=>$year,
			':paper'=>$paper				
		);
		
		return self::model()->exists($condition,$params); 
	}

	/**
	 * 获取试卷相关数据
	 * @param  [int] $paper
	 * @param  [int] $course  
	 * @param  [int] $year  
	 * @return [Gaokao]      
	 */
	public function getPaper($paper,$course,$year)
	{

		$criteria = new CDbCriteria(array(
			'condition'=>'course = :course AND year = :year AND paper = :paper',
			'params'=>array(
				':course'=>$course,
				':year'=>$year,
				':paper'=>$paper				
			)
		));	
		
		return self::model()->find($criteria);
	}
	
	/**
	 *根据省份和高考科目生成相关试卷链接
	 * @param  [int] $province
	 * @param  [int] $course  
	 * @param  [int] $year  
	 * @return [string]  
	 */
	public function getPaperLink($paper,$course,$year)
	{

		$criteria = new CDbCriteria(array(
			'condition'=>'course = :course AND year = :year AND paper = :paper',
			'params'=>array(
				':course'=>$course,
				':year'=>$year,
				':paper'=>$paper			
			)
		));


		$model = self::model()->find($criteria);

		//未完成，根据ID等信息生成相应的链接
		if($model)
		{
			$link = CHtml::link('试题',array('space/view','id'=>$model->id)).'&nbsp;&nbsp;&nbsp;&nbsp;';

			if($model->paperkey)
			{
				$link .= CHtml::link('答案',array('space/view','id'=>$model->paperkey->id));
			}
			else
			{
				$link .= '答案';
			}

			return $link;
			
		}
		else
		{
			return '<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>';
		}
	}
	
	public function getCourses()
	{
		$config =  Yii::getPathOfAlias('gaokao.config.gaokao_courses').'.php';		
		$courses = require $config;	
		return $courses;				
	}

	public function getProvinceCourses($province)
	{

		$courses = self::getCourses();	


		//默认21为海南
		if($province == 22)
		{
			unset($courses[4]);
			unset($courses[5]);
		}
		else
		{
			$chunks = array_chunk($courses, 6);
			$courses = $chunks[0];
		}

		return $courses;
	}

	/**
	 * [获取当前已有的高考真题卷]
	 * @return [int] 
	 */
	public function getCurrentYear()
	{
		return (intval(date('m')) >= 6)?date('Y'):(date('Y')-1);
	}
	
	public function getYearsList()
	{
		$list = array(''=>'年份');
		$years = $this->getYears();
		foreach($years as $K=>$year)
		{
			$list[$year] = $year;
		}
		
		return $list;
	}
	
	public function getYears()
	{
		$years = array_reverse(range(2006,date('Y')));
		return $years;
	}


	/**
	 * [getProvincesScope 获取试卷适用省份名称]
	 * @param  [string] $ids [适用省份ID]
	 * @return [string]      [对应省份名称的链接]
	 */
	public function getProvincesScope($ids)
	{

		$num = func_num_args();


		$links = '';
		$ids = explode(',', $ids);
		foreach ($ids as $key => $value) 
		{
			$province = Region::model()->getRegion($value);
			if(num > 1)
			{
				$links .= '<span>'.$province.'</span>';
			}
			else
			{
				$links .= CHtml::link($province,array('space/province/','id'=>$value));
			}
			
		}	
		return $links;
	}


	public function getProvinces()
	{
		$provinces = Region::model()->generateProvince(0);

		$keys = array_keys($provinces);
		$values = array_values($provinces);
		$provinces = array_combine($values, $keys);

		$provinces = array_slice($provinces, 0, 31);

		$keys = array_keys($provinces);
		$values = array_values($provinces);

		$provinces = array_combine($values, $keys);

		return $provinces;
	}
}
