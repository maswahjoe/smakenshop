(function( $ ) {
	'use strict';

  $(function() {
    /* Hide the component states, city, & postcode */
    setTimeout(function(){
      const prefixs = ["billing", "shipping"];
      prefixs.forEach(prefix => {
        let hide_component = [
                              prefix+"_address_1_field", prefix+"_address_2_field",
                              prefix+"_state_field", prefix+"_city_field", 
                              prefix+"_postcode_field", prefix+"biteship_district", 
                              prefix+"_biteship_district_info_field"
                        ];
          hide_component.forEach(element => {
              $(`#${element}`).hide();
          });
          $(`#${prefix}_biteship_location`).css({"padding-left": "29px", "background": 'url("'+window.location.protocol+"//"+window.location.host.replace("www.", "")+'/wp-content/plugins/biteship/public/images/pin.svg") no-repeat left', "background-size" : "13px", "background-position": "7px", "height": "48px"});
      });
      $("#myModal").hide();
      customShippingText($);
    },500)
  });

  $(function() {
    $("#billing_biteship_address").change(function() {
      var billing_address = $("#billing_biteship_address").val();
      $("#billing_address_1").val(billing_address);
    });
    $("#shipping_biteship_address").change(function() {
      var shipping_address = $("#shipping_biteship_address").val();
      $("#shipping_address_1").val(shipping_address);
    });
    $("#billing_biteship_location").click(function() {
      $("#myModal").show();
    });
  });

  $(function() {
    $('body').append(`<div id="myModal" class="modal">
      <div class="modal-content">
        <div>
          <span style="font-size: 25px;">Pin Alamat</span>
          <span class="close">&times;</span>
        </div>
        <form id="mapSearchForm" style="margin-top: 10px;font-size:13px;">
          <input style="width: 100%" type="text" id="placeSearch" placeholder="Masukkan alamat lengkap yang ada atau pilih pin"> 
        </form>
        <div id="map" class="map-order-review"></div>
      </div>
    </div>`);

    if (!phpVars) {
      phpVars = {};
    }

    setTimeout(function(){
      $("[data-title=Shipping]").text("Masukkan alamat lengkap untuk menghitung ongkos kirim")
    },200);


    var marker = null;
    var infoWindow = null;
    var enc = function(s, b) { var w = ""; for (var i = 0; i < s.length; i++) { w += String.fromCharCode(s.charCodeAt(i) ^ b) } return unescape(w) };
    var apiKey = enc(phpVars.apiKey, window.location.host.replace("www.", "").length) || '';
    $.getScript(`https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`, function() {
      var myLatLng = {lat: -6.1753871, lng: 106.8249641};
      var map = new google.maps.Map(
        document.getElementById('map'), {
          zoom: 15, 
          center: myLatLng,
          disableDefaultUI: true,
          fullscreenControl: true
        }
      );
      marker = new google.maps.Marker({
        position: null,
        map: null,
        title: 'Location'
      })
      infoWindow = new google.maps.InfoWindow({});
      map.addListener('click', function(mapsMouseEvent) {
        var selectedPosition = mapsMouseEvent.latLng
        setPosition(marker, infoWindow, map, selectedPosition, $);
      });

      var placesAutoCompleteConfig = {
        source: function (request, response) {
          var placeService = new google.maps.places.PlacesService(map);
          var searchRequest = {
            query: request.term,
            fields: ['name', 'geometry', 'formatted_address'],
            locationBias: new google.maps.LatLng(-2.3932545,108.8479564) /*Indonesia*/
          }
          placeService.findPlaceFromQuery(searchRequest, function (results, status) {
            if (status !== google.maps.places.PlacesServiceStatus.OK) {
              response([]);
            }
            var result = results.map(function (val) {
              var value = `${val.name}, ${val.formatted_address}`;
              return {
                label: value,
                value: value,
                location: val.geometry.location
              }
            });
            response(result);
          })
        },
        select: function (_, ui) {
          if (ui.item) {
            map.setCenter(ui.item.location);
            setPosition(marker, infoWindow, map, ui.item.location, $);
          }
        }
      }

      var placeSearchInput = $('#placeSearch')
      placeSearchInput.autocomplete(placesAutoCompleteConfig)
      placeSearchInput.autocomplete("option", "appendTo", "#mapSearchForm")

      if (!phpVars.shouldUseMapModal) {
        var billingLocationInput = $("#billing_biteship_location")
        var shippingLocationInput = $("#shipping_biteship_location")
        billingLocationInput.autocomplete(placesAutoCompleteConfig)
        shippingLocationInput.autocomplete(placesAutoCompleteConfig)

        jQuery.ui.autocomplete.prototype._resizeMenu = function () {
          var ul = this.menu.element;
          ul.outerWidth(this.element.outerWidth());
        }
      }
    });

    var modal = $('#myModal')
    var close = $('.close')
    var billingLocationInput = $("#billing_biteship_location")
    var shippingLocationInput = $("#shipping_biteship_location")
    if (billingLocationInput.length > 0) {
      if (phpVars.shouldUseMapModal) {
        billingLocationInput[0].addEventListener("focus", function() {
          modal.css('display', 'block')
        })
      }
    }
    if (shippingLocationInput.length > 0) {
      if (phpVars.shouldUseMapModal) {
        shippingLocationInput[0].addEventListener("focus", function() {
          modal.css('display', 'block')
        })
      }
    }
    if (close.length > 0) {
      close[0].addEventListener("click", function() {
        closeModal(modal);
      })
    }

    $(document).on("click", ".select-location", function () {
      closeModal(modal);
      $(document.body).trigger( 'update_checkout' );
    })

    var states = {}
    $.each($("#billing_state").prop("options"), function(i, opt) {
      states[opt.value] = opt.textContent
    })

    var billingBiteshipDistrict = $("#billing_biteship_new_district");
    var shippingBiteshipDistrict = $("#shipping_biteship_new_district");
    billingBiteshipDistrict.autocomplete(geAreas($, states, "billing")).autocomplete( "instance" )._renderItem = function( ul, item ) {
      let msg = "<div style='border-bottom: 1px solid #ddd;font-size: 12px;'>" + item.label + "<br>" + item.desc + "<b>"+item.zipcode+"</b></div>" 
      if(item.desc === "not_found"){
        msg = "<div style='border-bottom: 1px solid #ddd;font-size: 12px;'><font color='red'>" + item.label + "</font></div>" 
      }
      return $("<li>").append(msg).appendTo(ul);
    };
    shippingBiteshipDistrict.autocomplete(geAreas($, states, "shipping")).autocomplete( "instance" )._renderItem = function( ul, item ) {
      let msg = "<div style='border-bottom: 1px solid #ddd;font-size: 12px;'>" + item.label + "<br>" + item.desc + "<b>"+item.zipcode+"</b></div>" 
      if(item.desc === "not_found"){
        msg = "<div style='border-bottom: 1px solid #ddd;font-size: 12px;'><font color='red'>" + item.label + "</font></div>" 
      }
      return $("<li>").append(msg).appendTo(ul);
    };

    /* Refresh fee calculation when payment method changed */
    $('form.checkout').on('change', 'input[name="payment_method"]', function(){
      $(document.body).trigger('update_checkout');
    });

    $('form.checkout').on('change', 'input[name="is_insurance_active"]', function() {
      $(document.body).trigger('update_checkout');
    })
  })

})( jQuery );

