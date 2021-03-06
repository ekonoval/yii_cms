<?php
namespace Ekv\B\extensions\sgridview;

use CClientScript;
use CException;
use CGridView;
use CHtml;
use Ekv\B\components\System\GlobalHelper;
use Ekv\B\modules\core\models\GridViewFilter;
use Ekv\components\System\IFullyQualified;
use Yii;

Yii::import('zii.widgets.grid.CGridView');
//Yii::import('application.modules.core.models.GridViewFilter');

/**
 * Extends yii gridview and adds several new features as: "Clear/Save filter",
 * ability to add personal menu.
 *
 * @package admin.widgets
 */
//implements IPathHelper
class SGridView extends CGridView implements IFullyQualified
{
    public $template = '{items}{summary}{pager}';
    public $selectableRows = 2;

    /**
     * @var bool Show additional filter actions as "Clear Filter" && "Save filter"
     */
    public $extended = true;

    /**
     * @var bool Set to false to hide `Delete` button.
     */
    public $hasDeleteAction = true;

    /**
     * @var bool Display custom actions
     */
    public $enableCustomActions = true;

    public $enableHistory = false;

    /**
     * @var array List of custom actions to display in footer.
     * See example in {@link SGridView::getFooterActions}
     */
    protected $_customActions;

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    /**
     * Initializes the grid view.
     */
    public function init()
    {
        // Uhhhh! ugly copy-paste from CBaseListView::init()!
        if ($this->dataProvider === null) {
            throw new CException(Yii::t('zii', 'The "dataProvider" property cannot be empty.'));
        }

        $this->dataProvider->getData();

        $this->htmlOptions['id'] = $this->getId();

        if ($this->enableSorting && $this->dataProvider->getSort() === false) {
            $this->enableSorting = false;
        }
        if ($this->enablePagination && $this->dataProvider->getPagination() === false) {
            $this->enablePagination = false;
        }
        // End of ugly

        if (!isset($this->htmlOptions['class'])) {
            $this->htmlOptions['class'] = 'grid-view';
        }

        if ($this->baseScriptUrl === null) {
            $this->baseScriptUrl = Yii::app()->getAssetManager()->publish(
                //Yii::getPathOfAlias('ext.sgridview.assets'),
                __DIR__.'/assets',
                false,
                -1,
                YII_DEBUG
            );
        }

        if ($this->cssFile !== false) {
            if ($this->cssFile === null) {
                $this->cssFile = $this->baseScriptUrl . '/styles.css';
            }
            Yii::app()->getClientScript()->registerCssFile($this->cssFile);
        }

        Yii::app()->getClientScript()->registerScriptFile($this->baseScriptUrl . '/gridview.dropdown.js', CClientScript::POS_END);

        $this->pager = array(
            'cssFile' => $this->baseScriptUrl . '/pager.css',
        );

        $this->initColumns();
        //pa($this->ajaxUrl);
    }

    static function getExtAssetsUrl($file_path_relative)
    {
        $baseUrl = Yii::app()->assetManager->publish(__DIR__."/assets/");
        $final = $baseUrl . "/{$file_path_relative}";

        return $final;
    }

    /**
     * Renders the data items for the grid view.
     */
    public function renderItems()
    {
        if ($this->extended && $this->filter) {
            $this->insertDropdownHtml();
            $this->insertModelAttributes();
        }

        parent::renderItems();

        if ($this->enableCustomActions === true) {
            $this->widget('zii.widgets.CMenu', array(
                'id' => $this->getId() . 'Actions',
                'htmlOptions' => array(
                    'class' => 'gridFooterActions',
                ),
                'items' => $this->getCustomActions(),
            ));
        }
    }

    /**
     * Insert dropdown menu html code.
     */
    public function insertDropdownHtml()
    {
        $filters = GridViewFilter::model()->findAllByAttributes(array(
            'grid_id' => $this->getId(),
            'user_id' => Yii::app()->user->id
        ));

        $filtersHtml = '';

        /**
         * If there have been any filters preloaded - display them as filer1 - delete button
         */
        if ($filters) {
            $filtersHtml .= CHtml::openTag('hr');
            foreach ($filters as $filter) {
                $filtersHtml .= strtr('
					<li id="SGridViewFilter_' . $filter->id . '">
						<div style="clear:both;">
							<div style="float:left;">
								<a href="#" onClick="return loadSGridViewFilterById(\'{gridId}\',{filterId})">{name}</a>
							</div>
							<div style="float:right;">
								{delete}
							</div>
						</div>
					</li>',

                    array(
                        '{name}' => CHtml::encode($filter->name),
                        '{gridId}' => $this->getId(),
                        '{filterId}' => $filter->id,
                        '{delete}' => CHtml::ajaxLink(
                                CHtml::image($this->baseScriptUrl . '/cross.png', Yii::t('SGridView.core', 'Удалить')),
                                Yii::app()->createUrl('core/gridView/deleteFilter', array(
                                    'id' => $filter->id,
                                )),

                                // Ajax options
                                array(
                                    'success' => "js:function(){\$('#SGridViewFilter_{$filter->id}').remove();}"
                                ),

                                // Html options
                                array(
                                    'confirm' => Yii::t('SGridView.core', 'Вы действительно хотите удалить этот фильтр?'),
                                    'id' => 'fdLink' . $filter->id
                                )
                            )
                ));
            }
        }

        /*
         * Clear filter button / save filter buttons
         */
        echo strtr('
			<div class="gridViewOptions">&nbsp;</div>
			<div class="gridViewOptionsMenu">
				<ul>
					<li>
						<a href="#" onClick="clearSGridViewFilter(\'' . $this->getId() . '\');">' . Yii::t('SGridView.core', 'Очистить фильтр') . '</a>
					</li>
					<li>{saveLink}</li>
					' . $filtersHtml . '
				</ul>
			</div>', array(
                '{saveLink}' => $this->_checkAttributes() ? '<a href="#" onClick="$(\'#' . $this->getId() . 'saveFilterDialog\').dialog(\'open\');">' . Yii::t('SGridView.core', 'Сохранить фильтр') . '</a>' : '<a class="nonActive">' . Yii::t('SGridView.core', 'Сохранить фильтр') . '</a>',
            )
        );

