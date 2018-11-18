<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use common\models\AccountUserSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class AccountController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'error', 'create', 'update', 'index', 'delete', 'stat', 'lists'],
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

    public function actionCreate() //create new account, show it's information
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('view', ['model' => $model]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new AccountUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     **/
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * @param integer $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     **/
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException();
    }

    /**
     * @param integer $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     **/
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return mixed
     */
    public function actionStat()
    {
        $st = new AccountUserSearch();
        $ar = $st->statistic();
        //if ($ar['ALL'] == 0) {
        //  throw new \Exception('No statistics is available now.');
        // }
        return $this->render('stat', ['model' => $ar]);
    }

    public function actionLists($id)
    {
        $posts = Account::find()
            ->where(['id' => $id])
            ->orderBy('id DESC')
            ->all();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                echo "<option value='" . $post->currency . "'>" . $post->currency . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
}


