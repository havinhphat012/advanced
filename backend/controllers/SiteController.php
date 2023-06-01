<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            //Quản lý quyền truy cập
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'set-cookie', 'show-cookie'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            //quản lý phương thức HTTP được sử dụng cho các hành động trong controller
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    //thiết lập một cookie trên trình duyệt
    public function actionSetCookie()
    {
        $cookie = new yii\web\Cookie([
            'name' => 'test',
            'value' => 'test cookie value'
    ]);
        //lấy danh sách các cookie hiện có trên response
        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionShowCookie()
    {
        //lấy danh sách các cookie hiện có trên request
        //Has kiểm tra xem cookie có tên là "test" có tồn tại trong danh sách này hay không
        if( Yii::$app->getRequest()->getCookies()->has('test'))
        {
            //có thì lấy giá trị của cookie và hiển thị
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout='loginLayout';
        if (!Yii::$app->user->isGuest) // Với vai trò người dùng đăng nhập vào
        {
            return $this->goHome(); //Chuyển hướng đến trang home
        }

        //Đăng nhập thành công
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();//Chuyển hướng người dung về trang trước đó
        }

        $model->password = '';

        //Không thành công - Hiện lại form đăng nhập
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */

    public function actionLanguage()
    {
        if(isset($_POST['lang']))//kiểm tra xem có yêu cầu POST được gửi lên không
        {
            Yii::$app->language = $_POST['lang']; //thiết lập ngôn ngữ của ứng dụng
            $cookie = new yii\web\Cookie([ //lưu giá trị ngôn ngữ vào cookie
                'name' => 'lang',
                'value' => $_POST['lang']
            ]);

            Yii::$app->getResponse()->getCookies()->add($cookie);//lấy danh sách các cookie hiện có
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
