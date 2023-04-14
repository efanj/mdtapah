<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $info = $this->controller->informations->getReviewAcctInfo($reviewId); ?>
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
                    <td width="17%"><?= $info["pmk_nmbil"] ?></td>
                    <td width="17%" colspan="2"></td>
                  </tr>
                  <tr>
                    <td><strong>No. Akaun :</strong></td>
                    <td><?= $info["smk_akaun"] ?></td>
                    <td><strong>No. Lot :</strong></td>
                    <td><?= $info["peg_nolot"] ?></td>
                    <td><strong>No. PT :</strong></td>
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
                    <td><?= $info["tnh_tnama"] ?></td>
                    <td><strong>Jenis Bangunan :</strong></td>
                    <td><?= $info["bgn_bnama"] ?></td>
                    <td colspan="2"></td>
                  </tr>
                  <tr>
                    <td><strong>Kegunaan Hartanah :</strong></td>
                    <td><?= $info["hrt_hnama"] ?></td>
                    <td><strong>Struktur Bangunan :</strong></td>
                    <td><?= $info["stb_snama"] ?></td>
                    <td colspan="2"></td>
                  </tr>
                  <tr>
                    <td><strong>Nilai Tahunan :</strong></td>
                    <td><?= "RM " . number_format($info["peg_nilth"], 2) ?></td>
                    <td><strong>Kadar :</strong></td>
                    <td><?= $info["kaw_kadar"] . " %" ?></td>
                    <td><strong>Cukai Tahunan :</strong></td>
                    <td><?= "RM " . number_format($info["peg_nilth"], 2) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Luas Tanah :</strong></td>
                    <td><?= $info["peg_lstnh"] ?></td>
                    <td><strong>Luas Bangunan :</strong></td>
                    <td><?= $info["peg_lsbgn"] ?></td>
                    <td><strong>Luas Ansolari :</strong></td>
                    <td><?= $info["peg_lsans"] ?></td>
                  </tr>
                </tbody>
              </table>
              <form method="post" id="form-edit-area">
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr>
                      <th colspan="5">KEMAS KINI KELUASAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>Luas Bangunan Tamb. :</strong></td>
                      <td>
                        <input class="form-control input-sm" type="number" name="lsbgn_tamb" min="0" value="<?= $info["lsbgnt"] ?>" step="any">
                        <input type="hidden" value="<?= $info["pid"] ?>" name="pindaan_id">
                        <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                      </td>
                      <td><strong>Luas Ansolari Tamb. :</strong></td>
                      <td><input class="form-control input-sm" type="number" name="lsans_tamb" min="0" value="<?= $info["lsanst"] ?>" step="any"></td>
                      <td width="50px"><button type="submit" class="btn btn-square btn-primary btn-sm"><i class="icon-save"></i>
                          Simpan Rekod</button></td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <form method="post" id="form-edit-note">
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr>
                      <th colspan="3">KEMAS KINI CATATAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="100px"><strong>Catatan :</strong></td>
                      <td>
                        <textarea class="form-control limitTextarea" maxlength="250" rows="3" name="catatan" id="catatan"><?= $info['catatan'] ?></textarea>
                        <input type="hidden" value="<?= $info["pid"] ?>" name="pindaan_id">
                        <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                      </td>
                      <td width="50px"><button type="submit" class="btn btn-square btn-primary btn-sm"><i class="icon-save"></i>
                          Simpan Rekod</button></td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <form method="post" id="form-edit-coordinate">
                <table class="table table-bordered mb20" style="width:100%; font-size:12px;">
                  <thead>
                    <tr>
                      <th colspan="5">KEMAS KINI KOORDINAT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>koordinat X :</strong></td>
                      <td>
                        <input class="form-control input-sm" type="text" value="<?= $info["codex"] ?>" name="codex" id="codex" required>
                        <input type="hidden" value="<?= $info["sid"] ?>" name="smk_id">
                        <input type="hidden" value="<?= $info["smk_akaun"] ?>" name="no_akaun">
                      </td>
                      <td><strong>koordinat Y :</strong></td>
                      <td><input class="form-control input-sm" type="text" value="<?= $info["codey"] ?>" name="codey" id="codey" required></td>
                      <td width="50px"><button type="submit" class="btn btn-square btn-primary btn-sm"><i class="icon-save"></i>
                          Simpan Rekod</button></td>
                    </tr>
                  </tbody>
                </table>
              </form>
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