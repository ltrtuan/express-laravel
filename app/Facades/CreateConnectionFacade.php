<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class CreateConnectionFacade extends Facade{
    protected static function getFacadeAccessor() { return 'CreateConnection'; }
}