<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6">
          <?php $hacmjb = $this->controller->informations->getReviewSubmitInfo($fileId); ?>
          <?php $imgs = $this->controller->informations->getAllImgs($fileId); ?>
          <?php $docs = $this->controller->informations->getAllDocs($fileId); ?>
          <?php $cals = $this->controller->informations->getCalcInfo(Encryption::encryptId($hacmjb['siriNo'])); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MAKLUMAT NILAIAN SEMULA PEGANGAN</h4>
            </div>
            <div class="panel-body" style="font-size:13px;">
              <div id="reviewps" class="bwizard">
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
                  <li>
                    <a href="#tab3" data-toggle="tab">
                      <span class="step-number">3</span>
                      <span class="step-text">Gambar</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab4" data-toggle="tab">
                      <span class="step-number">4</span>
                      <span class="step-text">Dokumen</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="reviewPS" method="post">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["smk_akaun"] ?>
                          <input type="hidden" name="mjbAkaun" id="mjbAkaun" value="<?= $hacmjb["smk_akaun"] ?>" />
                          <input type="hidden" name="mjbDigit" id="mjbDigit" value="" />
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                          <label class="control-label">No. Siri :</label>
                        </div>
                        <div class="col-md-1 control-label tal">-</div>
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
                            <input type="checkbox" id="dummy_mjb_Stcbk" <?php if ($hacmjb["peg_stcbk"] === "Y") {
                                                                          echo "checked";
                                                                        } ?>disabled>
                            <label for="dummy_mjb_Stcbk"></label>
                          </div>
                          <input type="hidden" id="mjb_stcbk" name="mjbStcbk" value="<?= $hacmjb["peg_stcbk"] ?>">
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
                          <input type="hidden" value="<?= $hacmjb["kaw_kwkod"] ?>" name="kawKwkod" id="kawKwkod">
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
                          <?php $htanah = $this->controller->elements->htanah(); ?>
                          <select class="form-control input-sm select2" name="mjbThkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($htanah as $row) { ?>
                            <option <?php if ($row["tnh_thkod"] == $hacmjb["thkod"]) {
                                        echo "selected";
                                      } ?> value="<?= $row["tnh_thkod"] ?>"><?= $row["tnh_tnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Jenis Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hbangn = $this->controller->elements->hbangn(); ?>
                          <select class="form-control input-sm select2" name="mjbBgkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hbangn as $row) { ?>
                            <option <?php if ($row["bgn_bgkod"] == $hacmjb["bgkod"]) {
                                        echo "selected";
                                      } ?> value="<?= $row["bgn_bgkod"] ?>"><?= $row["bgn_bnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Hartanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hharta = $this->controller->elements->hharta(); ?>
                          <select class="form-control input-sm select2" id="mjb_htkod" name="mjbHtkod"
                            onchange="semakKadar(this.value)">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hharta as $row) { ?>
                            <option <?php if ($row["hrt_htkod"] == $hacmjb["htkod"]) {
                                        echo "selected";
                                      } ?> value="<?= $row["hrt_htkod"] ?>"><?= $row["hrt_hnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Struktur Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hstbgn = $this->controller->elements->hstbgn(); ?>
                          <select class="form-control input-sm select2" name="mjbStkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hstbgn as $row) { ?>
                            <option <?php if ($row["stb_stkod"] == $hacmjb["stkod"]) {
                                        echo "selected";
                                      } ?> value="<?= $row["stb_stkod"] ?>"><?= $row["stb_snama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="row mb10">
                        <div class="col-md-2">
                          <label class="control-label">Jenis Pemilik :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["jpk_jnama"] ?>
                          <input type="hidden" name="mjbJpkod" value="<?= $hacmjb["peg_jpkod"] ?>">
                        </div>
                      </div>
                      <div class="row mb15">
                        <div class="col-md-2">
                          <label class="control-label">Koordinat (X) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codex"><?= $hacmjb["codex"] ?></div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Koordinat (Y) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codey"><?= $hacmjb["codey"] ?></div>
                          <button class="btn btn-primary btn-xs" type="button" data-toggle="modal"
                            data-target="#peta_popup">Lokasi</button>
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
                        <div class="col-md-2 control-label tal"></div>
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
                          <label class="control-label">Luas Bangunan Tamb. :</label>
                        </div>
                        <div class="col-md-2 control-label tal">
                          <span id="mjb_lsbgntb"><?= $hacmjb["lsbgnt"] ?></span> m&sup2;
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Tanah :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lstnh"] ?> m&sup2;</div>
                      </div>
                      <div class="row mb10">
                        <div class="col-md-2">
                          <label class="control-label">Luas Ansolari :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lsans"] ?> m&sup2;</div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Ansolari Tamb. :</label>
                        </div>
                        <div class="col-md-2 control-label tal">
                          <span id="mjb_lsanstb"><?= $hacmjb["lsanst"] ?></span> m&sup2;
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Catatan :</label>
                        </div>
                        <div class="col-md-10">
                          <textarea class="form-control" name="mjbMesej" cols="30"
                            rows="3"><?= $hacmjb["catatan"] ?></textarea>
                        </div>
                      </div>
                      <div class="row mt10 mb10">
                        <div class="col-md-2">
                          <label class="control-label tal"></label>
                        </div>
                        <div class="col-md-4 tal"></div>
                        <div class="col-md-2">
                          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="row gallery sortable-layout">
                        <?php foreach ($imgs as $file) { ?>
                        <div class="col-xs-12 col-md-4 imagePanel">
                          <div class="panel panel-default plain">
                            <div class="panel-heading">
                              <h4 class="panel-title"><strong><?= $file["filename"] ?></strong><br>
                                <small><?= $file["description"] ?></small>
                              </h4>
                            </div>
                            <div class="panel-body">
                              <a href="<?= PUBLIC_ROOT ?>img/big-lightgallry/<?= $file["hashed_filename"] ?>"
                                data-toggle="lightbox" data-gallery="gallerymode" data-title="<?= $file["filename"] ?>"
                                data-parrent>
                                <img class="img-responsive"
                                  src="<?= PUBLIC_ROOT ?>img/thumb-lightgallry/<?= $file["hashed_filename"] ?>"
                                  alt="<?= $file["filename"] ?>"
                                  style="height:auto; width: 100%; max-height:250px; max-width:250px">
                              </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab4">
                      <div class="row gallery sortable-layout">
                        <?php foreach ($docs as $doc) { ?>
                        <div class="col-xs-12 col-md-4 docPanel">
                          <div class="panel panel-default plain">
                            <div class="panel-heading">
                              <h4 class="panel-title"><strong><?= $doc["filename"] ?></strong><br>
                                <small><?= $doc["description"] ?></small>
                              </h4>
                              <?php if ($doc["extension"] == "pdf") { ?>
                              <div class="btn-group" role="group">
                                <a href="<?= PUBLIC_ROOT ?>img/documents/<?= $doc["hashed_filename"] . "." . $doc["extension"] ?>"
                                  class="btn btn-primary btn-sm view-pdf"><i class="fa fa-eye"></i> Papar
                                </a>
                              </div>
                              <?php } ?>
                            </div>
                            <div class="panel-body">
                              <?php if ($doc["extension"] == "pdf") { ?>
                              <embed
                                src="<?= PUBLIC_ROOT ?>img/documents/<?= $doc["hashed_filename"] . "." . $doc["extension"] ?>"
                                type="application/pdf" width='100%' height='250px'>
                              <?php } elseif ($doc["extension"] == "doc" || $doc["extension"] == "docx" || $doc["extension"] == "ppt" || $doc["extension"] == "pptx") { ?>
                              <iframe
                                src='https://view.officeapps.live.com/op/embed.aspx?src=<?= PUBLIC_ROOT ?>img/documents/<?= $doc["hashed_filename"] . "." . $doc["extension"] ?>'
                                frameborder='0' width='100%' height='250px'></iframe>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </form>
                <ul class="pager">
                  <li class="previous"><a href="#">&larr; Sebelumnya</a>
                  </li>
                  <li class="next"><a href="#">Seterusnya &rarr;</a>
                  </li>
                  <li class="next finish" style="display:none;"><a href="#" class="submit">Jadual B</a> <a href="#"
                      class="pending">Semak Semula</a>
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
                    <th colspan="6">TANAH</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($cals['land']["total"] == "0" || $cals['land']["total"] == "0.00") { ?>
                  <tr>
                    <td colspan="6" class="tac">Tiada Maklumat</td>
                  </tr>
                  <?php } else { ?>
                  <tr>
                    <td><?= $cals['land']["breadth"] ?></td>
                    <td>mp</td>
                    <td>X</td>
                    <td><?= $cals['land']["price"] ?></td>
                    <td>smp</td>
                    <td><?= $cals['land']["total"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr style="background: #ddd;">
                    <th colspan="7">BANGUNAN UTAMA</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($cals['mfa'][0]['id'] == 0) { ?>
                  <tr>
                    <td colspan="7" class="tac">Tiada Maklumat</td>
                  </tr>
                  <?php } else { ?>
                  <?php foreach ($cals['mfa'] as $section) { ?>
                  <?php if (!empty($section['title'])) { ?>
                  <tr>
                    <td colspan="7"><?= $section['title'] ?></td>
                  </tr>
                  <?php } ?>
                  <?php foreach ($section['items'] as $row) { ?>
                  <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row["breadth"] ?></td>
                    <td>
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
                    <td><?= $row['price'] ?>"></td>
                    <td>
                      <?php if ($row["breadthtype"] == "smp") {
                                echo "smp";
                              } elseif ($row["breadthtype"] == "sft") {
                                echo "sft";
                              } elseif ($row["breadthtype"] == "p/unit") {
                                echo "p/unit";
                              } elseif ($row["breadthtype"] == "sepetak") {
                                echo "sepetak";
                              }  ?>
                    </td>
                    <td><?= $row['total'] ?></td>
                  </tr>
                  <?php }
                      }
                    } ?>
                </tbody>
              </table>
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr style="background: #ddd;">
                    <th colspan="7">BANGUNAN LUAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($cals['afa'][0]['id'] == 0) { ?>
                  <tr>
                    <td colspan="7" class="tac">Tiada Maklumat</td>
                  </tr>
                  <?php } else { ?>
                  <?php foreach ($cals['afa'] as $section2) { ?>
                  <?php if (!empty($section2['title'])) { ?>
                  <tr>
                    <td colspan="7"><?= $section2['title'] ?></td>
                  </tr>
                  <?php } ?>
                  <?php foreach ($section2['items'] as $row) { ?>
                  <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row["breadth"] ?></td>
                    <td>
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
                    <td><?= $row['price'] ?>"></td>
                    <td>
                      <?php if ($row["breadthtype"] == "smp") {
                                echo "smp";
                              } elseif ($row["breadthtype"] == "sft") {
                                echo "sft";
                              } elseif ($row["breadthtype"] == "p/unit") {
                                echo "p/unit";
                              } elseif ($row["breadthtype"] == "sepetak") {
                                echo "sepetak";
                              }  ?>
                    </td>
                    <td><?= $row['total'] ?></td>
                  </tr>
                  <?php }
                      }
                    } ?>
                </tbody>
              </table>
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr style="background: #ddd;">
                    <th colspan="6">PENGIRAAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="width:80%" colspan="2"><strong>ANGGARAN SEWA BULANAN</strong></td>
                    <td style="width:20%"><?= "RM " . $cals['rental']; ?></td>
                  </tr>
                  <tr>
                    <td style="width:65%"><strong>CORNER LOT</strong></td>
                    <td><?= $cals['discount'] . " %"; ?></td>
                    <td><?php if ($cals['discount'] < 1) {
                            echo "RM " . $cals['rental'];
                          } else if ($cals['discount'] == "" || $cals['discount'] == 0 || $cals['discount'] >= 1) {
                            echo "RM " . $cals['rental'] - ($cals['rental'] * ($cals['discount'] / 100));
                          }
                          ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>SEWA BULANAN DIGENAPKAN</strong></td>
                    <td><?= "RM " . $cals['even']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>TEMPOH TAHUNAN</strong></td>
                    <td>X 12 BULAN</td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                    <td>RM <?= $cals['yearly_price']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>KADAR</strong></td>
                    <td><?= $cals["rate"] . " %" ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                    <td><strong>RM</strong> <?= $cals["assessment_tax"] ?></td>
                  </tr>
                </tbody>
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