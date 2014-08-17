<?php
namespace Ekv\B\modules\user\forms;

use Ekv\B\components\System\FormBuilder;
use Yii;

class FrmUserLogin extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'elements' => array(
                'username' => array(
                    'label' => Yii::t('AdminModule.admin', 'Логин'),
                    'type' => 'text',
                    'maxlength' => 32,
                ),
                'password' => array(
                    'label' => Yii::t('AdminModule.admin', 'Пароль'),
                    'type' => 'password',
                    'maxlength' => 32,
                ),
                'rememberMe' => array(
                    'label' => 'Запомнить меня',
                    'type' => 'checkbox',
                )
            ),

            'buttons' => array(
                'login' => array(
                    'type' => 'submit',
                    'label' => Yii::t('AdminModule.admin', 'Вход')
                )
            ),
        );

        return $config;
    }

}
 