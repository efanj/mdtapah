<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>KEMASUKKAN AKAUN BARU</h4>
            </div>
            <div class="panel-body">
              <form id="form-akaunbaru-desktop" class="form-horizontal" role="form">
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="plgid" class="control-label">No.IC / Daftar Syarikat :</label>
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control input-sm" id="plgid" name="plgid">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#customer_popup"><i class="fa fa-book"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="nmbil" class="control-label">Nama Dibil :</label>
                        <input class="form-control input-sm" type="text" value="" name="nmbil" id="nmbil">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="noAkaun" class="control-label">No. Akaun :</label>
                        <input class="form-control input-sm" type="text" value="" name="noAkaun" id="noAkaun" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="noLot" class="control-label">No. Lot :</label>
                        <input class="form-control input-sm" type="text" value="" name="noLot" id="noLot">
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="noPT" class="control-label">No. PT :</label>
                        <input class="form-control input-sm" type="text" value="" name="noPT" id="noPT">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="adpg1" class="control-label">Alamat</label>
                        <input type="text" class="form-control input-sm round" name="adpg1" id="adpg1" value="" />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="adpg2" class="control-label">Alamat</label>
                        <input type="text" class="form-control input-sm round" name="adpg2" id="adpg2" value="" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="dummy_jlkod" class="control-label">Jalan</label>
                        <div class="input-group input-group-sm">
                          <input type="hidden" class="form-control input-sm" id="jlkod" name="jlkod">
                          <input type="text" class="form-control input-sm" id="dummy_jlkod">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#street_popup"><i class="fa fa-book"></i></button>
                          </span>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="kwname" class="control-label">Kawasan</label>
                        <input type="hidden" name="kwkod" id="kawKwkod">
                        <input class="form-control input-sm" type="text" value="" id="kwname" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="thkod" class="control-label">Kegunaan Tanah</label>
                        <?php $htanah = $this->controller->elements->htanah(); ?>
                        <select class="form-control input-sm" name="thkod" id="thkod">
                          <option value="" selected>Sila Pilih</option>
                          <?php foreach ($htanah as $row) { ?>
                            <option value="<?= $row["tnh_thkod"] ?>"><?= $row["tnh_tnama"] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="bgkod" class="control-label">Jenis Bangunan</label>
                        <?php $hbangn = $this->controller->elements->hbangn(); ?>
                        <select class="form-control input-sm" name="bgkod" id="bgkod">
                          <option value="" selected>Sila Pilih</option>
                          <?php foreach ($hbangn as $row) { ?>
                            <option value="<?= $row["bgn_bgkod"] ?>"><?= $row["bgn_bnama"] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="htkod" class="control-label">Kegunaan Hartanah</label>
                        <?php $hharta = $this->controller->elements->hharta(); ?>
                        <select class="form-control input-sm" name="htkod" id="htkod">
                          <option value="" selected>Sila Pilih</option>
                          <?php foreach ($hharta as $row) { ?>
                            <option value="<?= $row["hrt_htkod"] ?>"><?= $row["hrt_hnama"] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="stkod" class="control-label">Struktur Bangunan</label>
                        <?php $hstbgn = $this->controller->elements->hstbgn(); ?>
                        <select class="form-control input-sm" name="stkod" id="stkod">
                          <option value="" selected>Sila Pilih</option>
                          <?php foreach ($hstbgn as $row) { ?>
                            <option value="<?= $row["stb_stkod"] ?>"><?= $row["stb_snama"] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="lstnh" class="control-label">Luas Tanah :</label>
                        <input class="form-control input-sm" type="number" value="" name="lstnh" id="lstnh" min="0" step="any">
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="lsbgn" class="control-label">Luas Bangunan :</label>
                        <input class="form-control input-sm" type="number" value="" name="lsbgn" id="lsbgn" min="0" step="any">
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="lsans" class="control-label">Luas Ansolari :</label>
                        <input class="form-control input-sm" type="number" value="" name="lsans" id="lsans" min="0" step="any">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codex" class="control-label">koordinat X :</label>
                        <input class="form-control input-sm" type="text" value="" name="codex" id="codex">
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codey" class="control-label">koordinat Y :</label>
                        <input class="form-control input-sm" type="text" value="" name="codey" id="codey">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <label for="catatan" class="control-label">Catatan :</label>
                    <textarea class="form-control limitTextarea" maxlength="250" rows="3" name="catatan" id="catatan"></textarea>
                  </div>
                </div>
                <div class="row mt20">
                  <div class="col-md-12 tar">
                    <button type="submit" class="btn btn-square btn-primary btn-sm" id="submit"><i class="fa fa-save"></i>
                      Simpan
                      Rekod</button>
                  </div>
                </div>
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

<div class="modal fade" id="street_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI JALAN</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_street" width="100%">
          <thead>
            <tr>
              <th>Kod Jalan</th>
              <th>Kod Kawasan</th>
              <th width="50%">Nama Jalan</th>
              <th width="10%">Poskod</th>
              <th width="30%">Nama Kawasan</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customer_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI PELANGGAN</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_customer" width="100%">
          <thead>
            <tr>
              <th>Pelanggan ID</th>
              <th>Nama Pelanggan</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customeraddress_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI ALAMAT</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_customeraddress" width="100%">
          <thead>
            <tr>
              <th>Pelanggan ID</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>