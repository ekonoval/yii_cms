<?php
namespace Ekv\components\Yii\Db;

use CActiveRecord;
use Ekv\components\System\IFullyQualified;

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
                if($this->hasRelated($relName)){
                    if(is_array($this->$relName)){
                        foreach($this->$relName as $k => $val){
                            $finalRes[$relName][$k] = $val->attributes;
                        }
                    }else{
                        $finalRes[$relName] = $this->$relName->attributes;
                    }
                }
            }
        }

        return $finalRes;
    }

    protected function mergeRules($additionalRules, $parentRules)
    {
        return array_merge(
            $additionalRules,
            $parentRules
        );
    }

}
