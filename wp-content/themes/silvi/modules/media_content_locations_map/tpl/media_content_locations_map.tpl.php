<?php
if (!empty($data['module_id'])) {
	$block_id = $data['module_id'];
} else {
	$block_id = 'block-' . uniqid();
}

$addClass = '';

$latitude = 40.13082155313381;
$longitude = -74.82232955794834;
$map_height = 700;
$map_zoom = 8;
$map_type = 'ROADMAP';
$map_scroll = 'true';
$map_control_inv = 'true';

$mapdataall = [];

if(!empty($data['location_item'])) {
	$long = [];
	$lat = [];
	$counter = 1;
	foreach ($data['location_item'] as $item) {
		$name = $item['location_name'];
		$address = $item['street_address'];
		$city = $item['city'];
		$state = $item['location_state'];
		$zip = $item['zip_code'];
		$phone = $item['phone_number'];
		$longitude = $item['longtitude'];
		$latitude = $item['latitude'];

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

			$mapdataall[] = [
				'longitude' => $longdeg,
				'latitude' => $latdeg,
				'id' => $counter,
				'details' => "{$address} {$city}, {$state} {$zip} {$phone}",
				'name' => $name
			];
			$counter++;
		}
	}
}


?>
<section class="media-content media-content--locations" id="<?php echo esc_attr($block_id); ?>" data-animate>
    <div id="map"></div>
  <!--  <figure class="media-content__bg-image <?php /*echo $addClass; */?>">
			<img src="<?php /*echo esc_url($data['image']['url']); */?>" alt="<?php /*echo esc_attr($data['image']['alt']); */?>">
		</figure>-->

	<?php if (!empty($data['title']) || !empty($data['buttons']) || !empty($data['content'])): ?>
		<div class="container">
			<div class="media-content__wrap">
				<?php if (!empty($data['title'])): ?>
					<h2 class="media-content__title"><?php echo $data['title']; ?></h2>
				<?php endif; ?>
				<?php if (!empty($data['content'])): ?>
					<div class="media-content__description entry-content"><?php echo $data['content']; ?></div>
				<?php endif; ?>
				<?php if (!empty($data['buttons'])): ?>
					<div class="media-content__secondary">
						<?php foreach ($data['buttons'] as $item):
							?>
							<a class="btn" href="<?php echo $item['link']['url']; ?>"
							   target="<?php echo $item['link']['target']; ?>">
								<?php echo $item['link']['title']; ?> <svg class="icon icon-silviRightArrow">
									<use xlink:href="#icon-silviRightArrow"></use>
								</svg>
							</a>
						<?php
						endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</section>


<script>
    var mapDataAll = <?php echo json_encode($mapdataall); ?>;

    function initialize() {
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

        // Loop through map data and create markers
        mapDataAll.forEach(function(location) {
            if (location.longitude && location.latitude) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(location.latitude, location.longitude),
                    map: map,
                    icon: {
                        url: '<?php echo get_template_directory_uri(); ?>/images/pin.png',
                        labelOrigin: new google.maps.Point(20, 20)
                    },
                    labelClass: "gmap-label"
                });

                google.maps.event.addListener(marker, 'click', function() {
                    var locationContent = `<h3 class="map-results__location-title-on-map">${location.name}</h3>${location.details}`;
                    infowindow.setContent(locationContent);
                    infowindow.open(map, marker);
                });
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>