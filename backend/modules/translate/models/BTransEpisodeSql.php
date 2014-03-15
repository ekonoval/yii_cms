<?php

class BTransEpisodeSql extends BTransEpisodeCommon
{
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

        //--- sql total ---//
        $sql_total = "
            SELECT COUNT(*) as `cnt`
            FROM episodes e
                INNER JOIN movies m
                    ON m.movieID = e.movieID
            WHERE
                e.movieID = :movieID
                {$SQL_COND}
        ";
        $cmd = yDb()->createCommand($sql_total);
        $total_records = $cmd->queryScalar($params);

        $dataProvider = new \CSqlDataProvider($sql, array(
            //'db' => yDb(),
            'keyField' => 'episodeID',
            'totalItemCount' => $total_records,
            'sort' => array(
                'attributes' => array('seasonNum', 'episodeNum'),
                'defaultOrder' => array('seasonNum' => true, 'episodeNum' => true),
            ),
            'pagination' => array(
                'pageSize' => 2,
            ),
            'params' => $params
        ));

        return $dataProvider;
    }


}
