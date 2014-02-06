<?php
class App_model extends Model{
  
private $mapper;
  
 public function __construct(){
   parent::__construct();
   $this->mapper=$this->getMapper('wifiloc');
 } 
 
 public function home(){
  
 }

 public function getUsers($params){
   //$this->dB->exec("select * from wifiloc left join wififav on wifiloc.id=wififav.favId");
   return $this->getMapper('favorite')->find(array('promo=?',$params['promo']),array('order'=>'lastname'));
 }
 
 public function getUser($params){
   return $this->mapper->load(array('id=?',$params['id']));
 }
 
 public function searchUsers($params){
   $query='(firstname like "%'.$params['keywords'].'%" or lastname  like "%'.$params['keywords'].'%")';
   $query.=$params['filter']?' and promo="'.$params['filter'].'"':'';
   return $this->getMapper('favorite')->find($query,array('order'=>'lastname'));
 }
 
 public function favorite($params){
  $map=$this->getMapper('wififav');
  $favorite=$map->load(array('favId=? and logId=?',$params['favId'],$params['logId']));
  if(!$favorite){
    $map->favId=$params['favId'];
    $map->logId=$params['logId'];
    $map->save();
    return true;
  }else{
    $favorite->erase();
    return false;
  }
  
 }
 
 public function getFavorite($params){
  return $this->getMapper('favorite')->find(array('logId=?',$params['logId']));
 }
  
  
  
  
  
  
  
  
}
?>