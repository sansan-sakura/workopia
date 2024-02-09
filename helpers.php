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

  function loadView($name){

  $viewPath=basePath("views/{$name}.view.php");
  if(file_exists($viewPath)){
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

  function loadPartial($name)
  {

    $partialPath=basePath("views/partials/{$name}.php");

    if(file_exists($partialPath)){
        require $partialPath;
    } else {
        echo "Partial {$partialPath} is not found";
    }
  }