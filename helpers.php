<?php 

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */

 function basePath($path=""){
    return __DIR__ . '/' . $path;
 }


 /**
  * load a view
  * @param string $name
  * @return void
  */

  function loadView($name, $data=[]){

  $viewPath=basePath("App/views/{$name}.view.php");
  if(file_exists($viewPath)){
    extract($data);
    require $viewPath;
  }  else {
    echo "View {$viewPath} is not found";
  }
  }


 /**
  * load a partials
  * @param string $name
  * @return void
  */

  function loadPartial($name,$data=[])
  {

    $partialPath=basePath("App/views/partials/{$name}.php");

    if(file_exists($partialPath)){
      extract($data);
        require $partialPath;
    } else {
        echo "Partial {$partialPath} is not found";
    }
  }

/**
 * inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

 function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
 }

/**
 * inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

 function isnpectAndDie($value){
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
 }

 /**
  * format salary
  * @param string $salary
  * @return string Formated salary
  */

  function formatSalary($salary){
    return '$'.number_format(floatval($salary));
  }

  /**
   * Sanatize Data
   * 
   * @param string $dirty
   * @return string
   */

   function sanitize($dirty){
    return filter_var(trim($dirty),FILTER_SANITIZE_SPECIAL_CHARS);
   }


   /**
    * Redirect to a given url
    * 
    * @param string $url
    * @return void
    */

    function redirect($url){
      header("Location:{$url}");
      exit;
    }