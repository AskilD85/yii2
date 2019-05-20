<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Request;
use app\models\RequestSearch;
use yii\web\Controller;
use app\models\User;
use app\models\AddUserForm;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ]
                    ],
            ],
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
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
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing Request model.
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
    
    //подтверждение заявки
    public function actionConfirm($id) {
        
        
        $model = Request::findOne($id);
        
        $model2 = new AddUserForm;
        $model2->fullname =$model['user'];
        $model2->email =$model['email'];
        
        if ( $model2->load(Yii::$app->request->post()) ){
                      
            if( $model2->validate() ){
                $model3 = User::find()->where(['email' => $model2->email])->one();
                if (empty($model3)) {
                    $user = new User();
                    $user->username = $model2->username;
                    $user->fullname = $model2->fullname;
                    $user->email = $model2->email;
                    $user->setPassword($model2->password);
                    $user->generateAuthKey();
                    if ($user->save()) {
                        
                        
                        $auth = Yii::$app->authManager;
                        $role_user = $auth->getRole('user'); // Получаем роль user
                        $auth->assign($role_user, $user->id);
                        
                        $model->status = 'Принят';
                        $model->save();
                        Yii::$app->session->SetFlash('success','Данные приняты');
                        return $this->redirect('/admin/request');
                    }
                }else{
                    Yii::$app->session->SetFlash('error','Такой пользователь существует');
                }
                
                
               // return $this->redirect('/request');
                
            }else{
                Yii::$app->session->SetFlash('error','Есть ошибка! Валидация не прошла!');
            }
        }
        
        
        
        
        return $this->render('confirm',['model'=>$model,'model2'=>$model2]);
        //var_dump($model['email']);
        //$model->email = $model['email'];
        
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
    }
    
    //обновление статуса 'Отклонена'
    public function actionClear($id) {
        
        $model = $this->findModel($id);
        
        if($model->status === 'Отклонена'){
            Yii::$app->session->SetFlash('error','Эта заявка уже отклонена!');
            return $this->redirect('index');
        }else{
            if($model->status === 'Новая'){
            $model->status = 'Отклонена';
            $model->save();
            return $this->redirect('index');
            }
        }
        
        
        
    }
}
