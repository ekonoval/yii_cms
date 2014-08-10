<?php
$assetUrl = "/exim";

/**
 * @var $cs CClientScript
 */
$cs = yClientScript();
$cs->registerCssFile($assetUrl . '/css/yui-grids/reset-fonts-grids.css');
$cs->registerCssFile($assetUrl . '/css/base.css');
$cs->registerCssFile($assetUrl . '/css/forms.css');
$cs->registerCssFile($assetUrl . '/css/theme.css');
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CMS - login</title>
    <style type="text/css">
        input[type=text] {
            width: 200px;
        }

        div.wide form label {
            width: 120px;
        }

        #doc3.root {
            width: 750px;
            margin: auto;
            margin-top: 150px;
        }
        .root div.form input[type="submit"]{
            display: block;
            width: 100px;
            font-size: 15px;
        }
    </style>


</head>
<body>

<div id="doc3" class="yui-t root">
    <div id="bd" class="marleft">
        <div id="yui-main">
            <!-- Remove yui-b class for full wide -->
            <div class="yui-b marright">
                <!-- Main content -->

                <div id="content" class="yui-g">
                    <div class="form wide padding-all">
                        <?php echo $form; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>