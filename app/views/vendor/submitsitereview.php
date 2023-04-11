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
                  <h4 class="ml15">MAKLUMAT SERAHAN SEMAKAN TAPAK</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <button class="btn btn-default btn-sm mt5 mr15" id="print_submit"><i class="glyphicon glyphicon-print"></i></button>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <form role="form" id="form-verifylists">
                  <table id="submitsitereview" class="display" style="width:100%;">
                    <thead>
                      <tr>
                        <th></th>
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
                  <div class="row mb15">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                      <button type="submit" class="btn btn-success btn-sm" id="accepted"><i class="glyphicon glyphicon-ok"></i>
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