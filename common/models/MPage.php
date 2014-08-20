<?php
namespace Ekv\models;

use Ekv\components\Yii\Db\ActiveRecordBase;
use CActiveRecord, CDbCriteria, CActiveDataProvider;

/**
 * This is the model class for table "ekvPage".
 *
 * The followings are the available columns in table 'ekvPage':
 * @property integer $idPage
 * @property string $pageTitle
 * @property string $url
 * @property string $metaDescr
 * @property string $metaKeywords
 * @property string $dateCreated
 * @property string $pageBody
 * @property integer $pageEnabled
 */
class MPage extends ActiveRecordBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ekvPage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pageTitle', 'required'),
			array('pageEnabled', 'numerical', 'integerOnly'=>true),
			array('pageTitle, url', 'length', 'max'=>255),
			// The following rule is used by search().

			array('url, pageTitle, metaDescr, metaKeywords, dateCreated, pageBody, pageEnabled', 'safe'),
			//array('idPage, url, pageTitle, metaDescr, metaKeywords, dateCreated, pageBody, pageEnabled', 'safe', 'on'=>'search'),
			array('idPage', 'safe', 'on'=>'search'),
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
			'idPage' => 'Id Page',
			'pageTitle' => 'Page Title',
			'metaDescr' => 'Meta Descr',
			'metaKeywords' => 'Meta Keywords',
			'dateCreated' => 'Date Created',
			'pageBody' => 'Page Body',
			'pageEnabled' => 'Page Enabled',
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

		$criteria->compare('idPage',$this->idPage);
		$criteria->compare('pageTitle',$this->pageTitle,true);
		$criteria->compare('metaDescr',$this->metaDescr,true);
		$criteria->compare('metaKeywords',$this->metaKeywords,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('pageBody',$this->pageBody,true);
		$criteria->compare('pageEnabled',$this->pageEnabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
