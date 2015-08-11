<?php
/* global.php

This contains the main classes, other important things.

Don't mess with this code */
class serverList  {	
//defining the main "serverList" class
	public $dev_mode = 1; //Set $dev_mode to 1 if you want error reporting, else set it to 0
	
	public function print_homepage() 
	{ //Display the homepage
		require("tpl/homepage.php");
		$serverList = new serverList;
		if($serverList->dev_mode==0)
		{
			error_reporting(0);
		}
	}
	
	public function print_sitename() {
require_once("core/dbconfig.php");

$conn = new mysqli($servername, $username, $password, $dbname);
$serverList = new serverList;
if($serverList->dev_mode==1)
{
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
}

$sql = "SELECT * FROM serverlist_config";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($res = $result->fetch_assoc()) {
        echo $res['sitename'];
    }
} else {
    echo "null";
}
$conn->close();
	}
	
	public function getLastServers($numservers) {
		echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Last 5 added servers</h3></div><div class='panel-body'>";
		echo "<table class='table'><tr><th>ID</th><th>Hostname</th><th>Owner</th><th>More Details</th></tr>";
		require_once("core/dbconfig.php");
$conn2 = new mysqli("localhost", "user", "password", "dbname");
if($serverList->dev_mode==1){
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}
}

$sql2 = "SELECT * FROM serverlist_servers ORDER BY id DESC LIMIT $numservers";
$result2 = $conn2->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
		echo "<tr><td>" . $row2['id'] . "</td><td>" . $row2['hostname'] . "</td><td>" . $row2['owner'] . "</td><td><a href='server/" . $row2['id'] . "'>Click here!</a></td></tr>";
    }
} else {
    echo "0 results";
}
$conn2->close();
echo "</div></div>";
	}
}
