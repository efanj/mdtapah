<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
          <?php $info = $this->controller->informations->getReviewAcctInfo($reviewId); ?>
          <div class="panel panel-primary">
            <input type="hidden" id="kwkod" value="<?= $info['kwkod']; ?>">
            <input type="hidden" id="htkod" value="<?= $info['htkod']; ?>">
            <div class="panel-heading">
              <h4>MAKLUMAT PEGANGAN</h4>
            </div>
            <div class="panel-body s12" style="font-size: 10px;">
              <table class="table table-bordered mb20 acct_info" style="width:100%; font-size:11px;">
                <tbody>
                  <tr>
                    <td width="17%"><strong>No. Akaun :</strong></td>
                    <td width="17%"><?= $info["no_akaun"] ?></td>
                    <td width="17%"><strong>ID Pemilik :</strong></td>
                    <td width="17%"><?= $info["plgid"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama Pemilik :</strong></td>
                    <td colspan="3"><?= $info["nmbil"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat :</strong></td>
                    <td colspan="3">
                      <?php
                      if ($info["adpg1"] != "" || $info["adpg1"] != null) {
                        echo $info["adpg1"] . ", ";
                      }
                      if ($info["adpg2"] != "" || $info["adpg2"] != null) {
                        echo $info["adpg2"] . ", ";
                      }
                      if ($info["adpg3"] != "" || $info["adpg3"] != null) {
                        echo $info["adpg3"] . ", ";
                      }
                      if ($info["adpg4"] != "" || $info["adpg4"] != null) {
                        echo $info["adpg4"];
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Jalan/Taman :</strong></td>
                    <td><?= $info["jnama"] ?></td>
                    <td><strong>Kawasan :</strong></td>
                    <td><?= $info["knama"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kegunaan Tanah :</strong></td>
                    <td><?= $info["tnama"] ?></td>
                    <td><strong>Kegunaan Hartanah :</strong></td>
                    <td><?= $info["hnama"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Luas Tanah :</strong></td>
                    <td><?= $info["lstnh"] . " mp" ?></td>
                    <td><strong>Luas Bangunan :</strong></td>
                    <td><?= $info["lsbgn"] . " mp" ?></td>
                  </tr>
                  <tr>
                    <td><strong>Luas Ansolari :</strong></td>
                    <td colspan="3"><?= $info["lsans"] . " mp" ?></td>
                  </tr>
                  <tr>
                    <td><strong>Luas Bgn Tamb :</strong></td>
                    <td><?= $info["lsbgnt"] . " mp" ?></td>
                    <td><strong>Luas Ans Tamb :</strong></td>
                    <td><?= $info["lsanst"] . " mp" ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nilai Tahunan :</strong></td>
                    <td><?= "RM " . number_format($info["nilth_asal"], 2) ?></td>
                    <td><strong>Kadar :</strong></td>
                    <td><?= $info["kadar_asal"] . " %" ?></td>
                  </tr>
                  <tr>
                    <td><strong>Cukai Tahunan :</strong></td>
                    <td colspan="3"><?= "RM " . number_format($info["cukai_asal"], 2) ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>NILAIAN - KAEDAH PERBANDINGAN</h4>
            </div>
            <div class="panel-body">
              <div id="calc-rent" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Perbandingan & Tanah</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab2" data-toggle="tab">
                      <span class="step-number">2</span>
                      <span class="step-text">Bangunan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab3" data-toggle="tab">
                      <span class="step-number">3</span>
                      <span class="step-text">Pengiraan</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="calcRent" method="post">
                  <input type="hidden" name="akaun" value="<?= $info["no_akaun"] ?>">
                  <input type="hidden" id="luas_ansolari" value="<?= $info["lsans"] ?>">
                  <input type="hidden" id="tamb_bangunan" value="<?= $info["lsbgnt"] ?>">
                  <input type="hidden" id="tamb_ansolari" value="<?= $info["lsanst"] ?>">
                  <div class="tab-content" id="panel_rent" style="overflow-y: scroll;display: inline-block; min-width: 100%;">
                    <div class="tab-pane active" id="tab1">
                      <div class="page-header">
                        <h4><strong>PERBANDINGAN</strong></h4>
                      </div>
                      <button id="add-comparison" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered comparison" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th></th>
                            <th style="width:20%">Nama Taman</th>
                            <th style="width:15%">Jenis Bangunan</th>
                            <th>Keluasan</th>
                            <th style="width:10%">Nilai Tahunan</th>
                            <th style="width:15%">Sewa SMP(MFA)</th>
                            <th style="width:15%">Sewa SMP(AFA)</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="comparison_table">
                          <tr id="0">
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i class="fa fa-plus"></i></button></td>
                            <td>
                              <input type="hidden" name="compare[]" id="comparison">
                              <div class='control-label tal' id='jlname'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='bgtype'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='breadth'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='nilth'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='mfa'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='afa'></div>
                            </td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></button></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="page-header">
                        <h4><strong>TANAH</strong></h4>
                      </div>
                      <table class="table table-bordered land">
                        <thead>
                          <tr>
                            <th style="width:30%"></th>
                            <th style="width:15%">Keluasan</th>
                            <th style="width:10%">Jenis</th>
                            <th style="width:2%"></th>
                            <th style="width:15%">Nilai Unit</th>
                            <th style="width:10%">Jenis</th>
                            <th style="width:18%">Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td><input type="number" class="form-control input-xs" name="breadth_land" id="breadth_land" min="0" value="<?= $info["lstnh"] ?>"></td>
                            <td>mp</td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-xs" name="price_land" id="price_land" min="0" value="0"></td>
                            <td>smp</td>
                            <td><input type="number" class="form-control input-xs total_land" name="total_land" id="total_land" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table mb10">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <td style="width:25%"></td>
                            <td style="width:15%"></td>
                            <td style="width:10%"></td>
                            <td></td>
                            <td style="width:15%"></td>
                            <td style="width:15%;font-size:14px; font-weight:bold; text-align:right;">Jumlah</td>
                            <td colspan="2">
                              <div class="input-group">
                                <span class="input-group-addon">RM</span>
                                <input type="number" class="form-control input-xs ttl_overall" id="ttl_land" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class=" tab-pane" id="tab2">
                      <div class="page-header">
                        <h4><strong>BANGUNAN UTAMA</strong></h4>
                      </div>
                      <button class="btn btn-primary btn-xs add" type="button">Add Row</button>
                      <table class="table table-bordered one" id="zero" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th style="width:30%">Perkara</th>
                            <th style="width:10%">Keluasan/Kuantiti</th>
                            <th style="width:12%">Jenis</th>
                            <th style="width:2%"></th>
                            <th style="width:13%">Nilai Unit</th>
                            <th style="width:15%">Jenis</th>
                            <th style="width:15%">Jumlah (RM)</th>
                            <th style="width:3%"></th>
                          </tr>
                        </thead>
                        <tbody id="zero">
                          <tr id="0">
                            <td>
                              <input type="text" class="form-control input-xs" name="main[0][title]" value="TINGKAT BAWAH">
                            </td>
                            <td><input type="number" class="form-control input-xs" name="main[0][breadth]" id="breadth" min="0" value="<?= $info["lsbgn"] ?>"></td>
                            <td>
                              <select class="form-control input-xs" name="main[0][breadthtype]">
                                <option value="">Sila Pilih</option>
                                <option value="mp" selected>Meter</option>
                                <option value="ft">Kaki</option>
                                <option value="unit">Unit</option>
                                <option value="petak">Petak</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-xs" name="main[0][price]" id="price" min="0" value="0"></td>
                            <td>
                              <select class="form-control input-xs" name="main[0][pricetype]">
                                <option value="">Sila Pilih</option>
                                <option value="smp" selected>Meter Persegi</option>
                                <option value="sft">Kaki Persegi</option>
                                <option value="p/unit">Per-Unit</option>
                                <option value="sepetak">Sepetak</option>
                              </select>
                            </td>
                            <td><input type="number" class="form-control input-xs total" name="main[0][total]" readonly>
                            </td>
                            <td></td>
                          </tr>
                          <tr id="0" class="adjustment">
                            <td colspan="6" style="font-size:14px; font-weight:bold; text-align:right;">Jumlah</td>
                            <td>
                              <input type="number" class="form-control input-xs sub_ttl" id="sub_ttl" value="" readonly>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="page-header">
                        <h4><strong>BANGUNAN LUAR</strong></h4>
                      </div>
                      <table class="table table-bordered two" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th style="width:30%">Perkara</th>
                            <th style="width:10%">Keluasan/Kuantiti</th>
                            <th style="width:12%">Jenis</th>
                            <th style="width:2%"></th>
                            <th style="width:13%">Nilai Unit</th>
                            <th style="width:15%">Jenis</th>
                            <th style="width:15%">Jumlah (RM)</th>
                            <th style="width:3%"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <input type="text" class="form-control input-xs" name="out[0][title]" value="">
                            </td>
                            <td><input type="number" class="form-control input-xs" name="out[0][breadth]" id="out_breadth" min="0" value="<?= $info["lsans"] ?>"></td>
                            <td>
                              <select class="form-control input-xs" name="out[0][breadthtype]">
                                <option value="">Sila Pilih</option>
                                <option value="mp" selected>Meter</option>
                                <option value="ft">Kaki</option>
                                <option value="unit">Unit</option>
                                <option value="petak">Petak</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-xs" name="out[0][price]" id="out_price" min="0" value="0"></td>
                            <td>
                              <select class="form-control input-xs" name="out[0][pricetype]">
                                <option value="">Sila Pilih</option>
                                <option value="smp" selected>Meter Persegi</option>
                                <option value="sft">Kaki Persegi</option>
                                <option value="p/unit">Per-Unit</option>
                                <option value="sepetak">Sepetak</option>
                              </select>
                            </td>
                            <td><input type="number" class="form-control input-xs total" name="out[0][total]" readonly>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" class="form-control input-xs" name="out[1][title]" value="">
                            </td>
                            <td><input type="number" class="form-control input-xs" name="out[1][breadth]" id="out_breadth" min="0" value="<?= $info["lsanst"] ?>"></td>
                            <td>
                              <select class="form-control input-xs" name="out[1][breadthtype]">
                                <option value="">Sila Pilih</option>
                                <option value="mp" selected>Meter</option>
                                <option value="ft">Kaki</option>
                                <option value="unit">Unit</option>
                                <option value="petak">Petak</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-xs" name="out[1][price]" id="out_price" min="0" value="0"></td>
                            <td>
                              <select class="form-control input-xs" name="out[1][pricetype]">
                                <option value="">Sila Pilih</option>
                                <option value="smp" selected>Meter Persegi</option>
                                <option value="sft">Kaki Persegi</option>
                                <option value="p/unit">Per-Unit</option>
                                <option value="sepetak">Sepetak</option>
                              </select>
                            </td>
                            <td><input type="number" class="form-control input-xs total" name="out[1][total]" readonly>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="6" style="font-size:14px; font-weight:bold; text-align:right;">Jumlah</td>
                            <td>
                              <input type="number" class="form-control input-xs sub_ttl" id="sub_ttl" value="" readonly>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table mb10">
                        <tbody>
                          <tr>
                          <tr>
                            <td style="font-size:14px; font-weight:bold; text-align:right;">Jumlah Keseluruhan
                            </td>
                            <td style="width:20%">
                              <div class="input-group">
                                <span class="input-group-addon">RM</span>
                                <input type="number" class="form-control input-xs ttl_overall" id="overall" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="page-header">
                        <h4><strong>PENGIRAAN</strong></h4>
                      </div>
                      <table style="width:100%;font-size:13px;" class="calculator mb15">
                        <tr>
                          <td style="width:80%" colspan="2"><strong>ANGGARAN SEWA BULANAN</strong></td>
                          <td style="width:20%">
                            <input type="hidden" name="rental" id="rental">
                            RM <span class="control-label tal" id="dummy_rental"></span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:60%"></td>
                          <td>
                            <div class="checkbox-custom">
                              <input type="checkbox" id="dummy_corner">
                              <label for="corner">Corner Lot 10%</label>
                            </div>
                            <input type="hidden" id="corner" name="corner" value="false">
                          </td>
                          <td>
                            RM <span class="control-label tal" id="value_corner"></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>SEWA BULANAN DIGENAPKAN</strong></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon">RM</span>
                              <input type="number" class="form-control input-sm" name="round" id="round">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>TEMPOH TAHUNAN</strong></td>
                          <td>X 12 BULAN</td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                          <td>
                            <input type="hidden" name="yearly" id="yearly">
                            RM <span class="control-label tal" id="dummy_yearly"></span>
                          </td>
                        </tr>
                        <tr>
                          <td><strong>KADAR</strong></td>
                          <td>
                            <button type="button" class="btn btn-info btn-sm" id="update_rate">Kemaskini</button>
                          </td>
                          <td>
                            <div class="input-group input-group-sm">
                              <input type="number" class="form-control input-sm" name="rate" id="rate" value="<?= $info["kadar_asal"] ?>">
                              <span class=" input-group-addon">%</span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                          <td>
                            <input type="hidden" name="tax" id="tax">
                            <strong>RM</strong> <span class="control-label tal bold" id="dummy_tax"></span>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </form>
                <ul class="pager">
                  <li class="previous"><a href="#">&larr; Sebelumnya</a>
                  </li>
                  <li class="next"><a href="#">Seterusnya &rarr;</a>
                  </li>
                  <li class="next finish" style="display:none;"><a href="#">Simpan</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="comparison_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">SENARAI DATA PERBANDINGAN</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_comparison" width="100%">
          <thead>
            <tr>
              <th></th>
              <th>Nama Jalan</th>
              <th>Jenis Bangunan</th>
              <th>Keluasan</th>
              <th>Nilai Tahunan</th>
              <th>Sewa SMP(MFA)</th>
              <th>Sewa SMP(AFA)</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>