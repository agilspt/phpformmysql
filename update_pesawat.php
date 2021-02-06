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
            $sql_get_data = "SELECT * FROM pesawat WHERE id=".$id_data;
            $result_get_data = $connection->query($sql_get_data);
            //JIKA DATA YANG DIHASILKAN LEBIH DARI 0
            $data_diupdate = '';
            if($result_get_data->num_rows>0){
                //DEFINISIKAN VARIABEL PERTAMA SEBAGAI DATA YANG AKAN DI UPDATE
                $data_diupdate = $result_get_data->fetch_assoc();
            }
        ?>  
        <b>Form Pesawat</b><br/>
        <form method="POST" action="">
            Kode Pesawat: <input type="text" name="kode_pesawat" value="<?php echo $data_diupdate['kode_pesawat']; ?>"><br/>
            Tahun Pembuatan: <input type="text" name="tahun_pembuatan" value="<?php echo $data_diupdate['tahun_pembuatan']; ?>"><br/>
            Nama Pesawat: <input type="text" name="nama_pesawat" value="<?php echo $data_diupdate['nama_pesawat']; ?>"><br/>
            Nama Maskapai: <input type="text" name="nama_maskapai" value="<?php echo $data_diupdate['nama_maskapai']; ?>"><br/>
            <button type="submit">SIMPAN</button>
        </form>
        <?php
            if(count($_POST)>1){
                if(!$connection->connect_error){
                    $sql_pesawat = "UPDATE pesawat SET 
                        kode_pesawat= '".$_POST['kode_pesawat']."',
                        tahun_pembuatan='".$_POST['tahun_pembuatan']."', 
                        nama_pesawat='".$_POST['nama_pesawat']."', 
                        nama_maskapai='".$_POST['nama_maskapai']."', 
                        updated_at='".date('Y-m-d h:i:s')."' 
                        WHERE id=".$id_data;

                    if($connection->query($sql_pesawat) === TRUE){
                        header('Location: index_pesawat.php');
                    }
                    else{
                        echo "Data gagal dimasukkan:".$connection->error;
                    }
                }
            }
        ?>
    </body>
</html>