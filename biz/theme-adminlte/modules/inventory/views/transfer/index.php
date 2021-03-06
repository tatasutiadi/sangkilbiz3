<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use biz\app\components\Helper;
use biz\inventory\models\Transfer;
use yii\grid\DataColumn;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\purchase\models\PurchaseSearch $searchModel
 */
$this->title = 'Transfer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-index">
    <div class="col-lg-12" style="text-align: right; padding-bottom: 10px;">
        <?= Html::a('', ['create'], ['class' => 'btn btn-warning btn-sm fa fa-plus', 'title' => 'New Supplier']) ?>
    </div>
    <div class=" col-lg-12">
        <?php Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
        <div class="box box-info">
            <div class="box-body no-padding">
                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table table-striped'],
                    'layout' => '{items}{pager}',
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'transfer_num',
                        'idWarehouseSource.nm_whse',
                        'idWarehouseDest.nm_whse',
                        'transferDate',
                        [
                            'class' => DataColumn::className(),
                            'label' => 'Status',
                            'value' => function ($model) {
                                    $warnaStatus = 'label-warning';
                                    switch ($model->status) {
                                        case Transfer::STATUS_DRAFT:
                                            $warnaStatus = 'label-danger';
                                            break;
                                        case Transfer::STATUS_ISSUE:
                                            $warnaStatus = 'label-success';
                                            break;
                                        case Transfer::STATUS_CONFIRM:
                                            $warnaStatus = 'label-info';
                                            break;
                                        case Transfer::STATUS_CONFIRM_APPROVE:
                                            $warnaStatus = 'label-info';
                                            break;
                                        case Transfer::STATUS_CONFIRM_REJECT:
                                            $warnaStatus = 'label-danger';
                                            break;
                                        case Transfer::STATUS_RECEIVE:
                                            $warnaStatus = 'label-primary';
                                            break;
                                    }

                                    return "<span class='label $warnaStatus'>{$model->nmStatus}</span>";
                            },
                            'format' => 'raw'
                        ],
                        //'nmStatus',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete} {issue}',
                            'buttons' => [
                                'issue' => function ($url, $model) {
                                    if (Helper::checkAccess('issue', $model)) {
                                        return Html::a('<span class="glyphicon glyphicon-open"></span>', $url, [
                                                    'title' => Yii::t('yii', 'Issue'),
                                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to issue this item?'),
                                                    'data-method' => 'post',
                                                    'data-pjax' => '0',
                                        ]);
                                    }
                                }
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>
