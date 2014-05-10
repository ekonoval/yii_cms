<?php
namespace Ekv\B\classes\Misc;

class DateHelper
{
    const FORMAT_JQ_DATE_PICKER = 'd.m.Y H:i';
    const FORMAT_JQ_DATE_PICKER_NO_TIME = 'd.m.Y';

    static function getJqDatePickerFormatedDate($mysql_date, $show_time = true)
    {
        $date_format = self::FORMAT_JQ_DATE_PICKER;
        if ($show_time == false) {
            $date_format = self::FORMAT_JQ_DATE_PICKER_NO_TIME;
        }

        $return_date = "";
        $php_date = self::mysqlDate2PhpDate($mysql_date);

        if ($php_date > 0) {
            $return_date = date($date_format, $php_date);
        }
        return $return_date;
    }

    //--- Convert 2009-06-15 13:16:4 to timestamp ---//
    static function mysqlDate2PhpDate($mysqldate)
    {
        return strtotime($mysqldate);
    }
}
 