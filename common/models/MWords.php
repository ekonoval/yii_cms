<?php

/**
 * This is the model class for table "words".
 *
 * The followings are the available columns in table 'words':
 * @property integer $wordID
 * @property integer $episodeID
 * @property string $wordEN
 * @property string $wordRU
 * @property integer $isHard
 * @property integer $superHard
 */
class MWords extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'words';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			'req' => array('wordEN, wordRU', 'required'),
			array('episodeID, isHard, superHard', 'numerical', 'integerOnly'=>true),
			array('wordEN, wordRU', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('wordID, episodeID, wordEN, wordRU, isHard, superHard', 'safe', 'on'=>'search'),
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
			'wordID' => 'Word',
			'episodeID' => 'Episode',
			'wordEN' => 'Word En',
			'wordRU' => 'Word Ru',
			'isHard' => 'Is Hard',
			'superHard' => 'Super Hard',
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

		$criteria->compare('wordID',$this->wordID);
		$criteria->compare('episodeID',$this->episodeID);
		$criteria->compare('wordEN',$this->wordEN,true);
		$criteria->compare('wordRU',$this->wordRU,true);
		$criteria->compare('isHard',$this->isHard);
		$criteria->compare('superHard',$this->superHard);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MWords the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
