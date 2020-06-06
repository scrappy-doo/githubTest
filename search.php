<?php
	include("DBSingleton.php");
	 
	$search;
	$emptyResult = [];
	
	if(!isset($_GET['searchText']) && !isset($_POST['searchText'])){
		echo("no searchText");
		die();
	}else if(isset($_GET['searchText'])==null){
		$search = $_POST['searchText'];
	}else{
		$search = $_GET['searchText'];
	}
	
	$instance = DBSingleton::getInstance();
	$conn = $instance->getConnection();
	
	
	
	//echo("<br />searchText ". $search."<br />");
	
	$sql = "CALL rdb_search_by_name_1(?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($search));
	$result = $stmt->fetchAll();
	$num = $stmt->rowCount();
	//echo($num); //number of rows
	if($num > 0){
		foreach($result as $row){
			if(isset($row['R_RESULT'])){
				echo $row['R_RESULT'];
			}else{
				echo(json_encode($emptyResult));
			}
		}
	}else{
		echo("no row found");
	}
	//print_r(json_encode($row['R_RESULT'][0]));
	//echo("<br />");
	/*
	$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($row['R_RESULT'], TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
	
	//reading json
	if($num > 0){
		foreach ($jsonIterator as $key => $val) {
			if(is_array($val)) {
				//echo "$key:<br />";
			} else {
				echo "<option value=$key>$val</option>";
			}
		}
	}*/

?>