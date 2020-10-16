<?php

namespace backend\controllers;

use backend\models\Patient;
use backend\models\DictionaryDetail;
use Yii;
use backend\models\Internment;
use backend\search\InternmentSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * InternmentController implements the CRUD actions for Internment model.
 */
class InternmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['addUser', 'addPatient'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['addUser'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Internment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Internment::getAccess() && Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT){
            return $this->redirect(['site/index']);
        }
        
        $searchModel = new InternmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Internment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Internment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($PatientId)
    {
        $patientModel = Patient::findOne($PatientId);
        if (!isset($patientModel)) {
            return $this->redirect(['index']);
        }
        $model = new Internment();
        $model->PatientId = $patientModel->Id;
        $model->Status = DictionaryDetail::GENERAL_STATUS_NEW;
        $model->ExtraStatus = DictionaryDetail::INTERNMENT_EXTRA_STATUS_ACTIVE;
        
        if (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR) {
            $model->DoctorId = Yii::$app->user->getId();
        }

        $model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $patientModel->save();
            
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'patientModel' => $patientModel,
            ]);
        }
    }

    /**
     * Updates an existing Internment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $patientModel = Patient::findOne($model->PatientId);
        if(empty($model->ExtraStatus)){
            $model->ExtraStatus = DictionaryDetail::INTERNMENT_EXTRA_STATUS_ACTIVE;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'patientModel' => $patientModel,
            ]);
        }
    }

    /**
     * Deletes an existing Internment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Internment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Internment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Internment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
