<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\CategoryUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CategoryController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'error', 'create', 'update', 'index', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new CategoryUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) { //если в приложении можно делать post - запросы, то..
            if ($model->sub == null) { // ..если нет выбора категорий вообще, создаем root
                $model->makeRoot();
            } else { // ..если есть корень - > все остальные категории - потомки
               // $parent1 = Category::find()->where(['id' => 9])->one();
                $arrId = Category::find()->select('id')->asArray()->all();
                $cond = ltrim($model->sub, '_')-1;
                $parentID = $arrId[$cond]['id'];
                $parent = Category::find()->where(['id' => $parentID])->one();
                // ищем родителя с id, соответствующим выбранной категории
                  $model->prependTo($parent); // прикрепляем потомка

            }
        }
        if ($model->save()) {
            //   return $this->render('view', ['model' => $model,'data' => Category::findOne(['depth' => 0])->tree()]);
            return $this->render('view', ['model' => $model,]);
        }

        return $this->render('create', [
            'model' => $model,
            'data' => Category::findOne(['name' => 'Expense'])->tree(),
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
