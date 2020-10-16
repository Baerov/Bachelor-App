<?php

namespace backend\controllers;

use backend\models\Internment;
use backend\models\PatientInformation;
use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\InterestPointXPatient;
use moonland\phpexcel\Excel;
use Yii;
use backend\models\Patient;
use backend\search\PatientSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PatientController implements the CRUD actions for Patient model.
 */
class PatientController extends Controller
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
                        'actions' => ['logout', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update'],
                        'allow' => true,
                        'roles' => ['addUser', 'addPatient'],
                    ],
                    [
                        'actions' => ['delete', 'import', 'export'],
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
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Internment::getAccess() && Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
            return $this->redirect(['site/index']);
        }

        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $extraInfoModel = PatientInformation::find()->where(['PatientId' => $id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('view', [
            'model' => $model,
            'extraInfoModel' => $extraInfoModel,
        ]);
    }

    /**
     * Finds the Patient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Patient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patient();
        $model->StatusId = DictionaryDetail::PATIENT_STATUS_NEW;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty($model->interestPoint)) {
                foreach ($model->interestPoint as $interestPoint) {
                    $modelInterestPoint = new InterestPointXPatient();
                    $modelInterestPoint->PatientId = $model->Id;
                    $modelInterestPoint->InterestPointId = $interestPoint;
                    $modelInterestPoint->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Patient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExport()
    {
        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('export', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImport()
    {
        $model = new Patient();
        $import = [
            'total' => 0,
            'success' => 0,
            'error' => 0,
            'newSections' => 0,
            'newCities' => 0
        ];
        if (Yii::$app->request->post()) {
            $model->scenario = 'import';
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
//            $newFileName = Yii::getAlias('@backend/import/') . date('Y-m-d H:i:s') . '.' . $model->file->extension;
            $newFileName = Yii::getAlias('@backend/import/') . 'test.' . $model->file->extension;

            $model->file->saveAs($newFileName);
            ini_set('display_errors', 1);
            ini_set('memory_limit', '1G');
            $data = Excel::widget([
                'mode' => 'import',
                'fileName' => $newFileName,
                'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
            ]);
            $data = array_values($data);
            if (isset($data[0][0])) {
                $data = $data[0];
            }
            foreach ($data as $row) {
                $import['total']++;
                $patient = new Patient();
                $patient->attributes = Yii::$app->request->post('Patient');

                $extraInfo = [];
                foreach ($row as $key => $value) {
                    if ($key == 'Name') {
                        $patient->Name = $value;
                        continue;
                    }
                    if ($key == 'Address') {
                        $patient->Address = $value;
                        continue;
                    }
                    if ($key == 'City') {
                        $city = DictionaryDetail::find()->where(['Name' => $value, 'DictionaryId' => Dictionary::CITY])->one();
                        if (!$city) {
                            $city = new DictionaryDetail();
                            $city->Name = $value;
                            $city->Code = str_replace(' ', '', strtoupper($value));
                            $city->DictionaryId = Dictionary::CITY;
                            $city->save();
                            $import['newCities']++;
                        }
                        $patient->CityId = $city->Id;
                        continue;
                    }
                    if ($key == 'Section') {
                        $section = DictionaryDetail::find()->where(['Name' => $value, 'DictionaryId' => Dictionary::SECTION])->one();
                        if (!$section) {
                            $section = new DictionaryDetail();
                            $section->Name = $value;
                            $section->Code = str_replace(' ', '', strtoupper($value));
                            $section->DictionaryId = Dictionary::SECTION;
                            $section->save();
                            $import['newSections']++;
                        }
                        $patient->SectionId = $section->Id;
                        continue;
                    }
                    if ($key == 'Phone') {
                        $patient->Phone = (string)$value;
                        continue;
                    }
                    if ($key == 'Mobile Phone') {
                        $patient->MobilePhone = (string)$value;
                        continue;
                    }
                    if ($key == 'Email') {
                        $patient->Email = $value;
                        continue;
                    }
                    $extraInfo[$key] = $value;
                }
                $patient->StatusId = DictionaryDetail::PATIENT_STATUS_NEW;
                $patient->Information = serialize($extraInfo);

                if ($patient->validate() && $patient->save()) {
                    $import['success']++;
                    foreach ($extraInfo as $name => $value) {
                        $PatientInformation = new PatientInformation();
                        $PatientInformation->PatientId = $patient->Id;
                        $PatientInformation->Name = $name;
                        $PatientInformation->Value = $value;
                        $PatientInformation->save();
                    }
                } else {
                    $import['error']++;
                    $duplicatePatient = Patient::find()->where(['Name' => $patient->Name, 'Address' => $patient->Address, 'SectionId' => $patient->SectionId, 'CityId' => $patient->CityId])->one();

                    //verificare daca eroarea e de duplicat -- daca este duplicat(daca exista deja in baza de date), se face select pe Patientul existent
                    if ($duplicatePatient) {
                        //verificare daca nr telefon este unic sau nu -- daca este unic(daca NU exista deja in baza de date), inserezi  PatientId= id Patient curent, PatientInformation->Name = Phone Number si PatientInformation->Value = nr telefon Patient duplicat selectat mai sus
                        if (!Patient::find()->where(['Phone' => $patient->Phone])->exists()) {
                            $PatientInformation = new PatientInformation();
                            $PatientInformation->PatientId = $duplicatePatient->Id;
                            $PatientInformation->Name = 'Phone number';
                            $PatientInformation->Value = $patient->Phone;
                            $PatientInformation->save();
                        }

                        //verificare daca nr telefon este unic sau nu -- daca este unic(daca NU exista deja in baza de date), inserezi  PatientId= id Patient curent, PatientInformation->Name = Phone Number si PatientInformation->Value = nr telefon Patient duplicat selectat mai sus
                        if (!Patient::find()->where(['MobilePhone' => $patient->MobilePhone])->exists()) {
                            $PatientInformation = new PatientInformation();
                            $PatientInformation->PatientId = $duplicatePatient->Id;
                            $PatientInformation->Name = 'Mobile phone number';
                            $PatientInformation->Value = $patient->MobilePhone;
                            $PatientInformation->save();//salvare in Patient information
                        }
                    }
                }
            }
        }

        return $this->render('import',
            ['model' => $model,
                'import' => $import]
        );
    }
}
