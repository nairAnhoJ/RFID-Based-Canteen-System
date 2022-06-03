<?php
    session_start();

    require './dompdf/vendor/autoload.php';

    include("./connection.php");

    use Dompdf\Dompdf;
    $fromDate = $_SESSION['from'];
    $toDate = $_SESSION['to'];


$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Total Sales Report</title>
        </head>
        <body style="margin: 0; padding: 0; align-items: center; font-family: sans-serif;">';
    
        $html .= '  <div style="page-break-after: always;>
                    <header style="text-align: center; font-size: 12px;">
                        <h3 style="margin: 0; padding: 0;">GLORY PHILIPPINES INC.</h3>
                        <h3 style="margin: 0; padding: 0;">Total Sales Report</h3>
                        <h3 style="margin: 0; padding: 0;">For the Period '.$fromDate.' to '.++$toDate.'</h3>
                    </header>   
                    <table style="margin-top: 20px; width: 100%; text-align: center; border-collapse: collapse;">
                        <thead>';
    
        $html .= '  <tr>
                        <td style="width: 25%; font-weight: bold; font-size: 11px">Customer</td>
                        <td style="width: 25%; font-weight: bold; font-size: 11px">'.date('M-d',strtotime($fromDate)).'</td>';
                        if($fromDate < $toDate){
                            $headbang .= '<td style="width: 25%; font-weight: bold; font-size: 11px">'.date('M-d',strtotime(++$fromDate)).'</td>';
                            $headbang;
                            echo ++$fromDate;
                        }elseif($fromDate == $toDate){
                            $bangbang .= '<td style="width: 25%; font-weight: bold; font-size: 11px">'.date('Y-m-d',strtotime($toDate)).'</td>';
                            $bangbang;
                        }
                    '.</tr>
                </thead>
            <tbody>.';
        
        $Employees = "SELECT `emp_name`, `employer` FROM emp_list WHERE employer = 'GLORY' GROUP BY emp_name UNION SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$fromDate' AND '$toDate' AND employer = 'GLORY' GROUP BY emp_name UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_date BETWEEN '$fromDate' AND '$toDate' AND lgbk_employer = 'GLORY' GROUP BY emp_name";
        $Employee_list = mysqli_query($con, $Employees);
        $gloryRow = mysqli_fetch_assoc($Employee_list);
        // $DateQuery = ";
        $Date_list = mysqli_query($con, $DateQuery);
        // $queryGlory = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$fromDate' AND '$toDate' AND employer = 'GLORY' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_date BETWEEN '$fromDate' AND '$toDate' AND lgbk_employer = 'GLORY'";
        // $resultGlory = mysqli_query($con, $queryGlory);
        // $gloryTotalSales = 0;

        // while($gloryRow = mysqli_fetch_assoc($resultGlory)){
        while($gloryRow = mysqli_fetch_assoc($Employee_list)){
        //     $gloryTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$gloryRow['emp_name'].'</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px;">'.$gloryTotalSales.'</td>
                        </tr>';

        $queryMaxim = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'MAXIM' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'MAXIM' AND lgbk_date = '$perDate'";
        $resultMaxim = mysqli_query($con, $queryMaxim);
        $maximTotalSales = 0;

        while($maximRow = mysqli_fetch_assoc($resultMaxim)){
            $maximTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$maximRow['tran_date'].'</td>
                            <td style="font-size: 11px">'.$maximRow['emp_name'].'</td>
                            <td style="font-size: 11px">'.$maximRow['employer'].'</td>
                            <td style="font-size: 11px">25'.$_SESSION['from'].'</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px">'.$maximTotalSales.'</td>
                        </tr>';

        $queryNippi = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'NIPPI' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'NIPPI' AND lgbk_date = '$perDate'";
        $resultNippi = mysqli_query($con, $queryNippi);
        $nippiTotalSales = 0;

        while($nippiRow = mysqli_fetch_assoc($resultNippi)){
            $nippiTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$nippiRow['tran_date'].'</td>
                            <td style="font-size: 11px">'.$nippiRow['emp_name'].'</td>
                            <td style="font-size: 11px">'.$nippiRow['employer'].'</td>
                            <td style="font-size: 11px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px">'.$nippiTotalSales.'</td>
                        </tr>';

        $queryPL = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'POWERLANE' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'POWERLANE' AND lgbk_date = '$perDate'";
        $resultPL = mysqli_query($con, $queryPL);
        $plTotalSales = 0;

        while($plRow = mysqli_fetch_assoc($resultPL)){
            $plTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$plRow['tran_date'].'</td>
                            <td style="font-size: 11px">'.$plRow['emp_name'].'</td>
                            <td style="font-size: 11px">'.$plRow['employer'].'</td>
                            <td style="font-size: 11px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px">'.$plTotalSales.'</td>
                        </tr>';

        $querySP = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'SERVICE PROVIDER' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'SERVICE PROVIDER' AND lgbk_date = '$perDate'";
        $resultSP = mysqli_query($con, $querySP);
        $spTotalSales = 0;

        while($spRow = mysqli_fetch_assoc($resultSP)){
            $spTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$spRow['tran_date'].'</td>
                            <td style="font-size: 11px">'.$spRow['emp_name'].'</td>
                            <td style="font-size: 11px">'.$spRow['employer'].'</td>
                            <td style="font-size: 11px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px"></td>
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px">'.$spTotalSales.'</td>
                        </tr>';    



        $html .= '<tr>
                    <td style="font-size: 11px"></td>
                    <td style="font-size: 11px"></td>
                    <td style="font-size: 11px">TOTAL CREDIT AMOUNT</td>
                    <td style="font-size: 11px">'.($gloryTotalSales + $maximTotalSales + $nippiTotalSales + $plTotalSales + $spTotalSales).'</td>
                </tr>
                <tr>
                    <td style="font-size: 11px"></td>
                    <td style="font-size: 11px"></td>
                    <td style="font-size: 11px">TOTAL CUSTOMERS</td>
                    <td style="font-size: 11px">'.(($gloryTotalSales + $maximTotalSales + $nippiTotalSales + $plTotalSales + $spTotalSales)/25).'</td>
                </tr>
            </tbody>
        </table>
        </div>';
    

    $html .= '</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>