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
                    <button type="button" class="btn btn-default btn-xs" id="print_submit" disabled><i class="glyphicon glyphicon-print"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" id="delete" disabled><i class="glyphicon glyphicon-trash"></i></button>
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
              <div class="table-responsive">
                <form role="form" id="form-verifylists">
                  <table id="submitsitereview" class="display" style="width:100%;">
                    <thead>
                      <tr>
                        <th rowspan="2">Akaun</th>
                        <th rowspan="2">Nama Pemilik & Alamat Harta</th>
                        <th rowspan="2">No Lot</br>No PT</br>Hakmilik</th>
                        <th rowspan="2">Luas Tanah Asal<br />Luas Bgn Asal<br />Luas Ans Asal</th>
                        <th rowspan="2">Luas Bgn Tamb.</br>Luas Ans Tamb.</th>
                        <th rowspan="2">Catatan Hadapan <br /> Catatan Belakang</th>
                        <th colspan="3" style="text-align:center;">Berkaitan</th>
                        <th rowspan="2">Status</th>
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