<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM album")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM album where id_album='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO album (nombre,fecha,id_artista,id_categoria) 
      VALUES ('{$request['name']}','{$request['date']}','{$request['idartist']}','{$request['idcategory']}')")->execute();
    echo json_encode('se ha creado un album');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE album 
      SET nombre ='{$request['name']}', fecha ='{$request['date']}', id_artista ='{$request['idartist']}', id_categoria ='{$request['idcategory']}' WHERE id_album ={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM album where id_album='" . $id . "'")->single();
 
    echo json_encode('se actualizo el album');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM album WHERE id_album='{$id}'")->execute();
    echo json_encode('se elimino el album');
});
