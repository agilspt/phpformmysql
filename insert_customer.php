<html>
    <head>
        <title>Insert Customer</title>
    </head>
    <body>
        <b>Form Customer</b><br/>
        <form method="POST" action="">
            Nama: <input type="text" name="nama"><br/>
            Nomor KTP: <input type="text" name="nomor_ktp"><br/>
            Alamat: <input type="text" name="alamat"><br/>
            Jenis Kelamin: <input type="text" name="jenis_kelamin"><br/>
            Tanggal Lahir: <input type="text" name="tanggal_lahir"><br/>
            <button type="submit">SIMPAN</button>
        </form>
        <?php
            //JIKA ADA VARIBEL POST, MAKA JALANKAN KODE INI
            //VARIABEL POST DIDAPATKAN DARI PROSES KETIKA SIMPAN DATA
            //ATAU KLIK SUBMIT
            if(count($_POST)>1){
                $username = "root";
                $password = "";
                $server_name = "localhost";
                $database_name = "penerbangan"; 
            
                $connection = new mysqli($server_name, $username, $password, $database_name);
                if(!$connection->connect_error){
                    $sql_customer = "INSERT INTO customer (nama, 
                    nomor_ktp, alamat, jenis_kelamin, tanggal_lahir, created_at, 
                        updated_at) VALUE(
                        '".$_POST['nama']."',
                        '".$_POST['nomor_ktp']."', 
                        '".$_POST['alamat']."', 
                        '".$_POST['jenis_kelamin']."', 
                        '".$_POST['tanggal_lahir']."', 
                        '".date('Y-m-d h:i:s')."', 
                        '".date('Y-m-d h:i:s')."')";

                    if($connection->query($sql_customer) === TRUE){
                        header('Location: index_customer.php');
                    }
                    else{
                        echo "Data gagal dimasukkan:".$connection->error;
                    }
                }
            }
        ?>
    </body>
</html>