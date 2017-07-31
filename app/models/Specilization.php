<?php

use Phalcon\Mvc\Model;

class Specilization extends Model
{

	public $id;

	public $name;
        public function initialize()
        {
            $this->hasMany('id', 'Trainers', 'spec_id', array(
                    'foreignKey' => array(
                            'message' => 'Product Type cannot be deleted because it\'s used in Products'
                    )
            ));
        }
}