function getKeyByValue(object, value) {
  return Object.keys(object).find(key => object[key].toUpperCase() === value.toUpperCase());
}

function geAreas(jquery, states, addressType) {
  return {
    source: function (request, response) {
      var baseURL = phpVars.biteshipBaseUrl || '';
      var query = request.term.replace(/ /g, '+');
      jquery.ajax(`${baseURL}/v1/maps/areas?countries=ID&input=${query}&type=single`, {
        headers: {
          'authorization': `Bearer ${phpVars.biteshipLicenseKey || ''}`
        },
        success: function (data) {
          if (!data.success) {
            response([]);
          }
          if(data.areas.length === 0 ){
            return response([{
              label : "Alamat tidak ditemukan",
              desc : "not_found"
            }]);
          }
          var result = data.areas.map(function (val) {
            var title = `${val.administrative_division_level_1_name}`;
            var desc = `${val.administrative_division_level_2_name}, ${val.administrative_division_level_3_name}, `;
            return {
              label: title,
              provice: val.administrative_division_level_1_name,
              desc: desc,
              value: `${title}, ${desc}${val.postal_code}`,
              district: val.administrative_division_level_3_name,
              city: val.administrative_division_level_2_name,
              state: val.administrative_division_level_1_name,
              zipcode: val.postal_code
            }
          });
          response(result);
        },
        error: function (_) {
          alert("Gagal mencari lokasi berdasarkan provinsi, kota & kecamatan.");
        }
      });
    },
    select: function (_, ui) {
      if (ui.item) {
        jquery(`#${addressType}_city`).val(ui.item.city);
        var stateKey = getKeyByValue(states, ui.item.state);
        jquery(`#${addressType}_state`).val(stateKey);
        jquery(`#${addressType}_state`).select2().trigger('change');
        jquery(`#${addressType}_postcode`).val(ui.item.zipcode);
        jquery(`#${addressType}_biteship_district`).val(ui.item.district);
        jquery(`#${addressType}_biteship_district_info`).attr('rows', 4);
        jquery(`#${addressType}_biteship_district_info`).val(`Provinsi: ${ui.item.provice}\nKota: ${ui.item.city}\nKecamatan: ${ui.item.district}\nKode Pos: ${ui.item.zipcode}`);
        jquery(`#${addressType}_biteship_district_info`).attr('disabled','disabled');
        jquery(`#${addressType}_biteship_district_info_field`).show();
        jquery('body').trigger('update_checkout');
        customShippingText(jquery)
      }
    }
  }
}

