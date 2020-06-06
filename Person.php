<?php
//person file
	class Person{
		private $name;
		
		public function  __construct($new_name){
			$this->name = $new_name;
		}
		
		public function __destruct(){
			//__CLASS__ magic constant
			echo 'The class "'.__CLASS__ . '" was destroyed<br />';
		}
		
		public function set_name($new_name){
			$this->name = $new_name;
		}
		
		public function get_name(){
			return $this->name;
		}
		
		public function displayMessage(){
			echo"Message displayed from Person class <br />";
		}
	}
?>