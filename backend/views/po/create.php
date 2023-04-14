<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Po $model */

$this->title = Yii::t('app', 'Create Po');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPoItem' => $modelsPoItem,
    ]) ?>

</div>
