<?php

use backend\models\Companies;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\modules\settings\models\CompaniesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Companies'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'company_id',
            'company_name',
            'company_email:email',
            'company_address',
//            'logo',
//            'company_start_date',
            'company_created_date',
            //'company_status',
//            [
//                'class' => ActionColumn::class,
//                'urlCreator' => function ($action, Companies $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'company_id' => $model->company_id]);
//                }
//            ],
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>


</div>
