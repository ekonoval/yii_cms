<?php
/**
 * @var MPage $pageInfo
 */
use Ekv\models\MPage;

//pa($pageInfo);
?>

<h2><?php echo $pageInfo->pageTitle ?></h2>

<div class="page-body">
    <?=$pageInfo->pageBody ?>
</div>

 