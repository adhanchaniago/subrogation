<?php

include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";
include "../config/class_paging.php";

$aksi="modul/mod_subrogasi/subrogasi_aksi.php";

switch($_GET['act']) {
  // Tampil
  default:
  ?>
  <!-- Content -->


  <div class="cl-mcont">
      <h2 class="text-center">Piutang Subrogasi</h2>

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
            <a class="btn btn-success" href="modul/mod_subrogasi/subrogasi_piutang_pdf.php"><i class="fa fa-print"></i> Print PDF</a>
            <a class="btn btn-success" href="modul/mod_subrogasi/subrogasi_piutang_excel.php"><i class="fa fa-file"></i> Export to Excel</a>
          <div class="content">
            <!-- ========== Button ========== -->
            <form>
              <div class='btn-navigation'>
                <?php if ($_SESSION['level']=='admin') { ?>
                <?php } ?>
                <div class='pull-right'>
                  <a class="btn btn-primary" href="?module=subrogasi"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                </div>
              </div>
              <div class='row'>
                <div class='btn-search'>Cari Berdasarkan :</div>
                  <div class='col-md-2 col-sm-12'>
                    <select name="produk" class="form-control input-sm">
                      <option value=''>Semua Produk</option>
                      <?php
                      $result2=mysql_query("SELECT * FROM product");
                        while ($r2=mysql_fetch_array($result2)) { ?>
                          <option value='<?php echo $r2['product_id'] ?>'><?php echo $r2['product_name'] ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class='col-md-2 col-sm-12'>
                    <select name="search" class="form-control input-sm">
                      <option value='debitur_id'>Nama</option>
                      <option value='subrogasi_nosp'>Nomor SP</option>
                    </select>
                  </div>
                  <div class='col-md-2 col-sm-12'>
                    <div class="input-group">
                      <input type=hidden name=module value=subrogasi>
                      <input type="text" name="kata" class="form-control" value=""/>
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" type="button">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
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
                      <th width="200">Nama</th>
                      <th width="200">Nomor SP</th>
                      <th width="200">Bank</th>
                      <th width="200">Piutang Subrogasi</th>
                      <th width="200">Sisa Piutang Subrogasi</th>
                      <th width="80">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (empty(isset($_GET['kata']))) {
                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);

                    $result=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0 LIMIT $posisi,$batas");
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0"));
                    if(mysql_num_rows($result) === 0) {
                    ?>
                    <tr>
                      <td class="center" colspan="10">Data kosong...</td>
                    </tr>
                    <?php } else {
                    $no = $posisi+1;
                    while ($r=mysql_fetch_array($result)) {
                    $tanggal=tgl_indo($r['subrogasi_tglklaim']);
                    $totalpiutang=format_rupiah($r['subrogasi_totalpiutang']);
                    $sisapiutang=format_rupiah($r['subrogasi_sisapiutang']);
                    ?>
                    <tr>
                      <td class="center"><?php echo $no ?></td>
                      <?php
                      $result2 =mysql_query("SELECT * FROM debitur WHERE debitur_id='$r[debitur_id]'");
                      $r2      = mysql_fetch_array($result2);
                      $result3 =mysql_query("SELECT * FROM bank WHERE bank_id='$r[bank_id]'");
                      $r3      = mysql_fetch_array($result3);
                      $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$r3[categorybank_id]'");
                      $r4      = mysql_fetch_array($result4);
                      ?>
                      <td><?php echo $r2['debitur_name'] ?></td>
                      <td><?php echo $r['subrogasi_nosp'] ?></td>
                      <td><?php echo $r4['categorybank_name'] ?> <?php echo $r3['bank_cabang'] ?></td>
                      <td class="text-right">Rp<?php echo $totalpiutang ?>,00</td>
                      <td class="text-right">Rp<?php echo $sisapiutang ?>,00</td>

                      <td width=180 align="center">
                        <!-- ========== EDIT DETAIL HAPUS ========== -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-xs">Actions</button>
                          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                              <a href="?module=angsuran&id=<?php echo $r['subrogasi_id'] ?>" title="Angsuran"><i class='fa fa-money'></i> Angsuran</a>
                            </li>
                            <li>
                              <a href="?module=tindakan&id=<?php echo $r['subrogasi_id'] ?>" title="Tindakan"><i class='fa fa-pencil'></i> Tindakan</a>
                            </li>
                            <?php if ($_SESSION['level']=='admin') { ?>
                            <div class="divider"></div>
                            <li>
                              <a href="?module=subrogasi&act=edit&id=<?php echo $r['subrogasi_id'] ?>" title="Edit"><i class='fa fa-pencil'></i> Edit</a>
                            </li>
                            <li>
                              <a href="?module=subrogasi&act=detail&id=<?php echo $r['subrogasi_id'] ?>" title="Detail"><i class='fa fa-eye'></i> Detail</a>
                            </li>
                            <li>
                              <a href="javascript:;" data-id="<?php echo $r['subrogasi_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus"><i class='fa fa-trash-o'></i> Hapus</a>
                            </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- ========== End EDIT DETAIL HAPUS ========== -->
                      </td>
                      <?php $no++;
                     ?>
                    </tr>
                    <?php }
                      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0"));
                      $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                      $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                    }?>
                  </tbody>
                </table>
                <div id='pagination'>
                       <div class='pagination-left'>Total : <?php echo $jmldata ?></div>
                       <div class='pagination-right'>
                           <ul class="pagination">
                               <?php echo $linkHalaman ?>
                           </ul>
                       </div>
                   </div>
                <?php } else {
                  $p      = new Paging;
                  $batas  = 10;
                  $posisi = $p->cariPosisi($batas);
                  $search = $_GET['kata'];
                  $produk = $_GET['produk'];
                  $searchkategori = $_GET['search'];
                  if ($searchkategori == 'subrogasi_nosp') {
                    $result=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_nosp LIKE '%$search%' AND subrogasi_sisapiutang > 0 AND product_id LIKE '%$produk%' LIMIT $posisi,$batas");
                  } else {
                    $result5 =mysql_query("SELECT * FROM debitur WHERE debitur_name LIKE '%$search%'");
                    if(mysql_num_rows($result5) === 0) {
                      $result=mysql_query("SELECT * FROM subrogasi WHERE debitur_id LIKE '%aaaaaaaaaaaaaaaaaaaaaaaaaa%' AND subrogasi_sisapiutang > 0 LIMIT $posisi,$batas");
                    } else {
                      while ($r5=mysql_fetch_array($result5)) {
                        $result=mysql_query("SELECT * FROM subrogasi WHERE debitur_id LIKE '%$r5[debitur_id]%' AND subrogasi_sisapiutang > 0 AND product_id LIKE '%$produk%' LIMIT $posisi,$batas");
                      }
                    }
                  }
                  if(mysql_num_rows($result) === 0) {
                    if ($searchkategori == 'subrogasi_nosp') {
                      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE subrogasi_nosp LIKE '%$search%' AND subrogasi_sisapiutang > 0 AND product_id LIKE '%$produk%'"));
                    } else {
                      $result5 =mysql_query("SELECT * FROM debitur WHERE debitur_name LIKE '%$search%'");
                      while ($r5=mysql_fetch_array($result5)) {
                        $jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE debitur_id LIKE '%$r5[debitur_id]%' AND subrogasi_sisapiutang > 0 AND product_id LIKE '%$produk%'"));
                      }
                    }
                  ?>
                  <tr>
                    <td class="center" colspan="10">Data kosong...</td>
                  </tr>
                  <?php } else {
                  $no = $posisi+1;
                  while ($r=mysql_fetch_array($result)) {
                  $tanggal=tgl_indo($r['subrogasi_tglklaim']);
                  $totalpiutang=format_rupiah($r['subrogasi_totalpiutang']);
                  $sisapiutang=format_rupiah($r['subrogasi_sisapiutang']);
                  ?>
                  <tr>
                    <td class="center"><?php echo $no ?></td>
                    <?php
                    $result2 =mysql_query("SELECT * FROM debitur WHERE debitur_id='$r[debitur_id]'");
                    $r2      = mysql_fetch_array($result2);
                    $result3 =mysql_query("SELECT * FROM bank WHERE bank_id='$r[bank_id]'");
                    $r3      = mysql_fetch_array($result3);
                    $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$r3[categorybank_id]'");
                    $r4      = mysql_fetch_array($result4);
                    ?>
                    <td><?php echo $r2['debitur_name'] ?></td>
                    <td><?php echo $r['subrogasi_nosp'] ?></td>
                    <td><?php echo $r4['categorybank_name'] ?> <?php echo $r3['bank_cabang'] ?></td>
                    <td class="text-right">Rp<?php echo $totalpiutang ?>,00</td>
                    <td class="text-right">Rp<?php echo $sisapiutang ?>,00</td>
                    <td width=180 align="center">
                      <!-- ========== EDIT DETAIL HAPUS ========== -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs">Actions</button>
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                          <li>
                            <a href="?module=angsuran&id=<?php echo $r['subrogasi_id'] ?>" title="Angsuran"><i class='fa fa-money'></i> Angsuran</a>
                          </li>
                          <li>
                            <a href="?module=tindakan&id=<?php echo $r['subrogasi_id'] ?>" title="Tindakan"><i class='fa fa-pencil'></i> Tindakan</a>
                          </li>
                          <?php if ($_SESSION['level']=='admin') { ?>
                          <div class="divider"></div>
                          <li>
                            <a href="?module=subrogasi&act=edit&id=<?php echo $r['subrogasi_id'] ?>" title="Edit"><i class='fa fa-pencil'></i> Edit</a>
                          </li>
                          <li>
                            <a href="?module=subrogasi&act=detail&id=<?php echo $r['subrogasi_id'] ?>" title="Detail"><i class='fa fa-eye'></i> Detail</a>
                          </li>
                          <li>
                            <a href="javascript:;" data-id="<?php echo $r['subrogasi_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus"><i class='fa fa-trash-o'></i> Hapus</a>
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                      <!-- ========== End EDIT DETAIL HAPUS ========== -->
                    </td>
                  </tr>
                  <?php
                      $no++;
                    }
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE debitur_id LIKE '%$r5[debitur_id]%' AND subrogasi_sisapiutang > 0 AND product_id LIKE '%$produk%'"));
                    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
                  }?>
                </tbody>
              </table>
              <div id='pagination'>
                     <div class='pagination-left'>Total : <?php echo $jmldata ?></div>
                     <div class='pagination-right'>
                         <ul class="pagination">
                             <?php echo $linkHalaman ?>
                         </ul>
                     </div>
                 </div>
              <?php } ?>
              <!-- ========== End Table ========== -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========== Modal Konfirmasi ========== -->
    <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi</h4>
          </div>
          <div class="modal-body" style="background:#d9534f;color:#fff">
            Apakah Anda yakin ingin menghapus data ini?
          </div>
          <div class="modal-footer">
            <a href="javascript:;" class="btn btn-danger" id="hapus-subrogasi">Ya</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ========== End Modal Konfirmasi ========== -->
  <?php
  break;

  // Form Edit
  case "edit":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=subrogasi&act=edit" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <input name="subrogasi_id" hidden type="text" value='<?php echo $r['subrogasi_id'] ?>'/>
              <h3 class="title">Ubah Subrogasi</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width=200>
                        <label for="debitur_id" class="control-label">Debitur <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="debitur_id" class="form-control" id="debitur_id" required>
                          <?php
                          $result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $r[debitur_id]");
                            while ($e=mysql_fetch_array($result2)) { ?>
                          <option value="<?php echo $e['debitur_id'] ?>" selected><?php echo $e['debitur_name'] ?></option>
                          <?php }
                          $result3=mysql_query("SELECT * FROM debitur");
                            while ($w=mysql_fetch_array($result3)) { ?>
                              <option value='<?php echo $w['debitur_id'] ?>'><?php echo $w['debitur_name'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="bank_id" class="control-label">Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="bank_id" class="form-control" id="bank_id" required>
                          <?php
                          $result2=mysql_query("SELECT * FROM bank WHERE bank_id = $r[bank_id]");
                            while ($e=mysql_fetch_array($result2)) { ?>
                          <option value="<?php echo $e['bank_id'] ?>" selected><?php echo $e['bank_cabang'] ?></option>
                          <?php }
                          $result3=mysql_query("SELECT * FROM bank");
                            while ($w=mysql_fetch_array($result3)) { ?>
                              <option value='<?php echo $w['bank_id'] ?>'><?php echo $w['bank_cabang'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width=200>
                        <label for="product_id" class="control-label">Jenis Produk <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="product_id" class="form-control" id="product_id" required>
                          <?php
                          $result2=mysql_query("SELECT * FROM product WHERE product_id = $r[product_id]");
                            while ($e=mysql_fetch_array($result2)) { ?>
                          <option value="<?php echo $e['product_id'] ?>" selected><?php echo $e['product_name'] ?></option>
                          <?php }
                          $result3=mysql_query("SELECT * FROM product");
                            while ($w=mysql_fetch_array($result3)) { ?>
                              <option value='<?php echo $w['product_id'] ?>'><?php echo $w['product_name'] ?></option>;
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
                          <option value="<?php echo $r['subrogasi_SKIM'] ?>"><?php echo $r['subrogasi_SKIM'] ?></option>
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
                        <input name="subrogasi_nosp" type="text" required class="form-control input-sm" id="subrogasi_nosp" value="<?php echo $r['subrogasi_nosp'] ?>" placeholder="Masukan Nomor SP"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="subrogasi_sertifikat" class="control-label" >Sertifikat Terjamin <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="subrogasi_sertifikat" type="text" required class="form-control input-sm" id="subrogasi_sertifikat"  value="<?php echo $r['subrogasi_sertifikat'] ?>" placeholder="Masukan Sertifikat Terjamin"/>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=subrogasi'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=subrogasi");
  }
  break;

  // Form Detail
  case "detail":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  $tanggal=tgl_indo($r['subrogasi_tglklaim']);
  $totalpiutang=format_rupiah($r['subrogasi_totalpiutang']);
  $sisapiutang=format_rupiah($r['subrogasi_sisapiutang']);
  $agunan=format_rupiah($r['subrogasi_agunan']);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="?module=subrogasi&act=edit&id=<?php echo $r['subrogasi_id'] ?>" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Detail Subrogasi</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="200">
                        <label class="control-label">ID</label>
                      </td>
                      <td class="detail"><?php echo $r['subrogasi_id'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Debitur</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $r[debitur_id]");
                        while ($e=mysql_fetch_array($result2)) {
                          ?>
                      <td class="detail"><?php echo $e['debitur_name']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Bank</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM bank WHERE bank_id = $r[bank_id]");
                        while ($e=mysql_fetch_array($result2)) {
                          $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$e[categorybank_id]'");
                          $r4      = mysql_fetch_array($result4);
                          ?>
                      <td class="detail"><?php echo $r4['categorybank_name'] ?> <?php echo $e['bank_cabang']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Jenis Produk</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM product WHERE product_id = $r[product_id]");
                        while ($e=mysql_fetch_array($result2)) {
                          ?>
                      <td class="detail"><?php echo $e['product_name']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Subrogasi Nomor SP</label>
                      </td>
                      <td class="detail"><?php echo $r['subrogasi_nosp'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Sertifikat Terjamin</label>
                      </td>
                      <td class="detail"><?php echo $r['subrogasi_sertifikat'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">SKIM Kredit</label>
                      </td>
                      <td class="detail"><?php echo $r['subrogasi_SKIM'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Nilai Agunan</label>
                      </td>
                      <td class="detail">Rp<?php echo $agunan ?>,00</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Sisa Piutang Subrogasi</label>
                      </td>
                      <td class="detail">Rp<?php echo $sisapiutang ?>,00</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Total Piutang Subrogasi</label>
                      </td>
                      <td class="detail">Rp<?php echo $totalpiutang ?>,00</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Tanggal Klaim</label>
                      </td>
                      <td class="detail"><?php echo $tanggal ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div
            </form>
          </div>
          <div class='center'>
            <input class="btn btn-primary" type="submit" name="simpan" value="Edit Data">
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=subrogasi'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=subrogasi");
  }
  break;
} ?>
