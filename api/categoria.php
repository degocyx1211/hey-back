<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM categoria")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM categoria where id_categoria='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO categoria (nombre,id_genero) VALUES ('{$request['name']}','{$request['idgenre']}')")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM categoria where id_categoria='" . $id . "'")->single();
    echo json_encode('se ha creado un genero ');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE categoria SET nombre ='{$request['name']}',id_genero='{$request['idgenre']}' WHERE id_categoria={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM categoria where id_categoria='" . $id . "'")->single();
    echo json_encode('la categoria se ha actualizado');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM categoria WHERE id_categoria='{$id}'")->execute();
    
    echo json_encode('se ha eliminado la categoria');
});