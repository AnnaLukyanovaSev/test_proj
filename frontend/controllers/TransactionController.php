<?php

namespace frontend\controllers;

use Yii;
use common\models\Transaction;
use common\models\Category;
use common\models\TransactionTrUserSearch;
use common\models\TransactionUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Account;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndextransfer()
    {
        $searchModel = new TransactionTrUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
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
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewtransfer($id)
    {
        return $this->render('viewtransfer', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();

        if ($model->load(Yii::$app->request->post())) {
            //transform of category_id for DB from Widget View
            if ($model->sub == null) {
                $model->sub = '_1';
            }
            $cond = ltrim($model->sub, '_') - 1;
            $arrId = Category::find()->select(['id', 'lft', 'name', 'user_id'])
                ->where(['user_id' => 1])
                ->orWhere(['user_id' => Yii::$app->user->identity->getId()])
                ->andWhere(['!=', 'name', 'Transfer'])
                ->orderBy('lft')->asArray()->all();
            $model->category_id = $arrId[$cond]['id'];

            // sign of amount.begin.
            //  $model->amount = abs($model->amount);
            // $catQ = Category::findOne(['id' => $model->category_id]);
            // $cat = Category::findOne(['id' => $model->category_id, 'name' => 'Expense']);
            // $parents = $catQ->parents()->where(['name' => 'Expense'])->asArray()->all();
            // if ($cat !== null || $parents !== null) {
            //     $model->amount = -$model->amount;
            //  }
            // sign of amount.end.
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id])
                    && Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTransfer()
    {
        $model = new Transaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewtransfer', 'id' => $model->id])
                && Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id])
                && Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $model->receiver])
                && Transaction::create(
                    (-1) * $model->amount,
                    $model->currency,
                    $model->receiver,
                    $model->category_id,
                    $model->date
                )->save();
        }

        return $this->render('transfer', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transaction model transfer.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case update failed.
     */
    public function actionUpdatetransfer($id)
    {
        $model = $this->findModel($id);
        Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $model->account_id]);
        $inverse = Transaction::find()->where(['>', 'created_at', -1 + $model->created_at])
            ->andWhere(['<', 'created_at', 3 + $model->created_at])
            ->andWhere(['!=', 'id', $model->id])->one();
        Account::updateAllCounters(['amount' => $model->amount], ['id' => $inverse['account_id']]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id]);
            Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $inverse['account_id']]);
            $x = Transaction::findOne($inverse['id']);
            $x->amount = (-1) * $model->amount;
            $x->update();
            return $this->redirect(['viewtransfer', 'id' => $model->id]);
        } else {
            Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id]);
            Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $inverse['account_id']]);
        }

        return $this->render('updatetransfer', ['model' => $model,]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $model->account_id]);
        if ($model->load(Yii::$app->request->post())) {

            if ($model->sub == null) {
                $model->sub = '_1';
            }
            $cond = ltrim($model->sub, '_') - 1;
            $arrId = Category::find()->select(['id', 'lft', 'name', 'user_id'])
                ->where(['user_id' => 1])
                ->orWhere(['user_id' => Yii::$app->user->identity->getId()])
                ->andWhere(['!=', 'name', 'Transfer'])
                ->orderBy('lft')->asArray()->all();
            $model->category_id = $arrId[$cond]['id'];
            // sign of amount.begin.
          //  $model->amount = abs($model->amount);
            //$catQ = Category::findOne(['id' => $model->category_id]);
            //$cat = Category::findOne(['id' => $model->category_id, 'name' => 'Expense']);
            //$parents = $catQ->parents()->where(['name' => 'Expense'])->asArray()->all();
            //if ($cat !== null || $parents !== null) {
             //   $model->amount = -$model->amount;
            //}
            // sign of amount.end.
            if ($model->save()) {
                Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        Account::updateAllCounters(['amount' => $model->amount], ['id' => $model->account_id]);
        return $this->render('update', ['model' => $model, 'id' => $id]);
    }


    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $model->account_id]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionDeletetransfer($id)
    {
        $model = $this->findModel($id);
        Account::updateAllCounters(['amount' => (-1) * $model->amount], ['id' => $model->account_id]);
        $inverse = Transaction::find()->where(['>', 'created_at', -1 + $model->created_at])
            ->andWhere(['<', 'created_at', 3 + $model->created_at])
            ->andWhere(['!=', 'id', $model->id])->one();
        Account::updateAllCounters(['amount' => $model->amount], ['id' => $inverse['account_id']]);
        Transaction::findOne($inverse['id'])->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
