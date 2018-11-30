<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Todos',
            'user_id'
        );
    }
}