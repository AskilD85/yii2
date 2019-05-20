<?php

namespace app\controllers;

use Yii;
use app\models\Admins;
use app\models\User;
use app\controllers\ForbiddenHttpException;
use app\models\AdminsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminsController implements the CRUD actions for Admins model.
 */
class AdminsController extends Controller
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
     * Lists all Admins models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admins model.
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
     * Creates a new Admins model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateAdmin')) {
                       
        
        $model = new Admins();
        $model->role = 'admin';
       
        
        
        if($model->load(Yii::$app->request->post())){
            $model->setPassword($model->password);
            $model->generateAuthKey();
        }
        
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $auth = Yii::$app->authManager;
            $role_admin = $auth->getRole('admin'); // Получаем роль admin
            $auth->assign($role_admin, $model->id);
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        }else{
           Yii::$app->session->SetFlash('error','Недостаточно прав!');
           return $this->redirect('/');
        }
    }

    /**
     * Updates an existing Admins model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
     * Deletes an existing Admins model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
     * Finds the Admins model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admins the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admins::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
