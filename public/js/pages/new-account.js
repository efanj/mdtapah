$(document).ready(function () {
  var popup_street = $("#popup_street").DataTable({
    processing: true,
    serverSide: true,
    select: "single",
    searching: false,
    serverMethod: "post",
    ajax: config.root + "elements/streettable",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "jln_jlkod"
      },
      {
        targets: 1,
        orderable: false,
        data: "kws_kwkod"
      },
      {
        targets: 2,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 3,
        orderable: false,
        data: "jln_poskd"
      },
      {
        targets: 4,
        orderable: false,
        data: "kws_knama"
      }
    ],
    language: {
      search: "Saring:",
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
  $("#popup_street").css("font-size", 13)

  $("#popup_street tbody").on("click", "tr", function () {
    var data_street = popup_street.row(this).data()
    $("#dummy_jlkod").val(data_street.jln_jnama)
    $("#jlkod").val(data_street.jln_jlkod)
    $("#kwname").val(data_street.kws_knama)
    $("#kawKwkod").val(data_street.kws_kwkod)
    $("#street_popup").modal("toggle")
  })

  var popup_customer = $("#popup_customer").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: config.root + "elements/customertable",
    select: "single",
    columns: [
      { data: "pid_plgid", targets: 0 },
      { data: "pid_pnama", targets: 1 }
    ],
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

  $("#popup_customer").css("font-size", 13)

  $("#popup_customer tbody").on("click", "tr", function () {
    var customer = popup_customer.row(this).data()
    $("#plgid").val()
    $("#plgid").val(customer["pid_plgid"])
    $("#nmbil").val(customer["pid_pnama"])

    if ($.fn.dataTable.isDataTable("#popup_customeraddress")) {
      $("#popup_customeraddress").DataTable().clear()
      $("#popup_customeraddress").DataTable().destroy()
      $("#popup_customeraddress").empty()
    }

    var table_customeraddress = $("#popup_customeraddress").DataTable({
      ajax: {
        url: config.root + "elements/customeraddtable",
        type: "POST",
        data: function (d) {
          d.id_search = customer["pid_plgid"]
        }
      },
      select: "single",
      columns: [
        { data: "val_amtid", targets: 0 },
        { data: "pid_pnama", targets: 1 },
        {
          targets: 2,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.val_almt1 + "<br/>"
              if (row.val_almt2 != null) {
                data += row.val_almt2 + "<br/>"
              }
              if (row.val_almt3 != null) {
                data += row.val_almt3 + "<br/>"
              }
              if (row.val_almt4 != null) {
                data += row.val_almt4 + "<br/>"
              }
              if (row.val_almt5 != null) {
                data += row.val_almt5
              }
            }

            return data
          }
        }
      ],
      order: [[1, "asc"]],
      language: {
        search: "Saring:",
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
    $("#popup_customer").css("font-size", 13)
    $("#customer_popup").modal("toggle")

    $("#popup_customeraddress tbody").on("click", "tr", function () {
      var data
      var data_custadd = table_customeraddress.row(this).data()
      // console.log(data_custadd);
      $("#mjc_amtid").val(data_custadd["val_amtid"])
      data = data_custadd["val_almt1"] + ","
      if (data_custadd["val_almt2"] != null) {
        data += data_custadd["val_almt2"] + ","
      }
      if (data_custadd["val_almt3"] != null) {
        data += data_custadd["val_almt3"] + ","
      }
      if (data_custadd["val_almt4"] != null) {
        data += data_custadd["val_almt4"] + ","
      }
      if (data_custadd["val_almt5"] != null) {
        data += data_custadd["val_almt5"]
      }
      $("#alamat_pemilik").html(data)
      $("#customeraddress_popup").modal("toggle")
    })
  })
})

$("#form-akaunbaru-desktop").validate({
  errorPlacement: function (error, element) {
    var place = element.closest(".input-group")
    if (!place.get(0)) {
      place = element
    }
    if (place.get(0).type === "checkbox") {
      place = element.parent()
    }
    if (error.text() !== "") {
      place.after(error)
    }
  },
  errorClass: "help-block",
  rules: {
    jlkod: {
      required: true
    },
    adpg1: {
      required: true
    },
    thkod: {
      required: true
    },
    bgkod: {
      required: true
    },
    htkod: {
      required: true
    },
    stkod: {
      required: true
    },
    jpkod: {
      required: true
    },
    codex: {
      required: true
    },
    codey: {
      required: true
    },
    lstnh: {
      required: true
    },
    plgid: {
      required: true
    },
    nmbil: {
      required: true
    }
  },
  messages: {
    jlkod: {
      required: "Sila pilih jalan"
    },
    adpg1: {
      required: "Sila isi ruangan ini"
    },
    thkod: {
      required: "Sila pilih"
    },
    bgkod: {
      required: "Sila pilih"
    },
    htkod: {
      required: "Sila pilih"
    },
    stkod: {
      required: "Sila pilih"
    },
    jpkod: {
      required: "Sila pilih"
    },
    codex: {
      required: "Klik pada peta untuk dapatkan koordinat"
    },
    codey: {
      required: "Klik pada peta untuk dapatkan koordinat"
    },
    lstnh: {
      required: "Sila isi atau klik pada peta dan salin."
    },
    plgid: {
      required: "Sila pilih ID pemilik"
    },
    nmbil: {
      required: "Sila pilih ID pemilik disebelah."
    }
  },
  highlight: function (label) {
    $(label).closest(".form-group").removeClass("has-success").addClass("has-error")
  },
  success: function (label) {
    $(label).closest(".form-group").removeClass("has-error")
    label.remove()
  },
  submitHandler: function (form) {
    ajax.send("Informations/createnewaccount", helpers.serialize(form), submitNewAccountCallBack)
  }
})

function submitNewAccountCallBack(result) {
  if (result === true) {
    swal(
      {
        title: "Berjaya!",
        text: "Akaun Baru, Telah berjaya direkodkan.",
        icon: "success",
        confirmButtonClass: "btn-primary",
        confirmButtonText: "Ok",
        closeOnConfirm: false
      },
      function () {
        window.location = config.root + "vendor/sitereview"
      }
    )
  } else {
    swal("Oops...!", "Akaun baru tidak berjaya.", "info")
  }
}
