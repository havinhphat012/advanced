<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\settings\models\Companies $model */

$this->title = Yii::t('app', 'Update Companies: {name}', [
    'name' => $model->company_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_id, 'url' => ['view', 'company_id' => $model->company_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="companies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
