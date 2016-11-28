<?php
	include 'include_sqlconnection.php';
	$input = file_get_contents("php://input");
    $data  =json_decode($input);
    //$french = $data->{"typedValue"};
    $french = $mysqli->real_escape_string($data->{"typedValue"});
    $finnish = "Bullshit";
    $grammaticalCategory = "='verb'";//sqlStringConditionify(real_escape_string($data->{"grammaticalCategory"}), false)
    $group = "";
    $gender = $mysqli->real_escape_string($data->{"gender"});
    $plural = "";
    $declinationOrTempus = "";
    $personalProname = "";

    $chooseIdQuery = "select distinct idBaseForm from `word` where `idBaseForm` <> -1 ";
//    "(`idBaseForm`, `french`, `finnish`, `grammaticalCategory`, `group`, `gender`, `plural`, `declinationOrTempus`, `personalProname`) values (".
//    "-1,".
//    sqlStringify($french, false).",".
//    sqlStringify($finnish, false).",".
    if($grammaticalCategory != ""){
        $chooseIdQuery = $chooseIdQuery." and `grammaticalCategory` ".$grammaticalCategory." ";
     }
//    sqlStringify($group, false).",".
//    sqlStringify($gender, false).",".
//    sqlNumerify($plural, false).",".
//    sqlStringify($declinationOrTempus, false).",".
//    sqlStringify($personalProname, false).
    $chooseIdQuery = $chooseIdQuery." ORDER BY RAND() limit 1";


    $res = $mysqli->query($chooseIdQuery);
    $row_cnt = $res->num_rows;
    while($obj = $res->fetch_object()){
		 $idWord=$obj->idBaseForm;
    }

    $wordsAllFormsQuery = "select * from `word` where `idBaseForm` = ".$idWord
//    ." and `declinationOrTempus` like 'present%'"
    ." order by `declinationOrTempus` asc, `plural` asc, `personalProname` asc " ;
    $res2 = $mysqli->query($wordsAllFormsQuery);

     while($obj2 = $res2->fetch_object()){
         $idWord2[]=$obj2;
     }
//    $encoding = mb_detect_encoding($idWord2[0]->finnish);
//    mb_convert_encoding($idWord2, 'UTF-8', 'UTF-16');
//    $encoding = mb_detect_encoding($idWord2);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($idWord2,JSON_UNESCAPED_UNICODE);
//    echo $idWord2[0]->finnish;
?>