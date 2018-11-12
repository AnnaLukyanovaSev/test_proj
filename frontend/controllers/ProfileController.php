<?php

namespace frontend\controllers;

use Yii;
use common\models\Profile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['info', 'error', 'index','update'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionInfo()
    {
        $model = Profile::find()->select("first_name, last_name")
            ->where('user_id=:user_id', [':user_id' => strval(Yii::$app->user->identity->getId())])->one();
        if ($model) {
            return $this->render('index', ['model' => $model]);
        }

        $model = new Profile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->user_id]);
        }

        return $this->render('info', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
         $us =Yii::$app->user->identity->getId() ;
        $model = Profile::find()->select("first_name, last_name")
            ->where('user_id=:user_id', [':user_id' => $us])->one();
        return $this->render('index', ['model' => $model]);
    }

    public function actionUpdate()
    {
        $us =Yii::$app->user->identity->getId() ;
        $model = Profile::findOne($us);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

