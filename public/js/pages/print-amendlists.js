$(document).on("click", "#print", function () {
  var btn_print = $(this)
  siriNo = btn_print.data("sirino")
  createPDFJadualKeseluruhan(siriNo)
})

var today = new Date()
var date = today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear()

function createPDFJadualKeseluruhan(siriNo) {
  $.ajax({
    async: false,
    url: "printNotices",
    type: "POST",
    data: helpers.appendCsrfToken({ siri_no: siriNo }),
    context: this,
    success: function (data) {
      if (type == "land") {
        var doc = new jsPDF("p", "pt", "a4")
        doc.addImage(config.root + "img/logo_letter.jpg", "JPEG", 125, 40, 350, 90)
        doc.setLineWidth(1)
        doc.line(50, 160, 550, 160)
        doc.setFontSize(10)
        doc.setFont("helvetica", "bold")
        doc.text("JABATAN PENILAIAN DAN PENGURUSAN HARTA", 297, 176, "center")
        doc.line(176, 180, 418, 180)

        doc.text("KERTAS PENILAIAN", 297, 210, "center")
        doc.line(248, 213, 346, 213)

        doc.setLineWidth(2)
        doc.rect(386, 220, 160, 16)
        doc.text("LOT HUJUNG", 466, 232, "center")

        doc.setFont("helvetica", "normal")
        doc.text("ALAMAT HARTA", 50, 250, "left")
        doc.text(":", 150, 250, "left")
        doc.text("TAMAN SAUJANA INDAH, 35400 TAPAH ROAD", 170, 250, "left")

        doc.text("NILAIAN", 50, 275, "left")
        doc.text(":", 150, 275, "left")
        doc.text("BANGUNAN UTAMA", 170, 275, "left")

        doc.setLineWidth(0.5)
        doc.text("TINGKAT BAWAH", 50, 300, "left")
        doc.text("68.00", 240, 300, "right")
        doc.line(170, 303, 240, 303)
        doc.text("MP X RM", 242, 300, "left")
        doc.text("1.30", 338, 300, "right")
        doc.line(290, 303, 338, 303)
        doc.text("SMP : RM", 340, 300, "left")
        doc.text("88.40", 460, 300, "right")
        doc.line(390, 303, 460, 303)

        doc.text("TINGKAT BAWAH", 50, 317, "left")
        doc.text("68.00", 240, 317, "right")
        doc.line(170, 320, 240, 320)
        doc.text("MP X RM", 242, 317, "left")
        doc.text("1.30", 338, 317, "right")
        doc.line(290, 320, 338, 320)
        doc.text("SMP : RM", 340, 317, "left")
        doc.text("88.40", 460, 317, "right")
        doc.line(390, 320, 460, 320)

        doc.text("RM", 450, 332, "left")
        doc.text("88.40", 540, 332, "right")
        doc.line(466, 335, 540, 335)

        doc.text("NILAIAN", 50, 355, "left")
        doc.text(":", 150, 355, "left")
        doc.text("BANGUNAN LUAR", 170, 355, "left")

        doc.text("68.00", 240, 380, "right")
        doc.line(170, 383, 240, 383)
        doc.text("MP X RM", 242, 380, "left")
        doc.text("1.30", 338, 380, "right")
        doc.line(290, 383, 338, 383)
        doc.text("SMP : RM", 340, 380, "left")
        doc.text("88.40", 460, 380, "right")
        doc.line(390, 383, 460, 383)

        doc.text("RM", 450, 394, "left")
        doc.text("88.40", 540, 394, "right")
        doc.line(466, 397, 540, 397)

        doc.setFont("helvetica", "bold")
        doc.text("ANGGARAN SEWA BULANAN", 400, 420, "right")
        doc.text(":", 430, 420, "left")
        doc.text("RM", 450, 420, "left")
        doc.text("88.40", 540, 420, "right")
        doc.line(466, 423, 540, 423)

        doc.setFont("helvetica", "normal")
        doc.text("+Corner Lot 10 %", 400, 445, "right")
        doc.text(":", 430, 445, "left")
        doc.text("RM", 450, 445, "left")
        doc.text("88.40", 540, 445, "right")
        doc.line(466, 448, 540, 448)

        doc.text("SEWA SEBULAN DIGENABKAN", 400, 470, "right")
        doc.text(":", 430, 470, "left")
        doc.text("RM", 450, 470, "left")
        doc.text("88.40", 540, 470, "right")
        doc.line(466, 473, 540, 473)

        doc.setFont("helvetica", "bold")
        doc.text("NILAI TAHUNAN", 400, 495, "right")
        doc.text(":", 430, 495, "left")
        doc.text("RM", 450, 495, "left")
        doc.text("88.40", 540, 495, "right")
        doc.line(466, 498, 540, 498)

        doc.setFont("helvetica", "normal")
        doc.text("KADAR", 400, 520, "right")
        doc.text(":", 430, 520, "left")
        doc.text("RM", 450, 520, "left")
        doc.text("88.40", 540, 520, "right")
        doc.line(466, 523, 540, 523)

        doc.setFont("helvetica", "bold")
        doc.text("CUKAI TAKSIRAN", 400, 545, "right")
        doc.text(":", 430, 545, "left")
        doc.text("RM", 450, 545, "left")
        doc.text("88.40", 540, 545, "right")
        doc.line(466, 548, 540, 548)

        doc.setFont("helvetica", "normal")
        doc.text("NILAIAN", 50, 570, "left")
        doc.setFont("helvetica", "bold")
        doc.text(":", 150, 570, "left")
        doc.text("RM", 170, 570, "left")
        doc.text("1,380.00", 270, 570, "right")
        doc.setFont("helvetica", "normal")
        doc.text("MULAI", 280, 570, "left")
        doc.setFont("helvetica", "bold")
        doc.text("1.7.2023", 385, 570, "right")

        doc.setLineWidth(2)
        doc.setFont("helvetica", "normal")
        doc.text("DINILAI OLEH", 320, 595, "right")
        doc.text(":", 330, 595, "left")
        doc.setFont("helvetica", "bold")
        doc.text("(PEN. PENGAWAI PENILAIAN)", 345, 610, "left")
        doc.setLineDash([2, 2], 0)
        doc.line(345, 598, 515, 598)
        doc.setFont("helvetica", "normal")
        doc.text("TARIKH", 320, 630, "right")
        doc.text(":", 330, 630, "left")

        doc.setFont("helvetica", "bold")
        doc.text("DILULUSKAN / TIDAK DILULUSKAN", 320, 665, "right")
        doc.text(":", 330, 665, "left")
        doc.setFont("helvetica", "bold")
        doc.text("(PEN. PENGAWAI PENILAIAN KANAN)", 345, 680, "left")
        doc.setLineDash([2, 2], 0)
        doc.line(345, 668, 515, 668)
        doc.setFont("helvetica", "normal")
        doc.text("TARIKH", 320, 700, "right")
        doc.text(":", 330, 700, "left")
      } else if (type == "building") {
        doc.addImage(config.root + "img/logo_letter.jpg", "JPEG", 125, 40, 350, 90)
        doc.setLineWidth(1)
        doc.line(50, 200, 550, 200)
        doc.setFontSize(11)
        doc.setFont("helvetica", "normal", "bold")
        doc.text("JABATAN PENILAIAN DAN PENGURUSAN HARTA", 300, 216, "center")
        doc.line(168, 220, 432, 220)

        doc.text("KERTAS PENILAIAN", 300, 250, "center")
        doc.line(246, 254, 354, 254)

        doc.setLineWidth(2)
        doc.rect(386, 260, 160, 16)
        doc.text("LOT HUJUNG", 466, 272, "center")
      } else if (type == "special") {
        var doc = new jsPDF("p", "pt", "a4")

        doc.addImage("logo_letter.jpg", "JPEG", 125, 40, 350, 90)
        doc.setFontSize(12)
        doc.setFont("times", "bold")
        doc.text("JABATAN PENILAIAN DAN PENGURUSAN HARTA", 297, 156, "center")

        doc.setFontSize(10)
        doc.setFont("helvetica", "bold")
        doc.text("ALAMAT HARTA", 70, 180, "left")
        doc.text(":", 155, 180, "left")
        doc.text("TAMAN SAUJANA INDAH, 35400 TAPAH ROAD", 170, 180, "left")

        doc.text("A.", 55, 210, "left")
        doc.text("TANAH :-", 70, 210, "left")
        doc.setFont("helvetica", "normal")

        doc.text("21,888.8888", 260, 225, "right")
        doc.text("mp @  RM", 270, 225, "left")
        doc.text("1.30", 355, 225, "right")
        doc.text("smp", 360, 225, "left")
        doc.text("=    RM", 393, 225, "left")
        doc.text("151,000.00", 510, 225, "right")

        doc.text("Pelarasan :", 70, 245, "left")
        doc.text("(-)", 70, 260, "left")
        doc.text("%", 355, 260, "right")
        doc.text("=    RM", 393, 260, "left")
        doc.text("151,000.00", 510, 260, "right")

        doc.text("RM", 410, 285, "left")
        doc.text("151,000.00", 510, 285, "right")

        doc.setFont("helvetica", "bold")
        doc.text("B.", 55, 315, "left")
        doc.text("Bangunan :-", 70, 315, "left")

        doc.text("1", 55, 335, "left")
        doc.text("KILANG & STOR BATA (BANGUNAN TERBUKA)", 70, 335, "left")

        doc.setFont("helvetica", "normal")
        doc.text("MFA", 70, 355, "left")
        doc.text("21,888.8888", 260, 355, "right")
        doc.text("mp @  RM", 270, 355, "left")
        doc.text("1.30", 355, 355, "right")
        doc.text("smp", 360, 355, "left")
        doc.text("=    RM", 393, 355, "left")
        doc.text("151,000.00", 510, 355, "right")

        doc.text("AFA", 70, 375, "left")
        doc.text("21,888.8888", 260, 375, "right")
        doc.text("mp @  RM", 270, 375, "left")
        doc.text("1.30", 355, 375, "right")
        doc.text("smp", 360, 375, "left")
        doc.text("=    RM", 393, 375, "left")
        doc.text("151,000.00", 510, 375, "right")

        doc.setFont("helvetica", "bold")
        doc.text("151,000.00", 510, 395, "right")
        doc.line(426, 384, 510, 384)

        doc.setFont("helvetica", "normal")
        doc.text("Pelarasan :", 70, 415, "left")
        doc.text("(-) Susut Nilai Bangunan", 70, 430, "left")
        doc.text("%", 355, 430, "right")
        doc.text("=    RM", 393, 430, "left")
        doc.text("151,000.00", 510, 430, "right")

        doc.setFont("helvetica", "bold")
        doc.text("RM", 410, 450, "left")
        doc.text("151,000.00", 510, 450, "right")

        doc.text("2", 55, 480, "left")
        doc.text("PEJABAT", 70, 480, "left")

        doc.setFont("helvetica", "normal")
        doc.text("MFA", 70, 500, "left")
        doc.text("21,888.8888", 260, 500, "right")
        doc.text("mp @  RM", 270, 500, "left")
        doc.text("1.30", 355, 500, "right")
        doc.text("smp", 360, 500, "left")
        doc.text("=    RM", 393, 500, "left")
        doc.text("151,000.00", 510, 500, "right")

        doc.text("AFA", 70, 520, "left")
        doc.text("21,888.8888", 260, 520, "right")
        doc.text("mp @  RM", 270, 520, "left")
        doc.text("1.30", 355, 520, "right")
        doc.text("smp", 360, 520, "left")
        doc.text("=    RM", 393, 520, "left")
        doc.text("151,000.00", 510, 520, "right")

        doc.setFont("helvetica", "bold")
        doc.text("151,000.00", 510, 540, "right")
        doc.line(426, 527, 510, 527)

        doc.setFont("helvetica", "normal")
        doc.text("Pelarasan :", 70, 560, "left")
        doc.text("(-) Susut Nilai Bangunan", 70, 575, "left")
        doc.text("%", 355, 575, "right")
        doc.text("=    RM", 393, 575, "left")
        doc.text("151,000.00", 510, 575, "right")

        doc.setFont("helvetica", "bold")
        doc.text("RM", 410, 595, "left")
        doc.text("151,000.00", 510, 595, "right")

        doc.setFont("helvetica", "normal")
        doc.setFontSize(11)
        doc.text("BERSAMBUNG...", 70, 630, "left")

        doc.addPage()
        doc.addImage("logo_letter.jpg", "JPEG", 125, 40, 350, 90)
        doc.setFontSize(12)
        doc.setFont("times", "bold")
        doc.text("JABATAN PENILAIAN DAN PENGURUSAN HARTA", 297, 156, "center")

        doc.setFontSize(10)
        doc.setFont("helvetica", "bold")
        doc.text("ALAMAT HARTA", 70, 180, "left")
        doc.text(":", 155, 180, "left")
        doc.text("TAMAN SAUJANA INDAH, 35400 TAPAH ROAD", 170, 180, "left")

        doc.setFont("helvetica", "normal")
        doc.text("SAMBUNGAN...", 70, 220, "left")

        doc.setLineWidth(2)
        doc.line(408, 238, 512, 238)

        doc.setFont("helvetica", "bold")
        doc.text("Nilai Modal", 70, 250, "left")
        doc.text("RM", 410, 250, "left")
        doc.text("492,072.59", 510, 250, "right")

        doc.setFont("helvetica", "normal")
        doc.text("X", 55, 280, "left")
        doc.text("(SEKSYEN 2 AKTA 171, 10%)", 70, 280, "left")
        doc.text("10%", 510, 280, "right")

        doc.setLineWidth(2)
        doc.line(408, 288, 512, 288)

        doc.setFont("helvetica", "bold")
        doc.text("Nilai Sewa Setahun", 70, 300, "left")
        doc.text("RM", 410, 300, "left")
        doc.text("49,207.26", 510, 300, "right")

        doc.text("NILAI TAHUNAN (DIGENABKAN)", 70, 340, "left")

        doc.setFont("helvetica", "normal")
        doc.text("Katakan", 360, 340, "left")

        doc.setFont("helvetica", "bold")
        doc.text("RM", 410, 340, "left")
        doc.text("50,000.00", 510, 340, "right")
        doc.text("Kadar (6.5%)", 70, 370, "left")

        doc.setFont("helvetica", "normal")
        doc.text("0.065", 510, 370, "right")
        doc.setLineWidth(1)
        doc.line(408, 378, 512, 378)

        doc.setFont("helvetica", "bold")
        doc.text("Cukai Taksiran", 70, 390, "left")
        doc.text("RM", 410, 390, "left")
        doc.text("49,207.26", 510, 390, "right")

        doc.setLineWidth(2)
        doc.line(408, 398, 512, 398)

        doc.text("KUATKUASA PADA", 55, 440, "left")
        doc.text("01.07.2022", 280, 440, "right")

        doc.setFont("helvetica", "normal")
        doc.text("DISEDIAKAN OLEH :", 70, 480, "left")
        doc.text("Tarikh", 70, 505, "left")
        doc.text("DILULUSKAN / TIDAK DILULUSKAN :", 70, 550, "left")
        doc.text("Tarikh", 70, 575, "left")
      }
      window.open(doc.output("bloburl").toString(), "_blank")
    }
  })
}

function firstUpperCase(str) {
  var text
  if (str != null) {
    var string = str.toLowerCase()
    var arr = string.split(" ")
    for (var i = 0; i < arr.length; i++) {
      arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1)
    }
    text = arr.join(" ")
  } else {
    text = ""
  }
  return text
}

function getFormattedDate(date) {
  let year = date.getFullYear()
  let month = (1 + date.getMonth()).toString().padStart(2, "0")
  let day = date.getDate().toString().padStart(2, "0")

  return day + "/" + month + "/" + year
}
