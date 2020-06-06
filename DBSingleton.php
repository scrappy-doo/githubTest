<?php
	class DBSingleton{
		//private instance of class
		private static $instance = null;
		
		//db connection 
		private $pdo;

		//private constructor to prevent making new instances of class
		private function __construct(){
			//db settings
			$host = '127.0.0.1';
			$db   = 'rest_db';
			$user = 'root';
			$pass = 'test';
			$charset = 'utf8';
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$opt = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			$this->pdo = new PDO($dsn, $user, $pass, $opt);
		}
		
		// late static bindings
		//used to reference the called class in a context of static inheritance.
		public static function getInstance(){
			if(!self::$instance){
			  self::$instance = new DBSingleton();
			}
			return self::$instance;
		}
	
		public function getConnection(){
			return $this->pdo;
		}
	}
?>