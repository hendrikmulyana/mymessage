/**
 * Created by EBOD on 7/29/2017.
 */

var map;
var marker_name = 'null';

$(document).ready(function () {

    var styledMapType = new google.maps.StyledMapType(
        [
            {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
            {
                featureType: 'administrative',
                elementType: 'geometry.stroke',
                stylers: [{color: '#c9b2a6'}]
            },
            {
                featureType: 'administrative.land_parcel',
                elementType: 'geometry.stroke',
                stylers: [{color: '#dcd2be'}]
            },
            {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#ae9e90'}]
            },
            {
                featureType: 'landscape.natural',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
            },
            {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#93817c'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry.fill',
                stylers: [{color: '#a5b076'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#447530'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
            },
            {
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [{color: '#fdfcf8'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#f8c967'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e9bc62'}]
            },
            {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry',
                stylers: [{color: '#e98d58'}]
            },
            {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry.stroke',
                stylers: [{color: '#db8555'}]
            },
            {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#806b63'}]
            },
            {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
            },
            {
                featureType: 'transit.line',
                elementType: 'labels.text.fill',
                stylers: [{color: '#8f7d77'}]
            },
            {
                featureType: 'transit.line',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#ebe3cd'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [{color: '#b9d3c2'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#92998d'}]
            }
        ],
        {name: 'Styled Map'});

    function edit_marker_name(a, thiis){

        var edit_marker_name = prompt("Edit marker name", $(thiis).html());

        marker = window['marker_' + a];

        if(edit_marker_name)
        {
            $(thiis).html(edit_marker_name);

            marker.setTitle(edit_marker_name);

            google.maps.event.clearListeners(marker, 'click');

            var content = "<span class='destination_name' onclick='edit_marker_name(\"" + a + "\", this)'>" + edit_marker_name + "</span>";
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                };
            })(marker,content,infowindow));
        }
    }

    function initialize() {
    var myMap = {lat: -7.7976366, lng: 110.3700377};
     map = new google.maps.Map(document.getElementById('map'), {
            center: myMap,
            zoom: 13,
         mapTypeControlOptions: {
             mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                 'styled_map']
         }
     });

    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');

        google.maps.event.addListener(map, 'click', function(event)
        {
            if( marker_name == 'null' ){
                marker_name = 'a';
            }else{
                marker_name = String.fromCharCode( marker_name.charCodeAt(0) + 1 );
            }

            icons = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
            var location = event.latLng;
            window['marker_' + marker_name] = new google.maps.Marker({
                position: location,
                map: map,
                icon: icons,
                draggable: true,
                title: '' + marker_name
            });
            var marker = window['marker_' + marker_name];
            var content = "<span class='destination_name' onclick='edit_marker_name(\"" + marker_name + "\", this)'>" + marker_name + "</span>";
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                };
            })(marker,content,infowindow));
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
})