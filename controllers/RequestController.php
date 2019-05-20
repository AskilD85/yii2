<?php

namespace app\controllers;

use Yii;
use app\models\Request;
use app\models\User;
use app\models\AddUserForm;
use app\models\RequestSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     * @return mixed
     */
    
    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();
        if ( $model->load(Yii::$app->request->post()) ){
            
            //var_dump(Yii::$app->request->post());
            if( $model->validate() && $model->save() ){
                
                Yii::$app->session->SetFlash('success','Данные приняты');
                
                return $this->redirect('/');
                
            }else{
               
                    Yii::$app->session->SetFlash('error','Есть ошибка');
               
                
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
        
    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   


    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    
    
    
  
}
