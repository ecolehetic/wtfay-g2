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
   return $this->mapper->find(array('promo=?',$params['promo']),array('order'=>'lastname'));
 }
 
 public function getUser($params){
   return $this->mapper->load(array('userId=?',$params['userId']));
 }
 
 public function searchUsers($params){
   $query='(firstname like "%'.$params['keywords'].'%" or lastname  like "%'.$params['keywords'].'%")';
   $query.=$params['filter']?' and promo="'.$params['filter'].'"':'';
   return $this->mapper->find($query);
 }
  
  
  
  
  
  
  
  
}
?>