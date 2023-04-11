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
                  <h4 class="ml15">SENARAI JADUAL (Jadual A, Jadual B Dan Jadual C)</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <button class="btn btn-default btn-sm mt5 mr15" id="print"><i
                      class="glyphicon glyphicon-print"></i></button>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="amendlists" class="table table-bordered display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Jadual</th>
                      <th>
                        No. Akaun<br />
                        No. Siri
                      </th>
                      <th>
                        Tarikh Mesyuarat<br />
                        Tarikh Kuatkuasa
                      </th>
                      <th>
                        Kegunaan Tanah<br />
                        Jenis Bangunan<br />
                        Kegunaan Hartanah<br />
                        Struktur Bangunan
                      </th>
                      <th>
                        Nilai Tahunan Asal(RM)<br />
                        Kadar Tahunan Asal(RM)<br />
                        Cukai Taksiran Asal(RM)
                      </th>
                      <th>
                        Nilai Tahunan Baru(RM)<br />
                        Kadar Tahunan Baru(RM)<br />
                        Cukai Taksiran Baru(RM)
                      </th>
                      <th>Perbezaan</th>
                      <th>Sebab-Sebab / Catatan</th>
                      <th>Status Pengesahan</th>
                      <th>
                        Pegawai Pendaftar<br />
                        Pegawai Pengesah
                      </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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