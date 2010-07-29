<?php

require_once APPPATH.'/models/core/field.php';

final class Array_Field extends Field {
    
    private $field;
    private $fields = array();
    private $min;
    private $max;
    
    public function Array_Field(Field $field, $min = 0, $max = PHP_INT_MAX) {
        // Mimick the underlying type
        parent::Field($field->name(), $field->type());
        $this->min = $min;
        $this->max = $max;
    }

    public function equals(Field $that) {
        if(! $that instanceof Array_Field) {
            return false;
        }
        if(! parent::equals($that)) {
            return false;
        }
        if(! $this->field->equals($that->field)) {
            return false;
        }
        return true;
    }
    
    protected function doValidate($list) {
        log_message('error', 'Array_Field::doValidate()');
        if(! is_array($list)) {
            $this->error = "Not an array.";
            return false;
        }
        log_message('error', 'is_array');
        $size = count($list);
        if($size < $this->min) {
            $this->error = "Not enough elements found. " . $size . "/" . $this->min;
            return false;
        }
        log_message('error', 'check min');
        if($size > $this->max) {
            $this->error = "Too many elements found. " . $size . "/" . $this->max;
            return false;
        }
        log_message('error', 'check max');
        foreach($list as $item) {
            // Don't call validate() as it can only be called once.
            log_message('error', '...');
            log_message('error', $item);
            if(! $this->field->validate($item)) {
                log_message('error', 'invalid');
                $this->error = $this->field->error;
                return false;
            }
        }
        log_message('error', 'validation complete');
        return true;
    }
    
    protected function doProcess($list) {
        $result = array();
        // Don't call process() as it can only be called once.
        foreach($list as $item) {
            $result[] = $this->doProcess($item);
        }
        return $result;
    }
}