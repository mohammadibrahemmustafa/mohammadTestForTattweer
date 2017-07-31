<?php

use Phalcon\Mvc\Controller;

class SpecilizationController extends Controller
{

    public function indexAction()
    {
        $form=new SpecializationForm();
        $this->view->form=$form;

    }
    public function addAction()
    { 
        if ($this->request->isPost()) {
            echo 'test';
            $data= $this->request->getPost();
            $form = new SpecializationForm();
            $specilization=new Specilization();
            if ($form->isValid($data,$specilization)) {
                $success=$specilization->save();
                if ($success) {
                    echo 'add successfully';
                }else{
                    echo "Sorry, the following problems were generated: ";

                    $messages = $specilization->getMessages();

                    foreach ($messages as $message) {
                        echo $message->getMessage(), "<br/>";
                    }
                }
                return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "browse",
                ]);
                //$this->view->disable("index/add");
            }  else {
                $messages = $form->getMessages();

                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                $this->flash->error("error input");
            }
        }

    }
        
}
