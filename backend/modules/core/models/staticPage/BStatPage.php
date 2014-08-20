<?php

use Ekv\models\MPage;

class BStatPage extends MPage
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('idPage', $this->idPage);
        $criteria->compare('pageTitle', $this->pageTitle, true);
        $criteria->compare('metaDescr', $this->metaDescr, true);
        $criteria->compare('metaKeywords', $this->metaKeywords, true);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('pageBody', $this->pageBody, true);
        $criteria->compare('pageEnabled', $this->pageEnabled);

        $criteria->order = 't.idPage DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,

        ));
    }


}
 