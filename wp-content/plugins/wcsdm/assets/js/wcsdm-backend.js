(function($) {
// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds.
function wcsdmDebounce(func, wait) {
  var timeout;
  return function () {
    var context = this;
    var args = arguments;
    var later = function () {
      timeout = null;
      func.apply(context, args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

function wcsdmToggleButtons(args) {
  var data = wcsdmGetButtons(args);
  $('#wcsdm-buttons').remove();
  $('#btn-ok').hide().after(wp.template('wcsdm-buttons')(data));
}

function wcsdmGetButtons(args) {
  var buttonLabels = wcsdmBackendVars.i18n.buttons;

  var leftButtonDefaultId = 'add-rate';
  var leftButtonDefaultIcon = 'plus';
  var leftButtonDefaultLabel = 'Add New Rate';

  var leftButtonDefault = {
    id: leftButtonDefaultId,
    icon: leftButtonDefaultIcon,
    label: leftButtonDefaultLabel
  };

  var rightButtonDefaultIcon = 'yes';
  var rightButtonDefaultId = 'save-settings';
  var rightButtonDefaultLabel = 'Save Changes';

  var rightButtonDefault = {
    id: rightButtonDefaultId,
    icon: rightButtonDefaultIcon,
    label: rightButtonDefaultLabel
  };

  var selected = {};
  var leftButton;
  var rightButton;

  if (_.has(args, 'left')) {
    leftButton = _.defaults(args.left, leftButtonDefault);

    if (_.has(buttonLabels, leftButton.label)) {
      leftButton.label = buttonLabels[leftButton.label];
    }

    selected.btn_left = leftButton;
  }

  if (_.has(args, 'right')) {
    rightButton = _.defaults(args.right, rightButtonDefault);

    if (_.has(buttonLabels, rightButton.label)) {
      rightButton.label = buttonLabels[rightButton.label];
    }

    selected.btn_right = rightButton;
  }

  if (_.isEmpty(selected)) {
    leftButton = _.defaults({}, leftButtonDefault);

    if (_.has(buttonLabels, leftButton.label)) {
      leftButton.label = buttonLabels[leftButton.label];
    }

    selected.btn_left = leftButton;

    rightButton = _.defaults({}, rightButtonDefault);

    if (_.has(buttonLabels, rightButton.label)) {
      rightButton.label = buttonLabels[rightButton.label];
    }

    selected.btn_right = rightButton;
  }

  return selected;
}

function wcsdmI18n(path) {
  if (typeof path === 'string') {
    path = path.split('.');
  }

  return _.property(path)(wcsdmBackendVars.i18n);
}

function wcsdmError(path) {
  if (typeof path === 'string') {
    path = path.split('.');
  }

  return _.property(path)(wcsdmBackendVars.i18n.errors);
}

function wcsdmSprintf() {
  //  discuss at: https://locutus.io/php/sprintf/
  // original by: Ash Searle (https://hexmen.com/blog/)
  // improved by: Michael White (https://getsprink.com)
  // improved by: Jack
  // improved by: Kevin van Zonneveld (https://kvz.io)
  // improved by: Kevin van Zonneveld (https://kvz.io)
  // improved by: Kevin van Zonneveld (https://kvz.io)
  // improved by: Dj
  // improved by: Allidylls
  //    input by: Paulo Freitas
  //    input by: Brett Zamir (https://brett-zamir.me)
  // improved by: Rafał Kukawski (https://kukawski.pl)
  //   example 1: sprintf("%01.2f", 123.1)
  //   returns 1: '123.10'
  //   example 2: sprintf("[%10s]", 'monkey')
  //   returns 2: '[    monkey]'
  //   example 3: sprintf("[%'#10s]", 'monkey')
  //   returns 3: '[####monkey]'
  //   example 4: sprintf("%d", 123456789012345)
  //   returns 4: '123456789012345'
  //   example 5: sprintf('%-03s', 'E')
  //   returns 5: 'E00'
  //   example 6: sprintf('%+010d', 9)
  //   returns 6: '+000000009'
  //   example 7: sprintf('%+0\'@10d', 9)
  //   returns 7: '@@@@@@@@+9'
  //   example 8: sprintf('%.f', 3.14)
  //   returns 8: '3.140000'
  //   example 9: sprintf('%% %2$d', 1, 2)
  //   returns 9: '% 2'

  var regex = /%%|%(?:(\d+)\$)?((?:[-+#0 ]|'[\s\S])*)(\d+)?(?:\.(\d*))?([\s\S])/g
  var args = arguments
  var i = 0
  var format = args[i++]

  var _pad = function (str, len, chr, leftJustify) {
    if (!chr) {
      chr = ' '
    }
    var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0).join(chr)
    return leftJustify ? str + padding : padding + str
  }

  var justify = function (value, prefix, leftJustify, minWidth, padChar) {
    var diff = minWidth - value.length
    if (diff > 0) {
      // when padding with zeros
      // on the left side
      // keep sign (+ or -) in front
      if (!leftJustify && padChar === '0') {
        value = [
          value.slice(0, prefix.length),
          _pad('', diff, '0', true),
          value.slice(prefix.length)
        ].join('')
      } else {
        value = _pad(value, minWidth, padChar, leftJustify)
      }
    }
    return value
  }

  var _formatBaseX = function (value, base, leftJustify, minWidth, precision, padChar) {
    // Note: casts negative numbers to positive ones
    var number = value >>> 0
    value = _pad(number.toString(base), precision || 0, '0', false)
    return justify(value, '', leftJustify, minWidth, padChar)
  }

  // _formatString()
  var _formatString = function (value, leftJustify, minWidth, precision, customPadChar) {
    if (precision !== null && precision !== undefined) {
      value = value.slice(0, precision)
    }
    return justify(value, '', leftJustify, minWidth, customPadChar)
  }

  // doFormat()
  var doFormat = function (substring, argIndex, modifiers, minWidth, precision, specifier) {
    var number, prefix, method, textTransform, value

    if (substring === '%%') {
      return '%'
    }

    // parse modifiers
    var padChar = ' ' // pad with spaces by default
    var leftJustify = false
    var positiveNumberPrefix = ''
    var j, l

    for (j = 0, l = modifiers.length; j < l; j++) {
      switch (modifiers.charAt(j)) {
        case ' ':
        case '0':
          padChar = modifiers.charAt(j)
          break
        case '+':
          positiveNumberPrefix = '+'
          break
        case '-':
          leftJustify = true
          break
        case "'":
          if (j + 1 < l) {
            padChar = modifiers.charAt(j + 1)
            j++
          }
          break
      }
    }

    if (!minWidth) {
      minWidth = 0
    } else {
      minWidth = +minWidth
    }

    if (!isFinite(minWidth)) {
      throw new Error('Width must be finite')
    }

    if (!precision) {
      precision = (specifier === 'd') ? 0 : 'fFeE'.indexOf(specifier) > -1 ? 6 : undefined
    } else {
      precision = +precision
    }

    if (argIndex && +argIndex === 0) {
      throw new Error('Argument number must be greater than zero')
    }

    if (argIndex && +argIndex >= args.length) {
      throw new Error('Too few arguments')
    }

    value = argIndex ? args[+argIndex] : args[i++]

    switch (specifier) {
      case '%':
        return '%'
      case 's':
        return _formatString(value + '', leftJustify, minWidth, precision, padChar)
      case 'c':
        return _formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, padChar)
      case 'b':
        return _formatBaseX(value, 2, leftJustify, minWidth, precision, padChar)
      case 'o':
        return _formatBaseX(value, 8, leftJustify, minWidth, precision, padChar)
      case 'x':
        return _formatBaseX(value, 16, leftJustify, minWidth, precision, padChar)
      case 'X':
        return _formatBaseX(value, 16, leftJustify, minWidth, precision, padChar)
          .toUpperCase()
      case 'u':
        return _formatBaseX(value, 10, leftJustify, minWidth, precision, padChar)
      case 'i':
      case 'd':
        number = +value || 0
        // Plain Math.round doesn't just truncate
        number = Math.round(number - number % 1)
        prefix = number < 0 ? '-' : positiveNumberPrefix
        value = prefix + _pad(String(Math.abs(number)), precision, '0', false)

        if (leftJustify && padChar === '0') {
          // can't right-pad 0s on integers
          padChar = ' '
        }
        return justify(value, prefix, leftJustify, minWidth, padChar)
      case 'e':
      case 'E':
      case 'f': // @todo: Should handle locales (as per setlocale)
      case 'F':
      case 'g':
      case 'G':
        number = +value
        prefix = number < 0 ? '-' : positiveNumberPrefix
        method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(specifier.toLowerCase())]
        textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(specifier) % 2]
        value = prefix + Math.abs(number)[method](precision)
        return justify(value, prefix, leftJustify, minWidth, padChar)[textTransform]()
      default:
        // unknown specifier, consume that char and return empty
        return ''
    }
  }

  try {
    return format.replace(regex, doFormat)
  } catch (err) {
    return false
  }
}

(function (w) {
  'use strict';

  var A, F, O, consoleMethods, fixConsoleMethod, consoleOn,
    allHandlers, methodObj;

  A = [];
  F = function () { return; };
  O = {};

  // All possible standard methods to provide an interface for
  consoleMethods = [
    'assert', 'clear', 'count', 'debug',
    'dir', 'dirxml', 'error', 'exception',
    'group', 'groupCollapsed', 'groupEnd',
    'info', 'log', 'profile', 'profileEnd',
    'table', 'time', 'timeEnd', 'timeStamp',
    'trace', 'warn'
  ];

  // Holds handlers to be executed for every method
  allHandlers = [];

  // Holds handlers per method
  methodObj = {};

  // Overrides the existing console methods, to call any stored handlers first
  fixConsoleMethod = (function () {
    var func, empty;

    empty = function () {
      return F;
    };

    if (w.console) {
      // If `console` is even available
      func = function (methodName) {
        var old;
        if (methodName in console && (old = console[methodName])) {
          // Checks to see if `methodName` is defined on `console` and has valid function to execute
          // (and stores the old handler)
          // This is important so that undefined methods aren't filled in
          console[methodName] = function () {
            // Overwrites current console method with this function
            var args, argsForAll, i, j;
            // Copy all arguments passed to handler
            args = A.slice.call(arguments, 0);
            for (i = 0, j = methodObj[methodName].handlers.length; i < j; i++) {
              // Loop over all stored handlers for this specific method and call them
              F.apply.call(methodObj[methodName].handlers[i], console, args);
            }
            for (i = 0, j = allHandlers.length; i < j; i++) {
              // Loop over all stored handlers for ALL events and call them
              argsForAll = [methodName];
              A.push.apply(argsForAll, args);
              F.apply.call(allHandlers[i], console, argsForAll);
            }
            // Calls old
            F.apply.call(old, console, args);
          };
        }
        return console[methodName] || empty;
      };
    } else {
      func = empty;
    }

    return func;
  }());

  // Loop through all standard console methods and add a wrapper function that calls stored handlers
  (function () {
    var i, j, cur;
    for (i = 0, j = consoleMethods.length; i < j; i++) {
      // Loop through all valid console methods
      cur = consoleMethods[i];
      methodObj[cur] = {
        handlers: []
      };
      fixConsoleMethod(cur);
    }
  }());

  // Main handler exposed
  consoleOn = function (methodName, callback) {
    var key, cur;
    if (O.toString.call(methodName) === '[object Object]') {
      // Object literal provided as first argument
      for (key in methodName) {
        // Loop through all keys in object literal
        cur = methodName[key];
        if (key === 'all') {
          // If targeting all events
          allHandlers.push(cur);
        } else if (key in methodObj) {
          // If targeting specific valid event
          methodObj[key].handlers.push(cur);
        }
      }
    } else if (typeof methodName === 'function') {
      // Function provided as first argument
      allHandlers.push(methodName);
    } else if (methodName in methodObj) {
      // Valid String event provided
      methodObj[methodName].handlers.push(callback);
    }
  };

  // Actually expose an interface
  w.ConsoleListener = {
    on: consoleOn
  };
}(this));

/**
 * Map Picker
 */
var wcsdmMapPicker = {
  params: {},
  origin_lat: '',
  origin_lng: '',
  origin_address: '',
  zoomLevel: 16,
  apiKeyErrorCheckInterval: null,
  apiKeyError: '',
  editingAPIKey: false,
  init: function (params) {
    wcsdmMapPicker.params = params;
    wcsdmMapPicker.apiKeyError = '';
    wcsdmMapPicker.editingAPIKey = false;

    ConsoleListener.on('error', function (errorMessage) {
      if (errorMessage.toLowerCase().indexOf('google') !== -1) {
        wcsdmMapPicker.apiKeyError = errorMessage;
      }

      if ($('.gm-err-message').length) {
        $('.gm-err-message').replaceWith('<p style="text-align:center">' + wcsdmMapPicker.convertError(errorMessage) + '</p>');
      }
    });

    // Edit Api Key
    $(document).off('focus', '.wcsdm-field-type--api_key');
    $(document).on('focus', '.wcsdm-field-type--api_key', function () {
      if ($(this).prop('readonly') && !$(this).hasClass('loading')) {
        $(this).data('value', $(this).val()).prop('readonly', false);
      }
    });

    $(document).off('blur', '.wcsdm-field-type--api_key');
    $(document).on('blur', '.wcsdm-field-type--api_key', function () {
      if (!$(this).prop('readonly') && !$(this).hasClass('editing')) {
        $(this).data('value', undefined).prop('readonly', true);
      }
    });

    $(document).off('input', '.wcsdm-field-type--api_key', wcsdmMapPicker.handleApiKeyInput);
    $(document).on('input', '.wcsdm-field-type--api_key', wcsdmMapPicker.handleApiKeyInput);

    // Edit Api Key
    $(document).off('click', '.wcsdm-edit-api-key', wcsdmMapPicker.editApiKey);
    $(document).on('click', '.wcsdm-edit-api-key', wcsdmMapPicker.editApiKey);

    // Show Store Location Picker
    $(document).off('click', '.wcsdm-field--origin');
    $(document).on('click', '.wcsdm-field--origin', function () {
      if ($(this).prop('readonly')) {
        $('.wcsdm-edit-location-picker').trigger('click');
      }
    });

    // Show Store Location Picker
    $(document).off('focus', '[data-link="location_picker"]', wcsdmMapPicker.showLocationPicker);
    $(document).on('focus', '[data-link="location_picker"]', wcsdmMapPicker.showLocationPicker);

    // Hide Store Location Picker
    $(document).off('click', '#wcsdm-btn--map-cancel', wcsdmMapPicker.hideLocationPicker);
    $(document).on('click', '#wcsdm-btn--map-cancel', wcsdmMapPicker.hideLocationPicker);

    // Apply Store Location
    $(document).off('click', '#wcsdm-btn--map-apply', wcsdmMapPicker.applyLocationPicker);
    $(document).on('click', '#wcsdm-btn--map-apply', wcsdmMapPicker.applyLocationPicker);

    // Toggle Map Search Panel
    $(document).off('click', '#wcsdm-map-search-panel-toggle', wcsdmMapPicker.toggleMapSearch);
    $(document).on('click', '#wcsdm-map-search-panel-toggle', wcsdmMapPicker.toggleMapSearch);
  },
  validateAPIKeyBothSide: function ($input) {
    wcsdmMapPicker.validateAPIKeyServerSide($input, wcsdmMapPicker.validateAPIKeyBrowserSide);
  },
  validateAPIKeyBrowserSide: function ($input) {
    wcsdmMapPicker.apiKeyError = '';

    wcsdmMapPicker.initMap($input.val(), function () {
      var geocoderArgs = {
        latLng: new google.maps.LatLng(parseFloat(wcsdmMapPicker.params.defaultLat), parseFloat(wcsdmMapPicker.params.defaultLng)),
      };

      var geocoder = new google.maps.Geocoder();

      geocoder.geocode(geocoderArgs, function (results, status) {
        if (status.toLowerCase() === 'ok') {
          console.log('validateAPIKeyBrowserSide', results);

          $input.addClass('valid');

          setTimeout(function () {
            $input.removeClass('editing loading valid').data('value', undefined);
          }, 1000);
        }
      });

      clearInterval(wcsdmMapPicker.apiKeyErrorCheckInterval);

      wcsdmMapPicker.apiKeyErrorCheckInterval = setInterval(function () {
        if ($input.hasClass('valid') || wcsdmMapPicker.apiKeyError) {
          clearInterval(wcsdmMapPicker.apiKeyErrorCheckInterval);
        }

        if (wcsdmMapPicker.apiKeyError) {
          wcsdmMapPicker.showError($input, wcsdmMapPicker.apiKeyError);
          $input.prop('readonly', false).removeClass('loading');
        }
      }, 300);
    });
  },
  validateAPIKeyServerSide: function ($input, onSuccess) {
    $.ajax({
      method: 'POST',
      url: wcsdmMapPicker.params.ajax_url,
      data: {
        action: 'wcsdm_validate_api_key_server',
        nonce: wcsdmMapPicker.params.validate_api_key_nonce,
        key: $input.val(),
      }
    }).done(function (response) {
      console.log('validateAPIKeyServerSide', response);

      if (typeof onSuccess === 'function') {
        onSuccess($input);
      } else {
        $input.addClass('valid');

        setTimeout(function () {
          $input.removeClass('editing loading valid').data('value', undefined);
        }, 1000);
      }
    }).fail(function (error) {
      if (error.responseJSON && error.responseJSON.data) {
        wcsdmMapPicker.showError($input, error.responseJSON.data);
      } else if (error.statusText) {
        wcsdmMapPicker.showError($input, error.statusText);
      } else {
        wcsdmMapPicker.showError($input, wcsdmMapPicker.params.i18n.errors.unknown);
      }

      $input.prop('readonly', false).removeClass('loading');
    });
  },
  showError: function ($input, errorMessage) {
    $('<div class="error notice wcsdm-error-box"><p>' + wcsdmMapPicker.convertError(errorMessage) + '</p></div>')
      .hide()
      .appendTo($input.closest('td'))
      .slideDown();
  },
  removeError: function ($input) {
    $input.closest('td')
      .find('.wcsdm-error-box')
      .slideUp('fast');
  },
  convertError: function (text) {
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    return text.replace(exp, "<a href='$1' target='_blank'>$1</a>");
  },
  handleApiKeyInput: function (e) {
    var $input = $(e.currentTarget);

    if ($input.val() === $input.data('value')) {
      $input.removeClass('editing');
    } else {
      $input.addClass('editing');
    }

    wcsdmMapPicker.removeError($input);
  },
  editApiKey: function (e) {
    e.preventDefault();

    var $input = $(this).blur().prev('input');

    if (!$input.hasClass('editing') || $input.hasClass('loading')) {
      return;
    }

    $input.prop('readonly', true).addClass('loading');

    if ($input.attr('data-key') === 'api_key') {
      wcsdmMapPicker.validateAPIKeyServerSide($input);
    } else {
      wcsdmMapPicker.validateAPIKeyBrowserSide($input);
    }

    wcsdmMapPicker.removeError($input);
  },
  showLocationPicker: function (event) {
    event.preventDefault();

    $(this).blur();

    wcsdmMapPicker.apiKeyError = '';

    var api_key_picker = $('#woocommerce_wcsdm_api_key_picker').val();

    if (wcsdmMapPicker.isEditingAPIKey()) {
      return window.alert(wcsdmError('finish_editing_api'));
    } else if (!api_key_picker.length) {
      return window.alert(wcsdmError('api_key_picker_empty'));
    }

    $('.modal-close-link').hide();

    wcsdmToggleButtons({
      left: {
        id: 'map-cancel',
        label: 'Cancel',
        icon: 'undo'
      },
      right: {
        id: 'map-apply',
        label: 'Apply Changes',
        icon: 'editor-spellcheck'
      }
    });

    $('#wcsdm-field-group-wrap--location_picker').fadeIn().siblings().hide();

    var $subTitle = $('#wcsdm-field-group-wrap--location_picker').find('.wc-settings-sub-title').first().addClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1').append('<span>' + $subTitle.text() + '</span>');

    wcsdmMapPicker.initMap(api_key_picker, wcsdmMapPicker.renderMap);
  },
  hideLocationPicker: function (e) {
    e.preventDefault();

    wcsdmMapPicker.destroyMap();

    $('.modal-close-link').show();

    wcsdmToggleButtons();

    $('#wcsdm-field-group-wrap--location_picker').find('.wc-settings-sub-title').first().removeClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1 span').remove();

    $('#wcsdm-field-group-wrap--location_picker').hide().siblings().not('.wcsdm-hidden').fadeIn();
  },
  applyLocationPicker: function (e) {
    e.preventDefault();

    if (!wcsdmMapPicker.apiKeyError) {
      $('#woocommerce_wcsdm_origin_lat').val(wcsdmMapPicker.origin_lat);
      $('#woocommerce_wcsdm_origin_lng').val(wcsdmMapPicker.origin_lng);
      $('#woocommerce_wcsdm_origin_address').val(wcsdmMapPicker.origin_address);
    }

    wcsdmMapPicker.hideLocationPicker(e);
  },
  toggleMapSearch: function (e) {
    e.preventDefault();

    $('#wcsdm-map-search-panel').toggleClass('expanded');
  },
  initMap: function (apiKey, callback) {
    wcsdmMapPicker.destroyMap();

    if (_.isEmpty(apiKey)) {
      apiKey = 'InvalidKey';
    }

    $.getScript('https://maps.googleapis.com/maps/api/js?libraries=geometry,places&key=' + apiKey, callback);
  },
  renderMap: function () {
    wcsdmMapPicker.origin_lat = $('#woocommerce_wcsdm_origin_lat').val();
    wcsdmMapPicker.origin_lng = $('#woocommerce_wcsdm_origin_lng').val();

    var currentLatLng = {
      lat: _.isEmpty(wcsdmMapPicker.origin_lat) ? parseFloat(wcsdmMapPicker.params.defaultLat) : parseFloat(wcsdmMapPicker.origin_lat),
      lng: _.isEmpty(wcsdmMapPicker.origin_lng) ? parseFloat(wcsdmMapPicker.params.defaultLng) : parseFloat(wcsdmMapPicker.origin_lng)
    };

    var map = new google.maps.Map(
      document.getElementById('wcsdm-map-canvas'),
      {
        mapTypeId: 'roadmap',
        center: currentLatLng,
        zoom: wcsdmMapPicker.zoomLevel,
        streetViewControl: false,
        mapTypeControl: false
      }
    );

    var marker = new google.maps.Marker({
      map: map,
      position: currentLatLng,
      draggable: true,
      icon: wcsdmMapPicker.params.marker
    });

    var infowindow = new google.maps.InfoWindow({ maxWidth: 350 });

    if (_.isEmpty(wcsdmMapPicker.origin_lat) || _.isEmpty(wcsdmMapPicker.origin_lng)) {
      infowindow.setContent(wcsdmMapPicker.params.i18n.drag_marker);
      infowindow.open(map, marker);
    } else {
      wcsdmMapPicker.setLatLng(marker.position, marker, map, infowindow);
    }

    google.maps.event.addListener(marker, 'dragstart', function () {
      infowindow.close();
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
      wcsdmMapPicker.setLatLng(event.latLng, marker, map, infowindow);
    });

    $('#wcsdm-map-wrap').prepend(wp.template('wcsdm-map-search-panel')());
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('wcsdm-map-search-panel'));

    var mapSearchBox = new google.maps.places.SearchBox(document.getElementById('wcsdm-map-search-input'));

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
      mapSearchBox.setBounds(map.getBounds());
    });

    var markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve more details for that place.
    mapSearchBox.addListener('places_changed', function () {
      var places = mapSearchBox.getPlaces();

      if (places.length === 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function (marker) {
        marker.setMap(null);
      });

      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();

      places.forEach(function (place) {
        if (!place.geometry) {
          console.log('Returned place contains no geometry');
          return;
        }

        marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          draggable: true,
          icon: wcsdmMapPicker.params.marker
        });

        wcsdmMapPicker.setLatLng(place.geometry.location, marker, map, infowindow);

        google.maps.event.addListener(marker, 'dragstart', function () {
          infowindow.close();
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
          wcsdmMapPicker.setLatLng(event.latLng, marker, map, infowindow);
        });

        // Create a marker for each place.
        markers.push(marker);

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });

      map.fitBounds(bounds);
    });

    setTimeout(function () {
      $('#wcsdm-map-search-panel').removeClass('wcsdm-hidden');
    }, 500);
  },
  destroyMap: function () {
    if (window.google) {
      window.google = undefined;
    }

    $('#wcsdm-map-canvas').empty();
    $('#wcsdm-map-search-panel').remove();
  },
  setLatLng: function (location, marker, map, infowindow) {
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode(
      {
        latLng: location
      },
      function (results, status) {
        if (status === google.maps.GeocoderStatus.OK && results[0]) {
          var infowindowContents = [
            wcsdmMapPicker.params.i18n.latitude + ': ' + location.lat().toString(),
            wcsdmMapPicker.params.i18n.longitude + ': ' + location.lng().toString()
          ];

          infowindow.setContent(infowindowContents.join('<br />'));
          infowindow.open(map, marker);

          marker.addListener('click', function () {
            infowindow.open(map, marker);
          });

          $('#wcsdm-map-search-input').val(results[0].formatted_address);

          wcsdmMapPicker.origin_lat = location.lat();
          wcsdmMapPicker.origin_lng = location.lng();
          wcsdmMapPicker.origin_address = results[0].formatted_address;
        }
      }
    );

    map.setCenter(location);
  },
  isEditingAPIKey: function () {
    return $('.wcsdm-field-type--api_key.editing').length > 0;
  },
};

