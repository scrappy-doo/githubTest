<?php
	
?>
<html>
	<head>
		<title>Name search</title>
		<script src="jquery-3.3.1.min.js"></script>
		
		<!-- For select2-->
		<link href="select2.min.css" rel="stylesheet" />
		<script src="select2.min.js"></script>
	</head>
	<body>
		<input name="ajaxsearch" id="ajaxsearch" value="" />
		<span id="listofnames"></span>	
		<br />
		<select id="name-search"></select>
		<script>
			var count = 0;
			
			function getNames(){
				$('#listofnames').text(count);
				 count++;
				 
				$.post("search.php", {searchText: $('#ajaxsearch').val()}, function(result){
					$('#listofnames').html(result);
					console.log(result);
					console.log($('#ajaxsearch').val());
					$('#name-search').find('option').remove(); //remove all options
					
					if(result == null){
						console.log("no rows");
					}
					
					result = $.parseJSON(result);
					$.each(result, function(i, item) {
						console.log(item.person_name);
						/*$('#name-search').append(
							$('<option/>'), {
								value: item.person_id,
								text: item.person_name
							}
						);*/
						
						$('#name-search').append("<option value='" + item.person_id +"'>"+ item.person_name + "</option>");
					})
					
					
					/*
					for (var key in result) {
						if (result.hasOwnProperty(key)) {
						  console.log(result[key].person_id);
						  console.log(result[key].person_name);
						}
					}
					*/
					//$('#name-search').html(result);
				});
			}
			
			$('#ajaxsearch').keyup(function(){
				getNames();
			});
			
			$('#ajaxsearch').focus(function(){
				getNames();
			});
			
			$('#name-search').css({'width': 200});
			
			$(document).ready(function() {
				$('#name-search').select2();
			});
		</script>
	</body>
</html>