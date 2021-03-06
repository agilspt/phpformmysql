<html>  
    <head>
        <title>Daftar Penerbangan</title>
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

            $keyword = "";
            if(count($_GET)>0){
                $keyword = $_GET['keyword'];
            }


        ?>
        <b>Daftar Pesawat</b>
        <br>
        <a href="insert_penerbangan.php">Tambah</a>
        <a href="index.php">Daftar Bandara</a>
        <a href="index_pesawat.php">Daftar Pesawat</a>
        <a href="index_customer.php">Daftar Customer</a>
        <a href="index_penumpang_penerbangan.php">Daftar Penumpang Penerbangan</a>

        <form action="" method="GET">                                               
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">SEARCH</button>
        </form>

        
        <table>
        
            <tr>
                <td>Nomor</td>
                <td>Kode Pesawat</td>
                <td>Bandara Asal</td>
                <td>Bandara Tujuan</td>
                <td>Waktu Penerbangan</td>
                <td>Status Penerbangan Penerbangan</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            <?php
                $sql_penerbangan = "SELECT * FROM penerbangan";
                if(strlen($keyword)>0){
                    $sql_penerbangan = "SELECT * FROM penerbangan WHERE 
                        id_pesawat LIKE '%".$keyword."%' 
                        OR id_bandara_dari LIKE '%".$keyword."%' 
                        OR id_bandara_tujuan LIKE '%".$keyword."%' 
                        OR waktu_penerbangan LIKE '%".$keyword."%' 
                        OR status_penerbangan LIKE '%".$keyword."%'";    
                }

                $result_penerbangan = $connection->query($sql_penerbangan);
                //MENGECEK APAKAH HASIL DATANYA ADA
                if($result_penerbangan->num_rows>0){
                    $i = 1;
                    //PERULANGAN UNTUK MENGAMBIL DATA HASIL QUERY
                    while($row = $result_penerbangan->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['id_pesawat']."</td>";
                        echo "<td>".$row['id_bandara_dari']."</td>";
                        echo "<td>".$row['id_bandara_tujuan']."</td>";
                        echo "<td>".$row['waktu_penerbangan']."</td>";
                        echo "<td>".$row['status_penerbangan']."</td>";
                        echo "<td><a href='update_penerbangan.php?id=".$row['id']."'>Update</a></td>";
                        echo "<td><a href='delete_penerbangan.php?id=".$row['id']."'>Delete</a></td>";
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