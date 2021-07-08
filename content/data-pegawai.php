<?php 
$success_msg = "";
$error_msg = "";

if(isset($_POST['hapus_data'])){

    $no_nota = filter_input(INPUT_POST, 'id_pegawai', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM pegawai
            WHERE id_pegawai = :id_pegawai";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":id_pegawai" => $id_pegawai
    );
  
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved) {
      $success_msg = "Data berhasil dihapus";
    } else {
      $error_msg = "Data tidak berhasil dihapus";
    }

}

if(isset($_POST['tambah_data'])){

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
    $telp_p = filter_input(INPUT_POST, 'telp_p', FILTER_SANITIZE_STRING);
    $id_toko = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);
  
    $sql = "INSERT INTO pegawai (nama, username, password, alamat, telp_p, id_toko) 
            VALUES (:nama, :username, :password, :alamat, :telp_p, :id_toko)";
  
    $stmt = $db->prepare($sql);
  
    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":username" => $username,
        ":password" => $password,
        ":alamat" => $alamat,
        ":telp_p" => $telp_p,
        ":id_toko" => $id_toko
    );
  
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved) {
      $success_msg = "Data berhasil ditambahkan";
    } else {
      $error_msg = "Data tidak berhasil ditambahkan";
    }

}

if(isset($_POST['edit_data'])){

  $id_pegawai_baru = filter_input(INPUT_POST, 'id_pegawai_baru', FILTER_SANITIZE_STRING);
  $id_pegawai_lama = filter_input(INPUT_POST, 'id_pegawai_lama', FILTER_SANITIZE_STRING);
  $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
  $telp_p = filter_input(INPUT_POST, 'telp_p', FILTER_SANITIZE_STRING);
  $id_toko = filter_input(INPUT_POST, 'id_toko', FILTER_SANITIZE_STRING);

  $sql = "UPDATE pegawai
          SET id_pegawai = :id_pegawai_baru, nama = :nama, username = :username, password = :password,
          alamat = :alamat, telp_p = :telp_p, id_toko = :id_toko
          WHERE id_pegawai = :id_pegawai_lama";

  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":id_pegawai_baru" => $id_pegawai_baru,
      ":id_pegawai_lama" => $id_pegawai_lama,
      ":nama" => $nama,
      ":username" => $username,
      ":password" => $password,
      ":alamat" => $alamat,
      ":telp_p" => $telp_p,
      ":id_toko" => $id_toko
  );

  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute($params);
  if($saved) {
    $success_msg = "Data berhasil diubah";
  } else {
    $error_msg = "Data tidak berhasil diubah";
  }

}

?>
<html>
<br>


