<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Locations $model */

$this->title = Yii::t('app', 'Update Locations: {name}', [
    'name' => $model->location_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->location_id, 'url' => ['view', 'location_id' => $model->location_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="locations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
