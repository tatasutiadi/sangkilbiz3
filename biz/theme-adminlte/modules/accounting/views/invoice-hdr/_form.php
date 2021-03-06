<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\Invoice $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="invoice-hdr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoice_type')->textInput() ?>

    <?= $form->field($model, 'invoice_date')->textInput() ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <?= $form->field($model, 'id_vendor')->textInput() ?>

    <?= $form->field($model, 'invoice_value')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
