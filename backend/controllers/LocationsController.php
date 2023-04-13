<?php

namespace backend\controllers;

use backend\models\Locations;
use backend\models\LocationsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LocationsController implements the CRUD actions for Locations model.
 */
class LocationsController extends Controller
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
     * Lists all Locations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LocationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Locations model.
     * @param int $location_id Location ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($location_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($location_id),
        ]);
    }

    /**
     * Creates a new Locations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Locations();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'location_id' => $model->location_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Locations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $location_id Location ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($location_id)
    {
        $model = $this->findModel($location_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'location_id' => $model->location_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionGetCityProvince($zipId)
    {
        $location=Locations::findOne($zipId);
        echo Json::encode($location);
    }

    /**
     * Deletes an existing Locations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $location_id Location ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($location_id)
    {
        $this->findModel($location_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Locations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $location_id Location ID
     * @return Locations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($location_id)
    {
        if (($model = Locations::findOne(['location_id' => $location_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
