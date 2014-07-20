<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
use biz\inventory\models\TransferDtl;
use mdm\relation\EditableList;
use biz\inventory\assets\TransferAsset;
use biz\app\assets\BizDataAsset;
use biz\master\components\Helper as MasterHelper;

/* @var $this yii\web\View */
/* @var $model biz\inventory\models\Transfer */

?>
<div class="col-lg-9" style="padding-left: 0px;">
    <div class="panel panel-info">
        <div class="panel-heading">
            Product :
            <?php
            echo AutoComplete::widget([
                'name' => 'product',
                'id' => 'product',
                'clientOptions' => [
                    'source' => new JsExpression('yii.global.sourceProduct'),
                    'select' => new JsExpression('yii.transfer.onProductSelect'),
                    'delay' => 100,
                ]
            ]);
            ?>
        </div>
        <table class="table table-striped">
            <?=
            EditableList::widget([
                'id' => 'detail-grid',
                'allModels' => $model->transferDtls,
                'modelClass' => TransferDtl::className(),
                'itemView' => '_item_detail',
                'options' => ['tag' => 'tbody'],
                'itemOptions' => ['tag' => 'tr'],
                'clientOptions'=>[
                    'initRow'=>new JsExpression('yii.transfer.initRow')
                ]
            ])
            ?>
        </table>
    </div>
</div>

<?php
TransferAsset::register($this);
BizDataAsset::register($this, [
    'master' => MasterHelper::getMasters('product, barcode, product_stock')
]);
$js_ready = <<< JS
\$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem;
yii.transfer.onReady();
JS;
$this->registerJs($js_ready);
