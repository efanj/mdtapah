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
  var kadlotwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mdt:lot",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })
  // var mukimwmsLayer = L.tileLayer.wms(api_url, {
  //   layers: "mdt:mukim",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  // })
  var sempadanwmsLayer = L.tileLayer.wms(api_url, {
    layers: "mdt:daerah",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var map = L.map("mapView", {
    center: [4.0943935, 101.2823129],
    zoom: 10.5,
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
        Kadlot: kadlotwmsLayer
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
  control.selectLayer(kadlotwmsLayer)

  var input = document.getElementById("google_term")
  var mdptBounds = new google.maps.LatLngBounds(new google.maps.LatLng(4.584785, 100.699578))
  var options = {
    bounds: mdptBounds,
    // location: new google.maps.LatLng(4.265604, 100.9320657),
    // radius: 15000, // (in meters; this is 15Km)
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

  var theMarker = {}

  map.on("click", function (e) {
    lat = e.latlng.lat
    lon = e.latlng.lng

    $("#codex").val(lat)
    $("#codey").val(lon)

    if (theMarker != undefined) {
      map.removeLayer(theMarker)
    }

    //Add a marker to show where you clicked.
    theMarker = L.marker([lat, lon]).addTo(map)
    map.setView([lat, lon], 16)
  })
})
