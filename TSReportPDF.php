<?php
    session_start();

    require './dompdf/vendor/autoload.php';

    include("./connection.php");

    use Dompdf\Dompdf;



$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales Report</title>
</head>
<body style="margin: 0; padding: 0; align-items: center; font-family: sans-serif;">';

    for ($x = 0; $x < $_SESSION['dateCount']; $x++){
        $perDate = $_SESSION['period'][$x];
        $date = date_create($perDate);

        $html .= '<div style="page-break-after: always;">
                    <header style="text-align: center; font-size: 11px;">
                        <h3 style="margin: 0; padding: 0;">GLORY PHILIPPINES INC.</h3>
                        <h3 style="margin: 0; padding: 0;">Total Sales Report</h3>
                        <h3 style="margin: 0; padding: 0;">For the Period '.date_format($date,"F d, Y").'</h3>
                    </header>
                    <table style="margin-top: 20px; width: 100%; text-align: center; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <td style="width: 25%; font-weight: bold; font-size: 10px">Date</td>
                                <td style="width: 25%; font-weight: bold; font-size: 10px">Customer</td>
                                <td style="width: 25%; font-weight: bold; font-size: 10px">Classification</td>
                                <td style="width: 25%; font-weight: bold; font-size: 10px">Credited Amount</td>
                            </tr>
                        </thead>
                        <tbody>';

        $queryGlory = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'GLORY' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'GLORY' AND lgbk_date = '$perDate'";
        $resultGlory = mysqli_query($con, $queryGlory);
        $gloryTotalSales = 0;

        while($gloryRow = mysqli_fetch_assoc($resultGlory)){
            $gloryTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 10px">'.$gloryRow['tran_date'].'</td>
                            <td style="font-size: 10px">'.$gloryRow['emp_name'].'</td>
                            <td style="font-size: 10px">GLORY (PHILS.) INC.</td>
                            <td style="font-size: 10px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 10px;">'.$gloryTotalSales.'</td>
                        </tr>';

        $queryMaxim = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'MAXIM' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'MAXIM' AND lgbk_date = '$perDate'";
        $resultMaxim = mysqli_query($con, $queryMaxim);
        $maximTotalSales = 0;

        while($maximRow = mysqli_fetch_assoc($resultMaxim)){
            $maximTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 10px">'.$maximRow['tran_date'].'</td>
                            <td style="font-size: 10px">'.$maximRow['emp_name'].'</td>
                            <td style="font-size: 10px">'.$maximRow['employer'].'</td>
                            <td style="font-size: 10px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 10px">'.$maximTotalSales.'</td>
                        </tr>';

        $queryNippi = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'NIPPI' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'NIPPI' AND lgbk_date = '$perDate'";
        $resultNippi = mysqli_query($con, $queryNippi);
        $nippiTotalSales = 0;

        while($nippiRow = mysqli_fetch_assoc($resultNippi)){
            $nippiTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 10px">'.$nippiRow['tran_date'].'</td>
                            <td style="font-size: 10px">'.$nippiRow['emp_name'].'</td>
                            <td style="font-size: 10px">'.$nippiRow['employer'].'</td>
                            <td style="font-size: 10px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 10px">'.$nippiTotalSales.'</td>
                        </tr>';

        $queryPL = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'POWERLANE' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'POWERLANE' AND lgbk_date = '$perDate'";
        $resultPL = mysqli_query($con, $queryPL);
        $plTotalSales = 0;

        while($plRow = mysqli_fetch_assoc($resultPL)){
            $plTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 10px">'.$plRow['tran_date'].'</td>
                            <td style="font-size: 10px">'.$plRow['emp_name'].'</td>
                            <td style="font-size: 10px">'.$plRow['employer'].'</td>
                            <td style="font-size: 10px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 10px">'.$plTotalSales.'</td>
                        </tr>';

        $querySP = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE employer = 'SERVICE PROVIDER' AND tran_date = '$perDate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_employer = 'SERVICE PROVIDER' AND lgbk_date = '$perDate'";
        $resultSP = mysqli_query($con, $querySP);
        $spTotalSales = 0;

        while($spRow = mysqli_fetch_assoc($resultSP)){
            $spTotalSales += 25;

            $html .= '  <tr>
                            <td style="font-size: 10px">'.$spRow['tran_date'].'</td>
                            <td style="font-size: 10px">'.$spRow['emp_name'].'</td>
                            <td style="font-size: 10px">'.$spRow['employer'].'</td>
                            <td style="font-size: 10px">25</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px"></td>
                            <td style="font-size: 10px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 10px">'.$spTotalSales.'</td>
                        </tr>';    



        $html .= '<tr>
                    <td style="font-size: 10px"></td>
                    <td style="font-size: 10px"></td>
                    <td style="font-size: 10px">TOTAL CREDIT AMOUNT</td>
                    <td style="font-size: 10px">'.($gloryTotalSales + $maximTotalSales + $nippiTotalSales + $plTotalSales + $spTotalSales).'</td>
                </tr>
                <tr>
                    <td style="font-size: 10px"></td>
                    <td style="font-size: 10px"></td>
                    <td style="font-size: 10px">TOTAL CUSTOMERS</td>
                    <td style="font-size: 10px">'.(($gloryTotalSales + $maximTotalSales + $nippiTotalSales + $plTotalSales + $spTotalSales)/25).'</td>
                </tr>
            </tbody>
        </table>
        </div>';
    }

    $html .= '</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>