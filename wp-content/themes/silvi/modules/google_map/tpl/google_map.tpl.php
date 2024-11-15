<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$terms = get_terms([
    'taxonomy' => 'location-category',
    'hide_empty' => true,
]);

$latitude = 40.13082155313381; // this is for marker
$longitude = -74.82232955794834; // this is  for market
$map_height = 700;
$map_zoom = 8;
$map_type = 'ROADMAP';
$map_scroll = 'true';
$map_control_inv = 'true';

?>
<section class="google-map-content" id="<?php echo esc_attr($block_id); ?>">
    <div class="map-results">
        <aside class="map-results__sidebar">
            <div class="map-results__inner has-scrollbar">

                <div class="map-results__main">
                    <h2 class="map-results__header-title js-toggle-location-all is-active">All</h2>
                </div>
                <?php

                $counter = 1;

                foreach ($terms as $term) {
                    echo '<div class="map-results__main location-cat-' . $term->term_id . '">';
                    echo '<div class="map-results__header"><h2 class="map-results__header-title has-children js-toggle-location" data-cat="' . $term->slug . '">' . $term->name . '</h2></div>';
                    $args = array(
                        'post_type' => 'location',
                        'orderby' => 'title',
                        'order' => 'DESC',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'location-category',
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        ),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        $long[] = [];
                        $lat[] = [];
                        //$mapdata = [];
                        echo '<div class="map-results__item">';
                        while ($query->have_posts()) : $query->the_post();
                            $address = get_field('google_location_address');
                            $city = get_field('google_location_city');
                            $state = get_field('google_location_state');
                            $zip = get_field('google_location_zip');
                            $phone = get_field('google_location_phone');
                            $longitude = get_field('google_location_longitude');
                            $latitude = get_field('google_location_latitude');

                            if (!empty($longitude) && !empty($latitude)) {
                                $longdeg = $longitude['degree'];
                                $longdir = $longitude['direction'];
                                $latdeg = $latitude['degree'];
                                $latdir = $latitude['direction'];
                                if ($longdir == 'W') {
                                    $longdeg = -1 * floatval($longdeg);
                                }

                                if ($latdir == 'N') {
                                    $latdeg = -1 * floatval($latdeg);
                                }
                                $mapdata[] = [$longdeg, $latdeg, $counter, $address . ' ' . $city . ', ' . $state . ' ' . $zip . ' ' . $phone, $term->slug];
                                $mapdatacat[$term->slug][] = [$longdeg, $latdeg, $counter, $address . ' ' . $city . ', ' . $state . ' ' . $zip . ' ' . $phone, $term->slug, get_the_title()];
                                $location_title[] = get_the_title();
                                $locationtitlecat[$term->slug][] = get_the_title();
                                ?>

                                <div class="map-results__item-inner js-list-item" id="location-<?php echo $counter; ?>"
                                     data-long="<?php echo $longdeg; ?>" data-lat="<?php echo $latdeg; ?>"
                                     data-count="<?php echo $counter; ?>"
                                     data-address="<?php echo $address . ' ' . $city . ', ' . $state . ' ' . $zip . ' ' . $phone; ?>">
                                    <h3 class="map-results__location-title"><?php the_title(); ?></h3>
                                    <address class="map-results__address"><?php echo $address . ' <br /> ' . $city . ', ' . $state . ' ' . $zip . ' <br /> ' . $phone; ?></address>
                                    <?php if(get_field('url') != ""){
                                        echo "<div class='featured-news__cat' style='margin-top:20px;'><a href='".get_field('url')."'>LEARN MORE</a></div>";
                                    }?>
                                </div>
                                <?php
                                $counter++;
                            } else {
                                $mapdata[] = [];
                                $mapdatacat[$term->slug][] = [];
                                $location_title[] = [];
                                $locationtitlecat[$term->slug][] = [];
                            }
                        endwhile;


                        echo '</div>';
                    endif;
                    echo '</div>';
                }
                wp_reset_postdata();
                ?>
            </div>
        </aside>
        <div class="map-results__map">
            <div id="map"></div>
        </div>
    </div>
