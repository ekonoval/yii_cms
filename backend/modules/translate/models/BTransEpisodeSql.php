<?php

class BTransEpisodeSql extends MEpisodes
{
    public $movieName;
    private $_movieID;

    function setMovieID($movieID)
    {
        $this->_movieID = intval($movieID);
    }

    public function getSqlDataProvider()
    {
        //$priceCondition = !empty($this->price) ? ' WHERE unionAlias.price =' . $this->price : ' ';

        $SQL_COND = "";
        $params = array(':movieID' => $this->_movieID);
        // todo - optimize and incapsulate this
        if(isset($_GET["BTransEpisodeSql"])){
            if(
                isset($_GET["BTransEpisodeSql"]["seasonNum"])
                && !empty($_GET["BTransEpisodeSql"]["seasonNum"])
            ){
                $SQL_COND .= " AND e.seasonNum = :sNum ";
                $params[':sNum'] = $_GET["BTransEpisodeSql"]["seasonNum"];
            }
        }

        $sql = "
            SELECT e.*, m.movieName
            FROM episodes e
                INNER JOIN movies m
                    ON m.movieID = e.movieID
            WHERE
                e.movieID = :movieID
                {$SQL_COND}
        ";
        //pa($_GET);
        //echo "\n <pre>$sql </pre> <br/>\n";exit;


        $dataProvider = new \CSqlDataProvider($sql, array(
            //'db' => yDb(),
            'keyField' => 'episodeID',
            'totalItemCount' => 50,//todo fix
            'sort' => array(
                'attributes' => array('seasonNum', 'episodeNum'),
                'defaultOrder' => array('seasonNum' => true, 'episodeNum' => true),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
            'params' => $params
        ));

        return $dataProvider;
    }


    function getSeasonNumFilter()
    {
        $options = $this->_getSeasonOptions();

        $ddl_name = get_class($this)."[seasonNum]";
        return CHtml::dropDownList($ddl_name, '', $options);
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

        $options = array('' => '-select-');
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
