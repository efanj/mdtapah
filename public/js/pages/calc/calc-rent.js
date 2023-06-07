$(document).ready(function () {
  var popup_comparison = $("#popup_comparison").DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    order: [],
    ajax: {
      url: config.root + "informations/comparison",
      type: "POST",
      data: {
        type: 1,
        kwkod: $("#kwkod").val(),
        htkod: $("#htkod").val()
      }
    },
    columnDefs: [
      {
        targets: 0,
        data: "id"
      },
      {
        targets: 1,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 2,
        orderable: false,
        data: "bgn_bnama"
      },
      {
        targets: 3,
        orderable: false,
        data: "peg_lsbgn"
      },
      {
        targets: 4,
        orderable: false,
        data: "peg_nilth"
      },
      {
        targets: 5,
        orderable: false,
        data: "mfa"
      },
      {
        targets: 6,
        orderable: false,
        data: "afa"
      }
    ],
    order: [[0, "asc"]],
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
  $("#popup_comparison").css("font-size", 13)
  popup_comparison.columns(0).visible(false)

  var lsans = $("#luas_ansolari").val()
  var lsbgnt = $("#tamb_bangunan").val()
  var lsanst = $("#tamb_ansolari").val()
  var kwkod = $("#kwkod").val()
  var htkod = $("#htkod").val()
  console.log(kwkod, htkod, lsans, lsbgnt, lsanst)
  ajax.send("Vendor/getBenchmark", { type: "2", kwkod: kwkod, htkod: htkod }, getBenchmarkCallBack)
  function getBenchmarkCallBack(result) {
    if (result.success === true) {
      addRowBuilding(result, lsans, lsbgnt, lsanst)
    } else {
      swal("Maaf, Tiada aras nilaian yang bersesuaian.", "Sila masukkan data aras nilaian.")
    }
  }

  var maxField = 4
  var maxLevel = 5
  var x = 1
  var y = 1
  var rowCount = 1
  var rowAmount = 1

  $("#add-comparison").click(function () {
    var added = document.querySelectorAll("tbody#comparison_table tr").length
    for (var i = 0; i < rowCount; i++) {
      var rowId = i + added
      if (x < maxField) {
        x++
        var row_comparison = '<tr id="' + rowId + '"><td><button class="btn btn-primary btn-xs" id="add" type="button"><i class="fa fa-plus"></i></button></td>'
        row_comparison += '<td><input type="hidden" name="comparison[]" id="comparison"><div class="control-label tal" id="jlname"></div></td>'
        row_comparison += "<td><div class='control-label tal' id='bgtype'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='breadth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='nilth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='mfa'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='afa'></div></td>"
        row_comparison += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }

    tableBody = $("table.comparison tbody")
    tableBody.append(row_comparison)
  })

  $("body").on("click", ".add", function (e) {
    var tableId = "zero"
    var added = document.querySelectorAll("tbody#" + tableId + " tr").length
    // console.log(added)
    for (var i = 0; i < rowAmount; i++) {
      var rowId = i + added
      if (y < maxLevel) {
        y++
        var row = '<tr id="' + rowId + '"><td><input type="text" class="form-control input-xs" name="main[item]["' + rowId + '"][title]"></td>'
        row += '<td><input type="number" class="form-control input-xs" name="main[item]["' + rowId + '"][breadth]" id="breadth" min="0" value="0"></td>'
        row += '<td><select class="form-control input-xs" name="main[item]["' + rowId + '"][breadthtype]">'
        row += "<option value=''>Sila Pilih</option>"
        row += '<option value="mp" selected>Meter</option>'
        row += '<option value="ft">Kaki</option>'
        row += '<option value="unit">Unit</option>'
        row += "</select></td>"
        row += '<td style="text-align:center">X</td>'
        row += '<td><input type="number" class="form-control input-xs" name="main[item]["' + rowId + '"][price]" id="price" min="0" value="0"></td>'
        row += '<td><select class="form-control input-xs" name="main[item]["' + rowId + '"][pricetype]">'
        row += "<option value=''>Sila Pilih</option>"
        row += '<option value="smp" selected>Meter Persegi</option>'
        row += '<option value="sft">Kaki Persegi</option>'
        row += '<option value="p/unit">Per-Unit</option>'
        row += "</select></td>"
        row += '<td><input type="number" class="form-control input-xs total" name="main[item]["' + rowId + '"][total]" readonly></td>'
        row += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }
    $(row).insertBefore("table#" + tableId + " .adjustment")
  })

  $("body").on("click", "#delete", function (e) {
    e.preventDefault()
    console.log("test")
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })

  $("body").on("click", "#add", function (e) {
    var row = $(this).parent().parent()
    var rowId = row.attr("id")

    $("#comparison_popup").modal("show")
    console.log(rowId)

    popup_comparison.on("click", "tr", function () {
      var data_comparison = popup_comparison.row(this).data()
      console.log(data_comparison)
      $(".comparison #comparison").val(data_comparison.id)
      $(".comparison #jlname").html(data_comparison.jln_jnama)
      $(".comparison #bgtype").html(data_comparison.bgn_bnama)
      $(".comparison #breadth").html(data_comparison.peg_lsbgn)
      $(".comparison #nilth").html(data_comparison.peg_nilth)
      $(".comparison #mfa").html(data_comparison.mfa)
      $(".comparison #afa").html(data_comparison.afa)
      $("#comparison_popup").on("hidden.bs.modal", function (e) {
        rowId = ""
      })
      $("#comparison_popup").modal("hide")
    })
  })

  $("#dummy_corner").change(function () {
    if (this.checked) {
      $(this).prop("checked", true)
    } else {
      $(this).prop("checked", false)
    }
    $("#corner").val(this.checked)
  })
})

$("body").on("keyup", "#breadth_land, #price_land", function () {
  var row = $(this).closest("tr")
  var breadth_land = parseFloat(row.find("#breadth_land").val())
  var price_land = parseFloat(row.find("#price_land").val())
  var total_land = parseFloat(breadth_land * price_land)
  row.find("#total_land").val(total_land.toFixed(2))
  land()
})

$("body").on("keyup", "#breadth, #price", function () {
  var row = $(this).closest("tr")
  var breadth = parseFloat(row.find("#breadth").val())
  var price = parseFloat(row.find("#price").val())
  var total = parseFloat(breadth * price)
  row.find(".total").val(total.toFixed(2))
  console.log(row[0].id)
  building(row[0].id)
})

$("body").on("keyup", "#out_breadth, #out_price", function () {
  var row = $(this).closest("tr")
  var breadth = parseFloat(row.find("#out_breadth").val())
  var price = parseFloat(row.find("#out_price").val())
  var total = parseFloat(breadth * price)
  row.find(".total").val(total.toFixed(2))
  console.log(row[0].id)
  building_out(row[0].id)
})

$("body").on("change", "#dummy_corner", function () {
  // console.log(this.checked)
  var corner
  var rental = $("#rental").val()
  if (this.checked === true) {
    corner = (parseFloat(rental) / 100) * 10 + parseFloat(rental)
    $("#corner").val("true")
  } else {
    corner = parseFloat(rental)
    $("#corner").val("false")
  }
  //console.log(corner)
  $("#value_corner").html(corner.toFixed(2))
  $("#round").val(corner.toFixed(2))
  generateTax()
})

$("body").on("keyup", "#round", function () {
  generateTax()
})

$("body").on("keyup", "#rate", function () {
  generateTax()
})

function land() {
  var land = 0
  $(".land").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find("#total_land")
          .each(function () {
            var val = parseFloat($(this).val())
            if (!isNaN(val)) land += val
          })
      })
  })
  $("#sub_land").val(land.toFixed(2))
  $("#ttl_land").val(land.toFixed(2))
  sumTotal()
}

