<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $info = $this->controller->informations->getReviewInfoById($reviewId); ?>
      <?php $i = $this->controller->informations->getAcctInfo($info["smk_akaun"]); ?>
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>KEMAS KINI DATA SEMAKAN</h4>
            </div>
            <div class="panel-body">
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr>
                    <th colspan="6">MAKLUMAT DATA SEMAKAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="17%"><strong>ID Pemilik :</strong></td>
                    <td width="17%"><?= $info["pmk_plgid"] ?></td>
                    <td width="17%"><strong>Nama Dibil :</strong></td>
                    <td width="17%" colspan="3"><?= $info["pmk_nmbil"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>No. Akaun :</strong></td>
                    <td><?= $info["smk_akaun"] ?></td>
                    <td><strong>No. Lot :</strong></td>
                    <td><?= $info["peg_nolot"] ?></td>
                    <td width="17%"><strong>No. PT :</strong></td>
                    <td width="17%"><?= $info["peg_nompt"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat :</strong></td>
                    <td colspan="5">
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
                    <td><strong>Kegunaan Tanah :</strong></td>
                    <td colspan="2"><?= $info["tnh_tnama"] ?></td>
                    <td><strong>Jenis Bangunan :</strong></td>
                    <td colspan="2"><?= $info["bgn_bnama"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kegunaan Hartanah :</strong></td>
                    <td colspan="2"><?= $info["hrt_hnama"] ?></td>
                    <td><strong>Struktur Bangunan :</strong></td>
                    <td colspan="2"><?= $info["stb_snama"] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nilai Tahunan :</strong></td>
                    <td><?= "RM " . number_format($info["nilth_asal"], 2) ?></td>
                    <td><strong>Kadar :</strong></td>
                    <td><?= $info["kadar_asal"] . " %" ?></td>
                    <td><strong>Cukai Tahunan :</strong></td>
                    <td><?= "RM " . number_format($info["cukai_asal"], 2) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Luas Tanah :</strong></td>
                    <td><?= $info["lstnh"] . " mp" ?></td>
                    <td><strong>Luas Bangunan :</strong></td>
                    <td><?= $info["lsbgn"] . " mp" ?></td>
                    <td><strong>Luas Ansolari :</strong></td>
                    <td><?= $info["lsans"] . " mp" ?></td>
                  </tr>
                </tbody>
              </table>

              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr>
                    <th colspan="5">KEMAS KINI KELUASAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <form class="form-inline" method="post" id="form-edit-area" role="form">
                        <div class="form-group">
                          <label for="lsbgn_tamb">Luas Bangunan Tamb. :</label>
                          <div class="input-group">
                            <input class="form-control input-sm" type="number" name="lsbgn_tamb" id="lsbgn_tamb" min="0" value="<?= $info["lsbgnt"] ?>" step="any">
                            <span class="input-group-addon">mp</span>
                          </div>
                          <input type="hidden" value="<?= $info["pid"] ?>" name="pindaan_id">
                          <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                        </div>
                        <div class="form-group ml20">
                          <label for="lsans_tamb">Luas Ansolari Tamb. :</label>
                          <div class="input-group">
                            <input class="form-control input-sm" type="number" name="lsans_tamb" id="lsans_tamb" min="0" value="<?= $info["lsanst"] ?>" step="any">
                            <span class="input-group-addon">mp</span>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-square btn-primary btn-sm ml20"><i class="icon-save"></i>
                          Simpan Rekod</button>
                      </form>
                    </td>
                  <tr>
                </tbody>
              </table>
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr>
                    <th colspan="3">KEMAS KINI CATATAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <form class="form-inline" method="post" id="form-edit-note" role="form">
                        <div class="form-group">
                          <label for="catatan">Catatan :</label>
                          <textarea class="form-control limitTextarea" maxlength="250" rows="3" name="catatan" id="catatan" style="width: 620px; height: 60px;"><?= $info['catatan'] ?></textarea>
                          <input type="hidden" value="<?= $info["pid"] ?>" name="pindaan_id">
                          <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                        </div>
                        <button type="submit" class="btn btn-square btn-primary btn-sm ml20"><i class="icon-save"></i>
                          Simpan Rekod</button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                <thead>
                  <tr>
                    <th colspan="2">KEMAS KINI KOORDINAT DAN KELUASAN ASAL(ePBT)</th>
                  </tr>
                </thead>
                <tbody>
                  <form class="form-horizontal" method="post" id="form-edit-coordinate" role="form">
                    <tr>
                      <td>
                        <div class="form-group">
                          <div class="col-lg-12">
                            <div class="row">
                              <!-- Start .row -->
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="codex">koordinat X :</label>
                                <input class="form-control input-sm" type="text" value="<?= $info["codex"] ?>" name="codex" id="codex" style="width: 250px;" required>
                                <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                                <input type="hidden" value="<?= $info["smk_akaun"] ?>" name="no_akaun">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="codey">koordinat Y :</label>
                                <input class="form-control input-sm" type="text" value="<?= $info["codey"] ?>" name="codey" id="codey" style="width: 250px;" required>
                              </div>
                            </div>
                            <!-- End .row -->
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <div class="col-lg-12">
                            <div class="row">
                              <!-- Start .row -->
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label for="lsbgn_tamb">Luas Tanah :</label>
                                <div class="input-group">
                                  <input class="form-control input-sm" type="number" name="lstnh" id="lstnh" min="0" value="<?= $i["peg_lstnh"] ?>" step="any">
                                  <span class="input-group-addon">mp</span>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label for="lsbgn_tamb">Luas Bangunan :</label>
                                <div class="input-group">
                                  <input class="form-control input-sm" type="number" name="lsbgn" id="lsbgn" min="0" value="<?= $i["peg_lsbgn"] ?>" step="any">
                                  <span class="input-group-addon">mp</span>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label for="lsans_tamb">Luas Ansolari :</label>
                                <div class="input-group">
                                  <input class="form-control input-sm" type="number" name="lsans" id="lsans" min="0" value="<?= $i["peg_lsans"] ?>" step="any">
                                  <span class="input-group-addon">mp</span>
                                </div>
                              </div>
                            </div>
                            <!-- End .row -->
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group">
                          <div class="col-lg-12">
                            <div class="row">
                              <!-- Start .row -->
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                <button type="submit" class="btn btn-square btn-primary btn-sm ml20"><i class="icon-save"></i>
                                  Simpan Rekod</button>
                              </div>
                            </div>
                            <!-- End .row -->
                          </div>
                        </div>
                      </td>
                    </tr>
                  </form>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div id="mapView" class="mapView"></div>
          <div class="google" width="50%">
            <input type="text" class="form-control input-sm" id="google_term">
          </div>
        </div>
      </div>
    </div>
    <!-- End .row -->
  </div>
  <!-- End .page-content-inner -->
</div>