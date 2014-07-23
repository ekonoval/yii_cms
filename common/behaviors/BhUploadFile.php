<?php
namespace Ekv\behaviors;

use CComponent;
use CEvent;
use CModelBehavior;
use CModelEvent;
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
     * @var string полный базовый путь директории, куда будем сохранять файлы
     */
    public $baseSavePathAbsolute = '';

    /**
     * @var string - when record has already previous file,
     * put it here - to delete old file after new file has been uploaded
     */
    public $oldFileName = '';

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
        if(in_array($this->owner->scenario, $this->scenarios)){
            $fileObj = CUploadedFile::getInstance($this->owner, $this->fileAttrName);
            $isFileUploading = !empty($fileObj);

            if($isFileUploading){

                $this->owner->setAttribute($this->fileAttrName, $fileObj->getName());
                $fileUploadRes = $fileObj->saveAs($this->getFileAbsFull());

                //--- delete previous file ---//
                if(
                    $fileUploadRes
                    && !empty($this->oldFileName)
                ){
                    $this->deleteFile($this->oldFileName);
                }

            }else{
                /*
                 * If the file was previously uploaded and now we just save other data (without uploading new file)
                 * don't let the old fileAttribute be ereased
                 */
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

    private function deleteFile($relativePath = '')
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
 