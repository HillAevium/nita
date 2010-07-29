<?php

abstract class Field {
    
    private $name;
    private $type;
    
    private $validated = false;
    private $validateResult = false;
    private $processed = false;
    private $processResult = false;
    
    //private $input;
    
    protected $error;
    
    protected function Field($name, $type) {
        $this->name = $name;
        $this->type = $type;
        $this->error = '';
        //$this->input = get_instance()->input;
    }
    
    public function error() {
        return $this->error;
    }
    
    public function equals(Field $that) {
        if($this->name !== $that->name) {
            return false;
        }
        if($this->type !== $that->type) {
            return false;
        }
        return true;
    }
    
    public function isEmpty() {
        // If there is a value set this returns the value
        // so switch to true
        log_message('error', '->isEmpty()');
        return ($this->value() === false) ? true : false;
    }
    
    public function matches($value) {
        /*
        if(! $this->validated) {
            throw new RuntimeException("Cannot perform match on non-validated field");
        }
        if(! $this->validateResult) {
            throw new RuntimeException("Cannot perform match on invalid field");
        }
        */
        return $this->value() === $value;
    }
    
    public function name() {
        return $this->name;
    }
    
    public function type() {
        return $this->type;
    }
    
    public final function validate() {
        if($this->validated) {
            log_message('debug', 'field already validated: ' . $this->name);
            return $this->validateResult;
        }
        log_message('error', 'validating');
        $this->validateResult = $this->doValidate($this->value());
        log_message('error', 'validated');
        $this->validated = true;
        return $this->validateResult;
    }
    
    public final function process() {
        if(! $this->validated) {
            throw new RuntimeException("Value must be validated before accessing.");
        }
        if(! $this->validateResult) {
            throw new RuntimeException("Trying to access an invalid result.");
        }
        
        if($this->processed) {
            log_message('debug', 'field already processed: ' . $this->name);
            return $this->processResult;
        }
        
        $this->processResult = $this->doProcess($this->value());
        $this->processed = true;
        return $this->processResult;
    }
    
    private function value() {
        //$value = $this->input->post($this->name);
        $value = get_instance()->input->post($this->name);
        
        // Array elements need to be squashed if they
        // have no data in them. The form may give more
        // elements than there really are.
        if(is_array($value)) {
            $values = array();
            foreach($value as $v) {
                if($v !== '') {
                    $values[] = $v;
                }
            }
            return count($values) === 0 ? false : $values;
        } else {
            return $value === '' ? false : $value;
        }
    }
    
    protected abstract function doValidate($data);
    
    protected abstract function doProcess($data);
}