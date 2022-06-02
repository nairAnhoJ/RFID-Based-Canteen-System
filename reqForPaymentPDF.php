<?php
    session_start();

    require './dompdf/vendor/autoload.php';

    include("./connection.php");

    use Dompdf\Dompdf;

    $dateToday = date_create(date("Y-m-d"));

    function numberTowords($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen');
    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
    $list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion', 'Octillion', 'Nonillion', 'Decillion', 'Undecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion', 'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion');
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

$x = $_SESSION['period'];
$y = $_SESSION['dateCount'] - 1;
$fromDate = date_create($_SESSION['period'][0]);
$toDate = date_create($_SESSION['period'][$y]);
$fdate = $_SESSION['period'][0];
$dcount = $_SESSION['dateCount'];

$queryfday = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE tran_date = '$fdate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_date = '$fdate'";
$resultfday = mysqli_query($con, $queryfday);
$countfday = mysqli_num_rows($resultfday);

$html = '   <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Request For Payment</title>
            </head>
            <body style=" font-family: Calibri, sans-serif; font-weight: Bold;">
                <div style="margin-top: 60px;">
                    <span style="font-size: 14px; padding-left: 150px; display: inline;">RAGIM FOOD & CATERING SERVICES</span><span style="font-size: 14px; padding-right: 20px; display: inline; float: right;">'.date_format($dateToday,"d-M-Y").'</span>
                    <p style="font-size: 14px; padding-left: 230px; margin-top: 28px;">ADMINISTRATION</p>
                </div>
	<table style="margin-top: 65px; width: 100%; text-align: center; border-collapse: collapse;">
                    <tr style="font-size: 12px;">
                        <td style="width: 30%; font-size: 12px;">Payment for Canteen meal subsidy</td>
                        <td rowspan="2" style="width: 20%;">Date</td>
                        <td rowspan="2" style="width: 20%;">Total Manpower</td>
                        <td></td>
                    </tr>
                    <tr style="font-size: 12px;">
                        <td>Direct and Agency Employee</td>
                        <td></td>
                    </tr>
                    <tr style="font-size: 12px;">
                        <td>'.date_format($fromDate,"F d, Y").' - '.date_format($toDate,"F d, Y").'</td>
                        <td>'.date_format($fromDate,"d-M-Y").'</td>
                        <td>'.$countfday.'</td>
                        <td style="text-align: right; padding-right: 20px;">'.number_format(($countfday*25), 2, '.', ',').'</td>
                    </tr>';

                $num = ($countfday*25);
                for($d = 1; $d < $dcount; $d++){
                    $fdate = $_SESSION['period'][$d];
                    $cdate = date_create($fdate);
                    $queryfday = "SELECT `tran_date`, `emp_name`, `employer` FROM `tbl_trans_logs` WHERE tran_date = '$fdate' UNION SELECT `lgbk_date`, `lgbk_name`, `lgbk_employer` FROM `logbooksales` WHERE lgbk_date = '$fdate'";
                    $resultfday = mysqli_query($con, $queryfday);
                    $countfday = mysqli_num_rows($resultfday);
                    $num += ($countfday*25);

                    if($countfday > 0){

$html .= '          <tr style="font-size: 12px; font-weight: bold;">
                        <td></td>
                        <td>'.date_format($cdate,"d-M-Y").'</td>
                        <td>'.$countfday.'</td>
                        <td style="text-align: right; padding-right: 20px;">'.number_format(($countfday*25), 2, '.', ',').'</td>
                    </tr>

';                    
                    }
                }

$html .= '          <tr style="line-height: 30px;">
                        <td colspan="3" style="font-size: 14px; font-weight: bold;">***************Nothing Follows***************</td>
                        <td></td>
                    </tr>
                </table>

                <table style="width: 100%; text-align: center; border-collapse: collapse; position: absolute; top: 430px;">
                    <tr style="font-size: 14px;">
                        <td colspan="3">'.numberTowords($num).' Pesos Only</td>
                        <td style="text-align: right; padding-right: 20px;">'.number_format($num, 2, '.', ',').'</td>
                    </tr>
                    
                    <tr style="line-height: 60px; font-size: 14px; text-align: left;">
                        <td style="padding-left: 0px">Cedrick/Nathan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>        
                </table>
            </body>
        </html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('total-sales-report.pdf', ['Attachment' => 0]);
?>