<div class="widget-content widget-content-area br-6">    
    <div>
      <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#loginModal">
        Tambah Data Pegawai
      </button>
    </div>
    <div class="table-responsive mb-4 mt-4">
    <?php if (!empty($success_msg)) { ?>
      <div class="alert alert-gradient" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        <strong>SUCCESS!</strong> <?php echo $success_msg; ?>. </button>
      </div> 
    <?php } ?>
                        
    <?php if (!empty($error_msg)) { ?>
      <div class="alert alert-gradient" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        <strong>ERROR!</strong> <?php echo $error_msg; ?>. </button>
      </div> 
    <?php } ?>
        <table id="zero-config" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Alamat </th>
                    <th>Nomor Telepon</th>
                    <th class="no-content"></>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM kategori_produk ORDER BY id_kategori DESC";
                $dd = $db->prepare($query);
                $dd->execute();
                $no = 1;
                while($row = $dd->fetch(PDO::FETCH_ASSOC)){
                 $id_kategori = $row['id_kategori'];
                 $nama_kategori = $row['nama_kategori'];
            ?>
                <tr>
                    <td><?php echo $id_kategori ?></td>
                    <td><?php echo $nama_kategori ?></td>
                    <td>
                    <div class="row">
                    <button type="button" class="btn btn-dark mb-2 mr-2 rounded-circle" data-toggle="modal" data-target="#edit-kategori-<?php echo $id_kategori; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> 
                    </button>
                    
                    <form method=POST>
                      <input type="hidden" name="id_pegawai" value="<?php echo $id_kategori; ?>"></input>
                      <button type="submit" name="hapus_data" class="btn btn-dark mb-2 mr-2 rounded-circle" onclick="return confirm('Are you sure you want to do that?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                      </button>
                    </form>
                    </div>
                    </td>
                </tr>
                <!--- MODAL EDIT KATEGORI -->                                
                <div class="modal fade" id="edit-kategori-<?php echo $id_kategori; ?>" tabindex="-1" role="dialog" aria-labelledby="edit-kategori<?php echo $id_kategori; ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header" id="loginModalLabel">
                            <h4 class="modal-title">Edit Pegawai <?php echo $id_kategori; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                          </div>
                          <div class="modal-body">
                            <form class="mt-0" method="POST">
                              <div class="form-group">
                                <input type="hidden" name="id_pegawai_lama"value="<?php echo $id_kategori; ?>">
                                <input type="text" name="id_pegawai_baru" class="form-control mb-2" maxlength = "10" size = "10" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="nama" class="form-control mb-2" maxlength = "50" size = "50" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="username" class="form-control mb-2" maxlength = "15" size = "15" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <input type="text" name="password" class="form-control mb-2" maxlength = "15" size = "15" value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></input>
                              </div>
                              <div class="form-group">
                                <textarea type="text" name="alamat" class="form-control mb-2" maxlength = "50" size = "50"  value="<?php echo $id_kategori; ?>" placeholder="<?php echo $id_kategori; ?>" required></textarea>
                              </div>
                              <div class="form-group">
                              <input type="text" name="telp_p" class="form-control mb-4" maxlength = "15" size = "15" id="" placeholder="Nomor telepon pegawai"></input>
                              </div>
                              <div class="form-group">
                              <input type="text" name="id_toko" class="form-control mb-4" maxlength = "10" size = "10" id="" placeholder="ID toko"></input>
                              </div>

                              <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" name="edit_data" class="btn btn-success">Kirim</button>
                              </>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--- MODAL TAMBAH KATEGORI -->                                
<div class="modal fade bd-example-modal-lg" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="loginModalLabel">
      <h4 class="modal-title">Tambah Pegawai</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
      </div>
      <div class="modal-body">
      <form class="mt-0" method="POST">
      <div class="form-group">
      <input type="text" name="id_pegawai" class="form-control mb-2" maxlength = "10" size = "10" id="" placeholder="ID Pegawai "></input>
      </div>
      <div class="form-group">
      <input type="text" name="nama" class="form-control mb-4" maxlength = "50" size = "50" id="" placeholder="Nama Pegawai"></input>
      </div>
      <div class="form-group">
      <input type="text" name="username" class="form-control mb-4" maxlength = "15" size = "15"id="" placeholder="Username"></input>
      </div>
      <div class="form-group">
      <input type="text" name="password" class="form-control mb-4" maxlength = "15" size = "15" id="" placeholder="Password"></input>
      </div>
      <div class="form-group">
      <textarea type="text" name="alamat" class="form-control mb-4" maxlength = "50" size = "50" id="" placeholder="Alamat"></textarea>
      </div>
      <div class="form-group">
      <input type="text" name="telp_p" class="form-control mb-4" maxlength = "15" size = "15" id="" placeholder="Nomor Telepon"></input>
      </div>
      <div class="form-group">
      <input type="text" name="id_toko" class="form-control mb-4" maxlength = "10" size = "10" id="" placeholder="ID Toko"></input>
      </div>
      <div class="form-group text-right">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      <button type="submit" name="tambah_data" class="btn btn-success">Kirim</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
</html>

