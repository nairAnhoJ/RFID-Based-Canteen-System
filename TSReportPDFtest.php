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
    
        $html .=        '<div style="page-break-after: always;>
                        <header style="text-align: center; font-size: 12px;">
                            <h3 style="margin: 0; padding: 0;">GLORY PHILIPPINES INC.</h3>
                            <h3 style="margin: 0; padding: 0;">Total Sales Report</h3>
                            <h3 style="margin: 0; padding: 0;">For the Period '.date('M-d',strtotime($fromDate)).' to '.date('M-d',strtotime($toDate)).'</h3>
                        </header>
                        <table style="margin-top: 20px; width: 100%; text-align: center; border-collapse: collapse;">
                        <thead>';
        $html .=            '<tr>
                                <td style="width: 25%; font-weight: bold; font-size: 11px">Customer</td>
                                <td style="width: 25%; font-weight: bold; font-size: 11px">'.date('M-d',strtotime($fromDate)).'test</td>';
                                while ($nextDate < $toDate) {
                                    if ($nextDate < $toDate){
                                        $nextDate = $fromDate;
        $html .=                '<td style="width: 25%; font-weight: bold; font-size: 11px">'.date('M-d',strtotime(++$nextDate)).'te</td>';
                                    }else{
        $html .=                '<td style="width: 25%; font-weight: bold; font-size: 11px">'.date('M-d',strtotime($toDate)).'st</td>';}}
        $html .=            '</tr>
                        </thead>
                    <tbody>';
        $Employee_list = "SELECT `emp_name`, `employer` FROM emp_list WHERE employer = 'GLORY' GROUP BY emp_name";
        $Data_list = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$fromDate' AND '$toDate' AND employer = 'GLORY' GROUP BY emp_name UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_date BETWEEN '$fromDate' AND '$toDate' AND lgbk_employer = 'GLORY' GROUP BY emp_name";
        $Employee_list_result = mysqli_query($con, $Employee_list);

        while($Employee_row = mysqli_fetch_array($Employee_row, MYSQLI_ASSOC)){

            $html .= '  <tr>
                            <td style="font-size: 11px">'.$Employee_row['emp_name'].'</td>
                        </tr>';
        }

            $html .= '  <tr style="background-color: #e3e6e8">
                            <--<td style="font-size: 11px"></td>-->
                            <td style="font-size: 11px; font-weight: bold;">TOTAL</td>
                            <td style="font-size: 11px;">'.$gloryTotalSales.'</td>
                        </tr>';    

    $html .= '</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>