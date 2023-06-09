<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var backend\models\Po $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="po-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'po_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Po Items </h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // bắt buộc: chỉ ký tự chữ và số cộng với "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // bắt buộc: bộ chọn lớp css
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // số lần tối đa, một phần tử có thể được sao chép (mặc định 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsPoItem[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'po_item_no',
                        'quantity',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsPoItem as $i => $modelPoItem): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Po Item</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelPoItem->isNewRecord) {
                                    echo Html::activeHiddenInput($modelPoItem, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelPoItem, "[{$i}]po_item_no")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelPoItem, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
