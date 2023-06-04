$(document).ready(function () {
  $("#tarikh").datepicker()

  $("#print_submit").click(function () {
    var url = config.root + "Printing/dataserahannilaiansemula/"
    window.open(url, "_blank")
  })

  $(document).delegate('*[data-toggle="lightbox"]', "click", function (event) {
    event.preventDefault()
    $(this).ekkoLightbox()
  })

  function format(d) {
    // `d` is the original data object for the row
    return (
      '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">' +
      "<tr>" +
      "<td width='10%' style='background-color: #f4f5f5;'><b>Nama Bil:</b></td>" +
      "<td width='15%'>" +
      d.pmk_nmbil +
      "</td>" +
      "<td width='10%' style='background-color: #f4f5f5;'><b>ID/No. Syarikat:</b></td>" +
      "<td width='15%'>" +
      d.pmk_plgid +
      "</td>" +
      "<td width='10%' style='background-color: #f4f5f5;'><b>No. Hakmilik:</b></td>" +
      "<td width='15%'>" +
      d.pmk_hkmlk +
      "</td>" +
      "<td width='10%' style='background-color: #f4f5f5;'><b>No. PT:</b></td>" +
      "<td width='15%'>" +
      d.smk_nompt +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>Alamat:</b></td>" +
      "<td>" +
      d.smk_adpg1 +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Alamat:</b></td>" +
      "<td>" +
      d.smk_adpg2 +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Alamat:</b></td>" +
      "<td>" +
      d.smk_adpg3 +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Alamat:</b></td>" +
      "<td>" +
      d.smk_adpg4 +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>Jalan:</b></td>" +
      "<td>" +
      d.jln_jnama +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Kawasan:</b></td>" +
      "<td>" +
      d.jln_kname +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Koordinat X:</b></td>" +
      "<td>" +
      d.smk_codex +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Koordinat Y:</b></td>" +
      "<td>" +
      d.smk_codey +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>No. Pelan:</b></td>" +
      "<td>" +
      d.peg_pelan +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Rujukan MMK:</b></td>" +
      "<td>" +
      d.peg_rjmmk +
      "</td>" +
      "<td style='background-color: #f4f5f5;'></td>" +
      "<td></td>" +
      "<td style='background-color: #f4f5f5;'></td>" +
      "<td></td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>Kegunaan Tanah:</b></td>" +
      "<td>" +
      d.tnh_tnama +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Jenis Bangunan:</b></td>" +
      "<td>" +
      d.bgn_bnama +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Kegunaan Hartanah:</b></td>" +
      "<td>" +
      d.hrt_hnama +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Struktur Bangunan:</b></td>" +
      "<td>" +
      d.stb_snama +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>Nilai Tahunan:</b></td>" +
      "<td>RM " +
      d.peg_nilth +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Kadar:</b></td>" +
      "<td>" +
      d.kaw_kadar +
      "%</td>" +
      "<td style='background-color: #f4f5f5;'><b>Cukai Tahunan:</b></td>" +
      "<td>RM " +
      d.peg_tksir +
      "</td>" +
      "<td style='background-color: #f4f5f5;'></td>" +
      "<td>" +
      "</td>" +
      "</tr>" +
      "</table>"
    )
  }

  var table = $("#submitsitereview").DataTable({
    scrollY: "50vh",
    scrollCollapse: true,
    pageLength: 50,
    lengthMenu: [
      [50, 100, 500, 1000],
      [50, 100, 500, 1000]
    ],
    processing: true,
    serverSide: true,
    searching: true,
    order: [],
    ajax: {
      url: "submitpbtsitereview",
      type: "POST",
      data: function (d) {
        return $.extend({}, d, {
          area: $("#area").val(),
          street: $("#street").val()
        })
      }
    },
    columnDefs: [
      {
        width: "3%",
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      {
        targets: 1,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.smk_akaun + "<br>" + row.smk_nolot + "<br>"
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
            data = row.pmk_nmbil + "<br/>"
            data += row.smk_adpg1 + "<br/>"
            if (row.smk_adpg2 != null) {
              data += row.smk_adpg2 + "<br/>"
            }
            if (row.smk_adpg3 != null) {
              data += row.smk_adpg3 + "<br/>"
            }
            if (row.smk_adpg4 != null) {
              data += row.smk_adpg4 + "<br/>"
            }
          }

          return data
        }
      },
      {
        targets: 3,
        orderable: false,
        data: "tnh_tnama"
      },
      {
        targets: 4,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.smk_lsbgn + " m&sup2; <br>" + row.smk_lstnh + " m&sup2; <br>" + row.smk_lsans + " m&sup2;"
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
            data = row.smk_lsbgn_tmbh + " m&sup2; <br>" + row.smk_lsans_tmbh + " m&sup2;"
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
            data = row.hadapan + "<br>" + row.belakang
          }
          return data
        }
      },
      {
        targets: 7,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            if (row.sirino == "-") {
              data = "Tiada"
            } else if (row.sirino != "-") {
              data = "Ada"
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
        targets: 9,
        orderable: false,
        className: "dt-body-center",
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row.docs)
          if (type === "display") {
            if (row.doc > "0") {
              data = "Ada (" + row.doc + ")</br>"
              for (let i = 0; i < row.docs.length; i++) {
                data += '<a href="../downloads/download/' + row.docs[i]["hashed_filename"] + '">' + row.docs[i]["doc_name"] + "</a></br>"
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
        targets: 10,
        orderable: false,
        className: "dt-body-center",
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            if (row.smk_stspn == "0") {
              data = "Baru"
            } else if (row.smk_stspn == "1") {
              data = "Baca"
            } else if (row.smk_stspn == "2") {
              data = "<span class='label label-primary'>Serah</span>"
            } else if (row.smk_stspn == "3") {
              data = "<span class='label label-success'>Diterima</span>"
            } else if (row.smk_stspn == "4") {
              data = "<span class='label label-warning'>Semak Semula</span>"
            } else if (row.smk_stspn == "5") {
              data = "<span class='label label-success'>Serah Kembali</span>"
            }
          }
          return data
        }
      },
      {
        targets: 11,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(data);
          if (type === "display") {
            data = '<div class="btn-group btn-group-xs" role="group">'
            data += '<a href="../Amendment/viewpsdetails/' + row.akaun + '" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Papar</a>'
            data += "</div>"
          }

          return data
        }
      }
    ],
    select: {
      style: "multi"
    },
    order: [[2, "asc"]],
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

  // Add event listener for opening and closing details
  $("#submitsitereview tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = table.row(tr)

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

  $("#form-verifylists").on("submit", function (e) {
    $("#submit_popup").modal("show")
    var form = this
    var rows_selected = table.column(0).checkboxes.selected()
    // console.log(rows_selected)
    var data = rows_selected.join(",")
    $("#id").val(data)

    // Prevent actual form submission
    e.preventDefault()
  })

  $("body").on("click", ".edit-area", function () {
    $("#luas_popup").modal("show")
    var row = $(this).parents("tr")[0]
    var rowindex = $(this).closest("tr").index()
    var rowval = table.row(row).data()

    $("#index").val(rowindex)
    $("#id").val(rowval.id)
    $("#akaun").val(rowval.akaun)
    console.log(rowindex)
    // console.log(table.row(row).data())
  })

  $("#submitsitereview").css("font-size", 13)

  $("#filter").bind("click", function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      table.draw()
    } else {
      alert("Select filter option")
      table.draw()
    }
  })

  $("#area").change(function () {
    $.ajax({
      type: "POST",
      url: "../Elements/street",
      data: { area: $(this).val() },
      success: function (data) {
        var len = data.length

        $("#street").empty()
        var rows = "<option selected value=''>Sila Pilih Jalan</option>"
        for (var i = 0; i < len; i++) {
          var id = data[i]["jln_jlkod"]
          var name = data[i]["jln_jnama"]
          rows += "<option value='" + id + "'>" + name + "</option>"
        }
        $("#street").append(rows)
      }
    })
  })

  $("#submitionareareview").submit(function (e) {
    e.preventDefault()
    var data = $("#submitionareareview").serialize()
    var index = this.index
    var lsbgn = this.lsbgn
    var lsans = this.lsans

    // console.log(index.value)
    $.ajax({
      url: config.root + "vendor/updatebreadth",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      // console.log(result.success)
      if (result === true) {
        $("#submitionareareview")[0].reset()
        $("#luas_popup").modal("hide")
        $("#sitereviews").DataTable().ajax.reload()
        swal("Berjaya", "Kemaskini keluasan, telah Berjaya direkodkan.", "success")
      } else {
        $("#luas_popup").modal("hide")
        swal("Oops...", "Kemaskini keluasan, tidak berjaya direkodkan!", "error")
      }
    })
  })
  // $("#sitereviews tbody").on("click", "#remove", function () {
  //   var data = table.row($(this).parents("tr")).data()
  //   alert(data[0] + "'s salary is: " + data[5])
  // })

  // $("#sitereviews tbody tr td #remove").click(function (e) {
  //   e.preventDefault()
  //   if (!confirm("Are you sure?")) {
  //     return
  //   }

  //   var row = $(this).parent().parent()
  //   var fileId = row.attr("id")

  //   ajax.send("Vendor/deletesitereview", { file_id: fileId }, deleteFileCallBack)
  //   function deleteFileCallBack(result) {
  //     if (helpers.validateData(result, row, "after", "row", "success")) {
  //       $(row).remove()
  //     }
  //   }
  // })
})
