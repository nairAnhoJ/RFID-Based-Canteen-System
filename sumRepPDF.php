<?php
    session_start();

    require './dompdf/vendor/autoload.php';

    include("./connection.php");

    use Dompdf\Dompdf;

$x = $_SESSION['period'];
$y = $_SESSION['dateCount'] - 1;
$fromDate = date_create($_SESSION['period'][0]);
$toDate = date_create($_SESSION['period'][$y]);

$html = '   <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Summary Report</title>
            </head>
            <body>
                <div>
                    <h5 style="margin: 0; padding: 0;">Glory (Philippines), Inc.</h5>
                    <h5 style="margin: 0; padding: 0;">Payment to Canteen for GPI Employee Meal Subsidy</h5>
                    <h5 style="margin: 0; padding: 0;">Period: '.date_format($fromDate,"F d, Y").' - '.date_format($toDate,"F d, Y").'</h5>
                </div>
                <table style="margin-top: 20px; width: 100%; text-align: center; border-collapse: collapse;">
                    <thead>
                        <tr style="font-size: 11px; border: 1px solid black; font-size: 12px;">
                            <th rowspan="2" style="width: 12.5%; border: 1px solid black;">Date</th>
                            <th colspan="6" style="border: 1px solid black; font-size: 12px;">ACTUAL PAYMENT</th>
                            <th rowspan="2" style="width: 12.5%; border: 1px solid black; font-size: 12px;">TOTAL MANPOWER</th>
                        </tr>
                        <tr style="font-size: 12px; border: 1px solid black;">
                            <th style="border: 1px solid black;">GPI</th>
                            <th style="border: 1px solid black;">MAXIM</th>
                            <th style="border: 1px solid black;">NIPPI</th>
                            <th style="border: 1px solid black;">POWERLANE</th>
                            <th style="border: 1px solid black;">SERVICE PROVIDER</th>
                            <th style="border: 1px solid black;">TOTAL PAYMENT</th>
                        </tr>
                    </thead>
                    <tbody>';

                    setlocale(LC_MONETARY,"en_US");

                    $totalManpower = 0;

                    $totalGlory = 0.00;
                    $totalMaxim = 0.00;
                    $totalNippi = 0.00;
                    $totalPL = 0.00;
                    $totalSP = 0.00;

                    $amountGlory = 0.00;
                    $amountMaxim = 0.00;
                    $amountNippi = 0.00;
                    $amountPL = 0.00;
                    $amountSP = 0.00;

                    for($d = 0; $d <= $y; $d++){
                        $qDate = $_SESSION['period'][$d];
                        $pDate = date_create($qDate);

                        $queryGlory = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'GLORY' AND tran_date = '$qDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'GLORY' AND lgbk_date = '$qDate'";
                        $resultGlory = mysqli_query($con, $queryGlory);
                        $countGlory = mysqli_num_rows($resultGlory);
                        $amountGlory = $countGlory * 25.00;
                        $totalGlory += $amountGlory;
                        
                        $queryMaxim = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'MAXIM' AND tran_date = '$qDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'MAXIM' AND lgbk_date = '$qDate'";
                        $resultMaxim = mysqli_query($con, $queryMaxim);
                        $countMaxim = mysqli_num_rows($resultMaxim);
                        $amountMaxim = $countMaxim * 25.00;
                        $totalMaxim += $amountMaxim;
                        
                        $queryNippi = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'NIPPI' AND tran_date = '$qDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'NIPPI' AND lgbk_date = '$qDate'";
                        $resultNippi = mysqli_query($con, $queryNippi);
                        $countNippi = mysqli_num_rows($resultNippi);
                        $amountNippi = $countNippi * 25.00;
                        $totalNippi += $amountNippi;
                        
                        $queryPL = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'POWERLANE' AND tran_date = '$qDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'POWERLANE' AND lgbk_date = '$qDate'";
                        $resultPL = mysqli_query($con, $queryPL);
                        $countPL = mysqli_num_rows($resultPL);
                        $amountPL = $countPL * 25.00;
                        $totalPL += $amountPL;
                        
                        $querySP = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'SERVICE PROVIDER' AND tran_date = '$qDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'SERVICE PROVIDER' AND lgbk_date = '$qDate'";
                        $resultSP = mysqli_query($con, $querySP);
                        $countSP = mysqli_num_rows($resultSP);
                        $amountSP = $countSP * 25.00;
                        $totalSP += $amountSP;

                        $totalPayment = $amountGlory + $amountMaxim + $amountNippi + $amountPL + $amountSP;

                        $totalManpower += $totalPayment;

$html .= '              <tr style="font-size: 12px; border: 1px solid black;">
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.date_format($pDate,"F d, Y").'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($amountGlory, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($amountMaxim, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($amountNippi, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($amountPL, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($amountSP, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.number_format($totalPayment, 2, '.', ',').'</td>
                            <td style="width: 12.5%; border: 1px solid black; line-height: 23px;">'.($totalPayment/25).'</td>
                        </tr>';
                    }  
$html .= '              <tr style="font-size: 12px; border: 1px solid black;">
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                            <td style="border: 1px solid black; line-height: 23px;">-</td>
                        </tr>

                        <tr style="font-size: 12px; border: 1px solid black;">
                            <td style="border: 1px solid black; line-height: 23px;">Total</td>
                            <td style="border: 1px solid black; line-height: 23px;">'.number_format($totalGlory, 2, '.', ',').'</td>
                            <td style="border: 1px solid black; line-height: 23px;">'.number_format($totalMaxim, 2, '.', ',').'</td>
                            <td style="border: 1px solid black; line-height: 23px;">'.number_format($totalNippi, 2, '.', ',').'</td>
                            <td style="border: 1px solid black; line-height: 23px;">'.number_format($totalPL, 2, '.', ',').'</td>
                            <td style="border: 1px solid black; line-height: 23px;">'.number_format($totalSP, 2, '.', ',').'</td>
                            <td style="border: 1px solid black; line-height: 23px;"></td>
                            <td style="border: 1px solid black; line-height: 23px;">'.($totalManpower/25).'</td>
                        </tr>

                        <tr style="font-size: 14px; line-height: 20px">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold;">GRAND TOTAL</td>
                            <td>'.number_format($totalManpower, 2, '.', ',').'</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                    <hr style="margin: 5px 0 0 0; padding: 0; border-left: 0px; border-top: 0px;  border-right: 0px;"><hr style="margin-top: 3px; padding: 0; border-left: 0px; border-top: 0px;  border-right: 0px;">
                    
                    <table style="width: 100%; margin-top: 10px; text-align: center; border-collapse: collapse;">
                        <tr>
                            <td>Prepared By:</td>
                            <td>Checked By:</td>
                        </tr>

                        <tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr>
                        

                        <tr>
                            <td>Cedrick James Orozo</td>
			    <td>Nathan Nemedez</td>
                        </tr>
                        <tr>
                            <td><em>MIS Staff</em></td>
                            <td><em>Supervisor</em></td>
                        </tr>
                    </table>
        ';

            
    
$html .= '  </body>
            </html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>
