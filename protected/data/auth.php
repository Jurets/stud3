<?php
return array (
  'createUser' => 
  array (
    'type' => 0,
    'description' => 'создание пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'viewUsers' => 
  array (
    'type' => 0,
    'description' => 'просмотр списка пользователей',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'readUser' => 
  array (
    'type' => 0,
    'description' => 'просмотр данных пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'updateUser' => 
  array (
    'type' => 0,
    'description' => 'изменение данных пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'deleteUser' => 
  array (
    'type' => 0,
    'description' => 'удаление пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'changeRole' => 
  array (
    'type' => 0,
    'description' => 'изменение роли пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'updateOwnData' => 
  array (
    'type' => 1,
    'description' => 'изменение своих данных',
    'bizRule' => 'return Yii::app()->user->id==$params["user"]->u_id;',
    'data' => NULL,
    'children' => 
    array (
      0 => 'updateUser',
    ),
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'createUser',
      1 => 'viewUsers',
      2 => 'readUser',
      3 => 'updateOwnData',
    ),
    'assignments' => 
    array (
      1 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      4 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'root' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'admin',
      1 => 'updateUser',
      2 => 'deleteUser',
      3 => 'changeRole',
    ),
  ),
  'createContact' => 
  array (
    'type' => 0,
    'description' => 'создание контакта',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'viewContacts' => 
  array (
    'type' => 0,
    'description' => 'просмотр списка контактов',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'readContact' => 
  array (
    'type' => 0,
    'description' => 'просмотр контакта',
    'bizRule' => 'return Yii::app()->user->id==$params["contact"]->user_id;',
    'data' => NULL,
  ),
  'updateContact' => 
  array (
    'type' => 0,
    'description' => 'редактирование контакта',
    'bizRule' => 'return Yii::app()->user->id==$params["contact"]->user_id;',
    'data' => NULL,
  ),
  'deleteContact' => 
  array (
    'type' => 1,
    'description' => 'удаление контакта',
    'bizRule' => 'return Yii::app()->user->id==$params["contact"]->user_id;',
    'data' => NULL,
  ),
  'user' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'createContact',
      1 => 'viewContacts',
      2 => 'readContact',
      3 => 'updateContact',
      4 => 'deleteContact',
      5 => 'updateOwnData',
    ),
    'assignments' => 
    array (
      1 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      4 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      2 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      3 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      23 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      5 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      6 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      81 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      103 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      83 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      257 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      289 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
);
