<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Locations;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Customers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(), 'location_id', 'zip_code'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Zip code', 'id'=>'zipCode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
 //Hien thi thong bao alert 
    $('#zipCode').change(function() {
        var zipId = $(this).val();  
        
        $.get('index.php?r=locations/get-city-province',{ zipId : zipId }, function (data) {
            var data = $.parseJSON(data);
            $('#customers-city').attr('value', data.city);
            $('#customers-province').attr('value', data.province);
        });
 }) ;
 JS;
 $this->registerJs($script);
?>
