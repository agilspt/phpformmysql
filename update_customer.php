<html>
    <head>
        <title>Update Pesawat</title>
    </head>
    <body>
        <?php 
            $username = "root";
            $password = "";
            $server_name = "localhost";
            $database_name = "penerbangan"; 
            $connection = new mysqli($server_name, $username, $password, $database_name);
            //MENGAMBIL NILAI ID YANG ADA PADA URL

            $id_data = $_GET['id'];
            $sql_get_data = "SELECT * FROM customer WHERE id=".$id_data;
            $result_get_data = $connection->query($sql_get_data);
            //JIKA DATA YANG DIHASILKAN LEBIH DARI 0
            $data_diupdate = '';
            if($result_get_data->num_rows>0){
                //DEFINISIKAN VARIABEL PERTAMA SEBAGAI DATA YANG AKAN DI UPDATE
                $data_diupdate = $result_get_data->fetch_assoc();
            }
        ?>  
        <b>Form Customer</b><br/>
        <form method="POST" action="">
            Nama: <input type="text" name="nama" value="<?php echo $data_diupdate['nama']; ?>"><br/>
            Nomor KTP: <input type="text" name="nomor_ktp" value="<?php echo $data_diupdate['nomor_ktp']; ?>"><br/>
            Alamat : <input type="text" name="alamat" value="<?php echo $data_diupdate['alamat']; ?>"><br/>
            Jenis Kelamin: <input type="text" name="jenis_kelamin" value="<?php echo $data_diupdate['jenis_kelamin']; ?>"><br/>
            Tanggal Lahir: <input type="text" name="tanggal_lahir" value="<?php echo $data_diupdate['tanggal_lahir']; ?>"><br/>
            <button type="submit">SIMPAN</button>
        </form>
        <?php
            if(count($_POST)>1){
                if(!$connection->connect_error){
                    $sql_customer = "UPDATE customer SET 
                        nama= '".$_POST['nama']."',
                        nomor_ktp='".$_POST['nomor_ktp']."', 
                        alamat='".$_POST['alamat']."', 
                        jenis_kelamin='".$_POST['jenis_kelamin']."', 
                        tanggal_lahir='".$_POST['tanggal_lahir']."', 
                        updated_at='".date('Y-m-d h:i:s')."' 
                        WHERE id=".$id_data;

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