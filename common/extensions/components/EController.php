<?php
use Ekv\components\Yii\Misc\ControllerGetAllActions;

/**
 * EController class
 *
 * Has some useful methods for your Controllers
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EController extends CController
{
    public $pageTitle;
    public $pageTitleFull;

	public $metaKeywords = "";
	public $metaDescription = "";

    protected function beforeAction($action)
    {
        $this->_breadcrumps();
        return parent::beforeAction($action);
    }


    /**
     * @var array - breadcrumbs
     */
    public $bc;

    protected function _breadcrumps(){}

    function getAllActionsList()
    {
        $obj = new ControllerGetAllActions($this);
        return $obj->mainGetAllActions();
    }

    protected function _addBreadCrumpItem($name, $href, $key = null)
    {
        $item = array(
            'name' => $name,
            'href' => $href
        );
        if(!is_null($key)){
            $this->bc[$key] = $item;
        }else{
            $this->bc[] = $item;
        }
    }


	/**
	 * Gets a param
	 * @param $name
	 * @param null $defaultValue
	 * @return mixed
	 */
	public function getActionParam($name, $defaultValue = null)
	{
		return Yii::app()->request->getParam($name, $defaultValue );
	}

	/**
	 * Loads the requested data model.
	 * @param string the model class name
	 * @param integer the model ID
	 * @param array additional search criteria
	 * @param boolean whether to throw exception if the model is not found. Defaults to true.
	 * @return CActiveRecord the model instance.
	 * @throws CHttpException if the model cannot be found
	 */
	protected function loadModel($class, $id, $criteria = array(), $exceptionOnNull = true)
	{
		if (empty($criteria))
			$model = CActiveRecord::model($class)->findByPk($id);
		else
		{
			$finder = CActiveRecord::model($class);
			$c = new CDbCriteria($criteria);
			$c->mergeWith(array(
				'condition' => $finder->tableSchema->primaryKey . '=:id',
				'params' => array(':id' => $id),
			));
			$model = $finder->find($c);
		}
		if (isset($model))
			return $model;
		else if ($exceptionOnNull)
			throw new CHttpException(404, 'Unable to find the requested object.');
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === $model->formId)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Outputs (echo) json representation of $data, prints html on debug mode.
	 * NOTE: json_encode exists in PHP > 5.2, so it's safe to use it directly without checking
	 * @param array $data the data (PHP array) to be encoded into json array
	 * @param int $opts Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_FORCE_OBJECT.
	 */
	public function renderJson($data, $opts=null)
	{
		if(YII_DEBUG && isset($_GET['debug']) && is_array($data))
		{
			foreach($data as $type => $v)
				printf('<h1>%s</h1>%s', $type, is_array($v) ? json_encode($v, $opts) : $v);
		}
		else
		{
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode($data, $opts);
		}
	}

	/**
	 * Utility function to ensure the base url.
	 * @param $url
	 * @return string
	 */
	public function baseUrl( $url = '' )
	{
		static $baseUrl;
		if ($baseUrl === null)
			$baseUrl = Yii::app()->request->baseUrl;
		return $baseUrl . '/' . ltrim($url, '/');
	}

    public function render($view = null, $data = null, $return = false)
    {
        if(is_null($view)){
           $view = "{$this->action->id}_tpl";
        }

        return parent::render($view, $data, $return);
    }

    /**
     * Tpl name is generated automatically
     * @param $data
     */
    function renderAuto($data = array())
    {
        $this->render(null, $data, false);
    }

    function getActionId()
    {
        return $this->action->id;
    }

    function getControllerIndexUrl()
    {
        $moduleName = $this->module->name;

        $relUrl = "";
        if(!empty($moduleName)){
            $relUrl .= "/{$moduleName}";
        }

        $relUrl .= "/{$this->id}/index/";
        return $relUrl;
    }

    function redirectControllerIndexUrl()
    {
        $this->redirect($this->getControllerIndexUrl());
    }

    function checkEditModel($model)
    {
        if (!$model) {
            throw new CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }
    }

    function ensureWith404($expr, $failMsg = '')
    {
        if(!$expr){
            if(!empty($failMsg)){
                $failMsg = "Page not found";
            }

            throw new CHttpException(404, $failMsg);
        }
    }

    /**
     * Used for composing page title in specific algorythm
     * @param string $view
     * @return bool
     */
    protected function beforeRender($view)
    {
        $parentRes = parent::beforeRender($view);

        if($parentRes){
            $this->composePageTitleFull();
        }

        return $parentRes;
    }

    protected function composePageTitleFull()
    {
        //override in main front and back controllers
    }

    protected function composePageTitleCommon($bigPartsSeparator, $commonTitle)
    {
        /**
         * When pageTitleFull is defined directly in controller then apply it without any further hesitations
         * or compose page title automatically
         */
        if(empty($this->pageTitleFull)){
            $leftTitle = "";
            if(!empty($this->pageTitle)){
                $leftTitle = $this->pageTitle;
            }else{
                $moduleName = !empty($this->module->id) ? $this->module->id : "";

                $localSeparator = "/";
                $leftTitle = "";

                if(!empty($moduleName)){
                    $leftTitle .= $moduleName . $localSeparator;
                }

                $leftTitle .= "{$this->id}{$localSeparator}{$this->action->id}";
            }

            $this->pageTitleFull = "{$leftTitle}{$bigPartsSeparator}{$commonTitle}";
        }
    }
}