<?php defined('SYSPATH') or die('No direct script access.');


class Sagui{
    
    private $_connection = NULL;
    private $_db = NULL;
    
    
    public function __construct($group='default'){
        
        $_config = Kohana::config('sagui');
        
        if(array_key_exists($group, $_config)){
            $_config = Kohana::config('sagui.'.$group);
        }else{
            $_config = Kohana::config('sagui.default');
        }
        
        $this->_config = $_config;
        
    }
    

    public function connect(){
        
        $this->_connection = new Mongo($this->_config['server'], $this->_config['options']);
        
        return $this;
      
    }
    
    public function select_database($name=NULL){
        
        if(is_null($this->_connection)){
            $this->connect();
        }
        
        
        if(is_null($name)){
            $name = $this->_config['database'];
        }
        
        $this->_db = $this->_connection->$name;
        
        if(is_null($this->_connection)){
            $this->_db->authenticate($this->_config['user'], $this->_config['password']); 
        }
        
        
        return $this;
        
    }
    
    public function select_db($name=NULL){
        return $this->select_database($name);
    }
    
    
    public function create_collection($name){
        
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->createCollection($name);
        
    }
    
    
    public function get_collection($name, $create=FALSE){
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->$name;
        
    }
    
    public function insert_in_collection($collection, $data){
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->$collection->insert($data);
    }
    
    public function count_collection($collection){
        
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->$collection->count();
    }
    

    public function find_one_in_collection($collection, $query = array(), $fields = array()){
        
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->$collection->findOne($query, $fields);
    }
    
    public function remove_collection($collection, $criteria = array(), $options = array() ){
        
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->$collection->remove($criteria, $options);
    }
    
    public function command($params){
        
        if(is_null($this->_db)){
            $this->select_database();
        }
        
        return $this->_db->command($params);
    }
    
    
}