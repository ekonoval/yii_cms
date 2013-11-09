<?php
namespace Ekv\B\modules\test\classes;

use Ekv\B\modules\test\models\Sqlite\MSqliteWords;

class SqliteToMysql
{
    function __construct()
    {

    }

    function main()
    {
//        $sql = "
//            SELECT *
//            FROM words
//        ";
//
//        $conn = yApp()->db_sqlite;
//        $cmd = $conn->createCommand($sql);
//        $res = $cmd->queryAll();

        //pa($res);

        $res = MSqliteWords::model()->findAll();
        //pa($obj);

        //pa(yDb()->quoteValue("riski'ng"));exit;


        $sql_values = array();
        foreach($res as $rval){
            /**
             * @var $rval MSqliteWords
             */

            $fields = array(
                $rval->wordID,
                $rval->episodeID,
                $rval->wordEN,
                $rval->wordRU,
                $rval->isHard,
                $rval->superHard
            );
            foreach($fields as &$fval){
                $fval = yDb()->quoteValue($fval);
            }

            $sql_values[] = "(".implode(",", $fields).")";
        }

        //pa($sql_values);

        if(!empty($sql_values)){
            $sql = "
                INSERT INTO `words`
                (wordID,episodeID,wordEN,wordRU,isHard,superHard)
                VALUES
                ".implode(',', $sql_values)."
            ";
            echo "\n <pre>$sql </pre> <br/>\n";

//            yDb()->createCommand($sql)->query();
//            echo "<h2>done  </h2>\n";
        }



    }

}
