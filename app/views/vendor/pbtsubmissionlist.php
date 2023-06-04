<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $kws = $this->controller->elements->area(); ?>
      <div class="row">
        <div class="col-lg-3 col-sm-3 col-md-3">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml15">MAKLUMAT SERAHAN</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <div class="btn-group btn-group-xs mt10 mr10">
                    <button type="button" class="btn btn-default btn-xs" id="print_submit" disabled><i
                        class="glyphicon glyphicon-print"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" id="delete" disabled><i
                        class="glyphicon glyphicon-trash"></i></button>
                  </div>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <table id="submitdatereview" class="display" style="width:100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Rujukan</th>
                    <th>Tarikh</th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-sm-9 col-md-9">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>SENARAI SERAHAN NILAIAN SEMULA</h4>
            </div>
            <div class="panel-body">
              <input type="hidden" id="submitId" value="">
              <div class="table-responsive">
                <form role="form" id="form-verifylists">
                  <table id="submitsitereview" class="display" style="width:100%;font-size:10px;">
                    <thead>
                      <tr>
                        <th rowspan="2" style="width:3%;"></th>
                        <th rowspan="2" style="width:3%;">Akaun</th>
                        <th rowspan="2" style="width:20%;">Nama Pemilik & Alamat Harta</th>
                        <th rowspan="2" style="width:10%;">No Lot</br>No PT</br>Hakmilik</th>
                        <th rowspan="2" style="width:10%;">Luas Tanah Asal<br />Luas Bgn Asal<br />Luas Ans Asal</th>
                        <th rowspan="2" style="width:10%;">Luas Bgn Tamb.</br>Luas Ans Tamb.</th>
                        <th rowspan="2" style="width:15%;">Catatan Hadapan <br /> Catatan Belakang</th>
                        <th colspan="3" style="text-align:center;width:15%;">Berkaitan</th>
                        <th rowspan="2" style="width:5%;">*</th>
                      </tr>
                      <tr>
                        <th>Nilaian</th>
                        <th>Gambar</th>
                        <th>Dokumen</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="row mb15">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                      <button type="submit" class="btn btn-success btn-sm" id="accepted"><i
                          class="glyphicon glyphicon-ok"></i>
                        Serahan diterima</button>
                    </div>
                  </div>
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

<div class="modal fade" id="submit_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="form-submit-sitereview">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">SERAHAN DATA DITERIMA</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail6" class="col-sm-4 control-label">Tarikh Terima</label>
                <div class="col-sm-8">
                  <input type="hidden" id="submit_id" name="submit_id" value="">
                  <input type="text" class="form-control input-sm" id="tarikh" name="tarikh" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt5">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputPassword5" class="col-sm-12 control-label">Pilihan Data</label>
                <div class="col-sm-12">
                  <textarea class="form-control" rows="3" id="id" name="data" readonly></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Serah</button>
        </div>
      </form>
    </div>
  </div>
</div>