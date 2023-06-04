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
var sitereview = $("#sitereview").DataTable({
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
    url: "sitereviewtable",
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
      orderable: true,
      data: null,
      render: function (data, type, row, meta) {
        // console.log(row);
        if (type === "display") {
          data = row.jln_jnama + "<br>" + row.hrt_hnama
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
          data = row.smk_lsbgn + " m&sup2; <br>" + row.smk_lstnh + " m&sup2; <br>" + row.smk_lsans + " m&sup2;"
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
          data = row.smk_lsbgn_tmbh + " m&sup2; <br>" + row.smk_lsans_tmbh + " m&sup2;"
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
          data = row.hadapan + "<br>" + row.belakang
        }
        return data
      }
    },
    {
      targets: 6,
      orderable: false,
      className: "dt-body-center",
      data: null,
      render: function (data, type, row, meta) {
        // console.log(row.smk_type)
        if (type === "display") {
          if (row.smk_type === 1) {
            data = "Akaun Baru"
          }
          if (row.smk_type === 2) {
            data = "Pindaan"
          }
          if (row.smk_type === 3) {
            data = "KemasKini Data"
          }
        }
        return data
      }
    },
    {
      targets: 7,
      orderable: true,
      className: "dt-body-center",
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          if (row.smk_stspn == "0") {
            data = "<span class='label label-default'>Baru</span>"
          } else if (row.smk_stspn == "1") {
            data = "<span class='label label-info'>Baca</span>"
          } else if (row.smk_stspn == "2") {
            data = "<span class='label label-primary'>Serah</span>"
          } else if (row.smk_stspn == "3") {
            data = "<span class='label label-success'>Diterima</span>"
          } else if (row.smk_stspn == "4") {
            data = "<span class='label label-warning'>Semak Semula</span>"
          } else if (row.smk_stspn == "5") {
            data = "<span class='label label-primary'>Serah Kembali</span>"
          }
        }
        return data
      }
    },
    {
      targets: 8,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = row.smk_datevisit + "</br>" + row.smk_timevisit
        }
        return data
      }
    },
    {
      targets: 9,
      orderable: true,
      data: null,
      render: function (data, type, row, meta) {
        if (type === "display") {
          data = row.workerid + "</br>" + row.name
        }
        return data
      }
    },
    {
      targets: 10,
      orderable: false,
      data: null,
      render: function (data, type, row, meta) {
        // console.log(data);
        if (type === "display") {
          data = '<a class="btn btn-danger btn-xs remove" title="Delete" id="remove" data-id="' + row.id + '"><i class="fa fa-trash"></i></a> '
          data += '<div class="btn-group btn-group-xs" role="group">'
          if (row.smk_type === 1) {
            data += '<a href="../Account/jadualcsemak/' + row.id + '" class="btn btn-primary btn-xs" title="Siasatan Tapak">Jadual C</a>'
          }
          if (row.smk_type === 2) {
            data += '<a href="../Account/jadualbsemak/' + row.id + '" class="btn btn-primary btn-xs" title="Siasatan Tapak">Jadual B</a>' + '<a href="../Evaluate/jadualbSemak/' + row.id + '" class="btn btn-primary btn-sm" title="Siasatan Tapak">Jadual B(PS)</a>'
          }
          if (row.smk_type === 3) {
            data += '<a href="kemaskini/' + row.id + '" class="btn btn-primary btn-xs" title="Siasatan Tapak">KemasKini Data</a>'
          }
          data += "</div>"
        }

        return data
      }
    }
  ],
  order: [[7, "asc"]],
  language: {
    search: "Saring : ",
    lengthMenu: "Paparkan _MENU_ rekod",
    zeroRecords: "Tiada maklumat yang dijumpai",
    info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
    infoEmpty: "Tiada rekod",
    paginate: {
      first: "Pertama",
      last: "Terakhir",
      next: "Seterusnya",
      previous: "Sebelumnya"
    }
  }
})
$("#sitereview tbody").css("font-size", 13)

// Add event listener for opening and closing details
$("#sitereview tbody").on("click", "td.details-control", function () {
  var tr = $(this).closest("tr")
  var row = sitereview.row(tr)

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
  console.log(rows_selected)
  // $.each(rows_selected, function (index, rowId) {
  //   data += rowId
  // })
  var data = rows_selected.join(",")
  $("#id").val(data)

  // Prevent actual form submission
  e.preventDefault()
})

$(document).ready(function () {
  sitereview.draw()

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      // $("#sitereview").DataTable().destroy()
      sitereview.draw()
    } else {
      alert("Select Both filter option")
      // $("#sitereview").DataTable().destroy()
      sitereview.draw()
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
})
