<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\master\models\ProductUomSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-uom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_product') ?>

    <?= $form->field($model, 'id_uom') ?>

    <?= $form->field($model, 'isi') ?>

    <?= $form->field($model, 'create_at') ?>

    <?= $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
