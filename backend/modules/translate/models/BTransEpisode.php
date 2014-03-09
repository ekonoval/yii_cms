<?php

class BTransEpisode extends MEpisodes
{
    public $movieName;
    private $_movieID;

    function setMovieID($movieID)
    {
        $this->_movieID = intval($movieID);
    }

    public function relations()
    {
        $rel = array(
            'lMovie' => array(
                self::BELONGS_TO,
                'BTransMovie',
                'movieID'
            )
        );
        return $rel;
    }


    public function search()
    {

        $criteria = new CDbCriteria;

        $criteria->compare('episodeID', $this->episodeID);
        $criteria->compare('seasonNum', $this->seasonNum);
        $criteria->compare('episodeNum', $this->episodeNum);
        $criteria->compare('movieID', $this->movieID);

        //$criteria->addCondition(" movieID = '{$this->_movieID}' ");
        $criteria->addCondition(" t.movieID = :movieID ");
        $criteria->params[":movieID"] = $this->_movieID;

        $criteria->with = array('lMovie' => array('select' => 'movieName')); // !!!!!!!!!
        //$criteria->select = "t.*, movieName ";
        //$criteria->select = "t.*";
        //$criteria->select = array("t.*", );

        $provider =  new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'seasonNum DESC, episodeNum DESC',
            ),
            'pagination' => array(
                'pageSize' => 20
            ),
        ));

        return $provider;
    }
}
