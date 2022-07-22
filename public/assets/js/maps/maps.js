/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/assets/js/maps/maps.js ***!
  \******************************************/


var geocoder;
var map;
var polygonCoordsArray = [];
var selectedPolygonCoordsArray = [];
var selectedPolygon;

function initialize() {
  map = new google.maps.Map(document.getElementById("mapCanvas"), {
    center: new google.maps.LatLng(14.420715, 120.967856),
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  if (SelectedLatLngObject.length > 0) {
    $.each(SelectedLatLngObject, function (i, v) {
      selectedPolygonCoordsArray.push(new google.maps.LatLng(v.lng, v.lat));
    }); // Construct the polygon

    selectedPolygon = new google.maps.Polygon({
      paths: selectedPolygonCoordsArray,
      draggable: true,
      editable: true,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35
    });
    selectedPolygon.setMap(map);
    google.maps.event.addListener(selectedPolygon.getPath(), "insert_at", selectedPolygonCoordsArray);
    google.maps.event.addListener(selectedPolygon.getPath(), "remove_at", selectedPolygonCoordsArray);
    google.maps.event.addListener(selectedPolygon.getPath(), "set_at", selectedPolygonCoordsArray);
  } else {
    var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: [// google.maps.drawing.OverlayType.MARKER,
        // google.maps.drawing.OverlayType.CIRCLE,
        google.maps.drawing.OverlayType.POLYGON // google.maps.drawing.OverlayType.POLYLINE,
        // google.maps.drawing.OverlayType.RECTANGLE
        ]
      },
      // markerOptions: {
      //     icon: 'images/car-icon.png'
      // },
      // circleOptions: {
      //     fillColor: '#ffff00',
      //     fillOpacity: 1,
      //     strokeWeight: 5,
      //     clickable: false,
      //     editable: true,
      //     zIndex: 1
      // },
      polygonOptions: {
        fillColor: '#FF0000',
        fillOpacity: 0.5,
        strokeWeight: 2,
        strokeColor: '#FF0000',
        clickable: false,
        editable: false,
        zIndex: 1,
        strokeOpacity: 0.8
      }
    });
    drawingManager.setMap(map);
    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
      for (var i = 0; i < polygon.getPath().getLength(); i++) {
        polygonCoordsArray.push(polygon.getPath().getAt(i).toUrlValue(6));
      }
    });
  }
}

google.maps.event.addDomListener(window, "load", initialize); // Store LatLan

$(document).on('submit', '#addForm', function (event) {
  event.preventDefault();
  var loadingButton = $('#btnSave');

  if (polygonCoordsArray.length == 0) {
    displayErrorMessage('Select latitude and longitude');
    loadingButton.button('reset');
    return false;
  }

  loadingButton.button('loading');
  $.ajax({
    url: createMapUrl,
    type: 'POST',
    data: {
      latLngArray: polygonCoordsArray
    },
    success: function success(obj) {
      if (obj.success) {
        displaySuccessMessage(obj.message);
        loadingButton.button('reset');
        location.reload();
      }
    },
    error: function error(data) {
      displayErrorMessage(data.message);
      loadingButton.button('reset');
    }
  });
}); // Delete LatLan

$(document).on('click', '#btnDelete', function (event) {
  event.preventDefault();
  var loadingButton = $('#btnDelete');
  loadingButton.button('loading');
  $.ajax({
    url: mapsUrl + '1',
    type: 'DELETE',
    success: function success(obj) {
      if (obj.success) {
        displaySuccessMessage(obj.message);
        loadingButton.button('reset');
        location.reload();
      }
    },
    error: function error(data) {
      displayErrorMessage(data.message);
      loadingButton.button('reset');
    }
  });
});
/******/ })()
;