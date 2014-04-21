<?php
namespace Ekv\B\components;
use Yii;

class WebModule extends \CWebModule
{
    protected $_namespace;

    public $_assetsUrl = null;

    protected function init()
    {
        $this->controllerNamespace = "\\{$this->_namespace}\\controllers";
        //pa($this->controllerNamespace);exit;
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
