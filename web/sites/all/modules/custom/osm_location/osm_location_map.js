function osm_location_map_init(locations) {
  var coordinates = [];
  for (var i = 0; i < locations.length; i++) {
    coordinates[i] = [locations[i].lat, locations[i].long];
  }
  var mymap = L.map('mapid').fitBounds(coordinates);

  L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox.streets'
  }).addTo(mymap);

  for (var i = 0; i < locations.length; i++) {
    L.marker([locations[i].lat, locations[i].long]).addTo(mymap)
      .bindPopup("<b>" + locations[i].title + "</b><br />" + [locations[i].lat + ", " + locations[i].long] + ".").openPopup();
  }

  // Debug utility for testing.
  function onMapClick(e) {
    console.log("clicked at " + e.latlng.toString());
  }

  mymap.on('click', onMapClick);
}
