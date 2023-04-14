<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Poitem $model */

$this->title = Yii::t('app', 'Create Poitem');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poitems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
