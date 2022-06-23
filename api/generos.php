<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM genero")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM genero where id_genero='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO genero (nombre) VALUES ('{$request['name']}') ")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM genero where id_genero='" . $id . "'")->single();
    $response['genero creado'] = $data;

    echo json_encode($response);
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE genero SET nombre ='{$request['name']}' WHERE id_genero={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM genero where id_genero='" . $id . "'")->single();

    echo json_encode( $data );
});

Route::delete(function($id, $request) {
      $db = new Database();

      $db ->query("DELETE FROM genero WHERE id_genero='{$id}'")->execute();

      $response['deleted'] = true;

    echo json_encode($response);
});

