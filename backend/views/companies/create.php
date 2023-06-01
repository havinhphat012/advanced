<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\settings\models\Companies $model */
/** @var backend\models\Branches $branch */


$this->title = Yii::t('app', 'Create Companies');
//Thiết lập đường dẫn điều hướng trang
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'branch' => $branch,
    ]) ?>

</div>
