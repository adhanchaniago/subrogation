<?php

include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";
include "../config/class_paging.php";

$aksi="modul/mod_subrogasi/subrogasi_aksi.php";

switch($_GET['act']) {
  default:
  break;
  // Tampil
  case "tambah":
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=subrogasiadd&act=tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Tambah Subrogasi</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="debitur_id" class="control-label">Debitur <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="debitur_id" class="form-control input-sm" id="debitur_id" required>
                          <option value="">--- Pilih Debitur ---</option>
                          <?php
                          $result2=mysql_query("SELECT * FROM debitur");
                            while ($r2=mysql_fetch_array($result2)) { ?>
                              <option value='<?php echo $r2['debitur_id'] ?>'><?php echo $r2['debitur_name'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="bank_id" class="control-label">Bank<span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="bank_id" class="form-control" id="bank_id" required>
                          <option value="">--- Pilih Bank ---</option>
                          <?php

                              $result=mysql_query("SELECT * FROM bank");
                              while ($r=mysql_fetch_array($result)) {
                                $result2=mysql_query("SELECT * FROM categorybank WHERE categorybank_id= $r[categorybank_id]");
                                  while ($r2=mysql_fetch_array($result2)) {
                                ?>
                              <option value='<?php echo $r['bank_id'] ?>'><?php echo $r2['categorybank_name'] ?> <?php echo $r['bank_cabang'] ?></option>;
                          <?php }
                        } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="product_id" class="control-label">Jenis Produk <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="product_id" class="form-control input-sm" id="product_id" required>
                          <option value="">--- Pilih Jenis Produk ---</option>
                          <?php
                          $result=mysql_query("SELECT * FROM product");
                            while ($r=mysql_fetch_array($result)) { ?>
                              <option value='<?php echo $r['product_id'] ?>'><?php echo $r['product_name'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="subrogasi_SKIM" class="control-label">SKIM Kredit <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="subrogasi_SKIM" class="form-control input-sm" id="subrogasi_SKIM" required>
                          <option value="">--- Pilih SKIM Kredit ---</option>
                          <option value='MKR'>MKR</option>
                          <option value='KREASI'>KREASI</option>
                          <option value='ARRUM'>ARRUM</option>
                          <option value='MTG'>MTG</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="subrogasi_nosp" class="control-label" >Nomor SP <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="subrogasi_nosp" type="text" required class="form-control input-sm" id="subrogasi_nosp" placeholder="Masukan Nomor SP"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="subrogasi_sertifikat" class="control-label" >Sertifikat Terjamin <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="subrogasi_sertifikat" type="text" required class="form-control input-sm" id="subrogasi_sertifikat" placeholder="Masukan Sertifikat Terjamin"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="subrogasi_agunan" class="control-label" >Nilai Agunan <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="subrogasi_agunan" type="number" required class="form-control input-sm" id="subrogasi_agunan" placeholder="Masukan Nilai Agunan"/>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="subrogasi_totalpiutang" class="control-label" >Total Piutang Subrogasi <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="subrogasi_totalpiutang" type="number" required class="form-control input-sm" id="subrogasi_totalpiutang" placeholder="Masukan Total Piutang Subrogasi"/>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div
            </form>
          </div>
          <div class='center'>
            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=home'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  break;
} ?>
