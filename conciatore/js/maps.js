
function initMap() {
     // Specify features and elements to define styles.
  var styleArray = [
    {
      featureType: "all",
      stylers: [
       { saturation: -80 }
      ]
    },{
      featureType: "road.arterial",
      elementType: "geometry",
      stylers: [
        { hue: "#00ffee" },
        { saturation: 50 }
      ]
    },{
      featureType: "poi.business",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
    }
  ];
    
  var uluru = {lat: 37.507953, lng: 127.054158};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 18,
    center: uluru,
      styles: styleArray
  });

  var contentString = '<div id="content">'+
      '<h1 id="firstHeading" class="firstHeading">Conciatore</h1>'+
      '<div id="bodyContent">'+
      '<address>서울 강남구 삼성동 테헤란로 77길 승광빌딩 2층<br/> Tel. 02-1234-1234</address>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
    title: 'Uluru (Ayers Rock)'
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}