<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class TrainerForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $name = new Text("name");
        $name->setLabel("Name");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($name);
        
        $email=new Text("email");
        $email->setLabel('Email');
        $email->addValidators([
                    new PresenceOf([
                        'message' => 'email is required'
                    ])
                    ,
                    new Email([
                        'message' => 'email not valid'
                    ]
                    )
                            
            ]);
        $this->add($email);

        $phone = new Text("phone");
        $phone->setLabel("phone");
        $phone->addValidators(array(
            new PresenceOf([
                'message' => 'phone is required'
            ]),
            new Numericality([
                'message' => 'phone should be numerice'
            ])
        ));
        $this->add($phone);
        $type = new Select(
            "spec_id",
            Specialization::find(),
            [
                "using"      => [
                    "id",
                    "name",
                ],
                "useEmpty"   => true,
                "emptyText"  => "",
                "emptyValue" => "",
            ]
        );
        $this->add($type);
        
        $initial_interview_date = new Text("initial_interview_date");
        $initial_interview_date->setLabel("initial_interview_date");
        $initial_interview_date->addValidators(array(
            new PresenceOf(array(
                'message' => 'initial_interview_date is required'
            ))
        ));
        $this->add($initial_interview_date);
        
        $start_date_trial_period = new Text("start_date_trial_period");
        $start_date_trial_period->setLabel("start_date_trial_period");
        $start_date_trial_period->addValidators(array(
            new PresenceOf(array(
                'message' => 'start date trial period is required'
            ))
        ));
        $this->add($start_date_trial_period);
        
        $end_date_trial_period = new Text("end_date_trial_period");
        $end_date_trial_period->setLabel("end_date_trial_period");
        
        $this->add($end_date_trial_period);
        
        $initial_assessment = new Text("initial_assessment");
        $initial_assessment->setLabel("initial_assessment");
        $initial_assessment->addValidators(array(
            new PresenceOf([
                'message' => 'initial_assessment is required'
            ]),
            new Numericality([
                'message' => 'initial assessment should be numerice'
            ])
        ));
        $this->add($initial_assessment);
        

        $end_trial_period_assessment = new Text("end_trial_period_assessment");
        $end_trial_period_assessment->setLabel("end_trial_period_assessment");
        $end_trial_period_assessment->setDefault(null);
        $end_trial_period_assessment->addValidators(array(
            new Numericality([
                'allowEmpty' => true,
                'message' => 'end trial period assessment should be numerice'
            ])
        ));
        $this->add($end_trial_period_assessment);
        $cv = new Text("cv");
        $cv->setLabel("cv");
        $cv->addValidators(array(
            new PresenceOf([
                'message' => 'cv is required'
            ])
        ));
        
        $this->add($cv);
       
    }
}