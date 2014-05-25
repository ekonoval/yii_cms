<?php
namespace Ekv\models;
use Ekv\components\Yii\Db\ActiveRecordBase;
use CDbCriteria, CActiveDataProvider;

/**
 * This is the model class for table "ekvNews2CategoryConn".
 *
 * The followings are the available columns in table 'ekvNews2CategoryConn':
 * @property integer $id
 * @property integer $newsID
 * @property integer $categoryID
 *
 * The followings are the available model relations:
 * @property MNewsCategory $category
 * @property MNews $news
 */
class MNews2CategoryConn extends ActiveRecordBase
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ekvNews2CategoryConn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, newsID, categoryID', 'required'),
			array('id, newsID, categoryID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, newsID, categoryID', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, MNewsCategory::getClassNameFQ(), 'categoryID'),
			'news' => array(self::BELONGS_TO, MNews::getClassNameFQ(), 'newsID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'newsID' => 'News',
			'categoryID' => 'Category',
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
		$criteria->compare('newsID',$this->newsID);
		$criteria->compare('categoryID',$this->categoryID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MNews2CategoryConn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
