<?php
namespace Ekv\B\widgets;

use CHtml;
use Ekv\B\components\System\GlobalHelper;
use Ekv\components\System\IFullyQualified;

class AdminBreadcrumps extends \CWidget implements IFullyQualified
{
// See CBreadcrumbs.php for more details
    public $tagName = 'ul';
    public $htmlOptions = array('class' => 'breadcrumbs');
    public $encodeLabel = true;
    //public $homeLink;
    public $links = array();
    public $separator = ' &raquo; ';

    public function run()
    {
        if (empty($this->links)) {
            return;
        }

        echo CHtml::openTag($this->tagName, $this->htmlOptions) . "\n";

//        if ($this->homeLink === null) {
//            $link = CHtml::link(Yii::t('zii', 'Home'), Yii::app()->homeUrl);
//        } else {
//            if ($this->homeLink !== false) {
//                $link = $this->homeLink;
//            }
//        }

        foreach ($this->links as $lval) {
            $label = $lval["name"];
            $url = $lval["href"];

            if (is_string($label) || is_array($url)) {
                $link = CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url);
            } else {
                $link = '<span>' . ($this->encodeLabel ? CHtml::encode($url) : $url) . '</span>';
            }

            if (is_string($label)) {
                echo '<li>' . $link . '</li>';
            } else {
                echo '<li class="noChevron">' . $link . '</li>';
            }

        }

        echo CHtml::closeTag($this->tagName);
    }

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }


}
 