<?php
class App_controller extends Controller{

  public function __construct(){
    parent::__construct();
    $this->tpl=array('sync'=>'main.html');
  }
  
  public function signin($f3){
    switch($f3->get('VERB')){
      case 'GET':
        $this->tpl['sync']='signin.html';
      break;
      case 'POST':
        $auth=$this->model->signin(array(
          'login'=>$f3->get('POST.login'),
          'password'=>$f3->get('POST.password')
        ));
        if(!$auth){
          $f3->set('error',$f3->get('loginError'));
          $this->tpl['sync']='signin.html';
        }else{
          $user=array(
            'id'=>$auth->id,
            'firstname'=>$auth->firstname,
            'lastname'=>$auth->lastname
          );
          $f3->set('SESSION',$user);
          $f3->reroute('/');
        }
      break;
    }
  }
  
  public function signout($f3){
    session_destroy();
    $f3->reroute('/signin');
  }
  
  
  
  public function home($f3){
    
  }
  
  public function getUsers($f3){
    $f3->set('users',$this->model->getUsers(array('promo'=>$f3->get('PARAMS.promo'))));
    $this->tpl['async']='partials/users.html';
  }
  
  public function getUser($f3){
    $f3->set('user',$this->model->getUser(array('id'=>$f3->get('PARAMS.id'))));
    $this->tpl['async']='partials/user.html';
  }
  
  public function searchUsers($f3){
    $f3->set('users',$this->model->searchUsers(array('keywords'=>$f3->get('POST.name'),'filter'=>$f3->get('POST.filter'))));
    $this->tpl['async']='partials/users.html';
  }
  
  public function favorite($f3){
    $f3->set('status',$this->model->favorite(array('favId'=>$f3->get('PARAMS.favId'),'logId'=>1)));
    $this->tpl['async']='json/status.json';
  }
  
  public function getFavorite($f3){
    $f3->set('users',$this->model->getFavorite(array('logId'=>1)));
    $this->tpl['async']='partials/users.html';
  }
  
  public function getIssues($f3){
    $web=new \Web();
    $token='e43b804c8d86a44abb25e827379b3b2216273c61';
    $header=array(
      'header'=>array(
        'Authorization: token '.$token
        )
      );
    $result=$web->request('https://api.github.com/repos/ecolehetic/wtfay-g2/issues',$header);
    if($result['body']){
      print_r($result);
    }
    exit;
  }
  
  public function setIssue($f3){
    $web=new \Web();
    $token='e43b804c8d86a44abb25e827379b3b2216273c61';
    $content=array(
      'title'=>'Gros bug',
      'body'=>"t'es trop noob...",
      'labels'=>array('bug')
      );
    
    $header=array(
      'header'=>array('Authorization: token '.$token),
      'method'=>'POST',
      'content'=>json_encode($content)
      );
    $result=$web->request('https://api.github.com/repos/ecolehetic/wtfay-g2/issues',$header);
    if($result['body']){
      print_r($result);
    }
    exit;
  }
  
  
  
  
  
  
  
}
?>