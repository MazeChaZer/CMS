<?php

/* 
 * class.View
 * created: 02/11/2013
 * last edit: 02/11/2013
 * author: DD
 */

class View
{
    private $data;
    private $pagename;
    
    public function __construct($pagename)
    {
        $this->pagename = $pagename;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function out(){
        require_once('out/templates/'.$this->pagename.'.php');
    }
}