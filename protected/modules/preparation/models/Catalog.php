<?php

/**
 * This is the model class for table "{{catalog}}".
 *
 * The followings are the available columns in table '{{catalog}}':
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $course
 */
class Catalog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{catalog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, pid, course', 'required'),
			array('pid, course', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, pid, course', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::app()->getModule('preparation')->t('preparation','Name'),
			'pid' => 'Pid',
			'course' => Yii::app()->getModule('preparation')->t('preparation','Course'),
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('course',$this->course);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbPreparation;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCourses()
	{
		$config =  Yii::getPathOfAlias('preparation.config.courses').'.php';		
		$courses = require $config;	
		return $courses;				
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

	//数据适配
	public function dataAdapter($model)
	{
		if(is_array($model))
		{
			foreach($model as $data)
			{
				$cateogryModel = new CategoryModel();
				$cateogryModel->id = $data->id;
				$cateogryModel->pid = $data->pid;
				$cateogryModel->name = $data->name;
				$result[] = $cateogryModel;				
			}
			return $result;

		}
		else
		{
			$cateogryModel = new CategoryModel();
			$cateogryModel->id = $model->id;
			$cateogryModel->pid = $model->pid;
			$cateogryModel->name = $model->name;
			return $cateogryModel;			
		}

	}

	//批量添加数据
	public function batchInsertData($file)
	{

	}
}
