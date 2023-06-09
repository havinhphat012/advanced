<?php

namespace backend\controllers;

use backend\models\Branches;
use Yii;
use backend\models\Companies;
use backend\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
{


    /**
     * Lists all Companies models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);//Tham số truy vấn

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
     * @param int $company_id Company ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($company_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($company_id),
        ]);
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-company')) {
            $model = new Companies();
            $branch = new Branches();

            if ($this->request->isPost) {
                if ($model->load(Yii::$app->request->post()) && $branch->load(Yii::$app->request->post())) {

                    //gọi biến
                    $imageName = $model->company_name;
                    //Nếu chưa chọn ảnh thì out
                    if(empty($model->file))
                    {
                        //Nếu đã chọn ảnh thì sử dụng phương thức UploadedFile để lưu thư mục upload lên serve
                        //getInstance lấy thông tin về tệp tin được tải lên từ yêu cầu POST
                        $model->file = UploadedFile::getInstance($model,'file');
                        //Save as lưu bản sao vào uploads
                        $model->file->saveAs( 'uploads/'.$imageName.'.'.$model->file->extension );

                        $model->logo = 'uploads/'.$imageName.'.'.$model->file->extension;
                    }


                    $model->company_created_date = date('Y-m-d h:m:s');
                    $model->save();

                    $branch->companies_company_id = $model->company_id;
                    $branch->branch_start_date = date('Y-m-d H:m:s');
                    $branch->save();

                    return $this->redirect(['view', 'id' => $model->company_id]);
            }} else {
                    return $this->render('create', [
                        'model' => $model,
                        'branch' => $branch,
                    ]);
                }
        }
        else {
                throw new ForbiddenHttpException;


            }
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $company_id Company ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($company_id)
    {
        //Dùng phương thứ findModel để truy vấn $company_id
        $model = $this->findModel($company_id);
        //Kiểm tra phương thức POST
        //Đúng thì ử dụng phương thức load lấy dữ liệu từ yêu cầu POST
        //Cập nhật bằng save
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            //Chuyển hướng đến trang view company
            return $this->redirect(['view', 'company_id' => $model->company_id]);
        }
        //Không phải POST thì hiện form cập nhật
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $company_id Company ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($company_id)
    {
        $this->findModel($company_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $company_id Company ID
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($company_id)
    {
        if (($model = Companies::findOne(['company_id' => $company_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
