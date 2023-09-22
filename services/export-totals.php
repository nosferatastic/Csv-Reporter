<?php

//We only act if this is a POST request (ie. it came from the download form)
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Download and decode table data from request
    $totals = json_decode($_POST["data"]);
    //Open output and initialise as CSV
    $fp = fopen('php://output', 'w');
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="ExportedTotals.csv";'); 
    //Store column headers
    fputcsv($fp, ["Category", "Total"]);
    //Store totals to CSV
    foreach($totals as $category => $total) {
        fputcsv($fp, [$category, $total]);
    }
    fclose($fp);
    exit();
}