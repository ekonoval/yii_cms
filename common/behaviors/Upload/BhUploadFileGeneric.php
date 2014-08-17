<?php
namespace Ekv\behaviors\Upload;

use CUploadedFile;
use CValidator;
use Ekv\classes\Misc\PathHelper;
use Ekv\components\System\IFullyQualified;

abstract class BhUploadFileGeneric extends \CActiveRecordBehavior implements IFullyQualified
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

    public $allowEmpty = true;

    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes = '';//'doc,docx,xls,xlsx,odt,pdf';

    public $filePrefix = ''; // prefix_d201c2b27f4a693cc1462348ce2f7542.doc

    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios = array('insert', 'update');

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
                    'allowEmpty' => $this->allowEmpty
                )
            );
            $owner->validatorList->add($fileValidator);
        }

        $this->init();
    }

    protected function init()
    {

    }


    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeSave($event)
    {
        if(in_array($this->owner->scenario, $this->scenarios)){
            $fileObj = CUploadedFile::getInstance($this->owner, $this->fileAttrName);
            $isFileUploading = !empty($fileObj);

            if($isFileUploading){

                $newFileName = PathHelper::getRandomFileName($fileObj->extensionName, $this->filePrefix);

                $absPathBeingUploading = $this->composeAbsolutePathCustom($newFileName);

                $fileUploadRes = $fileObj->saveAs($absPathBeingUploading);

                //--- delete previous file ---//
                if($fileUploadRes){
                    if(!empty($this->oldFileName)){
                        $this->deleteFile($this->oldFileName);
                    }

                    $this->afterSuccessfullUpload($newFileName);

                    //--- save file field only if upload was successfull ---//
                    $this->owner->setAttribute($this->fileAttrName, $newFileName);
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

    protected function afterSuccessfullUpload($newFileName)
    {
        //usefull for image uploading
    }

    protected function composeAbsolutePathCustom($relativePath)
    {
        return $this->composeAbsolutePath($relativePath);
    }

    protected function composeAbsolutePath($relativePath)
    {
        $path = $this->baseSavePathAbsolute . DIRECTORY_SEPARATOR . $relativePath;
        return $path;
    }

    protected function getFileAttrValue()
    {
        return $this->owner->getAttribute($this->fileAttrName);
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeDelete($event)
    {
        $this->deleteFile(); // удалили модель? удаляем и файл, связанный с ней
    }

    abstract  protected function deleteFileCustom($fileName);

    protected function deleteFile($relativePath = '')
    {

        $relativePathCalculated = "";
        if(!empty($relativePath)){
            $relativePathCalculated .= $relativePath;
        }else{
            $relativePathCalculated .= $this->getFileAttrValue();
        }

        $this->deleteFileCustom($relativePathCalculated);
    }
}
 