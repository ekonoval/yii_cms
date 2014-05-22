<?php
namespace Ekv\components\Yii\Db;

use CActiveRecord;
use Ekv\B\components\System\IFullyQualified;

class ActiveRecordBase extends CActiveRecord implements IFullyQualified
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    function debugRes()
    {
        $finalRes = $this->attributes;

        $relations = $this->relations();
        $relationNames = !empty($relations) ? array_keys($relations) : array();

        if(!empty($relationNames)){
            foreach($relationNames as $relName){
                $finalRes[$relName] = $this->$relName->attributes;
            }
        }

        return $finalRes;
    }

}
 