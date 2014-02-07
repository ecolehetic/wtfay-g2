<?php

namespace REST;

class users extends \REST\api{
  
  function get($f3){
    $dB=new \DB\SQL('mysql:host='.$f3->get('db_host').';port=3306;dbname='.$f3->get('db_server'),$f3->get('db_login'),$f3->get('db_password'));
    $mapper=new \DB\SQL\Mapper($dB,'wifiloc');
    $f3->set('datas',$mapper->find(array(),array('order'=>'lastname')));
    $this->tpl='datas.json';
  }
  
  function post($f3){
    
  }
  
  function put($f3){

  }
  
  function delete($f3){

  }
  
  
  
}
?>