<?php

class Validate {
	private $_passed = false,
			$_errors = array(),
			$_db = null;
	
	public function __construct() {
		$this->_db = DB::getInstance();
	}
	
	public function check($source, $items = array()) {
		foreach($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);
				$item = escape($item);
				
				if ($rule === "required" && empty($value)) {
					$this->addError("{$item} is required");
				} else if (!EMPTY($value)){
					switch($rule) {
						
						case "min":
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters");
							}
						break;
						
						case "max":
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters");
							}
						break;
						
						case "matches":
							if ($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}");
							}
						break;

						// case "phone":

						// 	if (!preg_match("/^[0-9]{10,10}+$/", $value) && $rule_value == true) {
						// 		$this->addError("{$item} doesn't match the required format");
						// 	}
						
						break;
						
						case "unique":
							$check = $this->_db->get($rule_value, array($item, "=", $value));

							if ($check->count()) {
								$this->addError("{$item} already exists");
							}
						break;
						
						case "regex":
							$check = preg_match("/".$rule_value."/", $value);
							if ($check != 1) {
								$this->addError("{$item} doesn't match the required format");
							}
						break;
					}
				}
			}
		}
		
		if (empty($this->_errors)) {
			$this->_passed = true;
		}
		
		return $this;
	}
	
	private function addError($error) {
		$this->_errors[] = $error;
	}
	
	public function errors() {
		return $this->_errors;
	}
	
	public function passed() {
		return $this->_passed;
	}
}