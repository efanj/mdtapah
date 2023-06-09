$(document).ready(function () {
  var $form = $("#form").val()
  if ($form === "C") {
    getRate()
  }
  function getRate() {
    var $kwkod = $("#kwkod").val()
    var $htkod = $("#htkod").val()
    ajax.send("Elements/getrate", { kwkod: $kwkod, htkod: $htkod }, getRateCallBack)
  }

  function getRateCallBack(result) {
    $("#rate").val(result)
    console.log(result)
  }

  var $validator = $("#calc-rent form").validate({
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
      mjb_tkhpl: {
        required: true
      },
      mjbThkod: {
        required: true
      },
      mjbBgkod: {
        required: true
      },
      mjbHtkod: {
        required: true
      },
      mjbStkod: {
        required: true
      }
    },
    messages: {
      mjb_tkhpl: {
        required: "Sila pilih tarikh"
      },
      mjbThkod: {
        required: "Sila pilih"
      },
      mjbBgkod: {
        required: "Sila pilih"
      },
      mjbHtkod: {
        required: "Sila pilih"
      },
      mjbStkod: {
        required: "Sila pilih"
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
  $("#calc-rent").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      // var validated = $("#calcRent form").valid()
      // if (!validated) {
      //   $validator.focusInvalid()
      //   return false
      // }
      return true
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
        $("#calc-rent").find(".pager .next").hide()
        $("#calc-rent").find(".pager .finish").show()
        $("#calc-rent").find(".pager .finish").removeClass("disabled")
      } else {
        $("#calc-rent").find(".pager .next").show()
        $("#calc-rent").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#calc-rent .finish").click(function (e) {
    e.preventDefault()
    var data = $("#calcRent").serialize()
    $.ajax({
      url: config.root + "calculator/rentSubmit",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      // console.log(result.success)
      if (result === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Nilaian Perbandingan, Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            window.location = config.root + "amendment/amendlists"
          }
        )
      } else {
        swal("Oops...", "Nilaian Perbandingan, tidak berjaya direkodkan!", "error")
      }
    })
  })
})
