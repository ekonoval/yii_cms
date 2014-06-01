<?php
use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MNews;

class BTestNews extends MNews
{
    public $categoriesRelated = array(22 => 'xxx2', 33 => 'yy3');
    public function rules()
    {
        return $this->mergeRules(
            array(array("categoriesRelated", "safe")),
            parent::rules()
        );
    }


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function search()
   	{
   		// @todo Please modify the following code to remove attributes that should not be searched.

   		$criteria=new CDbCriteria;

        $criteria->order = "date DESC";

   		$criteria->compare('idNews',$this->idNews);
   		$criteria->compare('name',$this->name,true);
   		$criteria->compare('headerPhoto',$this->headerPhoto,true);
   		$criteria->compare('date',$this->date,true);
   		$criteria->compare('text',$this->text,true);
   		$criteria->compare('enabled',$this->enabled);

   		return new CActiveDataProvider($this, array(
   			'criteria'=>$criteria,
   		));
   	}
}
 