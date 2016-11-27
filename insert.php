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

    // check that mandatory fields are provided

    $saveQuery = "insert into `word`".
    "(`idBaseForm`, `french`, `finnish`, `grammaticalCategory`, `group`, `gender`, `plural`, `declinationOrTempus`, `personalProname`) values (".
    "-1,".
    sqlStringify($french, false).",".
    sqlStringify($finnish, false).",".
    sqlStringify($grammaticalCategory, false).",".
    sqlStringify($group, false).",".
    sqlStringify($gender, false).",".
    sqlNumerify($plural, false).",".
    sqlStringify($declinationOrTempus, false).",".
    sqlStringify($personalProname, false).
    ")";

//    $saveQuery = "OK";
    $res = $mysqli->query($saveQuery);

    $readNewIdQuery = "select * from `word` where `idBaseForm` = -1 and `french` = ".$french ;

    $resId = $mysqli->query($readNewIdQuery);

    $row_cnt = $resId->num_rows;
    $obj = $resId->fetch_object();

    $newWordBaseId = $obj->id;

    $setNewWordIdQuery = "update `word` set `idBaseForm` = ".$newWordBaseId." where `idBaseForm` = -1 and `french` = ".$french ;

    header('Content-Type: application/json');
    echo json_encode($obj);


?>