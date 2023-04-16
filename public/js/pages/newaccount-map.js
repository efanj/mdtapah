//------------- blank.js -------------//
$(document).ready(function () {
  var api_url = "https://geoserver.mdtapah.gov.my/geoserver/mdt/wms?"
  var popup = L.popup()

  var g_roadmap = new L.Google("ROADMAP")
  var g_terrain = new L.Google("TERRAIN")
  var g_satellite = new L.Google("SATELLITE")

  var visitwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mdt:v_semak",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })
  // var paymentwmsLayer = L.tileLayer.betterWms(api_url, {
  //   layers: "mdt:v_payment_all",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  // })
  var lotndcdbwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mdt:lot_ndcdb",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var lotkomitedwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mdt:lot_komited",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var lotperancangwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mdt:lot_perancang",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var sempadanwmsLayer = L.tileLayer.wms(api_url, {
    layers: "mdt:daerah",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var map = L.map("mapView", {
    center: [4.0500455, 101.3585305],
    zoom: 10,
    markerZoomAnimation: false,
    zoomControl: false,
    maxZoom: 25
  })
  var zoomControl = new L.Control.Zoom({ position: "topright" })
  zoomControl.addTo(map)

  var baseMaps = [
    {
      groupName: "Base Maps",
      expanded: true,
      layers: {
        "Google Map - Satellite": g_satellite,
        "Google Map - Terrain": g_terrain,
        "Google Map - Road Map": g_roadmap
      }
    }
  ]
  var overlays = [
    {
      groupName: "Overlay",
      expanded: true,
      layers: {
        Sempadan: sempadanwmsLayer,
        "Lot NDCDB": lotndcdbwmsLayer,
        "Lot komited": lotkomitedwmsLayer,
        "Lot Perancang": lotperancangwmsLayer
        // Dilawati: visitwmsLayer,
      }
    }
  ]
  var options = {
    container_width: "250px",
    group_maxHeight: "150px",
    exclusive: false,
    collapsed: true,
    position: "topright"
  }

  var control = L.Control.styledLayerControl(baseMaps, overlays, options)
  map.addControl(control)
  control.selectLayer(g_roadmap)
  control.selectLayer(sempadanwmsLayer)
  control.selectLayer(lotndcdbwmsLayer)
  control.selectLayer(lotkomitedwmsLayer)
  control.selectLayer(lotperancangwmsLayer)

  var bounds = map.getBounds()
  var southWest = bounds.getSouthWest()
  var northEast = bounds.getNorthEast()
  // console.log(southWest, northEast)
  var input = document.getElementById("google_term")
  var bounds = new google.maps.LatLngBounds(new google.maps.LatLng(southWest), new google.maps.LatLng(northEast))
  var options = {
    bounds: bounds,
    // location: new google.maps.LatLng(4.265604, 100.9320657),
    radius: 25000, // (in meters; this is 15Km)
    types: ["establishment"],
    strictBounds: true,
    componentRestrictions: {
      country: ["my"]
    }
  }
  var autocomplete = new google.maps.places.Autocomplete(input, options)
  autocomplete.addListener("place_changed", function () {
    // clearOverlayVector();
    var places = autocomplete.getPlace()

    if (!places.geometry) {
      window.alert("No details available for input: '" + places.name + "'")
      return
    }

    var group = L.featureGroup()

    // Create a marker for each place.
    var marker = L.marker([places.geometry.location.lat(), places.geometry.location.lng()])
    group.addLayer(marker)

    group.addTo(map)
    map.fitBounds(group.getBounds())
  })

  map.on("overlayadd", function (eventLayer) {
    if (eventLayer.name === "Bayaran") {
      layerLegend.addTo(this)
    }
  })
  map.on("overlayremove", function (eventLayer) {
    if (eventLayer.name === "Bayaran") {
      this.removeControl(layerLegend)
    }
  })

  map.on("click", function (e) {
    console.log(e.latlng)
    var lat = e.latlng.lat
    var lng = e.latlng.lng
    $("#codex").val(lat.toString().substr(0, 15))
    $("#codey").val(lng.toString().substr(0, 15))
    L.marker([lat, lng]).addTo(map)
    const lnglat = [e.latlng.lat, e.latlng.lng]
    map.setView(lnglat, 16)
  })

  $("#mapView").on("click", "#copy", function () {
    var copy = $(this)
    var lot = copy.data("lot")
    var luasan = copy.data("luasan")
    $("#noLot").val(lot)
    $("#lstnh").val(luasan)
  })
})
