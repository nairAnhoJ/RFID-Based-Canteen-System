<?php
    session_start();

    require './dompdf/vendor/autoload.php';

    include("./connection.php");

    use Dompdf\Dompdf;

    $dateToday = date_create(date("Y-m-d"));

$html = '   <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body style=" font-family: sans-serif;">
                <div>
                    <span style="font-size: 14px; padding-left: 170px; display: inline;">RAGIM FOOD & CATERING SERVICES</span><span style="font-size: 14px; padding-right: 30px; display: inline; float: right;">'.date_format($dateToday,"F d, Y").'</span>
                </div>
                <h3 style="font-size: 14px">ADMINISTRATION</h3>
            </body>
            </html>';


$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>