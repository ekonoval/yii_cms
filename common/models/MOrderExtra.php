<?php
namespace Ekv\models;
use CActiveRecord, CDbCriteria, CActiveDataProvider;
use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MOrderBase;

/**
 * This is the model class for table "orderExtra".
 *
 * The followings are the available columns in table 'orderExtra':
 * @property integer $idOrderExtra
 * @property integer $baseOrderID
 * @property string $extraTxtField
 *
 * The followings are the available model relations:
 * @property MOrderBase $baseOrder
 */
class MOrderExtra extends ActiveRecordBase
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

//    public function init()
//    {
//        $this->setTableAlias('oe');
//        parent::init(); // TODO: Change the autogenerated stub
//    }


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orderExtra';
	}

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baseOrderID', 'required'),
			array('baseOrderID', 'numerical', 'integerOnly'=>true),
			array('extraTxtField', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idOrderExtra, baseOrderID, extraTxtField', 'safe', 'on'=>'search'),

            //array('extraTxtField', 'safe')
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
			'baseOrderCn' => array(self::BELONGS_TO, MOrderBase::getClassNameFQ(), 'baseOrderID', 'alias' => 'oe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOrderExtra' => 'Id Order Extra',
			'baseOrderID' => 'Base Order',
			'extraTxtField' => 'Extra Txt Field',
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

		$criteria->compare('idOrderExtra',$this->idOrderExtra);
		$criteria->compare('baseOrderID',$this->baseOrderID);
		$criteria->compare('extraTxtField',$this->extraTxtField,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MOrderExtra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}