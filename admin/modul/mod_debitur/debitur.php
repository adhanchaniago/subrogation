<?php

include "../config/fungsi_indotgl.php";
include "../config/class_paging.php";

$aksi="modul/mod_debitur/debitur_aksi.php";

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
            <form method="get" action='<?php echo '?module=debitur&'.$_SERVER['PHP_SELF'] ?>'>
              <div class='btn-navigation'>
                <?php if ($_SESSION['level']=='admin') { ?>
                <div class='pull-right'>
                  <a class="btn btn-primary" href="?module=debitur&act=tambah"><i class="fa fa-plus-circle"></i> Tambah Debitur</a>
                </div>
                <?php } ?>
                <div class='pull-right'>
                  <a class="btn btn-primary" href="?module=debitur"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                </div>
              </div>
              <div class='row'>
                <div class='btn-search'>Cari Berdasarkan Nama :</div>
                  <div class='col-md-3 col-sm-12'>
                    <div class="input-group">
                      <input type=hidden name=module value=debitur>
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
                      <th width="200">Nama</th>
                      <th width="100">Alamat</th>
                      <th width="150">No Telp</th>
                      <?php if ($_SESSION['level']=='admin') { ?> <th width="80">Aksi</th> <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (empty(isset($_GET['kata']))) {
                    $p      = new Paging;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);

                    $result=mysql_query("SELECT * FROM debitur LIMIT $posisi,$batas");
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM debitur"));
                    if(mysql_num_rows($result) === 0) {
                    ?>
                    <tr>
                      <td class="center" colspan="10">Data kosong...</td>
                    </tr>
                    <?php } else {
                    $no = $posisi+1;
                    while ($r=mysql_fetch_array($result)) {
                    ?>
                    <tr>
                      <td class="center"><?php echo $no ?></td>
                      <td><?php echo $r['debitur_name'] ?></td>
                      <td><?php echo $r['debitur_address'] ?></td>
                      <td><?php echo $r['debitur_notelp'] ?></td>
                      <?php if ($_SESSION['level']=='admin') { ?>
                      <td align="center">
                        <!-- ========== EDIT DETAIL HAPUS ========== -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-xs">Actions</button>
                          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                              <a href="?module=debitur&act=edit&id=<?php echo $r['debitur_id'] ?>" title="Edit <?php echo $r['debitur_name'] ?>"><i class='fa fa-pencil'></i> Edit</a>
                            </li>
                            <li>
                              <a href="?module=debitur&act=detail&id=<?php echo $r['debitur_id'] ?>" title="Detail <?php echo $r['debitur_name'] ?>"><i class='fa fa-eye'></i> Detail</a>
                            </li>
                            <li>
                              <a href="javascript:;" data-id="<?php echo $r['debitur_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $r['debitur_name'] ?>"><i class='fa fa-trash-o'></i> Hapus</a>
                            </li>
                          </ul>
                        </div>
                        <!-- ========== End EDIT DETAIL HAPUS ========== -->
                      </td>
                      <?php $no++;
                    } ?>
                    </tr>
                    <?php }
                      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM debitur"));
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

                  $result=mysql_query("SELECT * FROM debitur WHERE debitur_name LIKE '%$search%' LIMIT $posisi,$batas");
                  if(mysql_num_rows($result) === 0) {
                  $jmldata = mysql_num_rows(mysql_query("SELECT * FROM debitur WHERE debitur_name LIKE '%$search%'"));
                  ?>
                  <tr>
                    <td class="center" colspan="10">Data kosong...</td>
                  </tr>
                  <?php } else {
                  $no = $posisi+1;
                  while ($r=mysql_fetch_array($result)) {
                  ?>
                  <tr>
                    <td class="center"><?php echo $no ?></td>
                    <td><?php echo $r['debitur_name'] ?></td>
                    <td><?php echo $r['debitur_address'] ?></td>
                    <td><?php echo $r['debitur_notelp'] ?></td>
                    <?php if ($_SESSION['level']=='admin') { ?>
                    <td align="center">
                      <!-- ========== EDIT DETAIL HAPUS ========== -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs">Actions</button>
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                          <li>
                            <a href="?module=debitur&act=edit&id=<?php echo $r['debitur_id'] ?>" title="Edit <?php echo $r['debitur_name'] ?>"><i class='fa fa-pencil'></i> Edit</a>
                          </li>
                          <li>
                            <a href="?module=debitur&act=detail&id=<?php echo $r['debitur_id'] ?>" title="Detail <?php echo $r['debitur_name'] ?>"><i class='fa fa-eye'></i> Detail</a>
                          </li>
                          <li>
                            <a href="javascript:;" data-id="<?php echo $r['debitur_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $r['debitur_name'] ?>"><i class='fa fa-trash-o'></i> Hapus</a>
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
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM debitur WHERE debitur_name LIKE '%$search%'"));
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
            <a href="javascript:;" class="btn btn-danger" id="hapus-debitur">Ya</a>
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
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=debitur&act=tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Tambah Debitur</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="debitur_name" class="control-label" >Nama <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_name" type="text" required class="form-control input-sm" id="debitur_name" placeholder="Masukan Nama"/>
                      </td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label for="debitur_address" class="control-label">Alamat <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_address" type="text" id="debitur_address" required class="form-control input-sm" size="255" maxlength="255" placeholder="Masukan Alamat"/>
                      </td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label for="debitur_notelp" class="control-label">No Telp <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_notelp" type="text" id="debitur_notelp" required class="form-control input-sm" size="12" maxlength="12" placeholder="Masukan No Telp"/>
                      </td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label for="debitur_age" class="control-label">Umur <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_age" type="number" id="debitur_age" required class="form-control input-sm" size="12" maxlength="12" placeholder="Masukan Umur"/>
                      </td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label for="debitur_gender" class="control-label">Jenis Kelamin <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="debitur_gender" class="form-control input-sm" id="debitur_gender" required>
                          <option value="">--- Pilih Jenis Kelamin ---</option>
                          <option value="Pria">Pria</option>
                          <option value="Wanita">Wanita</option>
                        </select>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=debitur'"/>
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

  // Form Edit
  case "edit":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM debitur WHERE debitur_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=debitur&act=edit" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <input name="debitur_id" hidden type="text" value='<?php echo $r['debitur_id'] ?>'/>
              <h3 class="title">Ubah Debitur</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td>
                        <label for="debitur_name" class="control-label" >Nama <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_name" type="text" required class="form-control input-sm" id="debitur_name" placeholder="Masukan Nama" value='<?php echo $r['debitur_name'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="debitur_address" class="control-label" >Alamat <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_address" type="text" required class="form-control input-sm" id="debitur_address" placeholder="Masukan Alamat" value='<?php echo $r['debitur_address'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="debitur_notelp" class="control-label" >No Telp <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_notelp" type="text" required class="form-control input-sm" id="debitur_notelp" placeholder="Masukan No Telp" value='<?php echo $r['debitur_notelp'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="debitur_age" class="control-label" >Umur <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="debitur_age" type="text" required class="form-control input-sm" id="debitur_age" placeholder="Masukan Umur" value='<?php echo $r['debitur_age'] ?>'/>
                      </td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label for="debitur_gender" class="control-label">Jenis Kelamin <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="debitur_gender" class="form-control input-sm" id="debitur_gender" required value='<?php echo $r['debitur_gender'] ?>'>
                          <?php if ($r['debitur_gender'] === 'Pria') { ?>
                          <option value="Pria" selected>Pria</option>
                          <option value="Wanita">Wanita</option>
                          <?php } else { ?>
                          <option value="Pria">Pria</option>
                          <option value="Wanita" selected>Wanita</option>
                          <?php } ?>
                        </select>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=debitur'"/>
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

  // Form Detail
  case "detail":
  if ($_SESSION['level']=='admin') {
  $result =mysql_query("SELECT * FROM debitur WHERE debitur_id='$_GET[id]'");
  $r      = mysql_fetch_array($result);
  $tanggal=tgl_indo($r['debitur_created']);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-12">
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="?module=debitur&act=edit&id=<?php echo $r['debitur_id'] ?>" method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Detail Debitur</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="130">
                        <label class="control-label">ID</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_id'] ?></td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">Nama</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_name'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label" >Alamat</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_address'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label" >No Telp</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_notelp'] ?></td>
                    </tr>
                    <tr>
                      <td width="130">
                        <label class="control-label">Umur</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_age'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label" >Jenis Kelamin</label>
                      </td>
                      <td class="detail"><?php echo $r['debitur_gender'] ?></td>
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
            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='?module=debitur'"/>
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
