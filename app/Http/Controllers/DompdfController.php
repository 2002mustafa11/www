<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DompdfController extends Controller
{
    function index(){

$html = view('invoice')->toArabicHTML();

$pdf = PDF::loadHTML($html)->output();

$headers = array(
    "Content-type" => "application/pdf",
);

// Create a stream response as a file download
return response()->streamDownload(
    fn () => print($pdf), // add the content to the stream
    "invoice.pdf", // the name of the file/stream
    $headers
);
    }
}