/**
 * Table Rates
 */
var wcsdmTableRates = {
  params: {},
  errorId: 'wcsdm-errors-rate-fields',
  sortableTimer: null,
  init: function (params) {
    wcsdmTableRates.params = params;

    // Show advanced rate form
    $(document).off('click', '.wcsdm-action-link--show_advanced_rate', wcsdmTableRates.showAdvancedRateForm);
    $(document).on('click', '.wcsdm-action-link--show_advanced_rate', wcsdmTableRates.showAdvancedRateForm);

    // Close advanced rate form
    $(document).off('click', '#wcsdm-btn--cancel-advanced', wcsdmTableRates.closeAdvancedRateForm);
    $(document).on('click', '#wcsdm-btn--cancel-advanced', wcsdmTableRates.closeAdvancedRateForm);

    // Apply advanced rate
    $(document).off('click', '#wcsdm-btn--apply-advanced', wcsdmTableRates.applyAdvancedForm);
    $(document).on('click', '#wcsdm-btn--apply-advanced', wcsdmTableRates.applyAdvancedForm);

    // Add rate row
    $(document).off('click', '#wcsdm-btn--add-rate', wcsdmTableRates.handleAddRateButton);
    $(document).on('click', '#wcsdm-btn--add-rate', wcsdmTableRates.handleAddRateButton);

    // Delete rate row
    $(document).off('click', '#wcsdm-btn--delete-rate-select', wcsdmTableRates.showDeleteRateRowsForm);
    $(document).on('click', '#wcsdm-btn--delete-rate-select', wcsdmTableRates.showDeleteRateRowsForm);

    // Cancel delete rate row
    $(document).off('click', '#wcsdm-btn--delete-rate-cancel', wcsdmTableRates.closeDeleteRateRowsForm);
    $(document).on('click', '#wcsdm-btn--delete-rate-cancel', wcsdmTableRates.closeDeleteRateRowsForm);

    // Confirm delete rate row
    $(document).off('click', '#wcsdm-btn--delete-rate-confirm', wcsdmTableRates.deleteRateRows);
    $(document).on('click', '#wcsdm-btn--delete-rate-confirm', wcsdmTableRates.deleteRateRows);

    // Toggle selected rows
    $(document).off('change', '#wcsdm-table--table_rates--dummy thead .select-item', wcsdmTableRates.toggleRows);
    $(document).on('change', '#wcsdm-table--table_rates--dummy thead .select-item', wcsdmTableRates.toggleRows);

    // Toggle selected row
    $(document).off('change', '#wcsdm-table--table_rates--dummy tbody .select-item', wcsdmTableRates.toggleRow);
    $(document).on('change', '#wcsdm-table--table_rates--dummy tbody .select-item', wcsdmTableRates.toggleRow);

    // Handle change event dummy rate field
    $(document).off('focus', '.wcsdm-field--context--dummy.wcsdm-field--context--dummy--max_distance');
    $(document).on('focus', '.wcsdm-field--context--dummy.wcsdm-field--context--dummy--max_distance', function () {
      $(this).data('value', $(this).val());
    });

    $(document).off('blur', '.wcsdm-field--context--dummy.wcsdm-field--context--dummy--max_distance');
    $(document).on('blur', '.wcsdm-field--context--dummy.wcsdm-field--context--dummy--max_distance', function () {
      $(this).data('value', undefined);
    });

    $(document).off('input', '.wcsdm-field--context--dummy:not(a)');
    $(document).on('input', '.wcsdm-field--context--dummy:not(a)', wcsdmDebounce(function (e) {
      wcsdmTableRates.handleRateFieldDummy(e);
    }, 800));

    var validateDummyFieldsTimer;

    $(document.body).on('wc_add_error_tip', function (event, $input) {
      if (event.type !== 'wc_add_error_tip' || !$input.is('.wcsdm-field--context--dummy')) {
        return;
      }

      clearTimeout(validateDummyFieldsTimer);

      validateDummyFieldsTimer = setTimeout(function () {
        $input.trigger('input');

        if ($input.val().length) {
          wcsdmTableRates.sortRateRows();
        }
      }, 800);
    });

    // Toggle selected row
    $(document).off('change', '#woocommerce_wcsdm_distance_unit', wcsdmTableRates.initForm);
    $(document).on('change', '#woocommerce_wcsdm_distance_unit', wcsdmTableRates.initForm);

    wcsdmTableRates.initForm();

    if (!$('#wcsdm-table--table_rates--dummy tbody tr').length) {
      wcsdmTableRates.addRateRow();
    }

    wcsdmTableRates.sortRateRows();
  },
  initForm: function () {
    var distanceUnit = $('#woocommerce_wcsdm_distance_unit').val();
    var distanceUnitShort = distanceUnit === 'metric' ? 'km' : 'mi';
    var $distanceUnitFields = $('#woocommerce_wcsdm_distance_unit').data('fields');

    $('.wcsdm-field--context--dummy--max_distance').next('span').remove();
    $('.wcsdm-field--context--dummy--max_distance').addClass('has-unit').after('<span>' + distanceUnitShort + '</span>');

    var label = $distanceUnitFields && _.has($distanceUnitFields.label, distanceUnit) ? $distanceUnitFields.label[distanceUnit] : '';

    if (label && label.length) {
      $.each($distanceUnitFields.targets, function (index, target) {
        $(target).data('index', index).text(label);
      });
    }
  },
  handleAddRateButton: function (e) {
    e.preventDefault();
    $(e.currentTarget).prop('disabled', true);

    wcsdmTableRates.addRateRow();

    $(e.currentTarget).prop('disabled', false);
  },
  handleRateFieldDummy: function (e) {
    e.preventDefault();

    var $field = $(e.target);
    var $row = $field.closest('tr');
    $row.find('.wcsdm-field--context--hidden[data-id=' + $field.data('id') + ']').val(e.target.value);

    if ($field.hasClass('wcsdm-field--context--dummy--max_distance')) {
      $row.addClass('editing');

      if ($field.val() !== $field.data('value')) {
        wcsdmTableRates.sortRateRows($field);
      }
    }

    wcsdmTableRates.validateRows();
  },
  showAdvancedRateForm: function (e) {
    e.preventDefault();

    var $row = $(e.currentTarget).closest('tr').addClass('editing');

    $row.find('.wcsdm-field--context--hidden').each(function () {
      $('.wcsdm-field--context--advanced[data-id=' + $(this).data('id') + ']').val($(this).val());
    });

    wcsdmToggleButtons({
      left: {
        id: 'cancel-advanced',
        label: 'Cancel',
        icon: 'undo'
      },
      right: {
        id: 'apply-advanced',
        label: 'Apply Changes',
        icon: 'editor-spellcheck'
      }
    });

    $('.modal-close-link').hide();

    $('#wcsdm-field-group-wrap--advanced_rate').fadeIn().siblings('.wcsdm-field-group-wrap').hide();

    var $subTitle = $('#wcsdm-field-group-wrap--advanced_rate').find('.wc-settings-sub-title').first().addClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1').append('<span>' + $subTitle.text() + '</span>');
  },
  applyAdvancedForm: function (e) {
    e.preventDefault();

    $('.wcsdm-field--context--advanced').each(function () {
      var fieldId = $(this).data('id');
      var fieldValue = $(this).val();

      $('#wcsdm-table--table_rates--dummy tbody tr.editing .wcsdm-field--context--dummy[data-id=' + fieldId + ']:not(a)').val(fieldValue);
      $('#wcsdm-table--table_rates--dummy tbody tr.editing .wcsdm-field--context--hidden[data-id=' + fieldId + ']:not(a)').val(fieldValue);
    });

    wcsdmTableRates.closeAdvancedRateForm(e);
  },
  closeAdvancedRateForm: function (e) {
    e.preventDefault();

    wcsdmToggleButtons();

    $('#wcsdm-field-group-wrap--advanced_rate').hide().siblings('.wcsdm-field-group-wrap').not('.wcsdm-hidden').fadeIn();

    $('#wcsdm-field-group-wrap--advanced_rate').find('.wc-settings-sub-title').first().removeClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1 span').remove();

    $('.modal-close-link').show();

    $('#wcsdm-table--table_rates--dummy tbody tr.selected').each(function () {
      $(this).find('.select-item').trigger('change');
    });

    wcsdmTableRates.scrollToTableRate();
    wcsdmTableRates.sortRateRows();
    wcsdmTableRates.validateRows();
  },
  highlightRow: function () {
    var $row = $('#wcsdm-table--table_rates--dummy tbody tr.editing').removeClass('editing');

    if ($row.length) {
      $row.addClass('highlighted');

      setTimeout(function () {
        $row.removeClass('highlighted');
      }, 1500);
    }
  },
  addRateRow: function () {
    var $lastRow = $('#wcsdm-table--table_rates--dummy tbody tr:last-child');

    $('#wcsdm-table--table_rates--dummy tbody').append(wp.template('wcsdm-dummy-row'));

    if ($lastRow) {
      $lastRow.find('.wcsdm-field--context--hidden:not(a)').each(function () {
        var $field = $(this);
        var fieldId = $field.data('id');
        var fieldValue = fieldId === 'woocommerce_wcsdm_max_distance' ? Math.ceil((parseInt($field.val(), 10) * 1.8)) : $field.val();
        $('#wcsdm-table--table_rates--dummy tbody tr:last-child .wcsdm-field[data-id=' + fieldId + ']').val(fieldValue);
      });
    }

    wcsdmTableRates.setRowNumber();
    wcsdmTableRates.scrollToTableRate();

    wcsdmTableRates.initForm();
  },
  showDeleteRateRowsForm: function (e) {
    e.preventDefault();

    $('#wcsdm-table--table_rates--dummy tbody tr:not(.selected)').hide();
    $('#wcsdm-table--table_rates--dummy').find('.wcsdm-col--type--select_item, .wcsdm-col--type--action_link').hide();
    $('#wcsdm-field-group-wrap--table_rates').siblings().hide();

    $('#wcsdm-field-group-wrap--table_rates').find('p').first().addClass('wcsdm-hidden');

    var $subTitle = $('#wcsdm-field-group-wrap--table_rates').find('.wc-settings-sub-title').first().addClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1').append('<span>' + $subTitle.text() + '</span>');

    wcsdmToggleButtons({
      left: {
        id: 'delete-rate-cancel',
        label: 'Cancel',
        icon: 'undo'
      },
      right: {
        id: 'delete-rate-confirm',
        label: 'Confirm Delete',
        icon: 'trash'
      }
    });

    wcsdmTableRates.hideError();
  },
  closeDeleteRateRowsForm: function (e) {
    e.preventDefault();

    $('#wcsdm-table--table_rates--dummy tbody tr').show();
    $('#wcsdm-table--table_rates--dummy').find('.wcsdm-col--type--select_item, .wcsdm-col--type--action_link').show();
    $('#wcsdm-field-group-wrap--table_rates').siblings().not('.wcsdm-hidden').fadeIn();

    $('#wcsdm-field-group-wrap--table_rates').find('p').first().removeClass('wcsdm-hidden');
    $('#wcsdm-field-group-wrap--table_rates').find('.wc-settings-sub-title').first().removeClass('wcsdm-hidden');

    $('.wc-backbone-modal-header').find('h1 span').remove();

    $('#wcsdm-table--table_rates--dummy tbody tr.selected').each(function () {
      $(this).find('.select-item').trigger('change');
    });

    wcsdmTableRates.scrollToTableRate();
    wcsdmTableRates.validateRows();
  },
  deleteRateRows: function (e) {
    e.preventDefault();

    $('#wcsdm-table--table_rates--dummy tbody .select-item:checked').closest('tr').remove();

    if (!$('#wcsdm-table--table_rates--dummy tbody tr').length) {
      if ($('#wcsdm-table--table_rates--dummy thead .select-item').is(':checked')) {
        $('#wcsdm-table--table_rates--dummy thead .select-item').prop('checked', false).trigger('change');
      }

      wcsdmTableRates.addRateRow();
    } else {
      wcsdmToggleButtons();
    }

    wcsdmTableRates.setRowNumber();

    wcsdmTableRates.closeDeleteRateRowsForm(e);
  },
  toggleRows: function (e) {
    e.preventDefault();

    var isChecked = $(e.target).is(':checked');

    $('#wcsdm-table--table_rates--dummy tbody tr').each(function () {
      wcsdmTableRates.toggleRowSelected($(this), isChecked);
    });

    if (isChecked) {
      wcsdmToggleButtons({
        left: {
          id: 'delete-rate-select',
          label: 'Delete Selected Rates',
          icon: 'trash'
        }
      });
    } else {
      wcsdmToggleButtons();
    }
  },
  toggleRow: function (e) {
    e.preventDefault();

    var $field = $(e.target);
    var $row = $(e.target).closest('tr');

    wcsdmTableRates.toggleRowSelected($row, $field.is(':checked'));

    if ($('#wcsdm-table--table_rates--dummy tbody .select-item:checked').length) {
      wcsdmToggleButtons({
        left: {
          id: 'delete-rate-select',
          label: 'Delete Selected Rates',
          icon: 'trash'
        }
      });
    } else {
      wcsdmToggleButtons();
    }

    var isBulkChecked = $('#wcsdm-table--table_rates--dummy tbody .select-item').length === $('#wcsdm-table--table_rates--dummy tbody .select-item:checked').length;

    $('#wcsdm-table--table_rates--dummy thead .select-item').prop('checked', isBulkChecked);
  },
  toggleRowSelected: function ($row, isChecked) {
    $row.find('.wcsdm-field--context--dummy').prop('disabled', isChecked);

    if (isChecked) {
      $row.addClass('selected').find('.select-item').prop('checked', isChecked);
    } else {
      $row.removeClass('selected').find('.select-item').prop('checked', isChecked);
    }
  },
  sortRateRows: function ($fieldFocus) {

    var rows = $('#wcsdm-table--table_rates--dummy > tbody > tr').get().sort(function (a, b) {

      var aMaxDistance = $(a).find('.wcsdm-field--context--dummy--max_distance').val();
      var bMaxDistance = $(b).find('.wcsdm-field--context--dummy--max_distance').val();

      var aIndex = $(a).find('.wcsdm-field--context--dummy--max_distance').index();
      var bIndex = $(b).find('.wcsdm-field--context--dummy--max_distance').index();

      if (isNaN(aMaxDistance) || !aMaxDistance.length) {
        return 2;
      }

      aMaxDistance = parseFloat(aMaxDistance);
      bMaxDistance = parseFloat(bMaxDistance);

      if (aMaxDistance < bMaxDistance) {
        return -1;
      }

      if (aMaxDistance > bMaxDistance) {
        return 1;
      }

      if (aIndex < bIndex) {
        return -1;
      }

      if (aIndex > bIndex) {
        return 1;
      }

      return 0;
    });

    var maxDistances = {};

    $.each(rows, function (index, row) {
      var maxDistance = $(row).find('.wcsdm-field--context--dummy--max_distance').val();

      if (!maxDistances[maxDistance]) {
        maxDistances[maxDistance] = [];
      }

      maxDistances[maxDistance].push($(row));

      $(row).addClass('wcsdm-rate-row-index--' + index).attr('data-max-distance', maxDistance).appendTo($('#wcsdm-table--table_rates--dummy').children('tbody')).fadeIn('slow');
    });

    _.each(maxDistances, function (rows) {
      _.each(rows, function (row) {
        if (rows.length > 1) {
          $(row).addClass('wcsdm-sort-enabled').find('.wcsdm-action-link--sort_rate').prop('enable', true);
        } else {
          $(row).removeClass('wcsdm-sort-enabled').find('.wcsdm-action-link--sort_rate').prop('enable', false);
        }
      });
    });

    clearTimeout(wcsdmTableRates.sortableTimer);

    wcsdmTableRates.sortableTimer = setTimeout(function () {
      wcsdmTableRates.setRowNumber();
      wcsdmTableRates.highlightRow();

      if ($('#wcsdm-table--table_rates--dummy > tbody').sortable('instance')) {
        $('#wcsdm-table--table_rates--dummy > tbody').sortable('destroy');
      }

      $('#wcsdm-table--table_rates--dummy tbody').sortable({
        scroll: false,
        cursor: 'move',
        axis: 'y',
        placeholder: 'ui-state-highlight',
        items: 'tr.wcsdm-sort-enabled',
        start: function (event, ui) {
          if (ui.item.hasClass('wcsdm-sort-enabled')) {
            $(event.currentTarget).find('tr').each(function () {
              if (ui.item.attr('data-max-distance') === $(this).attr('data-max-distance')) {
                $(this).addClass('sorting');
              } else {
                $(this).removeClass('sorting');
              }
            });

            $('#wcsdm-table--table_rates--dummy > tbody').sortable('option', 'items', 'tr.wcsdm-sort-enabled.sorting').sortable('refresh');
          } else {
            $('#wcsdm-table--table_rates--dummy > tbody').sortable('cancel');
          }
        },
        stop: function () {
          $('#wcsdm-table--table_rates--dummy > tbody').sortable('option', 'items', 'tr.wcsdm-sort-enabled').sortable('refresh').find('tr').removeClass('sorting');
          wcsdmTableRates.setRowNumber();
        },
      }).disableSelection();

      if ($fieldFocus) {
        $fieldFocus.focus();
      }
    }, 100);
  },
  scrollToTableRate: function () {
    $('.wc-modal-shipping-method-settings').scrollTop($('.wc-modal-shipping-method-settings').find('form').outerHeight());
  },
  validateRows: function () {
    wcsdmTableRates.hideError();

    var uniqueKeys = {};
    var ratesData = [];

    $('#wcsdm-table--table_rates--dummy > tbody > tr').each(function () {
      var $row = $(this);
      var rowIndex = $row.index();
      var rowData = {
        index: rowIndex,
        error: false,
        fields: {},
      };

      var uniqueKey = [];

      $row.find('input.wcsdm-field--context--hidden').each(function () {
        var $field = $(this);
        var fieldTitle = $field.data('title');
        var fieldKey = $field.data('key');
        var fieldId = $field.data('id');
        var fieldValue = $field.val().trim();

        var fieldData = {
          title: fieldTitle,
          value: fieldValue,
          key: fieldKey,
          id: fieldId,
        };

        if ($field.hasClass('wcsdm-field--is-required') && fieldValue.length < 1) {
          fieldData.error = wcsdmTableRates.rateRowError(rowIndex, wcsdmSprintf(wcsdmError('field_required'), fieldTitle));
        }

        if (!fieldData.error && fieldValue.length) {
          if ($field.data('type') === 'number' && isNaN(fieldValue)) {
            fieldData.error = wcsdmTableRates.rateRowError(rowIndex, wcsdmSprintf(wcsdmError('field_numeric'), fieldTitle));
          }

          var fieldValueInt = parseInt(fieldValue, 10);

          if (typeof $field.attr('min') !== 'undefined' && fieldValueInt < parseInt($field.attr('min'), 10)) {
            fieldData.error = wcsdmTableRates.rateRowError(rowIndex, wcsdmSprintf(wcsdmError('field_min_value'), fieldTitle, $field.attr('min')));
          }

          if (typeof $field.attr('max') !== 'undefined' && fieldValueInt > parseInt($field.attr('max'), 10)) {
            fieldData.error = wcsdmTableRates.rateRowError(rowIndex, wcsdmSprintf(wcsdmError('field_max_value'), fieldTitle, $field.attr('max')));
          }
        }

        if ($field.data('is_rule') && fieldValue.length) {
          uniqueKey.push(wcsdmSprintf('%s__%s', fieldKey, fieldValue));
        }

        rowData.fields[fieldKey] = fieldData;
      });

      if (uniqueKey.length) {
        var uniqueKeyString = uniqueKey.join('___');

        if (_.has(uniqueKeys, uniqueKeyString)) {
          var duplicateKeys = [];

          for (var i = 0; i < uniqueKey.length; i++) {
            var keySplit = uniqueKey[i].split('__');
            var title = $row.find('input.wcsdm-field--context--hidden[data-key="' + keySplit[0] + '"]').data('title');

            duplicateKeys.push(wcsdmSprintf('%s: %s', title, keySplit[1]));
          }

          rowData.error = wcsdmTableRates.rateRowError(rowIndex, wcsdmSprintf(wcsdmError('duplicate_rate_row'), wcsdmTableRates.indexToNumber(uniqueKeys[uniqueKeyString]), duplicateKeys.join(', ')));
        } else {
          uniqueKeys[uniqueKeyString] = rowIndex;
        }
      }

      ratesData.push(rowData);
    });

    var errorText = '';

    _.each(ratesData, function (rowData) {
      if (rowData.error) {
        errorText += wcsdmSprintf('<p>%s</p>', rowData.error.toString());
      }

      _.each(rowData.fields, function (field) {
        if (field.error) {
          errorText += wcsdmSprintf('<p>%s</p>', field.error.toString());
        }
      });
    });

    if (!errorText) {
      return true;
    }

    $('#woocommerce_wcsdm_field_group_table_rates').next('p').after('<div class="error notice wcsdm-notice has-margin">' + errorText + '</div>');
  },
  rateRowError: function (rowIndex, errorMessage) {
    return new Error(wcsdmSprintf(wcsdmError('table_rate_row'), wcsdmTableRates.indexToNumber(rowIndex), errorMessage));
  },
  hideError: function () {
    $('#woocommerce_wcsdm_field_group_table_rates').next('p').next('.wcsdm-notice').remove();
  },
  setRowNumber: function () {
    $('#wcsdm-table--table_rates--dummy > tbody > tr').each(function () {
      $(this).find('.wcsdm-col--type--row_number').text(($(this).index() + 1));
    });
  },
  indexToNumber: function (rowIndex) {
    return (rowIndex + 1);
  },
};

