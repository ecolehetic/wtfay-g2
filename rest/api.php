<?php

namespace REST;

abstract class api{
  
protected $tpl;
  
 abstract function get($f3);
 
 abstract function post($f3);
 
 abstract function put($f3);
 
 abstract function delete($f3);
 
 function beforeroute($f3){
  
 }
 
 function afterroute($f3){
  echo \View::instance()->render($this->tpl,'application/json');
 }
 
  
}
?>