<?php
namespace Ekv\components\Yii\Main;
use CWebModule;
use Yii;

class WebModule extends \CWebModule
{
    protected $_namespace;

    public $_assetsUrl = null;

    /**
     * Folders in models directory used to autoload nonNamespaced models (mostly for forms)
     * @var array
     */
    protected $modelsPaths = array();//array('Ar', 'News', 'Sqlite');

    protected function init()
    {
        $this->controllerNamespace = "\\{$this->_namespace}\\controllers";

        //--- autoloaded pathes for models in subdirs ---//
        $aliases = array();
        $baseModelsPath = $this->name.'.models';
        $aliases[] = $baseModelsPath.".*";

        if(!empty($this->modelsPaths)){
            foreach($this->modelsPaths as $modelSubDir){
                $aliases[] = $baseModelsPath . ".{$modelSubDir}.*";
            }
        }

        $this->setImport($aliases);
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            //pa($controller->id);exit;
            $modelSubPathForController = "{$this->name}.models.{$controller->id}.*";
            Yii::import($modelSubPathForController);
            return true;
        } else {
            return false;
        }
    }

    protected function setModelsPaths($pathsArray)
    {
        $this->modelsPaths = $pathsArray;
    }

    protected function _setNamespace($namespace = __NAMESPACE__)
    {
        $this->_namespace = $namespace;
    }

    /**
     * Publish admin stylesheets,images,scripts,etc.. and return assets url
     *
     * @access public
     * @return string Assets url
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('application.modules.' . $this->moduleName . '.assets'),
                false,
                -1,
                YII_DEBUG
            );
        }

        return $this->_assetsUrl;
    }

    /**
     * Set assets url
     *
     * @param string $url
     * @access public
     * @return void
     */
    public function setAssetsUrl($url)
    {
        $this->_assetsUrl = $url;
    }
}
