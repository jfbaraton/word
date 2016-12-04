<?php

$mysqli = new mysqli("localhost", "root", "root", "finnish");
if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!$mysqli->set_charset("utf8")) {
    printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", $mysqli->error);
}

// todayDistance = distance from today in days
function calculateStats($mysqli,$todayDistance, $username){
	$debug = "XXX".time() %100 ;
	$todayJeffRequest=  "SELECT `group`, sum(`NbFormsAttempted`) attempts, sum(`NbFormsSuccess`) success FROM `verbexercises` V2 inner join `verbs` V1 on V1.id = V2.VerbId WHERE V1.id  >0 ";
	if(isset($username) && $username != "everybody"){
		$todayJeffRequest .= "and username = '".$username."' ";
	}
	if(isset($todayDistance)){
	 "and datediff(curdate(),V2.`date` )< ".$todayDistance." ";
	}
	$todayJeffRequest .= "group by V1.`group`";


	$todayJeffRes = $mysqli->query($todayJeffRequest);
	$debug .="YYY". time() %100 ;

	$totalAttemps = 0;
	$totalSuccesses = 0;

	$regularAttemps = 0;
	$regularSuccesses = 0;
	$irregularAttemps = 0;
	$irregularSuccesses = 0;

	$g1Attemps = 0;
	$g1Successes = 0;
	$g2Attemps = 0;
	$g2Successes = 0;
	$g3Attemps = 0;
	$g3Successes = 0;
	$g4Attemps = 0;
	$g4Successes = 0;
	$g5Attemps = 0;
	$g5Successes = 0;
	$g6Attemps = 0;
	$g6Successes = 0;
	$g2aAttemps = 0;
	$g2aSuccesses = 0;
	$g2bAttemps = 0;
	$g2bSuccesses = 0;

	$strongAttemps = 0;
	$strongSuccesses = 0;
	$irrAttemps = 0;
	$irrSuccesses = 0;
	$modalAttemps = 0;
	$modalSuccesses = 0;

	while($obj = $todayJeffRes->fetch_object()){
		$debug .="ZZZ". time() %100 ;
		$group=$obj->group;
		$attempts=$obj->attempts;
		$success =$obj->success ;
		// switch case sur le groupe
		switch($group){
			case "1":
				$g1Attemps += $attempts;
				$g1Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$regularAttemps += $attempts;
				$regularSuccesses += $success;
				break;
			case "2":
				$g2aAttemps += $attempts;
				$g2aSuccesses += $success;
				$g2Attemps += $attempts;
				$g2Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$regularAttemps += $attempts;
				$regularSuccesses += $success;
				break;
			case "2b":
				$g2bAttemps += $attempts;
				$g2bSuccesses += $success;
				$g2Attemps += $attempts;
				$g2Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$regularAttemps += $attempts;
				$regularSuccesses += $success;
				break;
			case "3":
				$g3Attemps += $attempts;
				$g3Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$regularAttemps += $attempts;
				$regularSuccesses += $success;
				break;
			case "4":
				$g4Attemps += $attempts;
				$g4Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
			case "5":
				$g5Attemps += $attempts;
				$g5Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
			case "6":
				$g6Attemps += $attempts;
				$g6Successes += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
			case "i":
				$irrAttemps += $attempts;
				$irrSuccesses += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
			case "m":
				$modalAttemps += $attempts;
				$modalSuccesses += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
			case "F":
				$strongAttemps += $attempts;
				$strongSuccesses += $success;
				$totalAttemps += $attempts;
				$totalSuccesses += $success;
				$irregularAttemps += $attempts;
				$irregularSuccesses += $success;
				break;
		}
	}

	if($totalAttemps == 0){	$totalAttemps = 1;}
	if($regularAttemps == 0){	$regularAttemps = 1;}
	if($irregularAttemps == 0){	$irregularAttemps = 1;}

	if($g1Attemps == 0){	$g1Attemps = 1;}
	if($g2Attemps == 0){	$g2Attemps = 1;}
	if($g3Attemps == 0){	$g3Attemps = 1;}
	if($g4Attemps == 0){	$g4Attemps = 1;}
	if($g5Attemps == 0){	$g5Attemps = 1;}
	if($g6Attemps == 0){	$g6Attemps = 1;}
	if($g2aAttemps == 0){	$g2aAttemps = 1;}
	if($g2bAttemps == 0){	$g2bAttemps = 1;}

	if($strongAttemps == 0){	$strongAttemps = 1;}
	if($irrAttemps == 0){	$irrAttemps = 1;}
	if($modalAttemps == 0){	$modalAttemps = 1;}

	// return as array
	$result['totalAttemps']=$totalAttemps;
	$result['totalSuccesses']=$totalSuccesses;

	$result['regularAttemps']=$regularAttemps;
	$result['regularSuccesses']=$regularSuccesses;
	$result['irregularAttemps']=$irregularAttemps;
	$result['irregularSuccesses']=$irregularSuccesses;

	$result['g1Attemps']=$g1Attemps;
	$result['g1Successes']=$g1Successes;
	$result['g2Attemps']=$g2Attemps;
	$result['g2Successes']=$g2Successes;
	$result['g3Attemps']=$g3Attemps;
	$result['g3Successes']=$g3Successes;
	$result['g4Attemps']=$g4Attemps;
	$result['g4Successes']=$g4Successes;
	$result['g5Attemps']=$g5Attemps;
	$result['g5Successes']=$g5Successes;
	$result['g6Attemps']=$g6Attemps;
	$result['g6Successes']=$g6Successes;
	$result['g2aAttemps']=$g2aAttemps;
	$result['g2aSuccesses']=$g2aSuccesses;
	$result['g2bAttemps']=$g2bAttemps;
	$result['g2bSuccesses']=$g2bSuccesses;

	$result['strongAttemps']=$strongAttemps;
	$result['strongSuccesses']=$strongSuccesses;
	$result['irrAttemps']=$irrAttemps;
	$result['irrSuccesses']=$irrSuccesses;
	$result['modalAttemps']=$modalAttemps;
	$result['modalSuccesses']=$modalSuccesses;


	//$debug .="AAA". time() %100 ;
	$result['debug']=$username;
	//$result['debug']=$debug;


	return $result;
}

function monitor($between0And100){
	$result = "00";// no blue
	if($between0And100 >60){
		$result = "#".ajouter0(dechex((255-(($between0And100-60)*2.5*2.55))%256))."FF00";
	}else{
		$result = "#FF".ajouter0(dechex(($between0And100*255/80)%256))."00";
	}
	return $result;
}

function ajouter0($string){
	if($string == null){
		return "00";
	}
	if(strlen ($string) == 1){
		return "0".$string;
	}
	if(strlen ($string) == 2){
		return $string;
	}
	if(strlen ($string) >2){
		return "00";
	}

}

// if NOT allowEmpty => empty string transformed to null
function sqlStringify($value, $allowEmpty){
    if(!isset($value))return "null";
    if(!$allowEmpty && ($value == "" || $value == "null"))return "null";
    return "'".str_replace("'", " ", $value)."'";
}

// if NOT allowEmpty => empty string transformed to null
// if not numeric, null is returned
function sqlNumerify($value, $allowEmpty){
    if(!isset($value))return "null";
    if(!$allowEmpty && ($value == "" || $value == "null"))return "null";
    if(!is_numeric($value))return null;
    return $value;
}

?>
