<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Запросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user',
            'email:email',
            'reg_date',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm} {clear}',
                'visibleButtons' => [

                    'confirm' => true,
                    'clear' => true//function($model) { return true; },
                ],
            'buttons' => [
            'confirm' => function ($url,$model,$key) {

            return Html::a('Принять', $url, ['class' => 'btn btn-success btn-xs']);
            },
            'clear' => function ($url,$model,$key) {

                return Html::a('Отклонить', $url, ['class' => 'btn btn-danger btn-xs']);
            },
        ],
        ],   
           
        ],
    ]); ?>


</div>
