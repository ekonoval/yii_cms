<?php
namespace Ekv\B\widgets\Grid;

class WGridCheckbox extends WGridColumn
{
    private $dropdownOptions = array(
        '1' => 'yes',
        '0' => 'no',
    );

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function init()
    {
        parent::init();

        //pa($this->dropdownOptions);
        $this->filter = $this->dropdownOptions;

        $this->value = function($data, $row){
            //pa($row, $data);exit;
            $pageEnabled = $data->pageEnabled;
            $value = isset($this->dropdownOptions[$pageEnabled]) ? $this->dropdownOptions[$pageEnabled] : '-';
            return $value;
        };
    }

}
