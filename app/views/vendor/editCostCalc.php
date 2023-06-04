<div class="page-content clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
          <?php $info = $this->controller->informations->getCalcCostInfo($siriNo); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MAKLUMAT PEGANGAN</h4>
            </div>
            <div class="panel-body s13">
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
              <input type="hidden" id="kwkod" value="<?= $info['kwkod']; ?>">
              <input type="hidden" id="htkod" value="<?= $info['htkod']; ?>">
            </div>
          </div>
          <!-- <div class="panel">
            <div class="panel-body">
              <div class="mapSideView" id="mapSideView"></div>
            </div>
          </div> -->
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml15">NILAIAN - KEMASKINI KAEDAH KOS</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <div class="btn-group btn-group-xs mt10 mr10">
                    <button type="button" class="btn btn-default btn-xs" id="print" data-sirino="<?= $info["esirino"] ?>"><i class="glyphicon glyphicon-print"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" id="delete" data-sirino="<?= $info["esirino"] ?>"><i class="glyphicon glyphicon-trash"></i></button>
                  </div>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <div id="edit-calc-cost" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Tanah</span>
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
                <form class="form-horizontal" role="form" id="editCalcCost" method="post">
                  <input type="hidden" name="akaun" value="<?= $info["no_akaun"] ?>">
                  <input type="hidden" name="siri_no" value="<?= $info["siri_no"] ?>">
                  <div class="tab-content" id="panel_cost" style="overflow-y: scroll;display: inline-block; min-width: 100%;">
                    <div class=" tab-pane active" id="tab1">
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
                            <td><input type="hidden" name="id_land" value="<?= $info['land']["id"] ?>"></td>
                            <td><input type="number" class="form-control input-xs" name="breadth_land" id="breadth_land" min="0" value="<?= $info['land']["breadth"] ?>"></td>
                            <td>mp</td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-xs" name="price_land" id="price_land" min="0" value="<?= $info['land']["price"] ?>"></td>
                            <td>smp</td>
                            <td><input type="number" class="form-control input-xs total_land" id="total_land" name="total_land" value="<?= $info['land']["total"] ?>" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">Pelarasan :<br />(-)</td>
                            <td colspan="4">
                              <div class="input-group">
                                <span class="input-group-addon">RM</span>
                                <input type="number" class="form-control input-xs" id="sub_land" value="<?= $info['land']["total"] ?>" readonly>
                                <span class="input-group-addon">-</span>
                                <input type="number" class="form-control input-xs" name="adjust_land" id="adjust_land" value="<?= $info['land']["adjustment"] ?>">
                                <span class="input-group-addon">%</span>
                              </div>
                            </td>
                            <td>
                              <div class="input-group">
                                <span class="input-group-addon">RM</span>
                                <input type="number" class="form-control input-xs" id="ttl_adjust" value="<?= $info['land']["total_overall"] ?>" readonly>
                              </div>
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
                                <input type="number" class="form-control input-xs ttl_overall" id="ttl_land" name="ttl_land" value="<?= $info['land']["total_overall"] ?>" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="page-header">
                        <h4><strong>BANGUNAN</strong></h4>
                      </div>
                      <div class="section">
                        <?php foreach ($info['main'] as $section) { ?>
                          <section id="<?= $section['id'] ?>">
                            <div class="row ml5 mr5">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                  <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>
                                  <div class="col-lg-10 col-md-9">
                                    <input type="hidden" name="section[<?= $section['id'] ?>][id]" value="<?= $section['id'] ?>">
                                    <input type="text" class="form-control input-xs" name="section[<?= $section['id'] ?>][main_title]" value="<?= $section['title'] ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <table class="table table-bordered one" id="<?= $section['id'] ?>" style="font-size:13px;">
                              <thead>
                                <tr>
                                  <th style="width:30%">Perkara</th>
                                  <th style="width:10%">Keluasan/Kuantiti</th>
                                  <th style="width:15%">Jenis</th>
                                  <th style="width:2%"></th>
                                  <th style="width:10%">Nilai Unit</th>
                                  <th style="width:15%">Jenis</th>
                                  <th style="width:15%">Jumlah</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody id="<?= $section['id'] ?>">
                                <?php
                                $subttl = 0;
                                foreach ($section['items'] as $row) {
                                  $subttl += $row['total'];
                                ?>
                                  <tr id="<?= $row['id'] ?>">
                                    <td>
                                      <input type="hidden" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][id]" value="<?= $row['id'] ?>">
                                      <input type="text" class="form-control input-xs" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][title]" value="<?= $row['title'] ?>">
                                    </td>
                                    <td><input type="number" class="form-control input-xs" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][breadth]" id="breadth" min="0" value="<?= $row["breadth"] ?>"></td>
                                    <td>
                                      <select class="form-control input-xs" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][breadthtype]">
                                        <option value="">Sila Pilih</option>
                                        <option value="mp" <?php if ($row["breadthtype"] == "mp") {
                                                              echo "selected";
                                                            } ?>>Meter
                                        </option>
                                        <option value="ft" <?php if ($row["breadthtype"] == "ft") {
                                                              echo "selected";
                                                            } ?>>Kaki</option>
                                        <option value="unit" <?php if ($row["breadthtype"] == "unit") {
                                                                echo "selected";
                                                              } ?>>Unit</option>
                                        <option value="petak" <?php if ($row["breadthtype"] == "petak") {
                                                                echo "selected";
                                                              } ?>>Petak</option>
                                      </select>
                                    </td>
                                    <td style="text-align:center">X</td>
                                    <td><input type="number" class="form-control input-xs" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][price]" id="price" min="0" value="<?= $row['price'] ?>"></td>
                                    <td>
                                      <select class="form-control input-xs" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][pricetype]">
                                        <option value="">Sila Pilih</option>
                                        <option value="smp" <?php if ($row["pricetype"] == "smp") {
                                                              echo "selected";
                                                            } ?>>Meter Persegi</option>
                                        <option value="sft" <?php if ($row["pricetype"] == "sft") {
                                                              echo "selected";
                                                            } ?>>Kaki Persegi</option>
                                        <option value="p/unit" <?php if ($row["pricetype"] == "p/unit") {
                                                                  echo "selected";
                                                                } ?>>Per-Unit</option>
                                        <option value="sepetak" <?php if ($row["pricetype"] == "sepetak") {
                                                                  echo "selected";
                                                                } ?>>Sepetak</option>
                                      </select>
                                    </td>
                                    <td><input type="number" class="form-control input-xs total" name="section[<?= $section['id'] ?>][item][<?= $row['id'] ?>][total]" value="<?= $row['total'] ?>" readonly></td>
                                    <td></td>
                                  </tr>
                                <?php } ?>
                                <tr class="adjustment">
                                  <td colspan="6" style="font-size:14px; font-weight:bold; text-align:right;">Jumlah</td>
                                  <td>
                                    <div class="input-group">
                                      <span class="input-group-addon">RM</span>
                                      <input type="number" class="form-control input-xs sub_ttl" value="<?= $subttl; ?>" readonly>
                                    </div>
                                  </td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="3">Pelarasan :<br />(-) Susut Nilai Bangunan</td>
                                  <td colspan="3">
                                    <div class="input-group">
                                      <span class="input-group-addon">RM</span>
                                      <input type="number" class="form-control input-xs duplicate_sub_ttl" value="<?= $subttl; ?>" readonly>
                                      <span class="input-group-addon">-</span>
                                      <input type="number" class="form-control input-xs adjust" name="section[<?= $section['id'] ?>][adjust]" value="<?= $section['adjust']; ?>">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="input-group">
                                      <span class="input-group-addon">RM</span>
                                      <input type="number" class="form-control input-xs ttl_adjustment ttl_partly" name="section[<?= $section['id'] ?>][ttladjust]" value="<?= $section['total']; ?>" readonly>
                                    </div>
                                  </td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
                          </section>
                        <?php } ?>
                      </div>
                      <table class="table mb10">
                        <tbody>
                          <tr>
                          <tr>
                            <td style="width:25%"></td>
                            <td style="width:15%"></td>
                            <td style="width:10%"></td>
                            <td></td>
                            <td style="width:15%"></td>
                            <td style="width:15%;font-size:14px; font-weight:bold; text-align:right;">Jumlah Keseluruhan
                            </td>
                            <td colspan="2">
                              <div class="input-group">
                                <span class="input-group-addon">RM</span>
                                <input type="number" class="form-control input-xs ttl_overall" id="overall" value="<?= $info['moverall']; ?>" name="overall" readonly>
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
                          <td style="width:80%" colspan="2"><strong>NILAI MODAL</strong></td>
                          <td style="width:20%">
                            <input type="hidden" name="capital" id="capital" value="<?= $info['capital_rental']; ?>">
                            RM <span class="control-label tal" id="dummy_capital"><?= $info['capital_rental']; ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td><strong>(SEKSYEN 2 AKTA 171, 10%)</strong></td>
                          <td style="width: 100px;">
                            <strong>X</strong>
                          </td>
                          <td>
                            10%
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                          <td>
                            <input type="hidden" name="yearly" id="yearly" value="<?= $info['yearly']; ?>">
                            RM <span class="control-label tal" id="dummy_yearly"><?= $info['yearly']; ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>NILAI TAHUNAN (DIGENABKAN)</strong></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon">RM</span>
                              <input type="number" class="form-control input-sm" name="round" id="round" value="<?= $info['round']; ?>">
                            </div>
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
                            <input type="hidden" name="tax" id="tax" value="<?= $info["tax"] ?>">
                            <strong>RM</strong> <span class="control-label tal bold" id="dummy_tax"><?= $info["tax"] ?></span>
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
                  <li class="next finish" style="display:none;"><a href="#">Kemaskini</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>