</section>
<?php
$args_all = array(
    'post_type' => 'location',
    'orderby' => 'title',
    'order' => 'DESC',
    'posts_per_page' => -1,
);
$query_all = new WP_Query($args_all);
if ($query_all->have_posts()) :
    $long[] = [];
    $lat[] = [];
    //$mapdata = [];
    while ($query_all->have_posts()) : $query_all->the_post();
        $address = get_field('google_location_address');
        $city = get_field('google_location_city');
        $state = get_field('google_location_state');
        $zip = get_field('google_location_zip');
        $phone = get_field('google_location_phone');
        $longitude = get_field('google_location_longitude');
        $latitude = get_field('google_location_latitude');

        if (!empty($longitude) && !empty($latitude)) {
            $longdeg = $longitude['degree'];
            $longdir = $longitude['direction'];
            $latdeg = $latitude['degree'];
            $latdir = $latitude['direction'];
            if ($longdir == 'W') {
                $longdeg = -1 * floatval($longdeg);
            }

            if ($latdir == 'N') {
                $latdeg = -1 * floatval($latdeg);
            }
            $mapdataall[] = [$longdeg, $latdeg, $counter, $address . ' ' . $city . ', ' . $state . ' ' . $zip . ' ' . $phone, $term->slug];
            $location_title_all[] = get_the_title();
            $counter++;
        } else {
            $mapdataall[] = [];
        }
    endwhile;
endif;
wp_reset_postdata(); ?>


<style>
    #map {
        width: 100%;
        height: <?php echo $map_height; ?>px;
    }
