<?php
namespace Ekv\models;
use CActiveRecord, CDbCriteria, CActiveDataProvider;
use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MOrderExtra;

/**
 * This is the model class for table "orderBase".
 *
 * The followings are the available columns in table 'orderBase':
 * @property integer $idOrder
 * @property integer $uid
 * @property integer $status
 * @property string $baseTxtField
 *
 * The followings are the available model relations:
 * @property MOrderExtra $orderExtras
 */
class MOrderBase extends ActiveRecordBase
{
    const REL_ORDER_EXTRAS = "orderExtras";

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orderBase';
	}

    function getExtRelateFieldName($fieldName)
    {
        return self::REL_ORDER_EXTRAS . ".{$fieldName}";
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('uid, status', 'numerical', 'integerOnly'=>true),
			array('baseTxtField', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idOrder, uid, baseTxtField', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			self::REL_ORDER_EXTRAS => array(
                self::HAS_ONE,
                $this->getOrderExtraModelFq(),
                'baseOrderID',
                'joinType' => "INNER JOIN",
                'alias' => 'oe'
            ),
		);
	}

    protected function getOrderExtraModelFq()
    {
        return MOrderExtra::getClassNameFQ();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOrder' => 'Id Order',
			'uid' => 'Uid',
			'baseTxtField' => 'Base Txt Field',
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

		$criteria->compare('idOrder',$this->idOrder);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('baseTxtField',$this->baseTxtField,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MOrderBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
