<?php

class BTransEpisode extends MEpisodes
{
    private $_movieID;

    function setMovieID($movieID)
    {
        $this->_movieID = intval($movieID);
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('episodeID', $this->episodeID);
        $criteria->compare('seasonNum', $this->seasonNum);
        $criteria->compare('episodeNum', $this->episodeNum);
        $criteria->compare('movieID', $this->movieID);

        $criteria->addCondition(" movieID = '{$this->_movieID}' ");


        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'seasonNum DESC, episodeNum DESC',
            ),
            'pagination' => array(
                'pageSize' => 20
            ),
        ));
    }
}
