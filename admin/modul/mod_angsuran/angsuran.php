<?php

include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";
include "../config/class_paging.php";

$aksi="modul/mod_angsuran/angsuran_aksi.php";

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

      <div class="col-md-5">
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
            <div class='center'>
              <a class="btn btn-primary btn-block" href="modul/mod_angsuran/angsuran_pdf.php?id=<?php echo $s['subrogasi_id']; ?>"><i class="fa fa-print"></i> Print PDF</a>
                <a class="btn btn-primary btn-block" id="button-print"><i class="fa fa-print"></i> Print Grafik</a>
              <a href="modul/mod_angsuran/angsuran_excel.php?id=<?php echo $s['subrogasi_id']; ?>" class="btn btn-success btn-block"><i class="fa fa-file"></i> Export to Excel</a>
                </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <?php if ($_SESSION['level']=='admin') { ?>
        <div class="block-flat">
          <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo $aksi ?>?module=angsuran&act=tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
            <input name="subrogasi_id" hidden type="text" value='<?php echo $s['subrogasi_id'] ?>'/>
            <input name="subrogasi_sisapiutang" hidden type="text" value='<?php echo $s['subrogasi_sisapiutang'] ?>'/>
              <h3 class="title">Pembayaran Subrogasi</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="200">
                        <label for="transaksi_sumberpenerimaan" class="control-label">Sumber Penerimaan <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="transaksi_sumberpenerimaan" class="form-control" id="transaksi_sumberpenerimaan" required>
                          <option value="">--- Pilih Sumber Penerimaan ---</option>
                          <option value="Angsuran">Angsuran</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_jenispenerimaan" class="control-label">Jenis Penerimaan <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="transaksi_jenispenerimaan" class="form-control" id="transaksi_jenispenerimaan" required>
                          <option value="">--- Pilih Jenis Penerimaan ---</option>
                          <option value="Transfer">Transfer</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_namarekjamkrindo" class="control-label" >Nama Rekening Jamkrindo <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="transaksi_namarekjamkrindo" type="text" value="Perum Jamkrindo" readonly required class="form-control input-sm" id="transaksi_namarekjamkrindo" placeholder="Masukan Nama Rekening Jamkrindo"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_bankjamkrindo" class="control-label">Bank Rekening Jamkrindo<span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="transaksi_bankjamkrindo" class="form-control" id="transaksi_bankjamkrindo" required>
                          <option value="">--- Pilih Bank ---</option>
                          <?php
$results=mysql_query("SELECT * FROM jamkrindo");
while ($rs=mysql_fetch_array($results)) {
                              $result=mysql_query("SELECT * FROM bank WHERE bank_id=$rs[bank_id]");
                              while ($r=mysql_fetch_array($result)) {
                                $result2=mysql_query("SELECT * FROM categorybank WHERE categorybank_id= $r[categorybank_id]");
                                  while ($r2=mysql_fetch_array($result2)) {
                                ?>
                              <option value='<?php echo $rs['jamkrindo_id'] ?>'><?php echo $rs['jamkrindo_norek'] ?> - <?php echo $r2['categorybank_name'] ?> <?php echo $r['bank_cabang'] ?></option>;
                          <?php } }
                        } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_norekbank" class="control-label" >Nomor Rekening Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="transaksi_norekbank" type="text" required class="form-control input-sm" id="transaksi_norekbank" placeholder="Masukan Nomor Rekening Bank"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_namarekbank" class="control-label" >Nama Rekening Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="transaksi_namarekbank" type="text" required class="form-control input-sm" id="transaksi_namarekbank" placeholder="Masukan Nama Rekening Bank"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_bank" class="control-label">Rekening Bank <span class="required">*</span></label>
                      </td>
                      <td>
                        <select name="transaksi_bank" class="form-control" id="transaksi_bank" required>
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
                        <label for="transaksi_jumlah" class="control-label" >Jumlah Pembayaran <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="transaksi_jumlah" type="number" required class="form-control input-sm" id="transaksi_jumlah" placeholder="Masukan Jumlah Pembayaran"/>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="transaksi_nobukti" class="control-label" >No Bukti <span class="required">*</span></label>
                      </td>
                      <td>
                        <input name="transaksi_nobukti" type="text" required class="form-control input-sm" id="transaksi_nobukti" placeholder="Masukan No Bukti"/>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

          <div class='center'>
            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
            <input class="btn btn-default" type="reset" name="batal" value="Kembali" onclick="location.href='?module=subrogasi'"/>
              </div>

            </form>
        </div></div>
      <?php } else { ?>
      <div class="block-flat">
        <div class='center'>
          <input class="btn btn-primary btn-block" type="reset" name="batal" value="Kembali" onclick="location.href='?module=subrogasi'"/>
        </div>
      <?php } ?>

      </div>
  </div>

  <div class="cl-mcont" style="margin-top:-100px;">
    <div class="row">
      <div class="col-md-7">
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
                      <th width="120">Tanggal</th>
                      <th width="300">No Bukti</th>
                      <th width="240">Angsuran</th>
                      <th width="80">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $result=mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'");
                    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'"));
                    if(mysql_num_rows($result) === 0) {
                    ?>
                    <tr>
                      <td class="center" colspan="10">Data kosong...</td>
                    </tr>
                    <?php } else {
                    $no = $posisi+1;
                    while ($r=mysql_fetch_array($result)) {
                    $tanggal=tgl_indo($r['transaksi_created']);


                    $angsuran=format_rupiah($r['transaksi_jumlah']);
                    ?>

                    <tr>
                      <td class="center"><?php echo $no ?></td>
                      <td class="text-center"><?php echo $tanggal ?></td>
                      <td><?php echo $r['transaksi_nobukti'] ?></td>
                      <td>Rp<?php echo $angsuran ?>,00</td>
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
                              <a href="?module=angsuran&act=detail&id=<?php echo $r['transaksi_id'] ?>" title="Detail"><i class='fa fa-eye'></i> Detail</a>
                            </li>
                          </ul>
                        </div>
                        <!-- ========== End EDIT DETAIL HAPUS ========== -->
                      </td>
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

        <div class="col-md-5">
          <div class="block-flat">
            <div class="content text-center">


<div id="charts" style="width:100%; height:400px;"></div>
<script>
$(function () {

  <?php
    $result=mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'");
    while ($row = mysql_fetch_array($result)) {
       $transaksi_jumlah[] = $row['transaksi_jumlah'];
       $dt = strtotime($row['transaksi_created']);
       $dt2  =  date('dmY', $dt);
       $transaksi_created[] = $dt2;
    }
    ?>
  var myChart = Highcharts.chart('charts', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Grafik Pembayaran Subrogasi'
      },
      xAxis: {
        title: {
            text: 'Tanggal Pembayaran'
        },
        type: 'date',
          categories: [<?php echo join($transaksi_created, ',') ?>]
      },
      yAxis: {
          title: {
              text: 'Jumlah Pembayaran'
          }
      },
      exporting: {
              buttons: {
                  contextButton: {
                      enabled: false
                  },
                  exportButton: {
                    align: 'right',
            y:15,
                      text: 'Download',
                      // Use only the download related menu items from the default
                      // context button
                      menuItems: [
                          'downloadPNG',
                          'downloadJPEG',
                          'downloadPDF',
                          'downloadSVG'
                      ]
                  }
              }
          },
      series: [{
          name: 'Jumlah Pembayaran',
          data: [<?php echo join($transaksi_jumlah, ',') ?>]
      }]
  });

  $('#button-print').click(function () {
    myChart.print();
});
});


