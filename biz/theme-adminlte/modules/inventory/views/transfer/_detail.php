<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
use biz\inventory\models\TransferDtl;
use mdm\widgets\TabularInput;
use biz\app\assets\BizDataAsset;
use biz\master\components\Helper as MasterHelper;
?>
<div class="box box-info">
    <div class="box-header" style="padding: 10px;">
        Product :
        <?php
        echo AutoComplete::widget([
            'name' => 'product',
            'id' => 'product',
            'clientOptions' => [
                'source' => new JsExpression('yii.global.sourceProduct'),
                'select' => new JsExpression('yii.transfer.onProductSelect'),
                'delay' => 100,
            ],
            'options'=>['class'=>'form-control']
        ]);
        ?>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped">
            <?=
            TabularInput::widget([
                'id' => 'detail-grid',
                'allModels' => $model->transferDtls,
                'modelClass' => TransferDtl::className(),
                'itemView' => '_item_detail',
                'options' => ['tag' => 'tbody'],
                'itemOptions' => ['tag' => 'tr'],
                'clientOptions' => [
                    'initRow' => new JsExpression('yii.transfer.initRow')
                ]
            ])
            ?>
        </table>
    </div>
</div>

<?php
$js = $this->render('_script',[],$this->context);
$this->registerJs($js, yii\web\View::POS_END);
BizDataAsset::register($this, [
    'master' => MasterHelper::getMasters('product, barcode, product_stock')
]);
$js_ready = <<< JS
\$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem;
yii.transfer.onReady();
JS;
$this->registerJs($js_ready);
