$(document).ready(function () {
  fill_datatable()

  function fill_datatable(area = "", street = "") {
    var table = $("#sitereviews").DataTable({
      pageLength: 5,
      lengthMenu: [
        [5, 10, 20, 50],
        [5, 10, 20, 50]
      ],
      processing: true,
      serverSide: true,
      searching: false,
      order: [],
      ajax: {
        url: "sitereviewtable",
        type: "POST",
        data: {
          area: area,
          street: street
        }
      },
      columnDefs: [
        {
          targets: 0,
          data: "id",
          checkboxes: {
            selectRow: true
          }
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
            // console.log(row);
            if (type === "display") {
              data = row.smk_adpg1 + "<br>" + row.smk_adpg2 + "<br>"
            }
            return data
          }
        },
        {
          targets: 3,
          orderable: false,
          data: "jln_jnama"
        },
        {
          targets: 4,
          orderable: false,
          data: "hrt_hnama"
        },
        {
          targets: 5,
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
          targets: 6,
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
          targets: 7,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(row.smk_type)
            if (type === "display") {
              if (row.smk_type === 1) {
                data = "<span class='label label-default'>Akaun Baru</span>"
              }
              if (row.smk_type === 2) {
                data = "<span class='label label-primary'>Pindaan</span>"
              }
              if (row.smk_type === 3) {
                data = "<span class='label label-success'>KemasKini Data</span>"
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
              data = row.hadapan + "<br>" + row.belakang
            }
            return data
          }
        },
        { targets: 9, orderable: false, data: "smk_datevisit" },
        {
          targets: 10,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.workerid + "</br>" + row.name
            }
            return data
          }
        },
        {
          targets: 11,
          orderable: false,
          className: "dt-body-center",
          data: null,
          render: function (data, type, row, meta) {
            // console.log(data);
            if (type === "display") {
              data = '<div class="btn-group btn-group-sm" role="group">'
              data += '<a href="viewimages/' + row.id + '" class="btn btn-default btn-sm" title="Gambar"><i class="fa  fa-file-photo-o color-dark"></i></a>'
              data += '<a href="viewdocuments/' + row.id + '" class="btn btn-default btn-sm" title="Dokumen"><i class="fa fa-file color-dark"></i></a>'
              data += '<a class="btn btn-danger btn-sm remove" title="Padam" data-id="' + row.id + '"><i class="fa fa-trash"></i></a>'
              data += "</div>"
            }
            return data
          }
        }
      ],
      select: {
        style: "multi"
      },
      order: [[9, "asc"]],
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
          next: "Seterusnya",
          previous: "Sebelumnya"
        }
      }
    })
  }
  $("#sitereviews tbody").css("font-size", 13)

  $("#form-sitereview").submit(function (e) {
    var form = this
    var rows_selected = table.column(0).checkboxes.selected()
    $.each(rows_selected, function (index, rowId) {
      console.log(index, rowId)
      // $(form).append($("<input>").attr("type", "hidden").attr("name", "id[]").val(rowId))
    })
  })

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      $("#sitereview").DataTable().destroy()
      fill_datatable(area, street)
    } else {
      alert("Select Both filter option")
      $("#sitereview").DataTable().destroy()
      fill_datatable()
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