/**
 * Backend Scripts
 */

var wcsdmBackend = {
  renderForm: function () {
    if (!$('#woocommerce_wcsdm_origin_type') || !$('#woocommerce_wcsdm_origin_type').length) {
      return;
    }

    // Submit form
    $(document).off('click', '#wcsdm-btn--save-settings', wcsdmBackend.submitForm);
    $(document).on('click', '#wcsdm-btn--save-settings', wcsdmBackend.submitForm);

    // Toggle Store Origin Fields
    $(document).off('change', '#woocommerce_wcsdm_origin_type', wcsdmBackend.toggleStoreOriginFields);
    $(document).on('change', '#woocommerce_wcsdm_origin_type', wcsdmBackend.toggleStoreOriginFields);

    $('#woocommerce_wcsdm_origin_type').trigger('change');

    $('.wc-modal-shipping-method-settings table.form-table').each(function () {
      var $table = $(this);
      var $rows = $table.find('tr');

      if (!$rows.length) {
        $table.remove();
      }
    });

    $('.wcsdm-field-group').each(function () {
      var $fieldGroup = $(this);

      var fieldGroupId = $fieldGroup
        .attr('id')
        .replace('woocommerce_wcsdm_field_group_', '');

      var $fieldGroupDescription = $fieldGroup
        .next('p')
        .detach();

      var $fieldGroupTable = $fieldGroup
        .nextAll('table.form-table')
        .first()
        .attr('id', 'wcsdm-table--' + fieldGroupId)
        .addClass('wcsdm-table wcsdm-table--' + fieldGroupId)
        .detach();

      $fieldGroup
        .wrap('<div id="wcsdm-field-group-wrap--' + fieldGroupId + '" class="wcsdm-field-group-wrap stuffbox wcsdm-field-group-wrap--' + fieldGroupId + '"></div>');

      $fieldGroupDescription
        .appendTo('#wcsdm-field-group-wrap--' + fieldGroupId);

      $fieldGroupTable
        .appendTo('#wcsdm-field-group-wrap--' + fieldGroupId);

      if ($fieldGroupTable && $fieldGroupTable.length) {
        if ($fieldGroup.hasClass('wcsdm-field-group-hidden')) {
          $('#wcsdm-field-group-wrap--' + fieldGroupId)
            .addClass('wcsdm-hidden');
        }
      } else {
        $('#wcsdm-field-group-wrap--' + fieldGroupId).remove();
      }
    });

    var params = _.mapObject(wcsdmBackendVars, function (val, key) {
      switch (key) {
        case 'default_lat':
        case 'default_lng':
        case 'test_destination_lat':
        case 'test_destination_lng':
          return parseFloat(val);

        default:
          return val;
      }
    });

    wcsdmTableRates.init(params);
    wcsdmMapPicker.init(params);

    wcsdmToggleButtons();
  },
  maybeOpenModal: function () {
    // Try show settings modal on settings page.
    if (wcsdmBackendVars.showSettings) {
      setTimeout(function () {
        var isMethodAdded = false;
        var methods = $(document).find('.wc-shipping-zone-method-type');
        for (var i = 0; i < methods.length; i++) {
          var method = methods[i];
          if ($(method).text() === wcsdmBackendVars.methodTitle) {
            $(method).closest('tr').find('.row-actions .wc-shipping-zone-method-settings').trigger('click');
            isMethodAdded = true;
            return;
          }
        }

        // Show Add shipping method modal if the shipping is not added.
        if (!isMethodAdded) {
          $('.wc-shipping-zone-add-method').trigger('click');
          $('select[name="add_method_id"]').val(wcsdmBackendVars.methodId).trigger('change');
        }
      }, 500);
    }
  },
  submitForm: function (e) {
    e.preventDefault();

    if (wcsdmMapPicker.isEditingAPIKey()) {
      window.alert(wcsdmError('finish_editing_api'));
    } else if (!wcsdmTableRates.validateRows()) {
      window.alert(wcsdmError('table_rates_invalid'));
    } else {
      $('#btn-ok').trigger('click');
    }
  },
  toggleStoreOriginFields: function (e) {
    e.preventDefault();
    var selected = $(this).val();
    var fields = $(this).data('fields');
    _.each(fields, function (fieldIds, fieldValue) {
      _.each(fieldIds, function (fieldId) {
        if (fieldValue !== selected) {
          $('#' + fieldId).closest('tr').hide();
        } else {
          $('#' + fieldId).closest('tr').show();
        }
      });
    });
  },
  initForm: function () {
    // Init form
    $(document.body).off('wc_backbone_modal_loaded', wcsdmBackend.renderForm);
    $(document.body).on('wc_backbone_modal_loaded', wcsdmBackend.renderForm);
  },
  init: function () {
    wcsdmBackend.initForm();
    wcsdmBackend.maybeOpenModal();
  }
};

$(document).ready(wcsdmBackend.init);
}(jQuery));
