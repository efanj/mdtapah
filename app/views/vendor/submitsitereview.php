<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $kws = $this->controller->elements->area(); ?>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml15">MAKLUMAT SERAHAN SEMAKAN TAPAK (KESELURUHAN)</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <!-- <button class="btn btn-default btn-sm mt5 mr15" id="print_submit"><i class="glyphicon glyphicon-print"></i></button> -->
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6">
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 mb10 tar pr15">
                  <form class="form-inline" role="form">
                    <div class="form-group">
                      <select class="form-control input-sm" name="area" id="area">
                        <option selected value="">Sila Pilih Kawasan</option>
                        <?php foreach ($kws as $row) { ?>
                          <option value="<?= $row["kws_kwkod"] ?>"><?= $row["kws_knama"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control input-sm" name="street" id="street" style="width:100%">
                        <option selected value="">Sila Pilih Jalan</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="filter"><i class="fa  fa-search"></i>
                      Saring</button>
                    <!-- <button type="button" class="btn btn-info btn-sm btn-alt ml30" id="print"><i
                        class="fa fa-print"></i>
                      Cetak</button> -->
                  </form>
                </div>
              </div>
              <div class="table-responsive">
                <form role="form" id="form-verifylists">
                  <table id="submitsitereview" class="display" style="width:100%;">
                    <thead>
                      <tr>
                        <th></th>
                        <th>
                          No. Akaun <br />
                          No. Lot
                        </th>
                        <th>Nama Pemilik & Alamat Harta</th>
                        <th>Jenis Hartanah</th>
                        <th>
                          Luas Bangunan(mp) <br />
                          Luas Tanah(mp) <br />
                          Luas Ansolari(mp)
                        </th>
                        <th>
                          Luas Bgn Tamb.(mp) <br />
                          Luas Ans Tamb.(mp)
                        </th>
                        <th>
                          Catatan Hadapan <br />
                          Catatan Belakang
                        </th>
                        <th>Kiraan Nilaian</th>
                        <th>Gambar</th>
                        <th>Dokumen</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </form>
              </div>
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

<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="imageModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div class="row gallery sortable-layout"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="documentModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div class="row gallery sortable-layout"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>