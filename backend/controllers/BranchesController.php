<?php

namespace backend\controllers;

use backend\models\Branches;
use backend\models\BranchesSearch;
use backend\models\Companies;
use kartik\editable\Editable;
use kartik\form\ActiveForm;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
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
     * Lists all Branches models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $comments = Yii::$app->db2->createCommand("SELECT * from `comment`")->queryAll();
        print_r($comments);
//        die();

        $searchModel = new BranchesSearch(); //Tạo đối tượng mới từ lớp BranchesSearch
        $dataProvider = $searchModel->search($this->request->queryParams); //Hiển thị bảng ghi tìm kiếm thông qua ($this->...)

        if (Yii::$app->request->post('hasEditable')) //Kiểm tra cso tồn tại k
        {
            $branchId = Yii::$app->request->post('editableKey');
            $branch = Branches::findOne($branchId);

            $out = Json::encode(['output' => '', 'message' => '']);

            $post = [];
            $posted = current($_POST['Branches']);
            $post['Branches'] = $posted;
            if ($branch->load($post)) {
                $branch->save();
                $output = 'my values';
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param int $branch_id Branch ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($branch_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($branch_id),
        ]);
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('create-branch')) {
            $model = new Branches();

            if (Yii::$app->request->isAjax && $model-> load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = 'json';
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->branch_created_date = date('Y-m-d h:m:s');

                if ($model->save()) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }

    }

    public function actionValidation()
    {
        $model = new Branches;
        if (Yii::$app->request->isAjax && $model-> load(Yii::$app->request->post()))//Kiêm tra AJAX
            {
                Yii::$app->response->format = 'json';//xác thực mô hình và trả về các lỗi xác thực dưới định dạng JSON
                return ActiveForm::validate($model);
            }
}


    /**
     * @throws \Exception
     */
    public function actionImportExcel()
    {
        $inputFile = 'uploads/branches_file.xlsx';
        try {
            //Đọc dữ liệu
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFile);
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);


            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            //Lặp qua từng dòng của sheet
            for ($row = 1; $row <= $highestRow; $row++) {
                //Lưu ở mảng $rowdata
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                if ($row == 1) {
                    continue;
                }
                if(!empty($rowData[0][0])){
                    $data[] = [$rowData[0][0], $rowData[0][1], $rowData[0][2], $rowData[0][3], date('Y-m-d H-i-s'), $rowData[0][4]];
                }
            }
            Yii::$app->db->createCommand()
                ->batchInsert('branches', ['branch_id', 'companies_company_id', 'branch_name', 'branch_address',
                    'branch_created_date', 'branch_status'], $data)
                ->execute();

        } catch (\Exception $e) {
            Yii::debug($e->getMessage());
            die('okay');
        }
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $branch_id Branch ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($branch_id)
    {
        $model = $this->findModel($branch_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'branch_id' => $model->branch_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $branch_id Branch ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($branch_id)
    {
        $this->findModel($branch_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLists($id)
    {
        $countBranches = Branches::find()//đếm số lượng và lưu kq
            ->where(['Companies_company_id' => $id])
            ->count();
        $branches = Branches::find()
            ->where(['Companies_company_id' => $id])
            ->all();
        if ($countBranches > 0) {
            foreach ($branches as $branch) {
                echo "<option value='" . $branch->branch_id . "'>" . $branch->branch_name . "</option>";
            }
        } else {
            echo "<option>-</option>>";
        }
    }

    public function actionUpload()
    {
        //Định nghĩa tệp và đường dẫn
        $fileName = 'file';
        $uploadPath = 'uploads';

        if (isset($_FILES[$fileName])) //Kiểm tra tệp
        {
            //Lấy thông tin tệp đc tải lên
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Mã hóa thông tin tệp trả về dạng Json
                echo \yii\helpers\Json::encode($file);
            }
        }else {
            return  $this->render('upload');
        }

        return false;
    }


    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $branch_id Branch ID
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($branch_id)
    {
        if (($model = Branches::findOne(['branch_id' => $branch_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
