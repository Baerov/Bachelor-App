<?php
namespace backend\controllers;

use backend\models\Internment;
use backend\models\Patient;
use backend\models\PatientRequest;
use backend\models\DictionaryDetail;
use backend\search\InternmentSearch;
use backend\search\PatientSearch;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR) {
            //list things
            $searchModel = new PatientSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);
            $dataProvider->pagination->pageSize = 1;
            $dataProvider->pagination->defaultPageSize = 1;
            $today = (new \DateTime('now'))->format('Y-m-d');
            $dataProvider->query->andWhere('DATE(RecallDate) >= :today OR RecallDate is null');
            $dataProvider->query->params['today'] = $today;
            $dataProvider->query->orderBy([new Expression('coalesce(RecallDate, "2999-01-01") ASC')]);

            //_view things
            $patientPost = Yii::$app->request->post('Patient');
            $patientId = Yii::$app->request->post('Patient')['Id'];
            $patientRecallDate = Yii::$app->request->post('Patient')['RecallDate'];

            $model = null;
            if (!empty($patientPost)) {
                $model = $this->findModel($patientId);
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    $model->save();
                    if ($patientRecallDate != null) {
                        $patientRequestModel = new PatientRequest();
                        $patientRequestModel->UserId = Yii::$app->user->identity->getId();
                        $patientRequestModel->PatientId = $patientId;
                        $patientRequestModel->RecallDate = $patientRecallDate;
                        $patientRequestModel->save();
                    }
                }
            }
            return $this->render('index', [
                //operatorList things
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

                //_operatorView things
                'model' => $model,

            ]);
        }
        if (Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
            //list_priority things
            $priorityInternmentSearchModel = new InternmentSearch();
            $priorityInternmentDataProvider = $priorityInternmentSearchModel->search(Yii::$app->request->queryParams);
            $startDate = (new \DateTime('now'))->sub(new \DateInterval('P1D'))->format('Y-m-d');
            $priorityInternmentDataProvider->query->andWhere(['ExtraStatus' => DictionaryDetail::INTERNMENT_EXTRA_STATUS_ACTIVE]);
            $priorityInternmentDataProvider->query->andWhere(['<=', 'DATE(Date)', $startDate]);
            $priorityInternmentDataProvider->query->andWhere(['Status' => DictionaryDetail::GENERAL_STATUS_NEW]);
            $priorityInternmentDataProvider->query->orderBy(['Date' => SORT_ASC]);

            //list_normal things
            $searchModelInternment = new InternmentSearch();
            $dataProviderInternment = $searchModelInternment->search(Yii::$app->request->queryParams);
            if ($priorityInternmentDataProvider->totalCount == 0) {
                $dataProviderInternment->query->andWhere(['ExtraStatus' => DictionaryDetail::INTERNMENT_EXTRA_STATUS_ACTIVE]);
                $dataProviderInternment->query->andWhere(['>=', 'DATE(Date)', (new \DateTime('now'))->format('Y-m-d')]);
                $dataProviderInternment->query->andWhere(['Status' => DictionaryDetail::GENERAL_STATUS_NEW]);
                $dataProviderInternment->query->orderBy(['Date' => SORT_ASC]);
            }else{
                $dataProviderInternment->query->where('1=2');
            }
            return $this->render('index', [
                //list_priority things
                'priorityInternmentSearch' => $priorityInternmentSearchModel,
                'priorityInternmentDataProvider' => $priorityInternmentDataProvider,

                //list_normal things
                'searchModelInternment' => $searchModelInternment,
                'dataProviderInternment' => $dataProviderInternment,
            ]);
        }else{
            return $this->render('adminView');
        }
    }

    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
}
