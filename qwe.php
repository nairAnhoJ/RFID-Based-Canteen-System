<?php
            // if(isset($_POST['inputSubmit'])){

                // $cardNum = $_SESSION['tapInput'];
                // $dateNow = $_SESSION['dateNow'];
                // $timeNow = $_SESSION['echo "<script>document.writeln(curTime);</script>";'];


                // $query1 = "SELECT * from employee_list WHERE emp_cardNum = '$cardNum' LIMIT 1";
                $query3 = "SELECT * from employee_list";

                $result1 = mysqli_query($con,$query3);

                while ($row = mysqli_fetch_assoc($result1)){
                    $tr1 = $row['emp_name'];

                    echo '<h1 id="r1">', $tr1, '</h1>';
                    echo '<h1 id="r2"></h1>';
                    echo '<h1 id="r3"></h1>';
                    echo '<h1 id="r4"></h1>';
                    echo '<h1 id="r5"></h1>';
                    echo '<h1 id="r6"></h1>';
                }

                // if (mysqli_num_rows($result1) > 0){

                //     $query2 = "SELECT * from tbl_trans_logs WHERE emp_cardNum = '$cardNum' LIMIT 1";

                //     $result2 = mysqli_query($con,$query2);

                //     if(mysqli_num_rows($result1) > 0){
                //         echo '<style type="text/css">
                //                 #anim {
                //                     visibility: visible;
                //                 }
                //             </style>';
                //     }else{
                //         while ($row = mysqli_fetch_assoc($result1)){
                //             $tr1 = $row['emp_name'];


                //             echo '<h1 id="r1">', $tr1, '</h1>';
                //             echo '<h1 id="r2"></h1>';
                //             echo '<h1 id="r3"></h1>';
                //             echo '<h1 id="r4"></h1>';
                //             echo '<h1 id="r5"></h1>';
                //             echo '<h1 id="r6"></h1>';
                //         }
                //     }
                // }
            // }
        ?>