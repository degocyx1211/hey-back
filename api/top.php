<?php

require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Route.php');
require($_SERVER['DOCUMENT_ROOT'] . '/hey-backend/utils/Database.php');



Route::getAll(function($request) {
    $db = new Database();
    $data = $db->query("SELECT * FROM top")->resultset();
    echo json_encode($data);
});

Route::getOne(function($id, $request) {
      $db = new Database();
    $data = $db->query("SELECT * FROM top where id_top='" . $id . "'")->single();
    echo json_encode($data);
});

Route::create(function($request) {
      $db = new Database();
    $db->query("INSERT INTO top (id_canciones,reproducciones,id_usuario,id_artista,id_album,id_genero,id_categoria) VALUES ('{$request['idsong']}','{$request['reproduccion']}','{$request['iduser']}','{$request['idartist']}','{$request['idlbm']}','{$request['idgenre']}','{$request['idcategory']}')")->execute();
    $id = $db->lastInsertId();
    $data = $db->query("SELECT * FROM top where id_top='" . $id . "'")->single();

    echo json_encode('se ha creado un puesto');
});

Route::update(function($id, $request) {
      $db = new Database();
    $db->query("UPDATE top SET id_canciones ='{$request['idsong']}', reproducciones ='{$request['reproduccion']}' ,
     id_usuario ='{$request['iduser']}',id_artista ='{$request['idartist']}', 
     id_album ='{$request['idlbm']}', id_genero ='{$request['idgenre']}' ,id_categoria ='{$request['idcategory']}' 
      WHERE id_top={$request['id']}")->execute();
    $data = $db->query("SELECT * FROM top where id_top='" . $id . "'")->single();
 
    echo json_encode('se editado el puesto');
});

Route::delete(function($id, $request) {
      $db = new Database();
      $db ->query("DELETE FROM top WHERE id_top='{$id}'")->execute();
    
    echo json_encode('la cancion se ha eliminado del top global');
});
