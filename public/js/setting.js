;(function ($) {
  ;("use strict")

  var windowHeight, windowWidth, mapmobileheight, mapmobileheightSmall, mapmobilewidth

  // calculations for elements that changes size on window resize
  var windowResizeHandler = function () {
    windowHeight = window.innerHeight
    windowWidth = $(window).width()
    mapmobileheight = windowHeight - 140
    mapmobileheighthalf = windowHeight - 400
    mapmobileheightSmall = windowHeight - 500
    mapmobilewidth = (windowWidth / 5) * 3

    $("#mapView").css({
      width: "100%",
      height: mapmobileheight
    })
    $("#panel_cost").css({
      height: mapmobileheighthalf
    })
    $("#panel_rent").css({
      height: mapmobileheighthalf
    })
    $("#mapViewEdit").css({
      width: "100%",
      height: mapmobileheighthalf
    })
    $("#mapViewSmall").css({
      height: mapmobileheightSmall
    })
  }

  windowResizeHandler()
  $(window).resize(function () {
    windowResizeHandler()
  })

  window.isphone = false
  if (document.URL.indexOf("http://") === -1 && document.URL.indexOf("https://") === -1) {
    window.isphone = true
  }
})(jQuery)

function copyPassword() {
  var copyText = document.getElementById("passwordBox")
  copyText.select()
  document.execCommand("copy")

  var passwordBox = $("#passwordBox").val()

  $("#password").val(passwordBox)
  $("#confirm_password").val(passwordBox)
}

function password_generator() {
  var length = 8
  var string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" //to upper
  var numeric = "0123456789"
  var password = ""
  var character = ""
  var crunch = true
  while (password.length < length) {
    entity1 = Math.ceil(string.length * Math.random() * Math.random())
    entity2 = Math.ceil(numeric.length * Math.random() * Math.random())
    hold = string.charAt(entity1)
    hold = password.length % 2 == 0 ? hold : hold
    character += hold
    character += numeric.charAt(entity2)
    password = character
  }
  password = password
    .split("")
    .sort(function () {
      return 0.5 - Math.random()
    })
    .join("")
  document.getElementById("passwordBox").value = password.substr(0, length)
}

$(".modal.draggable>.modal-dialog").draggable({
  cursor: "move",
  handle: ".modal-header"
})
$(".modal.draggable>.modal-dialog>.modal-content>.modal-header").css("cursor", "move")
