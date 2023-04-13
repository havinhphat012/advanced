<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customers $model */

$this->title = Yii::t('app', 'Update Customers: {name}', [
    'name' => $model->customer_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_id, 'url' => ['view', 'customer_id' => $model->customer_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
