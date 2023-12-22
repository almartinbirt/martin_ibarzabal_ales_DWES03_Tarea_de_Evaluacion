<?php

  // Se incluye la clase HttpStatus que proporciona códigos de estado HTTP
  require '../core/HttpStatus.php';

  /**
  * Clase abstracta Model
  * 
  * Esta clase representa un modelo de datos abstracto con métodos para cargar y guardar datos.
  * Las clases que heredan de Model deben implementar los métodos abstractos loadData() y saveData().
  */
abstract class Model {
    protected $data;

    /**
     * Constructor de la clase Model
     * 
     * Se llama automáticamente al crear una instancia de una clase que hereda de Model.
     * Carga los datos llamando al método abstracto loadData().
     */
    public function __construct() {
      $this->loadData();
    }

    /**
     * Método abstracto loadData()
     * 
     * Debe ser implementado por las clases que heredan de Model.
     * Carga los datos en la propiedad protegida $data.
     */
    abstract protected function loadData();

    /**
     * Método abstracto saveData()
     * 
     * Debe ser implementado por las clases que heredan de Model.
     * Guarda los datos desde la propiedad protegida $data.
     */
    abstract public function saveData();
  }


/**
 * Clase EntryModel que hereda de Model
 * 
 * Representa un modelo específico para manipular datos de usuarios.
 * Implementa los métodos abstractos loadData() y saveData() de la clase Model.
 */
class EntryModel extends Model {

  /**
   * Implementación de loadData() para cargar datos desde un archivo JSON.
   */
  public function loadData() {
    $json = file_get_contents('data/usuarios.json', true);
    $this->data = json_decode($json, true);
  }

  /**
   * Implementación de saveData() para guardar datos en un archivo JSON.
   */
  public function saveData() {
    $json = json_encode($this->data, JSON_PRETTY_PRINT);
    file_put_contents('data/usuarios.json', $json, true);
  }

  /**
   * Obtiene todos los usuarios y los devuelve como un JSON.
   */
  public function getAllUsers() {
      return json_encode($this->data);
  }

  /**
   * Obtiene un usuario por su ID y lo devuelve como un JSON.
   * Si no encuentra al usuario, devuelve null y un código de estado 404 (Not Found).
   */
  public function getUserById($id) {
    foreach ($this->data as $key => $user) {
      if ($user['id'] == $id) {
          return json_encode($user);
      }
    }
    return null;
  }

  /**
   * Crea un nuevo usuario con los datos proporcionados y devuelve la lista actualizada de usuarios como un JSON.
   */
  public function createUser($data) {
    $nameValue = $data['name'];
    $length = count($this->data);
    $newElement = array('id' => $length + 1, 'name' => $nameValue);
    $this->data[] = $newElement;
    $this->saveData();
    return json_encode($this->data);
  }

  /**
   * Actualiza un usuario existente por su ID con los nuevos datos proporcionados y devuelve la lista actualizada de usuarios como un JSON.
   * Si no encuentra al usuario, devuelve un código de estado 404 (Not Found).
   */
  public function updateUser($id, $data) {
    foreach ($this->data as $key => $user) {
      if ($user['id'] == $id) {
        $this->data[$key] = array_merge($user, $data);
        $this->saveData();
        return json_encode($this->data);
      } 
      return HttpStatus::notFound();
    }
  }

  /**
   * Elimina un usuario por su ID y devuelve la lista actualizada de usuarios como un JSON.
   */
  public function deleteUser($id) {
    $index = array_search($id, array_column($this->data, 'id'));
    if ($index !== false) {
        unset($this->data[$index]);
        $this->data = array_values($this->data);
        $this->saveData();
    }
    return json_encode($this->data);
  }

}

?>