function setPosition(marker, infoWindow, map, location, $) {
  marker.setPosition(location);
  marker.setMap(map);
  infoWindow.setContent("<p class='select-location'>Pilih titik ini</p>");
  infoWindow.setPosition(location);
  infoWindow.open(map, marker);

  var latLong = `${location.lat()},${location.lng()}`
  $('#position').val(latLong);
  getAddress($,latLong);
  $("#billing_biteship_location_coordinate").val(latLong);
  $("#shipping_biteship_location_coordinate").val(latLong);
  $(document.body).trigger('update_checkout');
}

function getAddress($, latLong){
  var enc = function(s, b) { var w = ""; for (var i = 0; i < s.length; i++) { w += String.fromCharCode(s.charCodeAt(i) ^ b) } return unescape(w) };
  var apiKey = enc(phpVars.apiKey, window.location.host.replace("www.", "").length) || '';    
  $.ajax({
      url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latLong}&sensor=true&key=${apiKey}`,
      type: 'GET',
      success: function(response) {
        switch (response.status) {
          case 'OK':
            var address = response.results[0].formatted_address
            $("#billing_biteship_location").val(address).addClass('valid');
            $("#shipping_biteship_location").val(address).addClass('valid');
            if(address.length>=110){
              $(`#billing_biteship_location`).css({"padding-left": "29px", "background": 'url("'+window.location.protocol+"//"+window.location.host.replace("www.", "")+'/wp-content/plugins/biteship/public/images/pin.svg") no-repeat left', "background-size" : "13px", "background-position": "7px", "height": "66px"});
              $(`#shipping_biteship_location`).css({"padding-left": "29px", "background": 'url("'+window.location.protocol+"//"+window.location.host.replace("www.", "")+'/wp-content/plugins/biteship/public/images/pin.svg") no-repeat left', "background-size" : "13px", "background-position": "7px", "height": "66px"});
            }else{
              $(`#billing_biteship_location`).css({"padding-left": "29px", "background": 'url("'+window.location.protocol+"//"+window.location.host.replace("www.", "")+'/wp-content/plugins/biteship/public/images/pin.svg") no-repeat left', "background-size" : "13px", "background-position": "7px", "height": "48px"});
              $(`#shipping_biteship_location`).css({"padding-left": "29px", "background": 'url("'+window.location.protocol+"//"+window.location.host.replace("www.", "")+'/wp-content/plugins/biteship/public/images/pin.svg") no-repeat left', "background-size" : "13px", "background-position": "7px", "height": "48px"});
            }
            break;
          default:
            alert(response.status)
            /*var locationNotice = "Titik sudah terpasang";
            $("#billing_biteship_location").val(locationNotice).addClass('valid');
            $("#shipping_biteship_location").val(locationNotice).addClass('valid');
            break;*/
        }
      }
  })
}

function customShippingText($){
  if($("[data-title=Shipping]").html() !== undefined){
    if($("[data-title=Shipping]").html().includes("options")){
      $("[data-title=Shipping]").text("Masukkan alamat lengkap untuk menghitung ongkos kirim.")
    }
  }
}

function closeModal(modal) {
  modal.css('display', 'none');
}