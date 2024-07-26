<?php

class Validation {

    protected static $data;
    const available_validations = 
    [
        "validatePhoneNumber", 
        "validateNationalID", 
        "validateEmail", 
        "validateNumbersOrLetters", 
        "validateContainsNumbersAndLetters",
    ];

    public static function setData($data) {
        self::$data = $data;
    }

    public function validate(array $requested_validations){
        $answers = [];
        foreach ($requested_validations as $value) {
            if (in_array($value, self::available_validations)){
                $response = $this->$value();
                $answers[$value . " response"] = $response;

            } else {
                $answers[$value . " response"] = "Invalid validation requested.";
            }
            
        }
        return $answers;
    }

    protected function validatePhoneNumber(){
        return preg_match("/^(\+98|0)?9\d{9}$/", self::$data);
    }

    protected function validateNationalID(){
        return preg_match('/^\d{10}$/', self::$data);
    }

    protected function validateEmail(){
        return filter_var(self::$data, FILTER_VALIDATE_EMAIL) !== false;
    }

    protected static function validateNumbersOrLetters() {
        return preg_match('/^[a-zA-Z0-9]+$/', self::$data);
    }

    protected static function validateContainsNumbersAndLetters() {
        return preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', self::$data);
    }
}
?>