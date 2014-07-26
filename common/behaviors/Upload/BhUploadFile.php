<?php
namespace Ekv\behaviors\Upload;

class BhUploadFile extends BhUploadFileGeneric
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected function deleteFileCustom($relativePath)
    {
        $absPath = $this->composeAbsolutePath($relativePath);

        if (@is_file($absPath)) {
            @unlink($absPath);
        }
    }

}
 