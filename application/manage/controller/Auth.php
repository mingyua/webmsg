<?php
namespace app\manage\controller;
use think\Controller;
use think\Db;

class Auth extends Controller{
    protected function initialize()
    {
       
      $htusername=session('htusername');
      if(!$htusername){
      	$this->redirect('login/index');
      }
    }	
	
	
}
