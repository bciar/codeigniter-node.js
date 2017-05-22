<?php
defined('BASEPATH') OR exit('No direct script access allowed');

trait CallerTrait
{
    /**
     * __callStatic method
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     * */
    public static function __callStatic($name, $arguments = null)
    {
        // Create new instance of this class
        $class = new static;
        //Check the method that we need to call
        if(method_exists($class,$name)){
            //check is method require arguments
            return !is_null($arguments) ? call_user_func_array([$class,$name],$arguments) : call_user_func([$class,$name]);
        }
    }
    /**
     * __call method
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     * */
    public function __call($name, $arguments)
    {
        if(method_exists($this,$name))
        {
            return !is_null($arguments) ? call_user_func_array([$this,$name],$arguments) : call_user_func([$this,$name]);
        }
    }
}