<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $auth = Yii::$app->authManager;
    
    //var_dump(Yii::$app->user->can('admin'));
    if (!Yii::$app->user->isGuest and Yii::$app->user->can('admin') ) {
        
        $menuItems = [
                ['label' => 'Администраторы', 'url' => ['/admin/admins/']],
                ['label' => 'Пользователи', 'url' => ['/admin/user']],
                ['label' => 'Заявки на подключения', 'url' => ['/admin/request']],
            ];
                
    }else{
        if(!Yii::$app->user->isGuest && Yii::$app->user->can('user') ){
            $menuItems = [
            ['label' => 'Профиль', 'url' => ['/user']],

            ];
    } 
    }
    if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Оставить заявку на подключение', 'url' => ['/request/create']];
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                
                $menuItems[] = [
                    'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
                
            }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
