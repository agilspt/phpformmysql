<html>  
    <head>
        <title>Daftar Customer</title>
        <style>
            /* MENAMPILKAN BORDER PADA TABLE */
            table,td,tr,th { border: 1px solid black}
        </style>
    </head>
    <body>
        <?php
            //MENDEFINISIKAN KONEKSI DATABASE
            $username = "root";
            $password = "";
            $server_name = "localhost";
            $database_name = "penerbangan"; 
        
            $connection = new mysqli($server_name, $username, $password, $database_name);
            if($connection->connect_error)
                echo "Error, konfigurasi DB salah";
            else
                // echo "Database berhasil dikoneksikan";
            echo "<br/>";
                   /* form untuk searching */
                   $keyword = "";
                   if(count($_GET)>0){
                       $keyword = $_GET['keyword'];
                   }

        ?>
        <b>Daftar Customer</b>
        <br>
        <a href="insert_customer.php">Tambah</a>
        <a href="index.php">Daftar Bandara</a>
        <a href="index_pesawat.php">Daftar Pesawat</a>
        <a href="index_penerbangan.php">Daftar Penerbangan</a>
        <a href="index_penumpang_penerbangan.php">Daftar Penumpang Penerbangan</a>

        <form action="" method="GET">                                               
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">SEARCH</button>
        </form>

        <table>
        
            <tr>
                <td>Nomor</td>
                <td>Nama</td>
                <td>No KTP</td>
                <td>Alamat</td>
                <td>Jenis Kelamin</td>
                <td>Tgl Lahir</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            
            <?php
                $sql_customer = "SELECT * FROM customer";

                $sql_customer = "SELECT * FROM customer";
                if(strlen($keyword)>0){
                    $sql_customer = "SELECT * FROM customer WHERE 
                        nama LIKE '%".$keyword."%' 
                        OR nomor_ktp LIKE '%".$keyword."%'
                        OR alamat LIKE '%".$keyword."%'
                        OR jenis_kelamin LIKE '%".$keyword."%'";    
                }


                $result_customer = $connection->query($sql_customer);
                //MENGECEK APAKAH HASIL DATANYA ADA
                if($result_customer->num_rows>0){
                    $i = 1;
                    //PERULANGAN UNTUK MENGAMBIL DATA HASIL QUERY
                    while($row = $result_customer->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['nama']."</td>";
                        echo "<td>".$row['nomor_ktp']."</td>";
                        echo "<td>".$row['alamat']."</td>";
                        echo "<td>".$row['jenis_kelamin']."</td>";
                        echo "<td>".$row['tanggal_lahir']."</td>";
                        echo "<td><a href='update_customer.php?id=".$row['id']."'>Update</a></td>";
                        echo "<td><a href='delete_customer.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "<tr><td colspan='7'>Tidak ada data yang ditampilkan</td></tr>";
                }
            ?>
        </table>
    </body>
</html>