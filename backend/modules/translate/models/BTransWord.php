<?php

class BTransWord extends MWords
{
    private $_episodeIDPreselected;

    /**
     * @param mixed $episodeID
     */
    public function setEpisodeIDPreselected($episodeID)
    {
        $this->_episodeIDPreselected = $episodeID;
    }

    protected function beforeValidate()
    {
        if($this->isNewRecord){
            //$this->episodeID = 555;
        }
        //pa($this->getAttributes());
        //$this->addError("", "xxxx");

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    protected function afterValidate()
    {
        pa("after validate");
        parent::afterValidate(); // TODO: Change the autogenerated stub
    }


    protected function afterSave()
    {
        $sql = "
            insert into `fake`
            (`dt`)
            VALUES
            (NOW())
        ";
        $cmd = yDb()->createCommand($sql);
        $cmd->query();
        //pa(yDb()->getLastInsertID());exit;


        parent::afterSave(); // TODO: Change the autogenerated stub
    }


    public function search()
    {

        $criteria=new CDbCriteria;

        $criteria->compare('wordID',$this->wordID);
        $criteria->compare('episodeID',$this->episodeID);
        $criteria->compare('wordEN',$this->wordEN,true);
        $criteria->compare('wordRU',$this->wordRU,true);
        $criteria->compare('isHard',$this->isHard);
        $criteria->compare('superHard',$this->superHard);


        //$criteria->addCondition(" movieID = '{$this->_movieID}' ");
        $criteria->addCondition(" t.episodeID = :episodeID ");
        $criteria->params[":episodeID"] = $this->_episodeIDPreselected;

        //$criteria->with = array('lMovie' => array('select' => 'movieName')); // !!!!!!!!!

        $provider =  new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'wordID DESC',
            ),
            'pagination' => array(
                'pageSize' => 20,
                //'route' => "/translate/episode/index?movieID={$this->_movieID}"
            ),
        ));

        return $provider;
    }

    public static function model($className=__CLASS__)
   	{
   		return parent::model($className);
   	}
}
