<?
// Homepage
require_once("core/global.php");
$serverList = new serverList;
require("header.php");
echo "<div class='container'>";
$serverList->getLastServers(5);
echo "</div>";
require("footer.php");
?>