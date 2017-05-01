<!-- Find-Me-A-Drink is a simple web application that uses an image recognition API (clarifai.com) to provide suggestions
	 on what drink to have with the type of food you provided be it an uploaded image, a link to an image or query.
    Copyright (C) 2017 Nicolas Kadis, Marios Iacovou, Alex Orphanides, Chris Petrou

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

-->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<?php include 'search.php';?>
	<script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-2.0.9.js"></script>
	<script type="text/javascript">
	function searchItem(){
		var term = document.getElementById("search").value;
		window.location = "index.php?term="+term;
	}
	
	function searchUrl(){
		var url = document.getElementById("url").value;
		var app = new Clarifai.App(
		'rm-tFu-lyo4eev0IKOTivR5Or2O2wEoRg2ThzhIC',
		'7bPcW_NL2uVXW0WfIKTsswTYxYI9uc67YNcceq4d');
		
		app.models.predict(Clarifai.FOOD_MODEL, url).then(
			function(response) {
				var ingredients = response.data.outputs[0].data.concepts;
				window.location = "index.php?term="+ingredients[0].name+"&img_url="+url;
			},
			function(err) {
			  alert(err);
			}
		);
	}
	
	function convertToBase64(file){
			var reader = new FileReader();
			reader.readAsDataURL(file.files[0]);
			reader.onload = function(){
				var value = { base64: reader.result.split("base64,")[1]};
				var app = new Clarifai.App(
				'rm-tFu-lyo4eev0IKOTivR5Or2O2wEoRg2ThzhIC',
				'7bPcW_NL2uVXW0WfIKTsswTYxYI9uc67YNcceq4d');
				
				app.models.predict(Clarifai.FOOD_MODEL, value).then(
					function(response) {
						var ingredients = response.data.outputs[0].data.concepts;
						
						var form = document.createElement("form");
						form.setAttribute("method","POST");
						form.setAttribute("action","index.php");
						var hiddenBase64 = document.createElement("input");
						hiddenBase64.setAttribute("type","hidden");
						hiddenBase64.setAttribute("name","img_base64");
						hiddenBase64.setAttribute("value", reader.result);
						var hiddenTerm = document.createElement("input");
						hiddenTerm.setAttribute("type","hidden");
						hiddenTerm.setAttribute("name","term");
						hiddenTerm.setAttribute("value", ingredients[0].name);
						
						form.appendChild(hiddenBase64);
						form.appendChild(hiddenTerm);
						
						form.submit();
					},
					function(err) {
						alert(err);
					}
				);
			}
			reader.onerror = function (error){
				alert('Error: ' + error);
			}
		}
	</script>
</head>
<body>
<div class="w3-bar w3-black">
	<a href="index.php"><button class="w3-bar-item w3-button tablink w3-red">Home</button></a>
	<button class="w3-bar-item w3-button tablink" onclick="openSearch(event,'Upload')">Upload</button>
	<button class="w3-bar-item w3-button tablink" onclick="openSearch(event,'URL')">URL</button>
	<button class="w3-bar-item w3-button tablink" onclick="openSearch(event,'Search')">Search</button>
</div>

<div id="Home" class="w3-container w3-display-container option">
	<h2>Welcome to Find-Me-A-Drink</h2>
	<p>Search for a food and we'll tell you what to drink with it.</p>
</div>

<div id="Upload" class="w3-container w3-display-container option"> 
	<h2>Upload An Image From Your PC</h2>
	<input id="file" type="file" name="image"><br><br>
	<button onclick="convertToBase64(file)">Search</button>
</div>

<div id="URL" class="w3-container w3-display-container option" style="display:none">
	<h2>Enter An Image URL</h2>
	<input type="text" id="url" name="url">
	<button onclick="searchUrl()">Submit</button>
</div>

<div id="Search" class="w3-container w3-display-container option" style="display:none">
	<h2>Search</h2>
	<input type="text" id="search" name="search">
	<button onclick="searchItem()">Submit</button>
</div>

<table id='result' width='100%' style='text-align:center'>
<?php 
	if (isset($_GET['term']) || isset($_POST['term'])){
		$term = isset($_GET['term'])?$_GET['term']:$_POST['term'];
		$results = search(isset($_GET['term'])?$_GET['term']:$_POST['term']);
		if (!empty($results)){
			echo "<tr>";
				echo "<td rowspan='2'>". $term . "<br>";
				if (isset($_GET['img_url'])){
					echo "<img style='max-width:300px' src='".$_GET['img_url']."'/>";
				}else if (isset($_POST['img_base64'])){
					echo "<img style='max-width:300px' src='".$_POST['img_base64']."'/>";
				}
				echo "</td>";
				echo "<td>Recommended Alcoholic Drink:<br><img style='max-height:100px' src='drinks/".$results[1]."'/><br>". $results[0] . "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td>Recommended Non-Alcoholic Drink:<br><img style='max-height:100px' src='drinks/".$results[3]."'/><br>" . $results[2]. "</td>";
			echo "</tr>";?>
</table>
<?php	}else{
			echo "<p>Sorry, the food you entered does not match our database. Please try another term.</p>";
		}
	}
	?>
<script>
	function openSearch(evt, op) {
		document.getElementById("result").innerHTML = "";
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("option");
		for (i = 0; i < tabcontent.length; i++) {
		  tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < tabcontent.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
		}
		document.getElementById(op).style.display = "block";
		evt.currentTarget.className += " w3-red";
	}
</script>
</body>
</html>