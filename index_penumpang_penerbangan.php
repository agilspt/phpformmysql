<html>  
    <head>
        <title>Daftar Penumpang Penerbangan</title>
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
            //form searching keyword
            
            $keyword = "";
            if(count($_GET)>0){
                $keyword = $_GET['keyword'];
            }

        ?>
        <b>Daftar Penumpang Penerbangan</b>
        <br>
        <a href="insert_penumpang_penerbangan.php">Tambah</a>
        <a href="index.php">Daftar Bandara</a>
        <a href="index_pesawat.php">Daftar Pesawat</a>
        <a href="index_customer.php">Daftar Customer</a>
        <a href="index_penerbangan.php">Daftar Penerbangan</a>
        
        <form action="" method="GET">                                               
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">SEARCH</button>
        </form>

        <table>
        
            <tr>
                <td>Nomor</td>
                <td>Kode Penerbangan</td>
                <td>Kode Penumpang</td>
                <td>Status Penumpang</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            <?php
                $sql_penumpang_penerbangan = "SELECT * FROM penumpang_penerbangan";
                if(strlen($keyword)>0){
                    $sql_penumpang_penerbangan = "SELECT * FROM penumpang_penerbangan WHERE 
                        id_penerbangan LIKE '%".$keyword."%' 
                        OR id_penumpang LIKE '%".$keyword."%' 
                        OR status_penumpang LIKE '%".$keyword."%'";    
                }
                $result_penumpang_penerbangan = $connection->query($sql_penumpang_penerbangan);
                //MENGECEK APAKAH HASIL DATANYA ADA
                if($result_penumpang_penerbangan->num_rows>0){
                    $i = 1;
                    //PERULANGAN UNTUK MENGAMBIL DATA HASIL QUERY
                    while($row = $result_penumpang_penerbangan->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['id_penerbangan']."</td>";
                        echo "<td>".$row['id_penumpang']."</td>";
                        echo "<td>".$row['status_penumpang']."</td>";
                        echo "<td><a href='update_penumpang_penerbangan.php?id=".$row['id']."'>Update</a></td>";
                        echo "<td><a href='delete_penumpang_penerbangan.php?id=".$row['id']."'>Delete</a></td>";
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