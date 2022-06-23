<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM cancion")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM cancion where id_cancion='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO cancion (nombre,id_usuario,id_album,fecha,imagen,archivo,id_categoria) 
      VALUES ('{$request['name']}','{$request['iduser']}','{$request['idlbm']}','{$request['date']}','{$request['image']}',
      '{$request['file']}','{$request['idcategory']}')")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM cancion where id_cancion='" . $id . "'")->single();
   
    echo json_encode('se ha creado una cancion');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE cancion SET nombre ='{$request['name']}', id_usuario ='{$request['iduser']}', id_album ='{$request['idlbm']}', fecha ='{$request['date']}',imagen ='{$request['image']}', archivo='{$request['file']}', id_categoria ='{$request['idcategory']}'WHERE id_cancion={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM cancion where id_cancion='" . $id . "'")->single();
   
    echo json_encode('se ha actualizado la cancion');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM cancion WHERE id_cancion='{$id}'")->execute();
     
    echo json_encode('se ha eliminado la cancion');
});
