<?php
namespace Ekv\B\modules\user\models;

class BUserLoginForm extends \CFormModel
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $_identity;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    /**
     * Authenticate user
     */
    public function authenticate()
    {
        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate()) {
            $this->addError('password', Yii::t('AdminModule.admin', 'Неправильное имя пользователя или пароль.'));
        }
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->_identity;
    }
}
 