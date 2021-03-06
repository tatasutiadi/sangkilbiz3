<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use biz\inventory\models\TransferNotice;
use biz\app\components\Helper as AppHelper;

/* @var $this yii\web\View */
/* @var $model biz\inventory\models\TransferNotice */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{input}"
        ]
    ])
?>
<?php
$renderField = function ($model, $key) use ($form) {
    return $form->field($model, "[$key]qty_approve")->textInput(['style' => 'width:80px;']);
}
?>
<div class="purchase-hdr-view col-lg-9">
    <?php
    $models = $model->transferNoticeDtls;
    $models[] = $model;
    echo $form->errorSummary($models);
    ?>
    <?php
    echo GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $model->transferNoticeDtls,
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idProduct.nm_product',
            'transferDtl.transfer_qty_send:text:Qty Send',
            'transferDtl.transfer_qty_receive:text:Qty Receive',
            'qty_notice',
            [
                'label' => 'Qty Approve',
                'format' => 'raw',
                'content' => $renderField
            ],
            'idUom.nm_uom',
        ]
    ]);
    ?>
</div>
<div class="col-lg-3" style="padding-left: 0px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Notice Header
        </div>
        <?php
        echo DetailView::widget([
            'options' => ['class' => 'table table-striped detail-view', 'style' => 'padding:0px;'],
            'model' => $model,
            'attributes' => [
                'idTransfer.transfer_num',
                'idTransfer.idWarehouseSource.nm_whse',
                'idTransfer.idWarehouseDest.nm_whse',
                'noticeDate',
            ],
        ]);
        ?>
    </div>
    <?php
    echo Html::activeHiddenInput($model, 'status', ['value' => TransferNotice::STATUS_UPDATE]);
    if (AppHelper::checkAccess('update', $model)) {
        echo Html::submitButton('Update', ['class' => 'btn btn-success']);
    }
    ?>
</div>
<?php
ActiveForm::end();
