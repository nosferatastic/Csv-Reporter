<?php

// index.php
$request = $_SERVER['REQUEST_URI'];
switch($request) {
    case '/':
        require __DIR__ .'/view-uploaded.php'; break;
    case '/report':
        require __DIR__ .'/view-uploaded.php'; break;
    case '/export':
        require __DIR__ .'/services/export-totals.php'; break;
}
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $request)) {
    return false;    // serve the requested resource as-is.
} else { 
    //require_once('view-uploaded.php');
}
