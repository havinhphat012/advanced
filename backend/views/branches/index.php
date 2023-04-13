<?php

use backend\models\Branches;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use  yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var backend\models\BranchesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Branches', ['value'=>Url::to('index.php?r=branches/create'),
            'class'=>'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    Modal::begin([
        'title' => '<h4>Branches</h4>',
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();

    ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
                if($model->branch_status == 'inactive')
                {
                    return ['class'=>'danger'];
                }else
                {
                    return ['class'=>'success'];
                }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute'=>'companies_company_id',
                'value' => 'companiesCompany.company_name'
            ],
//            'branch_id',
            'branch_name',
            'branch_address',
            'branch_created_date',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Branches $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'branch_id' => $model->branch_id]);
//                 }
//            ],
        ],
    ]); ?>

    <?php Pjax::end()?>
</div>
