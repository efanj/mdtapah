$(document).ready(function () {
  // var lsans = $("#luas_ansolari").val()
  // var lsbgnt = $("#tamb_bangunan").val()
  // var lsanst = $("#tamb_ansolari").val()
  // console.log(lsans, lsbgnt, lsanst)
  // addRowBuilding(lsans, lsbgnt, lsanst)

  var maxField = 4
  var x = 1
  var rowAmmount = 1

  $("#add-section").click(function () {
    var added = document.querySelectorAll(".section section").length
    // console.log(added)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      if (rowId === 1) {
        var tableName = "one"
      } else if (rowId === 2) {
        tableName = "two"
      } else if (rowId === 3) {
        tableName = "three"
      } else if (rowId === 4) {
        tableName = "four"
      }
      if (x < maxField) {
        x++
        var section = '<hr><section id="' + rowId + '" class="mt20">'
        section += '<div class="row ml5 mr5"><div class="col-lg-12 col-md-12 col-sm-12">'
        section += '<div class="form-group"><label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>'
        section += '<div class="col-lg-10 col-md-9"><input type="text" class="form-control input-xs" name="section[' + rowId + '][main_title]">'
        section += '</div></div></div></div><div class="btn-group btn-group-xs">'
        section += '<button id="' + rowId + '" class="btn btn-primary btn-xs add mb5" type="button">Add Row</button>'
        section += '<button id="' + rowId + '" class="btn btn-danger btn-xs delete_section" type="button">Delete Section</button>'
        section += "</div></div>"
        section += '<table class="table table-bordered one" id="' + tableName + '" style="font-size:13px;">'
        section += '<thead><tr><th style="width:30%">Perkara</th><th style="width:10%">Keluasan/Kuantiti</th><th style="width:15%">Jenis</th><th style="width:2%"></th>'
        section += '<th style="width:10%">Nilai Unit</th><th style="width:15%">Jenis</th><th style="width:15%">Jumlah (RM)</th><th style="width:3%"></th></tr></thead>'
        section += '<tbody id="' + tableName + '"><tr id="' + rowId + '"><td>'
        section += '<input type="text" class="form-control input-xs" name="section[' + rowId + '][item][0][title]"></td>'
        section += '<td><input type="number" class="form-control input-xs" name="section[' + rowId + '][item][0][breadth]" min="0" id="breadth"></td>'
        section += '<td><select class="form-control input-xs" name="section[' + rowId + '][item][0][breadthtype]">'
        section += "<option value=''>Sila Pilih</option>"
        section += '<option value="mp" selected>Meter</option>'
        section += '<option value="ft">Kaki</option>'
        section += '<option value="unit">Unit</option>'
        section += "</select></td>"
        section += '<td style="text-align:center">X</td>'
        section += '<td><input type="number" class="form-control input-xs" name="section[' + rowId + '][item][0][price]" min="0" id="price" value="0"></td>'
        section += '<td><select class="form-control input-xs" name="section[' + rowId + '][item][0][pricetype]">'
        section += "<option value=''>Sila Pilih</option>"
        section += '<option value="smp" selected>Meter Persegi</option>'
        section += '<option value="sft">Kaki Persegi</option>'
        section += '<option value="p/unit">Per-Unit</option>'
        section += "</select></td>"
        section += '<td><input type="number" class="form-control input-xs total" name="section[' + rowId + '][item][0][total]" readonly></td>'
        section += "<td></td></tr>"
        section += '<tr id="' + rowId + '" class="adjustment"><td colspan="6" style="font-size:14px; font-weight:bold; text-align:right;">Jumlah</td>'
        section += '<td><input type="number" class="form-control input-xs sub_ttl" value="" readonly>'
        section += '</td><td></td></tr><tr id="' + rowId + '"><td colspan="2">Pelarasan :<br />(-) Susut Nilai Bangunan</td><td colspan="4">'
        section += '<div class="input-group"><span class="input-group-addon">RM</span><input type="number" class="form-control input-xs duplicate_sub_ttl" readonly>'
        section += '<span class="input-group-addon">-</span><input type="number" class="form-control input-xs" name="section[' + rowId + '][adjust]" id="adjust" value="0">'
        section += '<span class="input-group-addon">%</span></div></td><td>'
        section += '<input type="number" class="form-control input-xs ttl_adjustment ttl_partly" name="section[' + rowId + '][ttladjust]" readonly></td><td></td></tr>'
        section += "</tbody></table>"
      } else {
        $(this).prop("disabled", true)
      }
    }

    var divBody = $(".section")
    divBody.append(section)
  })

  $("body").on("click", ".add", function (e) {
    var Id = $(this).attr("id")
    var tableId = $(this)
      .closest("section#" + Id)
      .find("table")
      .attr("id")
    // var added = document.querySelectorAll(".section table#" + tableId + " tbody tr").length
    var added = $("table#" + tableId + " tbody tr").length
    console.log(tableId, Id, added)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row = '<tr id="' + Id + '"><td><input type="text" class="form-control input-xs" name="section[' + Id + "][item][" + rowId + '][title]"></td>'
      row += '<td><input type="number" class="form-control input-xs" name="section[' + Id + "][item][" + rowId + '][breadth]" id="breadth" min="0" value="0"></td>'
      row += '<td><select class="form-control input-xs" name="section[' + Id + "][item][" + rowId + '][breadthtype]">'
      row += "<option value=''>Sila Pilih</option>"
      row += '<option value="mp" selected>Meter</option>'
      row += '<option value="ft">Kaki</option>'
      row += '<option value="unit">Unit</option>'
      row += "</select></td>"
      row += '<td style="text-align:center">X</td>'
      row += '<td><input type="number" class="form-control input-xs" name="section[' + Id + "][item][" + rowId + '][price]" id="price" min="0" value="0"></td>'
      row += '<td><select class="form-control input-xs" name="section[' + Id + "][item][" + rowId + '][pricetype]">'
      row += "<option value=''>Sila Pilih</option>"
      row += '<option value="smp" selected>Meter Persegi</option>'
      row += '<option value="sft">Kaki Persegi</option>'
      row += '<option value="p/unit">Per-Unit</option>'
      row += "</select></td>"
      row += '<td><input type="number" class="form-control input-xs total" name="section[' + Id + "][item][" + rowId + '][total]" readonly></td>'
      row += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }
    $(row).insertBefore(".section table#" + tableId + " .adjustment")
  })

  $("body").on("click", ".delete_section", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var id = $(this).attr("id")
    console.log(id)
    $("section#" + id).remove()
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
})

