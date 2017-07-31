<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

	public function indexAction()
	{
            $form=new TrainerForm();
            $this->view->form=$form;
            
        }
        public function browseAction(){
            /*
            $query = $this->modelsManager->createQuery("SELECT * FROM trainers");
            $trainers  = $query->execute();
            */
            $trainers=  Trainers::find();
            $this->view->trainers=$trainers;
        }
	public function addAction()
	{ 
            if ($this->request->isPost()) {
                $data= $this->request->getPost();
                $form = new TrainerForm();
                $trainer=new Trainers();
                echo $this->request->getPost('initial_interview_date');
                if ($form->isValid($data,$trainer)) {
                    $success=$trainer->save();
                    if ($success) {
                        echo 'add successfully';
                    }else{
                        echo "Sorry, the following problems were generated: ";

                        $messages = $trainer->getMessages();

                        foreach ($messages as $message) {
                            echo $message->getMessage(), "<br/>";
                        }
                    }
                    $this->view->disable();
                }  else {
                    $messages = $form->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message);
                    }
                    $this->flash->error("error input");
                }
                /*
                $success=$trainer->save(
                            $this->request->getPost(),
                            [
                                'name',
                                'email',
                                'phone',
                                'initial_interview_date',
                                'spec_id',
                                'start_date_trial_period',
                                'end_date_trial_period',
                                'initial_assessment',
                                'end_trial_period_assessment',
                                'cv'
                            ]
                        );
                if ($success) {
                    echo 'add successfully';
                }else{
                    echo "Sorry, the following problems were generated: ";

                    $messages = $trainer->getMessages();

                    foreach ($messages as $message) {
                        echo $message->getMessage(), "<br/>";
                    }
                }
                $this->view->disable();
            */
            }
	}
    public function deleteAction() {
        if ($this->request->isGet()) {
            $id=$this->request->get('id');
            $trainer = Trainers::findFirstById($id);
            if (!$trainer) {
                $this->flash->error("trainer was not found");
            }else{
                $trainer->delete();
                $this->flash->success("trainer deleted");
            }
            
        }
    }
    public function updateAction() {
        if ($this->request->isGet()) {
            $id=$this->request->get('id');
            $trainer = Trainers::findFirstById($id);
            if (!$trainer) {
                $this->flash->error("trainer was not found");
            }else{
                $form=new TrainerForm();
                $this->view->form=$form;
                $this->view->trainer=$trainer;
            }
            
        }
    }
    public function editAction() {
        if ($this->request->isPost()) {
            $id=$this->request->getPost('id');
            $trainer = Trainers::findFirstById($id);
            $data= $this->request->getPost();
            $form = new TrainerForm();
        
            if ($form->isValid($data,$trainer)) {
                if (!$trainer->save()) {
                    $messages = $form->getMessages();

                    foreach ($messages as $message) {
                        $this->flash->error($message);
                    }
                }else{
                    $this->flash->error("updated successfully");
                }
                
            }else{/*
                $trainer->name=$this->request->getPost('name');
                $trainer->email=$this->request->getPost('email');
                $trainer->phone=$this->request->getPost('phone');
                $trainer->initial_interview_date=$this->request->getPost('initial_interview_date');
                $trainer->specialization=$this->request->getPost('specialization');
                $trainer->start_date_trial_period=$this->request->getPost('start_date_trial_period');
                $trainer->end_date_trial_period=$this->request->getPost('end_date_trial_period');
                $trainer->initial_assessment=$this->request->getPost('initial_assessment');
                $trainer->end_trial_period_assessment=$this->request->getPost('end_trial_period_assessment');
                $trainer->cv=$this->request->getPost('cv');
                */
                $messages = $form->getMessages();

                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                $this->flash->error("error input");
            }
            
        }
    }
        
}
