<?php

include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";
include "../config/class_paging.php";

$aksi="modul/mod_tindakan/tindakan_aksi.php";

switch($_GET['act']) {
  // Tampil
  default:
  $subrogasi=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_GET[id]'");
  $s      = mysql_fetch_array($subrogasi);
  $tanggal=tgl_indo($s['subrogasi_tglklaim']);
  $totalpiutang=format_rupiah($s['subrogasi_totalpiutang']);
  $sisapiutang=format_rupiah($s['subrogasi_sisapiutang']);
  $agunan=format_rupiah($s['subrogasi_agunan']);
  ?>
  <!-- Content -->
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-6">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="?module=produk&act=edit&id=<?php echo $r['product_id'] ?>" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label class="control-label">Nama</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $s[debitur_id]");
                        while ($e=mysql_fetch_array($result2)) {
                          ?>
                      <td class="detail"><?php echo $e['debitur_name'] ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Nomor SP</label>
                      </td>
                      <td class="detail"><?php echo $s['subrogasi_nosp'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Kreditur</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM bank WHERE bank_id = $s[bank_id]");
                        while ($e=mysql_fetch_array($result2)) {
                          $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$e[categorybank_id]'");
                          $r4      = mysql_fetch_array($result4);
                          ?>
                      <td class="detail"><?php echo $r4['categorybank_name'] ?> <?php echo $e['bank_cabang']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Tanggal Keputusan Klaim</label>
                      </td>
                      <td class="detail"><?php echo $tanggal ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Total Piutang Subrogasi</label>
                      </td>
                      <td class="detail">Rp<?php echo $totalpiutang ?>,00</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Sisa Piutang Subrogasi</label>
                      </td>
                      <td class="detail">Rp<?php echo $sisapiutang ?>,00</td>
                    </tr>
                    <tr>
                      <td width="200">
                        <label class="control-label">Nilai Agunan</label>
                      </td>
                      <td class="detail">Rp<?php echo $agunan ?>,00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <?php if ($_SESSION['level']=='admin') { ?>
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=tindakan&act=tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
            <input name="subrogasi_id" hidden type="text" value='<?php echo $s['subrogasi_id'] ?>'/>
              <h3 class="title">Tambah Tindakan</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="130">
                        <label for="tindakan_jenis" class="control-label">Jenis Tindakan <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="tindakan_jenis" class="form-control" id="tindakan_jenis" required>
                          <option value="">--- Pilih Jenis Tindakan ---</option>
                          <option value="Mencatat beberapa kali tunggakan pembayaran subrogasi">Mencatat beberapa kali tunggakan pembayaran subrogasi</option>
                          <option value="Mengirimkan Surat">Mengirimkan Surat</option>
                          <option value="Mengajukan Permohonan eksekusi ke bank">Mengajukan Permohonan eksekusi ke bank</option>
                          <option value="Menanyakan hasil eksekusi ke bank">Menanyakan hasil eksekusi ke bank</option>
                        </select>
                      </td>
                    </tr>
                      <tr>
                        <td>
                          <label for="tindakan_hasil" class="control-label" >Uraian / Hasil <span class="required">*</span></label>
                        </td>
                        <td>
                          <textarea name="tindakan_hasil" type="text" required class="form-control" id="tindakan_hasil" placeholder="Masukan Uraian / Hasil"></textarea>
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
            <input class="btn btn-default" type="reset" name="batal" value="Kembali" onclick="location.href='?module=subrogasi'"/>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="block-flat">
        <div class='center'>
          <input class="btn btn-primary btn-block" type="reset" name="batal" value="Kembali" onclick="location.href='?module=subrogasi'"/>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

  <div class="cl-mcont" style="margin-top:-100px;">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="content">
            <!-- ========== Button ========== -->
            <form method="get" action='<?php echo '?module=tindakan&'.$_SERVER['PHP_SELF'] ?>'>
              <div class='btn-navigation'>

              </div>
              <div class='row'>
                  <div class='col-md-2 col-sm-12'>

                  </div>
                  <div class='col-md-2 col-sm-12'>

                  </div>
                  <div class='col-md-2 col-sm-12'>

                  </div>
                </div>
              </form>
              <!-- ========== End Button ========== -->
              <!-- ========== Table ========== -->
              <div class="table-responsive">
                <table class="hover">
                  <thead class="primary-emphasis">
                    <tr>
                      <th width="30">#</th>
                      <th width="80">Tanggal</th>
                      <th width="200">Tindakan</th>
                      <th width="300">Hasil / Uraian</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $result=mysql_query("SELECT * FROM tindakan WHERE subrogasi_id='$_GET[id]'");
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM tindakan WHERE subrogasi_id='$_GET[id]'"));
                    if(mysql_num_rows($result) === 0) {
                    ?>
                    <tr>
                      <td class="center" colspan="10">Data kosong...</td>
                    </tr>
                    <?php } else {
                    $no = $posisi+1;
                    while ($r=mysql_fetch_array($result)) {
                    $tanggal=tgl_indo($r['tindakan_created']);
                    ?>
                    <tr>
                      <td class="center"><?php echo $no ?></td>
                      <td class="text-center"><?php echo$tanggal ?></td>
                      <td><?php echo $r['tindakan_jenis'] ?></td>
                      <td><?php echo $r['tindakan_hasil'] ?></td>
                      <?php $no++;
                     ?>
                    </tr>
                    <?php }
                    }?>
                  </tbody>
                </table>
                <!-- ========== End Table ========== -->
                <div id='pagination'>
                  <div class='pagination-left'>Total : <?php echo $jmldata ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Content -->
  <?php
  break;
} ?>
