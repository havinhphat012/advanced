<?php

namespace backend\controllers;

use Exception;
use Yii;
use backend\models\Po;
use backend\models\PoSearch;
use yii\web\Controller;
use backend\models\Model;
use backend\models\PoItem;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Po models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //hiển thị thông tin chi tiết của một đối tượng Po
    /**
     * Displays a single Po model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Po(); //Tạo đối tượng
        $modelsPoItem = [new PoItem]; //Tạo mảng chứa đối tượng để lưu thông tin
        if ($model->load(Yii::$app->request->post()) && $model->save()) //Kiểm tra yêu cầu đúng là POST lưu lại
        {

            $modelsPoItem = Model::createMultiple(PoItem::classname()); //tạo nhiều đối tượng PoItem tương ứng
            //nạp dữ liệu của các đối tượng PoItem từ dữ liệu được gửi từ form
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());

            // validate all models kiểm tra tính hợp lệ
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;

            if ($valid) {
                //lưu thông tin của đối tượng Po và các đối tượng PoItem vào cơ sở dữ liệu
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPoItem as $modelPoItem) {
                            $modelPoItem->po_id = $model->id;
                            if (!($flag = $modelPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    //Thành công
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    //thất bại - hiển thị lại trang
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        //Không phải POST render giao diện create
        else {
            return $this->render('create', [
                'model' => $model,
                'modelsPoItem' => (empty($modelsPoItem)) ? [new PoItem] : $modelsPoItem]);
        }

    }

    /**
     * Updates an existing Po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Po model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
