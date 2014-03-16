<?php
namespace Ekv\B\widgets;

use Yii, CMap;

/**
 * Renders admin top menu
 */
class SystemMenu extends \CWidget
{

    private $_items;

    static function getName()
    {
        $name = '\\' . __CLASS__;
        //pa($name);exit;
        return $name;
    }

    /**
     * Set default items
     */
    public function init()
    {
        // Minimum configuration
        $this->_items = array(
            'users' => array(
                'label' => Yii::t('AdminModule.admin', 'Movies'),
                'position' => 1,
                'url' => '/translate/movie/index/'
            ),
            'catalog' => array(
                'label' => Yii::t('AdminModule.admin', 'Каталог'),
                'position' => 3,
            ),
            'cms' => array(
                'label' => Yii::t('AdminModule.admin', 'Сайт'),
                'position' => 4,
            ),
        );
    }

    /**
     * Render menu
     */
    public function run()
    {
        //$found = $this->findMenuFiles();
        $found = array();
        $items = CMap::mergeArray($this->_items, $found);

        $this->processSorting($items);
        $this->widget('backend.extensions.mbmenu.MbMenu', array('items' => $items));
    }

    /**
     * Sort menu items by position key.
     * @param $items array menu items
     */
    protected function processSorting(&$items)
    {
        //uasort($items, "SSystemMenu::sortByPosition");
        uasort($items, array($this, 'sortByPosition'));
        foreach ($items as $key => $item) {
            if (isset($item['items'])) {
                $this->processSorting($items[$key]['items']);
            }
        }
    }

    /**
     * Find and load module menu files.
     */
    protected function findMenuFiles()
    {
        $result = array();

        $installedModules = SystemModules::model()->findAll(array(
            'select' => 'name',
        ));

        foreach ($installedModules as $module) {
            $filePath = Yii::getPathOfAlias('application.modules.' . $module->name . '.config') . DIRECTORY_SEPARATOR . 'menu.php';
            if (file_exists($filePath)) {
                $result = CMap::mergeArray($result, require($filePath));
            }
        }

        return $result;
    }

    /**
     *  Sort an array
     * @static
     * @param  $a array
     * @param  $b array
     * @return int
     */
    public static function sortByPosition($a, $b)
    {
        if (isset($a['position']) && isset($b['position'])) {
            if ((int)$a['position'] === (int)$b['position']) {
                return 0;
            }
            return ((int)$a['position'] > (int)$b['position']) ? 1 : -1;
        }

        return 1;
    }

}