<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;

class TranslateController extends BackendControllerBase
{
    protected function _breadcrumps()
    {
        parent::_breadcrumps();
        $this->_addBreadCrumpItem('Movies', $this->createUrl('/translate/movie/index/'));
    }

    protected function _addMovieIdBc($movieID)
    {
        //$movieID = yApp()->request->getParam('movieID');
        $url = $this->createUrl("/translate/episode/index/", array('movieID' =>  $movieID));

        $criteria = new \CDbCriteria(array('select' => 'movieID, movieName'));
        $movieObj = \BTransMovie::model()->findByPk($movieID, $criteria);
        if($movieObj){
            $this->_addBreadCrumpItem($movieObj->movieName, $url);
        }
    }

    function getEpisodeWordsIndexUrl($episodeID)
    {
        return $this->_episodeWordsUrl($episodeID, "index");
    }

    function getEpisodeWordsCreateUrl($episodeID)
    {
        return $this->_episodeWordsUrl($episodeID, "createExt");
    }

    private function _episodeWordsUrl($episodeID, $action)
    {
        return $url = $this->createUrl("/translate/word/{$action}", array("episodeID" => $episodeID));
    }
}
 