function building(id) {
  var building = 0
  $(".one").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find(".total")
          .each(function () {
            var value = parseFloat($(this).val())
            if (!isNaN(value)) building += value
          })
      })
  })
  $(".one #sub_ttl").val(building.toFixed(2))
  overall_building()
}

function building_out(id) {
  var building = 0
  $(".two").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find(".total")
          .each(function () {
            var value = parseFloat($(this).val())
            if (!isNaN(value)) building += value
          })
      })
  })
  $(".two #sub_ttl").val(building.toFixed(2))
  overall_building()
}

function overall_building() {
  var overall = 0
  $(".one, .two").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find(".sub_ttl")
          .each(function () {
            var val = parseFloat($(this).val())
            if (!isNaN(val)) overall += val
          })
      })
  })
  $("#overall").val(overall.toFixed(2))
  sumTotal()
}

function sumTotal() {
  var rental_value = 0
  $(".ttl_overall").each(function () {
    var val = parseFloat($(this).val())
    if (!isNaN(val)) rental_value += val
    console.log(rental_value)
  })
  $("#rental").val(rental_value)
  $("#dummy_rental").html(rental_value)
  $("#value_corner").html(rental_value)
  $("#round").val(rental_value)

  generateTax()
}

function generateTax() {
  var year_value
  var corner = $("#value_corner").html()
  var round = $("#round").val()
  if (round === parseFloat(corner)) {
    year_value = parseFloat(corner) * 12
  } else {
    year_value = parseFloat(round) * 12
  }

  var rate = $("#rate").val()
  var tax = (parseFloat(rate) / 100) * year_value

  $("#yearly").val(year_value)
  $("#dummy_yearly").html(formatter.format(year_value))

  $("#tax").val(tax)
  $("#dummy_tax").html(formatter.format(tax))
}

const formatter = new Intl.NumberFormat("en-MY")
