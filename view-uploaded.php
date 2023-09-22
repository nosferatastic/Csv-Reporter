<?php

include "./classes/ReportCsvParser.php";

$fileName = null;
if(isset($_FILES["userfile"]) && isset($_FILES["userfile"]["tmp_name"])) {
    $fileName = $_FILES["userfile"]["tmp_name"];
}

if($fileName) {
    $csvParser = new ReportCsvParser($fileName);
    if($csvParser) {
        $success = $csvParser->readCsvToStore();
    }
    //If we were able to load the parser and parse, we read the data and totals
    if(isset($success) && $success) {
        $totals = $csvParser->getDataStore()->getExpenseTotals();
    } else {
        $error = "The uploaded file could not be processed correctly. 
                    It may not have been uploaded correctly, or may not be in the required format. 
                    Please correct the issue and try again.";
    }
    $csvParser->closeCsv();
}

include("./display-data.php");


