<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Locations $model */

$this->title = Yii::t('app', 'Create Locations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
