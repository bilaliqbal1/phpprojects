<?php

class functions
 {
    function con()
    {
        session_start();
        $conn = $_SESSION['conn'] = mysqli_connect( 'localhost', 'root', '', 'datamining');
    }

//     function add_coupon($date, $exp_date, $discription,$link,$coupon_code,$store, $category,$checkbox)
//  {
//         $conn = $_SESSION['conn'];
//         $id="";
//         $insert = mysqli_query( $conn, "insert into coupon values('$id','$date','$exp_date','$discription','$link','$coupon_code','$store','$category','$checkbox');" );
//         if ( $insert )
//         {
//             echo "<script> alert('Coupon Added'); </script>";
//         }
//     }
   

    function bookview_data()
    {
        $conn = $_SESSION['conn'];
        $sel = mysqli_query( $conn, 'select * from data' );
        $num = mysqli_num_rows( $sel );
        for ( $i = 1; $i <= $num; $i++ )
       {
            $row = mysqli_fetch_array( $sel );
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td>' . $row[3] . '</td>';
            echo '<td>' . $row[4] . '</td>';
            echo '<td>' . $row[5] . '</td>';
            echo '<td>' . $row[6] . '</td>';
            echo '<td>' . $row[7] . '</td>';
            echo '<td>' . $row[8] . '</td>';
            echo '</tr>';
        }
    }



    function login( $email, $pass )
 {
        $conn = $_SESSION['conn'];
        $insert = mysqli_query( $conn, "select * from login where Email='".$email."' AND Password='".$pass."'" );
        $num = mysqli_num_rows( $insert );
        if ( $num > 0 )
       {
            $_SESSION['email'] = $email;
            header( 'location:dashboard.php' );

        }
    }

 }
?>