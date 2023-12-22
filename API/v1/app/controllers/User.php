<?php

// Se incluye el archivo que contiene la clase EntryModel
require '../core/EntryModel.php';

// La clase User representa un controlador para manejar operaciones relacionadas con usuarios
class User {

    // Constructor de la clase
    function __contruct(){}

    // Obtiene todos los usuarios y los imprime en formato JSON
    function getAllUsers(){
        $entryModel = new EntryModel(); 
        echo $entryModel->getAllUsers();
    }

    // Obtiene un usuario por su ID y lo imprime en formato JSON
    function getUserById($id) {
        $entryModel = new EntryModel(); 
        echo $entryModel->getUserById($id);
    }

    // Crea un nuevo usuario utilizando los datos proporcionados y lo imprime en formato JSON
    function createUser($data) {
        $entryModel = new EntryModel(); 
        echo $entryModel->createUser($data);
    }

    // Actualiza un usuario existente por su ID con los nuevos datos proporcionados y lo imprime en formato JSON
    function updateUser($id, $data) {
        $entryModel = new EntryModel();
        echo $entryModel->updateUser($id, $data);
    }

    // Elimina un usuario por su ID y devuelve el array de usuarios modificado en formato JSON
    function deleteUser($id) {
        $entryModel = new EntryModel(); 
        echo $entryModel->deleteUser($id);
    }

}

?>

