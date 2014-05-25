<?php
namespace Ekv\models;
use Ekv\components\Yii\Db\ActiveRecordBase;
use CDbCriteria, CActiveDataProvider;

/**
 * This is the model class for table "ekvNews".
 *
 * The followings are the available columns in table 'ekvNews':
 * @property integer $idNews
 * @property string $name
 * @property string $headerPhoto
 * @property string $date
 * @property string $text
 * @property integer $enabled
 *
 * The followings are the available model relations:
 * @property MNews2CategoryConn[] $news2CategoryConns
 */
class MNews extends ActiveRecordBase
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
		return 'ekvNews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, headerPhoto, date, text, enabled', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('headerPhoto', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idNews, name, headerPhoto, date, text, enabled', 'safe', 'on'=>'search'),
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
			'news2CategoryConns' => array(self::HAS_MANY, MNews2CategoryConn::getClassNameFQ(), 'newsID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idNews' => 'Id News',
			'name' => 'Name',
			'headerPhoto' => 'Header Photo',
			'date' => 'Date',
			'text' => 'Text',
			'enabled' => 'Enabled',
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

		$criteria->compare('idNews',$this->idNews);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('headerPhoto',$this->headerPhoto,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MNews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
