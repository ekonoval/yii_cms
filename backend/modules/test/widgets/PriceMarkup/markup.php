<?php
/**
 * @var $model BTestFieldsCustom
 */
?>

<script type="text/javascript">
    var ekvHasMarkup =
    (function(){
        var o = {
            hasMarkup: <?=$model->hasMarkup ? 'true' : 'false';?>,
            setState: function(status){
                var inputElements = $("#hasMarkup .inputs input");
                var inputsBlock = $("#hasMarkup .inputs");

                if(status){
                    inputElements.removeAttr('disabled');
                    inputsBlock.removeClass('disabled');
                }else{
                    inputElements.attr('disabled', true);
                    inputsBlock.addClass('disabled', true);
                }
            }
        };

        return o;
    })();

    $(function(){
        $("#idHasMarkup").click(function(){
            ekvHasMarkup.setState($(this).is(":checked"));
        });

        ekvHasMarkup.setState($("#idHasMarkup").is(":checked"));
    });

    //console.log(ekvHasMarkup.hasMarkup);

</script>

<style type="text/css">
    #hasMarkup{
        /*width: 100%;*/
    }
    #hasMarkup .chbFlag{
        width: 100px;
        float: left;
        padding-top: 5px;
    }

    #hasMarkup label{
        float: none;
        display: inline-block;
        width: auto;
    }

    #hasMarkup .inputs{
        float: left;
    }

    #hasMarkup .inputs.disabled label{
        color: #d3d3d3;
    }

    #hasMarkup .inputs label{
        padding-left: 10px;
    }
    #hasMarkup .inputs input{
        width: 40px;
    }
</style>

<div id="hasMarkup" style="float: left;">
    <div class="chbFlag">
        <?php
        $hasMarkupJsID = "idHasMarkup";
        echo CHtml::activeLabel($model, "hasMarkup", array('for' => $hasMarkupJsID));
        echo CHtml::activeCheckBox($model, "hasMarkup", array('id' => $hasMarkupJsID));
        ?>
    </div>

    <div class="inputs">
        <?php
        echo CHtml::activeLabel($model, "markupPercent");
        echo CHtml::activeTextField($model, "markupPercent");

        echo CHtml::activeLabel($model, "markupNumeric");
        echo CHtml::activeTextField($model, "markupNumeric");
        ?>
    </div>
    <div style="clear: both;"></div>
</div>

 