</script>
                   </div>
                 </div>
               </div>
             </div>
           </div>
    <!-- End Content -->
  <?php
  break;

  // Form Detail
  case "detail":
  $result =mysql_query("SELECT * FROM transaksi WHERE transaksi_id='$_GET[id]'");
  $s      = mysql_fetch_array($result);

  $result =mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$s[subrogasi_id]'");
  $r      = mysql_fetch_array($result);
  $tanggal=tgl_indo($r['subrogasi_tglklaim']);
  $totalpiutang=format_rupiah($r['subrogasi_totalpiutang']);
  $sisapiutang=format_rupiah($r['subrogasi_sisapiutang']);
  $agunan=format_rupiah($r['subrogasi_agunan']);
  $tanggal2=tgl_indo($s['transaksi_created']);
  $jumlah=format_rupiah($s['transaksi_jumlah']);
  ?>
  <div class="cl-mcont">
    <div class="row">
      <div class="col-md-6">
        <div class="block-flat">
          <div class="content">
            <form method="post" enctype="multipart/form-data" parsley-validate novalidate>
              <h3 class="title">Detail Pembayaran Subrogasi</h3>
              <div class="table-responsive">
                <table class="table no-border hover">
                  <tbody class="no-border-y">
                    <tr>
                      <td width="200">
                        <label class="control-label">ID</label>
                      </td>
                      <td class="detail"><?php echo $s['transaksi_id'] ?></td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">Sumber Penerimaan</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_sumberpenerimaan'] ?></td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">Jenis Penerimaan</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_jenispenerimaan'] ?></td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">No Rek Jamkrindo</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_norekjamkrindo'] ?></td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">Nama Rek Jamkrindo</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_namarekjamkrindo'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Bank Rekening Jamkrindo</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM bank WHERE bank_id = $s[transaksi_bankjamkrindo]");
                        while ($e=mysql_fetch_array($result2)) {
                          $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$e[categorybank_id]'");
                          $r4      = mysql_fetch_array($result4);
                          ?>
                      <td class="detail"><?php echo $r4['categorybank_name'] ?> <?php echo $e['bank_cabang']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">No Rek Bank</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_norekbank'] ?></td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">Nama Rek Bank</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_namarekbank'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Rekening Bank</label>
                      </td>
                      <?php
                      $result2=mysql_query("SELECT * FROM bank WHERE bank_id = $s[transaksi_bank]");
                        while ($e=mysql_fetch_array($result2)) {
                          $result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$e[categorybank_id]'");
                          $r4      = mysql_fetch_array($result4);
                          ?>
                      <td class="detail"><?php echo $r4['categorybank_name'] ?> <?php echo $e['bank_cabang']; ?></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Jumlah Pembayaran</label>
                      </td>
                      <td class="detail">Rp<?php echo $jumlah ?>,00</td>
                    </tr>
                    <tr>
                        <td width="200">
                          <label class="control-label">No Bukti</label>
                        </td>
                        <td class="detail"><?php echo $s['transaksi_nobukti'] ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="control-label">Dibayar</label>
                      </td>
                      <td class="detail"><?php echo $tanggal2 ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    <div class="col-md-6">
      <div class="block-flat">
        <div class="content">
          <form method="post" enctype="multipart/form-data" parsley-validate novalidate>
            <div class="table-responsive">
              <table class="table no-border hover">
                <tbody class="no-border-y">
                  <tr>
                    <td width="200">
                      <label class="control-label">ID Subrogasi</label>
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
            <div class='center'>
              <input class="btn btn-primary btn-block" type="reset" name="batal" value="Kembali" onclick="location.href='<?php echo '?module=angsuran&id='.$r[subrogasi_id] ?>'"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php
  break;
} ?>
