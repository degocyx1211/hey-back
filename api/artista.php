<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM artista")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM artista where id_artista='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO artista (nombre,id_categoria) VALUES ('{$request['name']}', '{$request['idcategory']}')")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM artista where id_artista='" . $id . "'")->single();
    echo json_encode('se creo el artista');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE artista SET nombre ='{$request['name']}', id_categoria='{$request['idcategory']}' WHERE id_artista={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM artista where id_artista='" . $id . "'")->single();
 
    echo json_encode('se actualizo el artista');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM artista WHERE id_artista='{$id}'")->execute();
    
    echo json_encode('se elimino el artista');
});
