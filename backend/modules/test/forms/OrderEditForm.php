<?php
namespace Ekv\B\modules\test\forms;

use CHtml;
use Ekv\B\components\System\FormBuilder;

class OrderEditForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'id' => 'orderEditForm',

            'elements' => array(
                'base' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'uid' => array('type' => 'text',),
                        'status' => array('type' => 'text',),
                        'baseTxtField' => array('type' => 'text',),
                    ),
                ),

                'extra' => array(
                    'type' => 'form',
                    'elements' => array(
                        'extraTxtField' => array('type' => 'text',),
                    ),
                ),

            ),
        );
        return $config;
    }

    public function render()
    {
        //pa($this->isRootObject);

        return
            $this->renderBegin() .
            $this->renderErrorSummarySingle() .
            $this->renderBody() .
            $this->renderEnd();
    }

    /**
     * Copy-paste from CForm class but cut off the piece of code which draws error summary for each related model
     * and draw common summary in single place for all related models
     * @return string
     */
    public function renderBody()
   	{
   		$output='';
   		if($this->title!==null)
   		{
   			if($this->getParent() instanceof self)
   			{
   				$attributes=$this->attributes;
   				unset($attributes['name'],$attributes['type']);
   				$output=CHtml::openTag('fieldset', $attributes)."<legend>".$this->title."</legend>\n";
   			}
   			else
   				$output="<fieldset>\n<legend>".$this->title."</legend>\n";
   		}

   		if($this->description!==null)
   			$output.="<div class=\"description\">\n".$this->description."</div>\n";

//   		if($this->showErrorSummary && ($model=$this->getModel(false))!==null)
//   			$output.=$this->getActiveFormWidget()->errorSummary($model)."\n";

   		$output.=$this->renderElements()."\n".$this->renderButtons()."\n";

   		if($this->title!==null)
   			$output.="</fieldset>\n";

   		return $output;
   	}

    /**
     * Tricky but working way to define the root object for form displaying
     * (each inner form is represented as object of the same type)
     * @return bool
     */
    protected function isRootObject()
    {
        return !($this->parent instanceof FormBuilder);
    }

    protected function renderErrorSummarySingle()
    {
        if(!$this->isRootObject()){
            return '';
        }

        $models = $this->getModels();
        $output = $this->getActiveFormWidget()->errorSummary($models);

        return $output;
    }


}
 