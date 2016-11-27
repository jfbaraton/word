<?php
	include 'include_sqlconnection.php';
	$input = file_get_contents("php://input");
    $data  =json_decode($input);
    //$french = $data->{"typedValue"};
    $french = $mysqli->real_escape_string($data->{"typedValue"});
    $finnish = "Bullshit";
    $grammaticalCategory = "verb";
    $group = "";
    $gender = $mysqli->real_escape_string($data->{"gender"});
    $plural = "";
    $declinationOrTempus = "";
    $personalProname = "";

    $chooseIdQuery = "select distinct idBaseForm from `word` where `idBaseForm` <> -1 ".
//    "(`idBaseForm`, `french`, `finnish`, `grammaticalCategory`, `group`, `gender`, `plural`, `declinationOrTempus`, `personalProname`) values (".
//    "-1,".
//    sqlStringify($french, false).",".
//    sqlStringify($finnish, false).",".
//    sqlStringify($grammaticalCategory, false).",".
//    sqlStringify($group, false).",".
//    sqlStringify($gender, false).",".
//    sqlNumerify($plural, false).",".
//    sqlStringify($declinationOrTempus, false).",".
//    sqlStringify($personalProname, false).
    " limit 10";

//    $chooseIdQuery = "OK";
    $res = $mysqli->query($chooseIdQuery);
    $row_cnt = $res->num_rows;
    $randbetween1and10 = rand(1,$row_cnt);
    while($obj = $res->fetch_object()){
    	if($randbetween1and10 --  <= 1){
		    $idWord=$obj->idBaseForm;
    	}
    }
    header('Content-Type: application/json');
    echo json_encode($row_cnt);
?>