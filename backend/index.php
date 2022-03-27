<?php
    // Incluindo o autoload
    require_once('./vendor/autoload.php');
    // setando sabeçalho da requisição
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT');
    header('Content-Type: Application/x-www-form-urlencoded');
    header('Content-Type: application/json');
    
    // Retornar o corpo da requisição
    function getPost(){
        if (!empty($_POST)) {
            return $_POST;
        }
        $post = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $post;
        }
        return [];
    }
    $MainController = new Classes\MainController(getPost());
?>