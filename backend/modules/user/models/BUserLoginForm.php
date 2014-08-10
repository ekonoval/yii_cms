<?php

use Ekv\B\components\User\Auth\BUserIdentity;

class BUserLoginForm extends \CFormModel
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $identity;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'tryAuthenticate'), // !!!!
        );
    }

    /**
     * Authenticate user
     */
    public function tryAuthenticate()
    {
        if(
            empty($this->username)
            || empty($this->password)
        ){
            return false;
        }

        $this->identity = new BUserIdentity($this->username, $this->password);

        if (!$this->identity->authenticate()) {
            $this->addError('password', Yii::t('AdminModule.admin', 'Неправильное имя пользователя или пароль.'));
        }
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }
}
 