<?php

class BTransEpisodeCommon extends MEpisodes
{
    public $movieName;
    protected $_movieID;

    function setMovieID($movieID)
    {
        $this->_movieID = intval($movieID);
    }

    function getSeasonNumFilter($model)
    {
        //pa($model);
        $selected = 5;
        $selected = $model->seasonNum;
        $options = $this->_getSeasonOptions();

        $ddl_name = get_class($this)."[seasonNum]";
        //return CHtml::dropDownList($ddl_name, $selected, $options);
        return $options;
    }

    private function _getSeasonOptions()
    {
        $sql = "
            SELECT DISTINCT seasonNum
            FROM `episodes`
            WHERE 1
            ORDER BY
                seasonNum DESC
        ";
        $command = yDb()->createCommand($sql);
        $dataReader = $command->query();

        //$options = array('' => '-select-');
        $options = array();
        foreach($dataReader as $rval){
            $snum = intval($rval["seasonNum"]);
            $options[$snum] = "season {$snum}";
        }

//        $res = $command->queryAll();
//        if(!empty($res)){
//            foreach($res as $rval){
//                $snum = intval($rval["seasonNum"]);
//                $options[$snum] = "season {$snum}";
//            }
//        }

        return $options;
    }
}
