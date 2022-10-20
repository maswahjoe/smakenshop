( function ($, elementor) {
    "use strict";

    var Marketo = {

        init: function () {

            var widgets = {
                'xs-maps.default': Marketo.Map,
                'xs-woo-slider.default': Marketo.Product_Slider,
                'xs-woo-carousel.default': Marketo.Product_Carousel,
                'xs-woo-tab.default': Marketo.Product_Tab_Slider,
                'xs-sliders.default': Marketo.Slider,
                'xs-countdown.default': Marketo.ContDown_Timer,
                'xs-nav-serch.default': Marketo.Nav_Search,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },

        Map: function ($scope) {

            var $container = $scope.find('.marketo-maps'),
                map,
                init,
                pins;
            if (!window.google) {
                return;
            }

            init = $container.data('init');
            pins = $container.data('pins');
            map = new google.maps.Map($container[0], init);

            if (pins) {
                $.each(pins, function (index, pin) {

                    var marker,
                        infowindow,
                        pinData = {
                            position: pin.position,
                            map: map
                        };

                    if ('' !== pin.image) {
                        pinData.icon = pin.image;
                    }

                    marker = new google.maps.Marker(pinData);

                    if ('' !== pin.desc) {
                        infowindow = new google.maps.InfoWindow({
                            content: pin.desc
                        });
                    }

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });

                    if ('visible' === pin.state && '' !== pin.desc) {
                        infowindow.open(map, marker);
                    }

                });
            }
        },

        Product_Slider: function ($scope) {
            var carousel = $scope.find('.xs-slider-highlight');
            var product_block_slider = $scope.find('.product-block-slider');

            if (carousel.length > 0) {
                carousel.myOwl({
                    navText: ['<i class="icon icon-arrow-left xs-simple-arrow"></i>', '<i class="icon icon-arrow-right xs-simple-arrow"></i>'],
                    nav: true,
                    autoplay:false,
                });
            }

            if (product_block_slider.length > 0) {
                product_block_slider.myOwl({
                    items: 1,
                    dots: true,
                    loop:false,
                });
            }
        },

        Product_Carousel: function ($scope) {
            var xsProuctSliderOne = $scope.find('.xs-product-slider-1');
            var prev = $scope.find('.prev');
            var next = $scope.find('.next');

            if (xsProuctSliderOne.length > 0) {
                xsProuctSliderOne.myOwl({
                    responsive: {
                        // breakpoint from 768 up
                        768: {
                            items: 1,
                        },
                        1024: {
                            items: 1,
                        }
                    }
                });
                prev.on('click', function () {
                    xsProuctSliderOne.trigger('prev.owl.carousel');
                });

                next.on('click', function () {
                    xsProuctSliderOne.trigger('next.owl.carousel');
                });
            }

            var xs_deal_of_the_week = $scope.find('.xs-deal-of-the-week');
            if (xs_deal_of_the_week.length > 0) {
                xs_deal_of_the_week.myOwl({
                    items: 1,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        1024: {
                            items: 1
                        }
                    }

                });
                $("#prev-4").on('click', function () {
                    xs_deal_of_the_week.trigger('prev.owl.carousel');
                });

                $("#next-4").on('click', function () {
                    xs_deal_of_the_week.trigger('next.owl.carousel');
                });
            }

            var recent_view_slider = $scope.find('.recent-view-slider');

            if (recent_view_slider.length > 0) {
                recent_view_slider.myOwl({
                    items: 6,
                    loop: false,
                    margin: 20,
                    nav: false,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 3
                        },
                        1024: {
                            items: 6
                        }
                    }
                });
            }
            var xs_slider_7_col = $scope.find('.xs-slider-7-col');
            var xs_slider_7_col_prev = $scope.find('#prev-15');
            var xs_slider_7_col_next = $scope.find('#next-15');
            xs_slider_7_col.myOwl({
                items: 7,
                autoplay: true,
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        items: 1,
                    },
                    // breakpoint from 768 up
                    768 : {
                        items: 3,
                    },
                    1024: {
                        items: 7,
                    }
                }
            });
            xs_slider_7_col_prev.on('click',function () {
                xs_slider_7_col.trigger('prev.owl.carousel');
            });
            xs_slider_7_col_next.on('click',function () {
                xs_slider_7_col.trigger('next.owl.carousel');
            });
        },

        Product_Tab_Slider: function ($scope) {
            var tabSixColSlider = $scope.find(".xs-tab-slider-6-col");
            var xs_product_slider_11 = $scope.find(".xs-product-slider-11");
            var xs_tab_slider = $scope.find(".xs-tab-slider");

            if (tabSixColSlider.length > 0) {
                tabSixColSlider.on('initialized.owl.carousel translated.owl.carousel', function () {
                    var $this = $(this);
                    $this.find('.owl-item.last-child').each(function () {
                        $(this).removeClass('last-child');
                    });
                    $(this).find('.owl-item.active').last().addClass('last-child');
                });
                tabSixColSlider.myOwl({
                    items: 6,
                    loop: false,
                    dots: true,
                    responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1,
                        },
                        // breakpoint from 480 up
                        480: {
                            items: 2,
                        },
                        // breakpoint from 768 up
                        768: {
                            items: 4,
                        },
                        1024: {
                            items: 6,
                        }
                    }
                });
            }

            if (xs_product_slider_11.length > 0) {
                var product_item = xs_product_slider_11.data('slider');
                xs_product_slider_11.myOwl({
                    items: 3,
                    loop: false,
                    responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1,
                        },
                        // breakpoint from 768 up
                        768: {
                            items: 2,
                        },
                        1024: {
                            items: product_item,
                        }
                    }
                });
                $(".prev").on('click', function () {
                    xs_product_slider_11.trigger('prev.owl.carousel');
                });
                $(".next").on('click', function () {
                    xs_product_slider_11.trigger('next.owl.carousel');
                });
            }

            if (xs_tab_slider.length > 0) {

                var tabSlider = xs_tab_slider;
                tabSlider.on('initialized.owl.carousel translated.owl.carousel', function () {
                    var $this = $(this);
                    $this.find('.owl-item.last-child').each(function () {
                        $(this).removeClass('last-child');
                    });
                    $(this).find('.owl-item.active').last().addClass('last-child');
                });

                xs_tab_slider.myOwl({
                    items: 3,
                    loop: false,
                    margin: 30,
                    stagePadding: 0,
                    dots: true,
                    responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1,
                        },
                        // breakpoint from 768 up
                        768: {
                            items: 2,
                        },
                        1024: {
                            items: 3,
                        }
                    }
                });
            }
        },

        Slider: function ($scope) {
            var xs_banner_slider = $scope.find('.xs-banner-slider');

            if ( xs_banner_slider.length > 0 ) {
                xs_banner_slider .myOwl({
                    items: 1,
                    loop: false,
                    navText: ['<i class="icon icon-arrow-left xs-simple-arrow"></i>','<i class="icon icon-arrow-right xs-simple-arrow"></i>'],
                    dots: true,
                    nav: true,
                    autoplay: false,
                    responsive: {
                        // breakpoint from 0 up
                        0 : {
                            dots: false,
                            nav: false,
                        },
                        // breakpoint from 768 up
                        768 : {
                            dots: true,
                            nav: true,
                        }
                    },
                    afterAction: function(){
                        if ( this.itemsAmount > this.visibleItems.length ) {
                            $('.owl-next').removeClass('disabled');
                            $('.owl-prev').removeClass('disabled');
                            if ( this.currentItem == 0 ) {
                                $('.owl-prev').addClass('disabled');
                            }
                            if ( this.currentItem == this.maximumItem ) {
                                $('.owl-next').addClass('disabled');
                            }
                        }
                    }
                });
            }
            var xs_banner_slider_6 = $scope.find('.xs-banner-slider-6');
            if ( xs_banner_slider_6.length > 0 ) {
                xs_banner_slider_6.myOwl({
                    dots: true,
                    loop:false,
                    nav: false,
                })
            }
        },
        Nav_Search: function ($scope) {
            $scope.find('.xs-ele-nav-search-select').mySelect();
        }
    };

    $(window).on('elementor/frontend/init', Marketo.init);

}(jQuery, window.elementorFrontend) );