        /*
         * Save filter jquery UI dialog preliminary markup (hidden after js is applied)
         */
        echo CHtml::openTag('div', array(
            'id' => $this->getId() . 'saveFilterDialog',
            'data-token' => Yii::app()->request->csrfToken
        ));
        echo '
			<div class="form">
				<div class="row">
					<input type="text" id="' . $this->getId() . 'FilterBox" maxlength="255">
					<div class="hint">' . Yii::t('SGridView.core', 'Укажите имя фильтра') . '</div>
				</div>
			</div>
		';
        echo CHtml::closeTag('div');

        Yii::app()->getClientScript()->registerScript('grid-modal-' . $this->getId(), 'initializeSaveFilterModal("' . $this->getId() . '");', CClientScript::POS_READY);
    }

    /**
     * Check if filter attributes is not empty.
     * @return boolean
     */
    public function _checkAttributes()
    {
        $attributes = $this->getModelAttributes();

        if ($attributes) {
            foreach ($attributes as $name => $val) {
                if (isset($_REQUEST[get_class($this->filter)][$name]) && $_REQUEST[get_class($this->filter)][$name] != '') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Add translate suuport.
     * Merge model attributes with translateable attributes.
     * @return array
     */
    public function getModelAttributes()
    {
        $attributes = $this->filter->attributes;
        if (isset($this->filter->translateAttributes)) {
            foreach ($this->filter->translateAttributes as $attrName)
                $attributes[$attrName] = $this->filter->$attrName;
        }
        return $attributes;
    }

    /**
     * Display current model attributes as json string in hidden block
     * for "save filter" js function.
     */
    public function insertModelAttributes()
    {
        if ($this->getModelAttributes()) {
            $attrs = array();

            foreach ($this->getModelAttributes() as $key => $value) {
                if ($value !== null) {
                    $attrs[get_class($this->filter) . '[' . $key . ']'] = $value;
                }
            }

            if (!empty($attrs)) {
                echo Chtml::openTag('div', array(
                    'id' => $this->getId() . 'HiddenJsonAttributes',
                    'style' => 'display:none',
                ));
                echo json_encode($attrs);
                echo CHtml::closeTag('div');
            }
        }
    }

    /**
     * @return array of actions
     */
    public function getCustomActions()
    {
        if ($this->hasDeleteAction === true) {
            $this->customActions = array(array(
                'label' => 'Удалить',
                'url' => $this->owner->createUrl('delete'),
                'linkOptions' => array(
                    'class' => 'actionDelete',
                    'data-question' => Yii::t('SGridView.core', 'Вы действительно хотите удалить выбранные объекты?'),
                )
            ));
        }
        return $this->_customActions;
    }

    /**
     * @param array $actions of user defined actions
     */
    public function setCustomActions($actions)
    {
        foreach ($actions as $action) {
            if (!isset($action['linkOptions'])) {
                $action['linkOptions'] = $this->getDefaultActionOptions();
            } else {
                $action['linkOptions'] = array_merge($this->getDefaultActionOptions(), $action['linkOptions']);
            }
            $this->_customActions[] = $action;
        }
    }

    /**
     * @return array Default linkOptions for footer action.
     */
    public function getDefaultActionOptions()
    {
        return array(
            'data-token' => Yii::app()->request->csrfToken,
            'data-question' => Yii::t('SGridView.core', 'Выполнить действие?'),
            'onClick' => strtr('return $.fn.yiiGridView.runAction(":grid", this);', array(
                ':grid' => $this->getId()
            )),
        );
    }
}

/**
 * Column class to render ID column
 */
//class SGridIdColumn extends \CDataColumn
//{
//
//    public function renderHeaderCell()
//    {
//        $this->headerHtmlOptions['width'] = '40px';
//        parent::renderHeaderCell();
//    }
//
//}