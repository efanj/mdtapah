function format(d) {
  // `d` is the original data object for the row
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">' + "<tr><td><b>Sebab-sebab : </b></td></tr>" + "<tr><td><b>Sebab-sebab : </b></td></tr></table >"
}
var evaluation = $("#evaluationlist").DataTable({
  scrollY: "60vh",
  scrollCollapse: true,
  pageLength: 50,
  lengthMenu: [
    [50, 100, 200, 500],
    [50, 100, 200, 500]
  ],
  processing: true,
  serverSide: true,
  searching: true,
  serverMethod: "post",
  ajax: "evaluationtable",
  columnDefs: [
    {
      targets: 0,
      orderable: false,
      data: "form"
    },
    {
      targets: 1,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = row.no_akaun + "<br/>"
          data += row.no_siri
        }
        return data
      }
    },
    {
      targets: 2,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = row.tkhpl + "<br/>"
          data += row.tkhtk
        }
        return data
      }
    },
    {
      targets: 3,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = row.tnama + "<br/>"
          data += row.bnama + "<br/>"
          data += row.hnama + "<br/>"
          data += row.snama
        }
        return data
      }
    },
    {
      targets: 4,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = "RM " + row.nilth_asal + "<br/>"
          data += row.kadar_asal + " % <br/>"
          data += "RM " + row.cukai_asal
        }
        return data
      }
    },
    {
      targets: 5,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = "RM " + row.nilth_baru + "<br/>"
          data += row.kadar_baru + " % <br/>"
          data += "RM " + row.cukai_baru
        }
        return data
      }
    },
    {
      targets: 6,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = "RM " + row.nilth_beza + "<br/>"
          data += row.kadar_beza + " % <br/>"
          data += "RM " + row.cukai_beza
        }
        return data
      }
    },
    {
      targets: 7,
      orderable: false,
      className: "dt-body-center",
      data: null,
      render: function (data, type, row, meta) {
        // console.log(row.files)
        if (type === "display") {
          if (row.file > "0") {
            data = "Ada (" + row.file + ")</br>"
            for (let i = 0; i < row.files.length; i++) {
              data += '<a href="../img/big-lightgallry/' + row.files[i]["hashed_filename"] + '" data-toggle="lightbox" data-gallery="gallerymode" data-title="' + row.files[i]["filename"] + '" data-parrent>' + row.files[i]["filename"] + "</a></br>"
            }
          } else if (row.file < "1") {
            data = "Tiada"
          }
        }
        return data
      }
    },
    {
      targets: 8,
      orderable: false,
      className: "dt-body-center",
      data: null,
      render: function (data, type, row, meta) {
        // console.log(row.docs)
        if (type === "display") {
          if (row.doc > "0") {
            data = "Ada (" + row.doc + ")</br>"
            for (let i = 0; i < row.docs.length; i++) {
              data += "<a href=" + config.root + '"img/documents/' + row.docs[i]["hashed_filename"] + '"  class="view-pdf">' + row.docs[i]["extension"] + "</a></br>"
            }
            data += ""
          } else if (row.doc < "1") {
            data = "Tiada"
          }
        }
        return data
      }
    },
    {
      targets: 9,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = '<a href="viewamendPSdetail/' + row.noSiri + '" class="btn btn-primary btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye color-dark"></i></a>'
        }
        return data
      }
    }
  ],
  order: [[1, "asc"]],
  language: {
    search: "Saring : ",
    lengthMenu: "Paparkan _MENU_ rekod",
    zeroRecords: "Tiada maklumat yang dijumpai",
    info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
    infoEmpty: "Tiada rekod",
    infoFiltered: "(Ditapis daripada _MAX_ rekod)",
    paginate: {
      first: "Pertama",
      last: "Terakhir",
      next: "Seterus",
      previous: "Sebelum"
    }
  }
})

$(".view-pdf").on("click", function () {
  var pdf_link = $(this).attr("href")
  var iframe = '<object type="application/pdf" data="' + pdf_link + '" width="100%" height="500">No Support</object>'
  $.createModal({
    title: "Dokumen",
    message: iframe,
    closeButton: true,
    scrollable: false
  })
  return false
})

// Add event listener for opening and closing details
$("#evaluationlist tbody").on("click", "td.details-control", function () {
  var tr = $(this).closest("tr")
  var row = evaluation.row(tr)

  if (row.child.isShown()) {
    // This row is already open - close it
    row.child.hide()
    tr.removeClass("shown")
  } else {
    // Open this row
    row.child(format(row.data())).show()
    tr.addClass("shown")
  }
})
$("#evaluationlist tbody").css("font-size", 13)

$("#print_submit").click(function () {
  var url = config.root + "Printing/datanilaiansemula"
  window.open(url, "_blank")
})
