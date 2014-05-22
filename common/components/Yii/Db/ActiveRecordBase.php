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
}
 