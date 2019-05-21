<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($user);
        
        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $createUser = $auth->createPermission('CreateUser');
        $createUser->description = 'Создание пользователя';
        
        $createAdmin = $auth->createPermission('CreateAdmin');
        $createAdmin->description = 'Создание админа';
        
        $createRequest = $auth->createPermission('CreateRequest');
        $createRequest->description = 'Создание заявки';
        
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Удаление пользователя';
        
        $deleteAdmin = $auth->createPermission('deleteAdmin');
        $deleteAdmin->description = 'Удаление админа';
        
        // Запишем эти разрешения в БД
        $auth->add($createUser);
        $auth->add($createRequest);
        $auth->add($createAdmin);
        $auth->add($deleteAdmin);
        $auth->add($deleteUser);
        
        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage
        
        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($user,$createRequest);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $user);
        
        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $createAdmin);
        $auth->addChild($admin, $deleteAdmin);
        $auth->addChild($admin, $deleteUser);
        
    }
}

