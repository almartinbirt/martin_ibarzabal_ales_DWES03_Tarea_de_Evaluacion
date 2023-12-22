<?php

/**
 * Clase Router
 * 
 * Esta clase gestiona las rutas de la aplicación y proporciona métodos para agregar rutas,
 * obtener todas las rutas, verificar si una ruta coincide con una URL dada y extraer parámetros de la URL.
 */
class Router {

  /**
   * @var array $routes Almacena las rutas de la aplicación con sus parámetros asociados.
   */
  protected $routes = array();

   /**
   * @var array $params Almacena los parámetros extraídos de una URL coincidente.
   */
  protected $params = array();


  /**
   * Agrega una nueva ruta con sus parámetros asociados.
   * 
   * @param string $route La ruta de la aplicación.
   * @param array $params Los parámetros asociados a la ruta (controlador y acción).
   */
  public function addRoute($route, $params) {
    $this->routes[$route] = $params;
  }


  /**
   * Obtiene todas las rutas definidas en la aplicación.
   * 
   * @return array Todas las rutas de la aplicación con sus respectivos parámetros.
   */
  public function getRoutes() {
    return $this->routes;
  }


  /**
   * Verifica si una URL coincide con alguna de las rutas definidas.
   * 
   * @param array $url Los componentes de la URL (controlador, acción y path).
   * @return bool True si hay coincidencia, false si no hay coincidencia.
   */
  public function match($url){
    foreach ($this->routes as $route => $params) {
      if($params['controller'] == $url['controller'] && $params['action'] == $url['action']) {
        return true;
      } 
    }
    return false;
  }


  /**
   * Verifica si una URL coincide con alguna de las rutas definidas y extrae los parámetros de la URL.
   * 
   * @param array $url Los componentes de la URL (controlador, acción y path).
   * @return bool True si hay coincidencia, false si no hay coincidencia.
   */
  public function matchRoutes($url){
    foreach ($this->routes as $route => $params) {
      $pattern = str_replace(['{id}', '/'] , ['([0-9]+)', '\/'], $route);
      $pattern = '/^'.$pattern.'$/';
      if(preg_match($pattern, $url['path'])){
        $this->params=$params;
        return true;
      }
    }
  }

  /**
   * Obtiene los parámetros extraídos de la última URL coincidente.
   * 
   * @return array Parámetros extraídos de la URL.
   */
  public function getParams() {
    return $this->params;
  }

}

?>
