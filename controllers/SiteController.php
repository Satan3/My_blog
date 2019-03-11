<?php

namespace app\controllers;

use Curl\Curl;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Vk;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;


class SiteController extends Controller
{
    /**
     * @param string $message
     * @return string
     */
    public function actionSay($message = "Привет"){
        return $this->render('say', ['message' => $message]);
    }

    /**
     * @return string
     */
    public function actionEntry(){
        $model = new EntryForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->render('entry-confirm', ['model' => $model]);
        }
        else{
            return $this->render('entry', ['model' => $model]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        return $this->render('index');
    }


    /**
     * Displays vk.
     *
     * @return string
     */
    public function actionVk()
    {
        $model = new Vk();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $term = $model->term;
            $curl = new Curl();
            $curl->post('https://api.vk.com/method/database.getSchool', array('access_token' => 'c2badfb139dbfc64e625349230a5b8752f577fbe6a3b7af87f4cb02d04a906775e4aa3334637298b5fbe1',
                'need_all' => '1',
                'v' => '5.87',
                'q' => $term,
                'count' => '100',
                'country_id' => '1',
            ));

            if ($curl->error) {
                $message = $curl->error_code;
            } else {
                $message = $curl->response;
                $message = json_decode($message);
                $message = ArrayHelper::getValue($message, 'response.items');
                foreach ($message as $k => $v){

                }
            }
            return $this->render('vk-response', ['message' => $message, 'model' => $model]);
        } else {
            return $this->render('vk', ['model' => $model]);
        }
    }













    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
