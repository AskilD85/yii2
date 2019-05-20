<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\Url;

//Если не авторизован - перенаправляем на страницу авторизации
class InitComponent  extends Component  {

    public function init() {
        if (\Yii::$app->getUser()->isGuest &&
            \Yii::$app->getRequest()->url !== Url::to('/site/login')&&
            \Yii::$app->getRequest()->url !== Url::to('/request/create')
        ) {
            \Yii::$app->getResponse()->redirect('/site/login');
        };
        parent::init();
    }
    
}
