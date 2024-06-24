<?
	function Name_compare($a, $b) {
	   return strcmp($a["Name"], $b["Name"]);
	}
	function PostCode_compare($a, $b) {
	   return strcmp($a["PostCode"], $b["PostCode"]);
	}
	function State_compare($a, $b) {
	   return strcmp($a["State"], $b["State"]);
	}
	
	function Suburb_compare($a, $b) {
	   return strcmp($a["Suburb"], $b["Suburb"]);
	}
	function Country_compare($a, $b) {
	   return strcmp($a["Country"], $b["Country"]);
	}
?>