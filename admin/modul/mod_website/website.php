<?php

include "../config/fungsi_indotgl.php";
include "../config/class_paging.php";

$aksi="modul/mod_website/website_aksi.php";

switch($_GET['act']) {
  // Form Edit
  case "edit":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM identitas WHERE identitas_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=website&act=edit" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <input name="identitas_id" hidden type="text" value='<?php echo $r['identitas_id'] ?>'/>
              <h3 class="title">Ubah Identitas Website</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="identitas_website" class="control-label">Identitas Website <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_website" type="text" required class="form-control input-sm" id="identitas_website" placeholder="Masukan Identitas Website" value='<?php echo $r['identitas_website'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="identitas_deskripsi" class="control-label">Identitas Deksripsi <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_deskripsi" type="text" required class="form-control input-sm" id="identitas_deskripsi" placeholder="Masukan Identitas Deksripsi" value='<?php echo $r['identitas_deskripsi'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="identitas_keyword" class="control-label">Identitas Keyword <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_keyword" type="text" required class="form-control input-sm" id="identitas_keyword" placeholder="Masukan Identitas Keyword" value='<?php echo $r['identitas_keyword'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="identitas_alamat" class="control-label">Identitas Alamat <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_alamat" type="text" required class="form-control input-sm" id="identitas_alamat" placeholder="Masukan Identitas Alamat" value='<?php echo $r['identitas_alamat'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="identitas_notelp" class="control-label">Identitas No Telp <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_notelp" type="text" required class="form-control input-sm" id="identitas_notelp" placeholder="Masukan Identitas No Telp" value='<?php echo $r['identitas_notelp'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="identitas_author" class="control-label">Identitas Author <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_author" type="text" required class="form-control input-sm" id="identitas_author" placeholder="Masukan Identitas Author" value='<?php echo $r['identitas_author'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="identitas_favicon" class="control-label">Favicon <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="identitas_favicon" readonly type="text" required class="form-control input-sm" id="identitas_favicon" placeholder="Masukan Identitas Alamat" value='<?php echo $r['identitas_favicon'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="fupload" class="control-label">Ganti Favicon <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="fupload" type="file" class="form-control" id="fupload"/>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div
            </form>
          </div>
          <div class='center'>
            <input class="btn btn-primary" type="submit" name="simpan" value="Ubah Data">
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=debitur");
  }
  break;
} ?>
