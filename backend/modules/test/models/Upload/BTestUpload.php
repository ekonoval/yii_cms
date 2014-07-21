<?php


class BTestUpload extends CFormModel
{
    public $fileUp;

    public function rules()
    {
        return array(
            array('fileUp', 'file', 'types' => 'txt')
        );
    }


}
 