$("body").on("keyup", "#breadth_land, #price_land", function () {
  var row = $(this).closest("tr")
  var breadth_land = parseFloat(row.find("#breadth_land").val())
  var price_land = parseFloat(row.find("#price_land").val())
  var total_land = parseFloat(breadth_land * price_land)
  row.find("#total_land").val(total_land.toFixed(2))
  $("#sub_land").val(total_land.toFixed(2))
  adjustmentLand()
})

$("body").on("keyup", "#adjust_land", function () {
  adjustmentLand()
})

$("body").on("keyup", "#breadth, #price", function () {
  var row = $(this).closest("tr")
  var name = $(this)
  var breadth = parseFloat(row.find("#breadth").val())
  var price = parseFloat(row.find("#price").val())
  var total = parseFloat(breadth * price)
  row.find(".total").val(total.toFixed(2))
  var str = name[0].name
  var start_pos = str.indexOf("[") + 1
  var end_pos = str.indexOf("]", start_pos)
  var id = str.substring(start_pos, end_pos)
  console.log(name[0].name, id)
  adjustmentBuilding(id)
})

$("body").on("keyup", "#adjust", function () {
  var name = $(this)
  var str = name[0].name
  var start_pos = str.indexOf("[") + 1
  var end_pos = str.indexOf("]", start_pos)
  var id = str.substring(start_pos, end_pos)
  console.log(name[0].name, id)
  adjustmentBuilding(id)
})

$("body").on("keyup", "#round", function () {
  generateTax()
})

$("body").on("keyup", "#rate", function () {
  generateTax()
})

function adjustmentLand() {
  var ttl_adjust
  var adjust_land = $("#adjust_land").val()
  var total_land = $("#total_land").val()
  if (adjust_land != "" && adjust_land > 0) {
    ttl_adjust = parseFloat(total_land) - (parseFloat(total_land) / 100) * adjust_land
  } else {
    ttl_adjust = total_land
  }
  $("#ttl_adjust").val(ttl_adjust.toFixed(2))
  $("#ttl_land").val(ttl_adjust.toFixed(2))
  console.log(total_land, ttl_adjust)
  land()
}

function adjustmentBuilding(id) {
  var building = 0
  var ttl_adjustment

  $("section#" + id + " .one").each(function () {
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

  $("section#" + id + " .one .sub_ttl").val(building.toFixed(2))
  $("section#" + id + " .one .duplicate_sub_ttl").val(building.toFixed(2))

  var adjust = $("section#" + id + " .one .adjust").val()

  if (adjust != "" && adjust > 0) {
    ttl_adjustment = parseFloat(building) - (parseFloat(building) / 100) * adjust
  } else {
    ttl_adjustment = building
  }
  $("section#" + id + " .one .ttl_adjustment").val(ttl_adjustment.toFixed(2))
  overall_building()
  // console.log(building, adjust, ttl_adjustment)
}

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
  $("#ttl_land").val(land.toFixed(2))
  $("#ttl_adjust").val(land.toFixed(2))
  sum()
}

function overall_building() {
  var overall = 0
  $("section .one").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find(".ttl_partly")
          .each(function () {
            var val = parseFloat($(this).val())
            if (!isNaN(val)) overall += val
          })
      })
  })
  $("#overall").val(overall.toFixed(2))
  sum()
}

function sum() {
  var capital = 0
  $(".ttl_overall").each(function () {
    capital += +$(this).val()
  })

  var yearly = parseFloat(capital / 100) * 10

  $("#capital").val(capital.toFixed(2))
  $("#dummy_capital").html(capital.toFixed(2))
  $("#yearly").val(yearly.toFixed(2))
  $("#dummy_yearly").html(yearly.toFixed(2))
  $("#round").val(yearly.toFixed(2))
  generateTax()
}

function generateTax() {
  var round = $("#round").val()
  var rate = $("#rate").val()
  var tax = (parseFloat(round) / 100) * rate
  $("#tax").val(tax.toFixed(2))
  $("#dummy_tax").html(tax.toFixed(2))
}
