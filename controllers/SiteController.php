<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Post;
use app\models\SignupForm;

class SiteController extends Controller
{
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
        $posts = Post::find()->orderBy(['likes' => SORT_DESC])->limit(3)->all();
        return $this->render('index', [
            'posts' => $posts,
        ]);
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
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /*Страница Мой Блог*/
    public function actionMyBlog()
    {
        $posts = Post::find()->where(['author' => \Yii::$app->user->identity->id])->orderBy(['date' => SORT_DESC])->all();
        //существующие посты пользователя в порядке от последнего к более ранним
        $model = new Post();
        if(!Yii::$app->user->isGuest){$model->author = \Yii::$app->user->identity->id;}
        //присваивается id автора перед записью нового поста в базу данных
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Пост опубликован');
                return $this->refresh();
            }
        }
        return $this->render('my_blog', [
            'posts' => $posts, 'model' => $model,
        ]);
    }
    /*Страница Регистрации*/
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            //пароль хэшируется перед записью в базу
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы!');
                return $this->refresh();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
