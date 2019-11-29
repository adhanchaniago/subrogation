<?php

include "../config/fungsi_indotgl.php";
include "../config/class_paging.php";

$aksi="modul/mod_bank/bank_aksi.php";

switch($_GET['act']) {
  // Tampil
  default:
  ?>
  <!-- Content -->
  <div class="cl-mcont">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="content">
            <!-- ========== Button ========== -->
            <form method="get" action='<?php echo '?module=bank&'.$_SERVER['PHP_SELF'] ?>'>
              <div class='btn-navigation'>
                <?php if ($_SESSION['level']=='admin') { ?>
                <div class='pull-right'>
                  <a class="btn btn-primary" href="?module=bank&act=tambah"><i class="fa fa-plus-circle"></i> Tambah Bank</a>
                </div>
                <?php } ?>
                <div class='pull-right'>
                  <a class="btn btn-primary" href="?module=bank"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                </div>
              </div>
              <div class='row'>
                <div class='btn-search'>Cari Berdasarkan Cabang Bank :</div>
                  <div class='col-md-3 col-sm-12'>
                    <div class="input-group">
                      <input type=hidden name=module value=bank>
                      <input type="text" name="kata" class="form-control" value=""/>
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" type="button">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
                  </div>
                  <div class='col-md-3 col-sm-12'>

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
                      <th width="200">Jenis Bank</th>
                      <th width="200">Cabang Bank</th>
                      <th width="200">KCP</th>
                      <th width="150">Dibuat</th>
                      <?php if ($_SESSION['level']=='admin') { ?> <th width="80">Aksi</th> <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (empty(isset($_GET['kata']))) {
                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);

                    $result=mysql_query("SELECT * FROM bank LIMIT $posisi,$batas");
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM bank"));
                    if(mysql_num_rows($result) === 0) {
                    ?>
                    <tr>
                      <td class="center" colspan="10">Data kosong...</td>
                    </tr>
                    <?php } else {
                    $no = $posisi+1;
                    while ($r=mysql_fetch_array($result)) {
                    $tanggal=tgl_indo($r['bank_created']);
                    ?>
                    <tr>
                      <td class="center"><?php echo $no ?></td>
                      <?php
                      $result2 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$r[categorybank_id]'");
                      $r2      = mysql_fetch_array($result2);
                      ?>
                      <td><?php echo $r2['categorybank_name'] ?></td>
                      <td><?php echo $r['bank_cabang'] ?></td>
                      <td><?php echo $r['bank_kcp'] ?></td>
                      <td class="center"><?php echo $tanggal ?></td>
                      <?php if ($_SESSION['level']=='admin') { ?>
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
                              <a href="?module=bank&act=edit&id=<?php echo $r['bank_id'] ?>" title="Edit <?php echo $r['bank_name'] ?>"><i class='fa fa-pencil'></i> Edit</a>
                            </li>
                            <li>
                              <a href="?module=bank&act=detail&id=<?php echo $r['bank_id'] ?>" title="Detail <?php echo $r['bank_name'] ?>"><i class='fa fa-eye'></i> Detail</a>
                            </li>
                            <li>
                              <a href="javascript:;" data-id="<?php echo $r['bank_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $r['bank_name'] ?>"><i class='fa fa-trash-o'></i> Hapus</a>
                            </li>
                          </ul>
                        </div>
                        <!-- ========== End EDIT DETAIL HAPUS ========== -->
                      </td>
                      <?php $no++;
                    } ?>
                    </tr>
                    <?php }
                      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM bank"));
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

                  $result=mysql_query("SELECT * FROM bank WHERE bank_cabang LIKE '%$search%' LIMIT $posisi,$batas");
                  if(mysql_num_rows($result) === 0) {
                  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM bank WHERE bank_cabang LIKE '%$search%'"));
                  ?>
                  <tr>
                    <td class="center" colspan="10">Data kosong...</td>
                  </tr>
                  <?php } else {
                  $no = $posisi+1;
                  while ($r=mysql_fetch_array($result)) {
                  $tanggal=tgl_indo($r['bank_created']);
                  ?>
                  <tr>
                    <td class="center"><?php echo $no ?></td>
                    <?php
                    $result2 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$r[categorybank_id]'");
                    $r2      = mysql_fetch_array($result2);
                    ?>
                    <td><?php echo $r2['categorybank_name'] ?></td>
                    <td><?php echo $r['bank_cabang'] ?></td>
                    <td><?php echo $r['bank_kcp'] ?></td>
                    <td class="center"><?php echo $tanggal ?></td>
                    <?php if ($_SESSION['level']=='admin') { ?>
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
                            <a href="?module=bank&act=edit&id=<?php echo $r['bank_id'] ?>" title="Edit <?php echo $r['bank_name'] ?>"><i class='fa fa-pencil'></i> Edit</a>
                          </li>
                          <li>
                            <a href="?module=bank&act=detail&id=<?php echo $r['bank_id'] ?>" title="Detail <?php echo $r['bank_name'] ?>"><i class='fa fa-eye'></i> Detail</a>
                          </li>
                          <li>
                            <a href="javascript:;" data-id="<?php echo $r['bank_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $r['bank_name'] ?>"><i class='fa fa-trash-o'></i> Hapus</a>
                          </li>
                        </ul>
                      </div>
                      <!-- ========== End EDIT DETAIL HAPUS ========== -->
                    </td>
                    <?php } ?>
                  </tr>
                  <?php
                      $no++;
                    }
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM bank WHERE bank_cabang LIKE '%$search%'"));
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
    <!-- End Content -->

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
            <a href="javascript:;" class="btn btn-danger" id="hapus-bank">Ya</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ========== End Modal Konfirmasi ========== -->
  <?php
  break;

  // Form Tambah
  case "tambah":
  if ($_SESSION['level']=='admin') { ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=bank&act=tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Tambah Bank</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="categorybank_id" class="control-label">Jenis Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="categorybank_id" class="form-control input-sm" id="categorybank_id" required>
                          <option value="">--- Pilih Jenis Bank ---</option>
                          <?php
                          $result=mysql_query("SELECT * FROM categorybank");
                            while ($r=mysql_fetch_array($result)) { ?>
                              <option value='<?php echo $r['categorybank_id'] ?>'><?php echo $r['categorybank_name'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width=150>
                        <label for="bank_cabang" class="control-label" >Cabang Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="bank_cabang" type="text" required class="form-control input-sm" id="bank_cabang" placeholder="Masukan Cabang Bank"/>
                      </td>
                    </tr>
                    <tr>
                      <td width=150>
                        <label for="bank_kcp" class="control-label" >KCP <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="bank_kcp" type="text" required class="form-control input-sm" id="bank_kcp" placeholder="Masukan KCP"/>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=bank'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=bank");
  }
  break;

  // Form Edit
  case "edit":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM bank WHERE bank_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=bank&act=edit" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <input name="bank_id" hidden type="text" value='<?php echo $r['bank_id'] ?>'/>
              <h3 class="title">Ubah Bank</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="categorybank_id" class="control-label">Jenis Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="categorybank_id" class="form-control input-sm" id="categorybank_id" required>
                          <?php
                          $result2=mysql_query("SELECT * FROM categorybank WHERE categorybank_id = $r[categorybank_id]");
                            while ($e=mysql_fetch_array($result2)) { ?>
                          <option value="<?php echo $e['categorybank_id'] ?>" selected><?php echo $e['categorybank_name'] ?></option>
                          <?php }
                          $result3=mysql_query("SELECT * FROM categorybank");
                            while ($w=mysql_fetch_array($result3)) { ?>
                              <option value='<?php echo $w['categorybank_id'] ?>'><?php echo $w['categorybank_name'] ?></option>;
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width=180>
                        <label for="bank_cabang" class="control-label" >Cabang Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="bank_cabang" type="text" required class="form-control input-sm" id="bank_cabang" placeholder="Masukan Cabang Bank" value='<?php echo $r['bank_cabang'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="bank_kcp" class="control-label" >KCP <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="bank_kcp" type="text" required class="form-control input-sm" id="bank_kcp" placeholder="Masukan KCP" value='<?php echo $r['bank_kcp'] ?>'/>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=bank'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=bank");
  }
  break;

  // Form Detail
  case "detail":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM bank WHERE bank_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  $tanggal=tgl_indo($r['bank_created']);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="?module=bank&act=edit&id=<?php echo $r['bank_id'] ?>" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Detail Bank</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="130">
                        <label class="control-label">ID</label>
                      </td>
                      <td class="detail"><?php echo $r['bank_id'] ?></td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">Jenis Bank</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM categorybank WHERE categorybank_id = $r[categorybank_id]");
                        while ($e=mysql_fetch_array($result2)) { ?>
                      <td class="detail"><?php echo $e['categorybank_name'] ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">Cabang Bank</label>
                      </td>
                      <td class="detail"><?php echo $r['bank_cabang'] ?></td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">KCP</label>
                      </td>
                      <td class="detail"><?php echo $r['bank_kcp'] ?></td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">Dibuat</label>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=bank'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  } else {
    header("location: admin/media.php?module=bank");
  }
  break;
} ?>
