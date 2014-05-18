<?php

use Ekv\B\classes\Misc\DateHelper;
use Ekv\models\MMovies;

class BTransMovie extends MMovies
{
    public function search()
    {
        $criteria = new \CDbCriteria;

        $createDateMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->createDate, false);

        $criteria->compare('movieID', $this->movieID);
        $criteria->compare('movieName', $this->movieName, true);
        $criteria->compare('createDate', $createDateMysql, false);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
