<?php

use Phalcon\Mvc\Model;

class Trainers extends Model
{

	public $id;

	public $name;

	public $email;
        
        public $phone;
        
        public $initial_interview_date;
        
        public $specialization;
        
        public $start_date_trial_period;
        
        public $end_date_trial_period;
        
	public $initial_assessment;

	public $end_trial_period_assessment;
        
        public $cv;
}
