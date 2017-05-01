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
<?php
    function search($name) {
        $servername = "food_and_drink";
        $username = "foodSearch";
        $password = "foodSearch";

        // Create connection
        $conn = new mysqli('127.0.0.1', $username, $password, $servername);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		
        $sql = "SELECT Alcoholic.Name as 'AName', Alcoholic.Image_Loc as 'AImage_Loc',NonAlcoholic.Name,NonAlcoholic.Image_Loc FROM Food,Alcoholic,NonAlcoholic WHERE ((Food.Name=?) AND Alcoholic.Name=AD_Name AND NonAlcoholic.Name=NAD_Name);";
        $st = $conn->prepare($sql);
		$st->bind_param("s",$name);
		$st->execute();
		$result = $st->get_result();
		$res = $result->fetch_assoc();
        if (!empty($res)) {
			return array($res['AName'], $res['AImage_Loc'],$res['Name'], $res['Image_Loc']);
        } else {
            return null;
        }
		$st->close();
        $conn->close();
    }
?>