</style>
<script>
    var map;

    function initMap() {
        var mapOptions = {
            zoom: <?php echo $map_zoom; ?>,
            center: new google.maps.LatLng(40.13082155313381, -74.82232955794834), // this is for center
            mapTypeId: google.maps.MapTypeId.<?php echo $map_type; ?>,
            scrollwheel: <?php echo $map_scroll ?>,
            zoomControl: <?php echo $map_control_inv ?>,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            styles: [
                {elementType: "geometry", stylers: [{color: "#F2F2F2"}]},
                {elementType: "labels.text.stroke", stylers: [{color: "#F2F2F2"}]},
                {elementType: "labels.text.fill", stylers: [{color: "#181818"}]},
                {
                    featureType: "administrative.locality",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#181818"}],
                },
                {
                    featureType: "poi",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#181818"}],
                },
                {
                    featureType: "poi.park",
                    elementType: "geometry",
                    stylers: [{color: "#F2F2F2"}],
                },
                {
                    featureType: "poi.park",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#F2F2F2"}],
                },
                {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{color: "#38414e"}],
                },
                {
                    featureType: "road",
                    elementType: "geometry.stroke",
                    stylers: [{color: "#212a37"}],
                },
                {
                    featureType: "road",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#9ca5b3"}],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{color: "#746855"}],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{color: "#1f2835"}],
                },
                {
                    featureType: "road.highway",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#f3d19c"}],
                },
                {
                    featureType: "transit",
                    elementType: "geometry",
                    stylers: [{color: "#2f3948"}],
                },
                {
                    featureType: "transit.station",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#181818"}],
                },
                {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [{color: "#C4C4C4"}],
                },
                {
                    featureType: "water",
                    elementType: "labels.text.fill",
                    stylers: [{color: "#C4C4C4"}],
                },
                {
                    featureType: "water",
                    elementType: "labels.text.stroke",
                    stylers: [{color: "#C4C4C4"}],
                },
            ],
        };


        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var infowindow = new google.maps.InfoWindow();
        <?php
        if( !empty($mapdata || $location_title) ){
        $c = count($mapdata);
        $l_title = count($location_title);
        if( $c >= 1 || $location_title >= 1){
        for ($i = 0; $i < $c; $i++) {
        if( !empty($mapdata[$i][0]) && !empty($mapdata[$i][1]) ) { ?>

        var marker = new google.maps.Marker({
            <?php  echo 'position: new google.maps.LatLng(' . $mapdata[$i][0] . ', ' . $mapdata[$i][1] . '),'; ?>
            icon: {
                url: '<?php echo get_template_directory_uri(); ?>/images/pin.png',
                labelOrigin: new google.maps.Point(20, 20)
            },
            map: map,
            labelClass: "gmap-label"
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            //console.log(marker[i])
            var temp_data = <?php echo $mapdata[$i][2]; ?>;
            var temp = temp_data.toString();
            var str1 = '#location-';
            var str2 = str1.concat(temp);
            const locationContent = `<h3 class="map-results__location-title-on-map"><?php echo $location_title[$i]; ?></h3> <?php echo $mapdata[$i][3]; ?>`;
            $(str2).click(function () {
                mapResult()
            })

            function mapResult() {
                infowindow.setContent(locationContent);
                infowindow.open(map, marker);
                window.setTimeout(function () {
                    //map.panTo(new google.maps.LatLng(<?php echo $mapdata[$i][0]; ?>, <?php echo $mapdata[$i][1]; ?>));
                    //map.setZoom(3);
                    $(str2).addClass("is-active");
                    var sum = 0;
                    $('.is-active').prevAll().each(function () {
                        sum += Number($(this).outerHeight());
                    });
                });
            }

            return function () {
                $('.js-list-item').removeClass('is-active');
                mapResult()
            }
        })(marker));

        <?php } } } } ?>

    }

    //google.maps.event.addDomListener(window, 'load', initMap);

    jQuery(document).ready(function ($) {
        $(".js-list-item").click(function () {
            $(".js-list-item").removeClass("is-active");
            $(this).toggleClass("is-active");
            var count = $(this).data('count');
            var long = $(this).data('long');
            var lat = $(this).data('lat');
            var address = $(this).data('address');
            var count_no = eval(count);
            var infowindow = new google.maps.InfoWindow();

            window.setTimeout(function () {
                infowindow.setContent(address);
            });
        });

        $('.js-toggle-location').on('click', function () {
            $(".js-list-item, .js-toggle-location-all").removeClass("is-active");
            $(this).toggleClass('is-active');
            $(this).parents('.map-results__main').find('.map-results__item').slideToggle('fast');
            $(this).parents('.map-results__main').siblings().find('.map-results__item').slideUp('fast');
            $(this).parents('.map-results__main').siblings().find('.js-toggle-location').removeClass('is-active');
            var mapOptions = {
                zoom: <?php echo $map_zoom; ?>,
                center: new google.maps.LatLng(40.13082155313381, -74.82232955794834), // this is for center
                mapTypeId: google.maps.MapTypeId.<?php echo $map_type; ?>,
                scrollwheel: <?php echo $map_scroll ?>,
                zoomControl: <?php echo $map_control_inv ?>,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                styles: [
                    {elementType: "geometry", stylers: [{color: "#F2F2F2"}]},
                    {elementType: "labels.text.stroke", stylers: [{color: "#F2F2F2"}]},
                    {elementType: "labels.text.fill", stylers: [{color: "#181818"}]},
                    {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{color: "#F2F2F2"}],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#F2F2F2"}],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{color: "#38414e"}],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{color: "#212a37"}],
                    },
                    {
                        featureType: "road",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#9ca5b3"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{color: "#746855"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{color: "#1f2835"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#f3d19c"}],
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{color: "#2f3948"}],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{color: "#C4C4C4"}],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#C4C4C4"}],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.stroke",
                        stylers: [{color: "#C4C4C4"}],
                    },
                ],
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var infowindow = new google.maps.InfoWindow();

            var category = $(this).attr("data-cat");

            var mapdatacat = <?php echo json_encode($mapdatacat); ?>
            // Display the array elements
            //console.log( myarr[category] );
            for (var i = 0; i < mapdatacat[category].length; i++) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(mapdatacat[category][i][0], mapdatacat[category][i][1]),
                    icon: {
                        url: '<?php echo get_template_directory_uri(); ?>/images/pin.png',
                        labelOrigin: new google.maps.Point(20, 20)
                    },
                    map: map,
                    labelClass: "gmap-label"
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    //console.log(marker[i])
                    var temp_data = mapdatacat[category][i][2];
                    var temp = temp_data.toString();
                    var str1 = '#location-';
                    var str2 = str1.concat(temp);
                    var locationContent = '<h3 class="map-results__location-title-on-map">' + mapdatacat[category][i][5] + '</h3>' + mapdatacat[category][i][3];
                    $(str2).click(function () {
                        infowindow.setContent(locationContent);
                        infowindow.open(map, marker);
                        window.setTimeout(function () {
                            $(str2).addClass("is-active");
                            var sum = 0;
                            $('.is-active').prevAll().each(function () {
                                sum += Number($(this).outerHeight());
                            });
                        });
                    })

                    return function () {
                        $('.js-list-item').removeClass('is-active');
                        infowindow.setContent(locationContent);
                        infowindow.open(map, marker);
                        window.setTimeout(function () {
                            $(str2).addClass("is-active");
                            var sum = 0;
                            $('.is-active').prevAll().each(function () {
                                sum += Number($(this).outerHeight());
                            });
                        });
                    }
                })(marker, i));
            }


        });

        $('.js-toggle-location-all').on('click', function () {
            $(".js-list-item").removeClass("is-active");
            $(this).toggleClass('is-active');
            $(this).parents('.map-results__main').find('.map-results__item').slideToggle('fast');
            $(this).parents('.map-results__main').siblings().find('.map-results__item').slideUp('fast');
            $(this).parents('.map-results__main').siblings().find('.js-toggle-location').removeClass('is-active');
            if ($('.has-scrollbar').length > 0) {
                const ps = new PerfectScrollbar('.has-scrollbar', {
                    wheelSpeed: 2,
                    wheelPropagation: true,
                    minScrollbarLength: 20
                });
            }

            var mapOptions = {
                zoom: <?php echo $map_zoom; ?>,
                center: new google.maps.LatLng(40.13082155313381, -74.82232955794834), // this is for center
                mapTypeId: google.maps.MapTypeId.<?php echo $map_type; ?>,
                scrollwheel: <?php echo $map_scroll ?>,
                zoomControl: <?php echo $map_control_inv ?>,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                styles: [
                    {elementType: "geometry", stylers: [{color: "#F2F2F2"}]},
                    {elementType: "labels.text.stroke", stylers: [{color: "#F2F2F2"}]},
                    {elementType: "labels.text.fill", stylers: [{color: "#181818"}]},
                    {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{color: "#F2F2F2"}],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#F2F2F2"}],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{color: "#38414e"}],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{color: "#212a37"}],
                    },
                    {
                        featureType: "road",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#9ca5b3"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{color: "#746855"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{color: "#1f2835"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#f3d19c"}],
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{color: "#2f3948"}],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#181818"}],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{color: "#C4C4C4"}],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#C4C4C4"}],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.stroke",
                        stylers: [{color: "#C4C4C4"}],
                    },
                ],
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            <?php

            if( !empty($mapdataall) ){
            $c = count($mapdataall);
            if( $c >= 1 ){
            for ($i = 0; $i < $c; $i++) {
            if( !empty($mapdataall[$i][0]) && !empty($mapdataall[$i][1]) ) { ?>

            var marker = new google.maps.Marker({
                <?php  echo 'position: new google.maps.LatLng(' . $mapdataall[$i][0] . ', ' . $mapdataall[$i][1] . '),'; ?>
                icon: {
                    url: '<?php echo get_template_directory_uri(); ?>/images/pin.png',
                    labelOrigin: new google.maps.Point(20, 20)
                },
                map: map,
                labelClass: "gmap-label"
            });

            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                //console.log(marker[i])
                var temp_data = <?php echo $mapdataall[$i][2]; ?>;
                var temp = temp_data.toString();
                var str1 = '#location-';
                var str2 = str1.concat(temp);
                const locationContentall = `<h3 class="map-results__location-title-on-map"><?php echo $location_title_all[$i]; ?></h3> <?php echo $mapdataall[$i][3]; ?>`;
                $(str2).click(function () {
                    infowindow.setContent(locationContentall);
                    infowindow.open(map, marker);
                    window.setTimeout(function () {
                        $(str2).addClass("is-active");
                        var sum = 0;
                        $('.is-active').prevAll().each(function () {
                            sum += Number($(this).outerHeight());
                        });
                    });
                })

                return function () {
                    $('.js-list-item').removeClass('is-active');
                    infowindow.setContent(locationContentall);
                    infowindow.open(map, marker);
                    window.setTimeout(function () {
                        $(str2).addClass("is-active");
                        var sum = 0;
                        $('.is-active').prevAll().each(function () {
                            sum += Number($(this).outerHeight());
                        });
                    });
                }
            })(marker));

            <?php } } } }?>

        });


    });

</script>
