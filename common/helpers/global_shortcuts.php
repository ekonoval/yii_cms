<?php

function yApp()
{
    return Yii::app();
}

/**
 * @return CWebUser
 */
function yUser()
{
    return Yii::app()->user;
}

function yDb()
{
    return Yii::app()->db;
}

/**
 * @return CHttpSession
 */
function ySession()
{
    return Yii::app()->session;
}

function t($message, $params, $category = 'myproject')
{
    return Yii::t($category, $message, $params);
}

function h($text)
{
    return CHtml::encode($text);
}

//function l(…) {
//    return CHtml::link(…);
//}

//function param($name, $default = null)
//{
//    return isset(Yii::app()->params[$name] ? Yii::app()->params[$name] : $default);
//}

