<?php

/**
 * @var $assetsManager CClientScript
 */
$assetsManager = yApp()->clientScript;
//pa($assetsManager); //exit;
pa(YII_DEBUG);
$assetsManager->scriptMap = array(
//    'jquery' => array(
////        'baseUrl' => $assetsManager->getCoreScriptUrl().'/',
////        'js' => array('jquery.min.js')
//        'baseUrl' => '//ajax.googleapis.com/ajax/libs/jquery/1.8/',
//        'js' => array('jquery.min.js'),
//    ),

    //'jquery.js' => "//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
    //'jquery.js' => $assetsManager->getCoreScriptUrl().'/jquery.min.js',
    //'jquery.js' => $assetsManager->getCoreScriptUrl().'/jquery.js',
    'jquery.js' => false,
    //'jquery-ui.css' => false,
);

$assetsManager->registerCoreScript('jquery');
$assetsManager->registerCoreScript('jquery.ui');

//pa($assetsManager);exit;
?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>

    <h2>ssss</h2>

</body>
</html>


 