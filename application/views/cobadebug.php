<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
   <title>Debug</title>
   
</head>
<body>
    <h1>Debug</h1>
    <p> 
        <?php 
            // echo $hasil; 
            // print_r($id_user);
        ?>
    </p>
    <br>
    <p> 
        <?php 
            // echo $hasil; 
            // print_r($peran);
            // print_r($cek);
            $var = 'nama';
            $var2 = 'ini';
            $md = md5('password');
            
            $insert = "INSERT INTO asdasd (nama, pwd)
                        VALUES(
                        '".$var.' '.$var2."',
                        '".$md."'
                        )
            ";

            // $res = $this->db->query($insert);
            $q="SELECT * FROM asdasd WHERE pwd = '".$md."' ";
            $res = $this->db->query($q);
            var_dump($q);
            var_dump($res->result_array());
        ?>
    </p>
</body>
</html>