$(document).ready(function () {
  $(".select2").select2()

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

  var $validator = $("#reviewPS form").validate({
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
      mjcTkhpl: {
        required: true
      },
      mjcJlkod: {
        required: true
      },
      mjcAdpg1: {
        required: true
      },
      mjcThkod: {
        required: true
      },
      mjcBgkod: {
        required: true
      },
      mjcHtkod: {
        required: true
      },
      mjcStkod: {
        required: true
      },
      mjcJpkod: {
        required: true
      },
      mjcCodex: {
        required: true
      },
      mjcCodey: {
        required: true
      },
      mjcLstnh: {
        required: true
      },
      mjcSbkod: {
        required: true
      },
      mjcNmbil: {
        required: true
      },
      mjcAmtid: {
        required: true
      }
    },
    messages: {
      mjcTkhpl: {
        required: "Sila pilih tarikh"
      },
      mjcJlkod: {
        required: "Sila pilih jalan"
      },
      mjcAdpg1: {
        required: "Sila isi ruangan ini"
      },
      mjcThkod: {
        required: "Sila pilih"
      },
      mjcBgkod: {
        required: "Sila pilih"
      },
      mjcHtkod: {
        required: "Sila pilih"
      },
      mjcStkod: {
        required: "Sila pilih"
      },
      mjcJpkod: {
        required: "Sila pilih"
      },
      mjcCodex: {
        required: "Klik pada map untuk dapatkan koordinat"
      },
      mjcCodey: {
        required: "Klik pada map untuk dapatkan koordinat"
      },
      mjcLstnh: {
        required: "Sila isi ruangan ini"
      },
      mjcSbkod: {
        required: "Sila pilih"
      },
      mjcNmbil: {
        required: "Sila isi ruangan ini"
      },
      mjcAmtid: {
        required: "Sila isi ruangan ini"
      }
    },
    highlight: function (label) {
      $(label).closest(".form-group").removeClass("has-success").addClass("has-error")
    },
    success: function (label) {
      $(label).closest(".form-group").removeClass("has-error")
      label.remove()
    }
  })

  //init first wizard
  $("#reviewps").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      // var validated = $("#reviewPS form").valid()
      // if (!validated) {
      //   $validator.focusInvalid()
      //   return false
      // }
    },
    onTabClick: function (tab, navigation, index, newindex) {
      if (newindex == index + 1) {
        return this.onNext(tab, navigation, index, newindex)
      } else if (newindex > index + 1) {
        return false
      } else {
        return true
      }
    },
    onTabShow: function (tab, navigation, index) {
      tab.prevAll().addClass("completed")
      tab.nextAll().removeClass("completed")
      var $total = navigation.find("li").length
      var $current = index + 1
      // If it's the last tab then hide the last button and show the finish instead
      if ($current >= $total) {
        $("#reviewps").find(".pager .next").hide()
        $("#reviewps").find(".pager .finish").show()
        $("#reviewps").find(".pager .finish").removeClass("disabled")
      } else {
        $("#reviewps").find(".pager .next").show()
        $("#reviewps").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#reviewps .finish").click(function (e) {
    e.preventDefault()
    var data = $("#reviewPS").serialize()
    $.ajax({
      url: config.root + "account/createAcct",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      console.log(result.success)
      if (result.success === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Jadual C, Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            var calctype
            if (result.calctype === 1) {
              calctype = "calcland"
            } else {
              calctype = "calcbuilding"
            }
            window.location = config.root + "calculator/" + calctype + "/" + result.sirino
          }
        )
      } else {
        swal("Oops...", "Jadual C, tidak berjaya direkodkan!", "error")
      }
    })
  })
})

function semakSumbangan(value) {
  var $jpkod = value
  ajax.send("account/getSumbangan", { jpkod: $jpkod }, getSumbanganCallBack)
}

function getSumbanganCallBack(result) {
  if (result["jpk_stcbk"] === "Y") {
    $("#dummy_mjc_Stcbk").prop("checked", true)
  } else {
    $("#dummy_mjc_Stcbk").prop("checked", false)
  }
  $("#mjc_Stcbk").val(result["jpk_stcbk"])
  // console.log(result)
}
