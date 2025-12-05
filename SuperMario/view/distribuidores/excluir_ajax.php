<?php

require_once(__DIR__ . "/../../controller/DistribuidorController.php");
header('Content-Type: application/json');

$id = 0;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if($id > 0) {
    
    $distribuidorCont = new DistribuidorController();
    $erros = $distribuidorCont->excluirPorId($id);

    if(empty($erros)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Não foi possível excluir'
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'ID inválido'
    ]);
}
