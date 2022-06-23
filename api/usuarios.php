<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM usuarios")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM usuarios where id_usuario='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO usuarios (email,password,nombre,apellido,imagen,nombreUsu) 
      VALUES ('{$request['email']}', '{$request['pass']}' , '{$request['name']}',
       '{$request['lastname']}', '{$request['image']}', '{$request['username']}')")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM usuarios where id_usuario='" . $id . "'")->single();
   
    echo json_encode('se creo el usuario');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE usuarios SET email ='{$request['email']}', password ='{$request['pass']}', nombre ='{$request['name']}',
      apellido ='{$request['lastname']}',imagen ='{$request['image']}', nombreUsu ='{$request['username']}' WHERE id_usuario={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM usuarios where id_usuario='" . $id . "'")->single();
   

    echo json_encode('se actualizo el usuario');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM usuarios WHERE id_usuario='{$id}'")->execute();
   
    echo json_encode('se elimino el usuario');
});
