<?php
namespace Ekv\behaviors;

use CComponent;
use CUploadedFile;
use CValidator;
use Ekv\B\components\System\IFullyQualified;
use Yii;

class BhUploadFile extends \CActiveRecordBehavior implements IFullyQualified
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    /**
     * @var string название атрибута, хранящего в себе имя файла и файл
     */
    public $fileAttrName = '';

    /**
     * @var string алиас директории, куда будем сохранять файлы
     */
    public $baseSavePathAbsolute = '';

    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios = array('insert', 'update');

    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes = 'doc,docx,xls,xlsx,odt,pdf';

    /**
     * Шорткат для Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.
     * Возвращает путь к директории, в которой будут сохраняться файлы.
     * @return string путь к директории, в которой сохраняем файлы
     */
    public function getSavePath()
    {
        return $this->baseSavePathAbsolute;
    }

    /**
     * @param \CModel $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);

        if (in_array($owner->scenario, $this->scenarios)) {

            // добавляем валидатор файла
            $fileValidator = CValidator::createValidator('file',
                $owner,
                $this->fileAttrName,
                array(
                    'types' => $this->fileTypes,
                    'allowEmpty' => true
                )
            );
            $owner->validatorList->add($fileValidator);
        }
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeSave($event)
    {
//        if (in_array($this->owner->scenario, $this->scenarios) &&
//            ($file = CUploadedFile::getInstance($this->owner, $this->fileAttrName))
//        ) {
//            $this->deleteFile(); // старый файл удалим, потому что загружаем новый
//
//            $this->owner->setAttribute($this->fileAttrName, $file->name);
//            $file->saveAs($this->savePath . $file->name);
//        }

        //pa('before Save BH');exit;

        if(in_array($this->owner->scenario, $this->scenarios)){
            $fileObj = CUploadedFile::getInstance($this->owner, $this->fileAttrName);
            $isFileUploading = !empty($fileObj);

            if($isFileUploading){
                $oldFileName = $this->getFileAttrValue();

                $this->owner->setAttribute($this->fileAttrName, $fileObj->getName());
                $fileObj->saveAs($this->getFileAbsFull());

                //--- delete previous file ---//
                $this->deleteFile($oldFileName);
            }else{
                $fileAttr = $this->fileAttrName;
                unset($this->owner->$fileAttr);
            }
        }

        return true;
    }

    private function getFileAbsFull()
    {
        $path = $this->baseSavePathAbsolute . DIRECTORY_SEPARATOR . $this->getFileAttrValue();
        return $path;
    }

    private function getFileAttrValue()
    {
        return $this->owner->getAttribute($this->fileAttrName);
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeDelete($event)
    {
        $this->deleteFile(); // удалили модель? удаляем и файл, связанный с ней
    }

    public function deleteFile($relativePath = '')
    {
        //$filePath = $this->baseSavePathAbsolute . $this->owner->getAttribute($this->fileAttrName);

        $filePath = $this->baseSavePathAbsolute . DIRECTORY_SEPARATOR ;
        if(!empty($relativePath)){
            $filePath .= $relativePath;
        }else{
            $filePath .= $this->getFileAttrValue();
        }

        if (@is_file($filePath)) {
            @unlink($filePath);
        }
    }
}
 