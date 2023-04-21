<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <a href="http://localhost/advanced/backend/web/index.php"><b>Admin</b>LTE</a>
    </div>
</div>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username', ['options' => [
            'tag' => 'div',
            'class' => 'form-group field-loginform-username has-feedbach requỉed'
        ],
            'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>
{error}{hint}'
        ])->textInput(['placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


