<?php

/**
 * This is the model class for table "episodes".
 *
 * The followings are the available columns in table 'episodes':
 * @property integer $episodeID
 * @property integer $seasonNum
 * @property integer $episodeNum
 * @property integer $movieID
 */
class BTestEpisode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'episodes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seasonNum, episodeNum, movieID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('episodeID, seasonNum, episodeNum, movieID', 'safe', 'on'=>'search'),
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
			'episodeID' => 'Episode',
			'seasonNum' => 'Season Num',
			'episodeNum' => 'Episode Num',
			'movieID' => 'Movie',
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

		$criteria->compare('episodeID',$this->episodeID);
		$criteria->compare('seasonNum',$this->seasonNum);
		$criteria->compare('episodeNum',$this->episodeNum);
		$criteria->compare('movieID',$this->movieID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 2,
                //'route' => "/translate/episode/index/movieID/{$this->_movieID}/"
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BTestEpisode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    //#------------------- new -------------------#//

    function getSeasonNumFilter($model)
    {
        //pa($model);
        $selected = 5;
        $selected = $model->seasonNum;
        $options = $this->_getSeasonOptions();

        $ddl_name = get_class($this)."[seasonNum]";
        return $options;
    }

    private function _getSeasonOptions()
    {
        $sql = "
            SELECT DISTINCT seasonNum
            FROM `episodes`
            WHERE 1
            ORDER BY
                seasonNum ASC
        ";
        $command = yDb()->createCommand($sql);
        $dataReader = $command->query();

        //$options = array('' => '-select-');
        $options = array();
        foreach($dataReader as $rval){
            $snum = intval($rval["seasonNum"]);
            $options[$snum] = "season {$snum}";
        }

        return $options;
    }
}
