<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6">
          <?php $hacmjb = $this->controller->account->viewamendBdetail($siriNo); ?>
          <?php $cals = $this->controller->account->getCalculationInfo($siriNo); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>PEGANGAN YANG DIPINDA NILAI TAHUNAN - JADUAL B</h4>
            </div>
            <div class="panel-body">
              <div id="jadualb" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Maklumat Akaun</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab2" data-toggle="tab">
                      <span class="step-number">2</span>
                      <span class="step-text">Maklumat Rujukan</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="jadualB" method="post" style="font-size:13px;">
                  <input type="hidden" name="mjbNsiri" value="<?= $hacmjb["mjb_nsiri"] ?>" />
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Tarikh MJP :</label>
                        </div>
                        <div class="col-md-3">
                          <div class="control-label tal"><?= $hacmjb["mjb_tkhpl"] ?></div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Tarikh K/Kuasa :</label>
                        </div>
                        <div class="col-md-1 tal">
                          <div class="control-label tal"><?= $hacmjb["mjb_tkhtk"] ?></div>
                        </div>
                        <div class="col-md-3">
                          <label class="control-label">Tarikh OC :</label>
                        </div>
                        <div class="col-md-1">
                          <div class="control-label tal" id="mjb_tkhoc"></div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["mjb_akaun"] ?>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                          <label class="control-label">No. Siri :</label>
                        </div>
                        <div class="col-md-1 control-label tal"><?= $hacmjb["mjb_nsiri"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun Lama :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["peg_oldac"] ?></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                          <label class="control-label tal">Sumbangan Membantu Kadar :</label>
                        </div>
                        <div class="col-md-1">
                          <div class="checkbox-custom">
                            <input type="checkbox" id="dummy_mjb_Stcbk" <?php if ($hacmjb["mjb_stcbk"] === "Y") {
                                                                          echo "checked";
                                                                        } ?>disabled>
                            <label for="dummy_mjb_Stcbk"></label>
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Nama Di Bil :</label>
                        </div>
                        <div class="col-md-10 control-label tal"><?= $hacmjb["pmk_nmbil"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. lot :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["peg_nolot"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Jalan :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["jln_jnama"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Alamat :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg1"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Kawasan :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["jln_knama"] ?>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg2"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg3"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg4"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Tanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?= $hacmjb["tnama"] ?>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Jenis Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?= $hacmjb["bnama"] ?>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Hartanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?= $hacmjb["hnama"] ?>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Struktur Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?= $hacmjb["snama"] ?>
                        </div>
                      </div>

                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Jenis Pemilik :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["jpk_jnama"] ?>
                        </div>
                      </div>
                      <div class="row mb15">
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS
                            (X) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codex"><?= $hacmjb["peg_codex"] ?></div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS
                            (Y) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codey"><?= $hacmjb["peg_codey"] ?></div>
                          <button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target="#peta_popup">Lokasi</button>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Diskaun :</label>
                        </div>
                        <div class="col-md-4 control-label tal">%</div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. PT :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_nompt"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan Fail :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_rjfil"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">No. Pelan :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_pelan"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Hak Milik :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["pmk_hkmlk"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Bil.Pemilik :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_bilpk"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan MMK :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_rjmmk"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Luas Bangunan :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lsbgn"] ?> m&sup2;</div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Tanah :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lstnh"] ?> m&sup2;
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Ansolari :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lsans"] ?> m&sup2;</div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Sebab-sebab :</label>
                        </div>
                        <div class="col-md-6">
                          <div class="control-label tal"><?= $hacmjb["acm_sbktr"] ?></div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Catatan :</label>
                        </div>
                        <div class="col-md-10">
                          <div class="control-label tal"><?= $hacmjb["mjb_mesej"] ?></div>
                        </div>
                      </div>
                      <div class="row mt10 mb10">
                        <div class="col-md-2">
                          <label class="control-label tal">Pegawai Pendaftar :</label>
                        </div>
                        <div class="col-md-4 tal"><label class="control-label"><b><?= $hacmjb["mjb_onama"] ?> -
                              <?= $hacmjb["name"] ?></b></b></label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <ul class="pager">
                  <li class="previous"><a href="#">&larr; Sebelumnya</a>
                  </li>
                  <li class="next"><a href="#">Seterusnya &rarr;</a>
                  </li>
                  <li class="next finish" style="display:none;"><a href="#">Tamat</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MAKLUMAT KIRA-KIRA</h4>
            </div>
            <div class="panel-body">

              <?php if (empty($cals)) { ?>
                <div class='col-xs-12 col-md-12 tac no-data'>Tiada Maklumat</div>
              <?php } else { ?>
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr style="background: #ddd;">
                      <th colspan="6">PERBANDINGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($cals['comparison'])) { ?>
                      <tr>
                        <td colspan="6" class="tac">Tiada Maklumat</td>
                      </tr>
                    <?php } else { ?>
                      <?php foreach ($cals['comparison'] as $row) { ?>
                        <tr>
                          <td><?= $row['jln_jnama'] ?></td>
                          <td><?= $row['bgn_bnama'] ?></td>
                          <td><?= $row['peg_lsbgn'] ?></td>
                          <td><?php echo "RM " . $row['peg_nilth'] ?></td>
                          <td><?php echo "RM " . $row['mfa'] ?></td>
                          <td><?php echo "RM " . $row['afa'] ?></td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>

                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr style="background: #ddd;">
                      <th colspan="7">TANAH</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($cals['land']["breadth"] == "0" || $cals['land']["breadth"] == "0.00") { ?>
                      <tr>
                        <td colspan="7" class="tac">Tiada Maklumat</td>
                      </tr>
                    <?php } else { ?>
                      <tr>
                        <td style="width:30%"></td>
                        <td style="text-align: right;width:15%"><?= $cals['land']["breadth"] ?></td>
                        <td style="width:10%">mp</td>
                        <td style="text-align: center;width:2%">X</td>
                        <td style="text-align: right;width:15%">RM <?= $cals['land']["price"] ?></td>
                        <td style="width:10%">smp</td>
                        <td style="text-align: right;width:18%" class="control-label tal bold">
                          <?= "RM " . number_format($cals['land']["total"], 2); ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr style="background: #ddd;">
                      <th colspan="7">BANGUNAN <?php if ($cals['calc_type'] == 1) {
                                                  echo "UTAMA";
                                                } ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($cals['main'][0]['id'] == 0) { ?>
                      <tr>
                        <td colspan="7" class="tac">Tiada Maklumat</td>
                      </tr>
                    <?php } else { ?>
                      <?php if ($cals['calc_type'] == 1) { ?>
                        <?php foreach ($cals['main'] as $row) { ?>
                          <tr>
                            <td style="width:30%"><?= $row['title'] ?></td>
                            <td style="text-align: right;width:15%"><?= $row["breadth"] ?></td>
                            <td style="width:10%">
                              <?php if ($row["breadthtype"] == "mp") {
                                echo "mp";
                              } elseif ($row["breadthtype"] == "ft") {
                                echo "ft";
                              } elseif ($row["breadthtype"] == "unit") {
                                echo "unit";
                              } elseif ($row["breadthtype"] == "petak") {
                                echo "petak";
                              }  ?>
                            </td>
                            <td style="text-align: center;width:2%">X</td>
                            <td style="text-align: right;width:15%">RM <?= $row['price'] ?></td>
                            <td style="width:10%">
                              <?php if ($row["pricetype"] == "smp") {
                                echo "smp";
                              } elseif ($row["pricetype"] == "sft") {
                                echo "sft";
                              } elseif ($row["pricetype"] == "p/unit") {
                                echo "p/unit";
                              } elseif ($row["pricetype"] == "sepetak") {
                                echo "sepetak";
                              }  ?>
                            </td>
                            <td style="text-align: right;width:18%" class="control-label tal bold">
                              <?= "RM " . number_format($row['total'], 2); ?></td>
                          </tr>
                        <?php }
                      } else { ?>
                        <?php foreach ($cals['main'] as $section) { ?>
                          <?php if (!empty($section['title'])) { ?>
                            <tr>
                              <td colspan="7"><strong><?= $section['title'] ?></strong></td>
                            </tr>
                          <?php } ?>
                          <?php foreach ($section['items'] as $row) { ?>
                            <tr>
                              <td style="width:30%"><?= $row['title'] ?></td>
                              <td style="text-align: right;width:15%"><?= $row["breadth"] ?></td>
                              <td style="width:10%">
                                <?php if ($row["breadthtype"] == "mp") {
                                  echo "mp";
                                } elseif ($row["breadthtype"] == "ft") {
                                  echo "ft";
                                } elseif ($row["breadthtype"] == "unit") {
                                  echo "unit";
                                } elseif ($row["breadthtype"] == "petak") {
                                  echo "petak";
                                }  ?>
                              </td>
                              <td style="text-align: center;width:2%">X</td>
                              <td style="text-align: right;width:15%">RM <?= $row['price'] ?></td>
                              <td style="width:10%">
                                <?php if ($row["pricetype"] == "smp") {
                                  echo "smp";
                                } elseif ($row["pricetype"] == "sft") {
                                  echo "sft";
                                } elseif ($row["pricetype"] == "p/unit") {
                                  echo "p/unit";
                                } elseif ($row["pricetype"] == "sepetak") {
                                  echo "sepetak";
                                }  ?>
                              </td>
                              <td style="text-align: right;width:18%" class="control-label tal bold">
                                <?= "RM " . number_format($row['total'], 2); ?></td>
                            </tr>
                    <?php }
                        }
                      }
                    } ?>

                  </tbody>
                </table>
                <?php if ($cals['calc_type'] == 1) { ?>
                  <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                    <thead>
                      <tr style="background: #ddd;">
                        <th colspan="7">BANGUNAN LUAR</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($cals['main'][0]['id'] == 0) { ?>
                        <tr>
                          <td colspan="7" class="tac">Tiada Maklumat</td>
                        </tr>
                      <?php } else { ?>
                        <?php if ($cals['calc_type'] == 1) { ?>
                          <?php foreach ($cals['out'] as $row) { ?>
                            <tr>
                              <td style="width:30%"><?= $row['title'] ?></td>
                              <td style="text-align: right;width:15%"><?= $row["breadth"] ?></td>
                              <td style="width:10%">
                                <?php if ($row["breadthtype"] == "mp") {
                                  echo "mp";
                                } elseif ($row["breadthtype"] == "ft") {
                                  echo "ft";
                                } elseif ($row["breadthtype"] == "unit") {
                                  echo "unit";
                                } elseif ($row["breadthtype"] == "petak") {
                                  echo "petak";
                                }  ?>
                              </td>
                              <td style="text-align: center;width:2%">X</td>
                              <td style="text-align: right;width:15%">RM <?= $row['price'] ?></td>
                              <td style="width:10%">
                                <?php if ($row["pricetype"] == "smp") {
                                  echo "smp";
                                } elseif ($row["pricetype"] == "sft") {
                                  echo "sft";
                                } elseif ($row["pricetype"] == "p/unit") {
                                  echo "p/unit";
                                } elseif ($row["pricetype"] == "sepetak") {
                                  echo "sepetak";
                                }  ?>
                              </td>
                              <td style="text-align: right;width:18%" class="control-label tal bold">
                                <?= "RM " . number_format($row['total'], 2); ?></td>
                            </tr>
                      <?php }
                        }
                      }  ?>
                    </tbody>
                  </table>
                <?php } ?>
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr style="background: #ddd;">
                      <th colspan="6">PENGIRAAN</th>
                    </tr>
                  </thead>
                  <?php if ($cals['calc_type'] == 1) { ?>
                    <tbody>
                      <tr>
                        <td style="width:80%" colspan="2"><strong>ANGGARAN SEWA BULANAN</strong></td>
                        <td style="width:18%">
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['capital_rental'], 2); ?>
                          </div>
                        </td>
                      </tr>
                      <?php if ($cals['corner'] == true) { ?>
                        <tr>
                          <td style="width:65%"><strong>CORNER LOT</strong></td>
                          <td>10%</td>
                          <td style="width:18%">
                            <div class="control-label tal bold">
                              <?php
                              echo "RM " . number_format($cals['capital_rental'] + ($cals['capital_rental'] / 100 * 10), 2);
                              ?>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="2"><strong>SEWA BULANAN DIGENAPKAN</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['round'], 2); ?></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['yearly'], 2); ?></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>KADAR</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= $cals["rate"] . " %" ?></div>
                        </td>
                      </tr>
                      <tr style="background: #ebebeb;">
                        <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['tax'], 2); ?></div>
                        </td>
                      </tr>
                    </tbody>
                  <?php } else { ?>
                    <tbody>
                      <tr>
                        <td style="width:80%" colspan="2"><strong>NILAI MODAL</strong></td>
                        <td style="width:18%">
                          <div class="control-label tal bold">
                            <?= "RM " . number_format($cals['capital_rental'], 2); ?>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>(SEKSYEN 2 AKTA 171, 10%)</strong></td>
                        <td style="width: 2%; text-align:center;">
                          <strong>X</strong>
                        </td>
                        <td class="control-label tal bold">
                          10%
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['yearly'], 2); ?></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>NILAI TAHUNAN (DIGENABKAN)</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['round'], 2); ?></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>KADAR</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= $cals["rate"] . " %" ?></div>
                        </td>
                      </tr>
                      <tr style="background: #ebebeb;">
                        <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                        <td>
                          <div class="control-label tal bold"><?= "RM " . number_format($cals['tax'], 2); ?></div>
                        </td>
                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <!-- End .row -->
    </div>
    <!-- End .page-content-inner -->
  </div>
  <!-- / page-content-wrapper -->
</div>

<div class="modal" id="peta_popup">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div id="mapViewEdit" class="mapView"></div>
      </div>
    </div>
  </div>
</div>