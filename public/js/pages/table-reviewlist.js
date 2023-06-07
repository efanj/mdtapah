$(document).ready(function () {
  $("#print").click(function () {
    var url = config.root + "Printing/dataserahannilaiansemula/"
    window.open(url, "_blank")
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
  var table = $("#reviewlists").DataTable({
    scrollY: "60vh",
    scrollCollapse: true,
    pageLength: 50,
    lengthMenu: [
      [50, 100, 200, 500],
      [50, 100, 200, 500]
    ],
    select: "single",
    processing: true,
    serverSide: true,
    searching: true,
    order: [],
    serverMethod: "post",
    ajax: "getReviewTable",
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
            data = '<a href="../Amendment/viewamendPSdetail/' + row.noSiri + '" class="btn btn-primary btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye color-dark"></i></a>'
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

  $("#reviewlists").css("font-size", 13)

  // $("#filter").click(function () {
  //   var area = $("#area").val()
  //   var street = $("#street").val()
  //   if (area != "" && street != "") {
  //     $("#reviewlists").DataTable().destroy()
  //     table.draw()
  //   } else {
  //     alert("Select Both filter option")
  //     $("#reviewlists").DataTable().destroy()
  //     table.draw()
  //   }
  // })

  // $("#area").change(function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "../Elements/street",
  //     data: { area: $(this).val() },
  //     success: function (data) {
  //       var len = data.length

  //       $("#street").empty()
  //       var rows = "<option selected value=''>Sila Pilih Jalan</option>"
  //       for (var i = 0; i < len; i++) {
  //         var id = data[i]["jln_jlkod"]
  //         var name = data[i]["jln_jnama"]
  //         rows += "<option value='" + id + "'>" + name + "</option>"
  //       }
  //       $("#street").append(rows)
  //     }
  //   })
  // })
})
