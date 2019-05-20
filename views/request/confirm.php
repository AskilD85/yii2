<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
echo '<pre>';
//var_dump($model);
echo '</pre>';

?>
<?php $form = ActiveForm::begin()?>
    <?=$form->field($model2,'fullname')?>
    <?=$form->field($model,'email');?>
    <?=$form->field($model2,'username');?>
    <?=$form->field($model2,'password')->passwordInput();?>
    <?=Html::submitButton('Сохранить',['class'=> 'btn btn-success'])?>
<?php  ActiveForm::end()?>