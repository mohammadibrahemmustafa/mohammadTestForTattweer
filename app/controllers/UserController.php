<?php

use Phalcon\Mvc\Controller;

use Phalcon\Http\Response;
class UserController extends Controller
{

    public function indexAction()
    {
        $form=new UserForm();
        $this->view->form=$form;

    }
    public function loginAction()
    { 
        if ($this->request->isPost()) {
            $username= $this->request->getPost("username");
            $email= $this->request->getPost("email");
            $password= $this->request->getPost("password");
            $user = Users::findFirst(
                [
                    "(email = :email: OR username = :username:) AND password = :password:",
                    "bind" => [
                        "username" => $username,
                        "email"    => $email,
                        "password" => $password,
                    ]
                ]
            );
            $response=$this->response;
            if ($user!=false) {
                $response->redirect("index/browse");
            }else{
                $this->flash->error("there is an error in login please try again");
                $response->redirect("user/index");
                
            }
            
            
        }
    }
        
}
