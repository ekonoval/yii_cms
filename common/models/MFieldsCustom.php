<?php

/**
 * This is the model class for table "fields_custom".
 *
 * The followings are the available columns in table 'fields_custom':
 * @property integer $id
 * @property string $fName
 * @property string $dt
 * @property string $txtFile
 * @property string $photoFile
 * @property integer $rubricID
 * @property string $markupNumeric
 * @property string $markupPercent
 */
class MFieldsCustom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fields_custom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fName', 'required'),
			array('rubricID', 'numerical', 'integerOnly'=>true),
			array('fName, txtFile', 'length', 'max'=>255),
			array('photoFile', 'length', 'max'=>100),
			array('markupNumeric, markupPercent', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fName, dt, txtFile, photoFile, rubricID, markupNumeric, markupPercent', 'safe', 'on'=>'search'),
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
			'fName' => 'F Name',
			'dt' => 'Dt',
			'txtFile' => 'Txt File',
			'photoFile' => 'Photo File',
			'rubricID' => 'Rubric',
			'markupNumeric' => 'Markup Numeric',
			'markupPercent' => 'Markup Percent',
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
		$criteria->compare('fName',$this->fName,true);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('txtFile',$this->txtFile,true);
		$criteria->compare('photoFile',$this->photoFile,true);
		$criteria->compare('rubricID',$this->rubricID);
		$criteria->compare('markupNumeric',$this->markupNumeric,true);
		$criteria->compare('markupPercent',$this->markupPercent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MFieldsCustom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
