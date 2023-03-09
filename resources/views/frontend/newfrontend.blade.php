<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DBD JEMBER</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{--
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-fe/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DATETIME  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <!-- LEAFLET CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- PleaseWait -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.css"
        integrity="sha512-LGdYsyO5vL18FjVLl4X0hpD6YfE/0GhsLu2+Z4W56CM/KlVNvfEe3BkKMFxqnSHEh2RpPF6ZoxHcisQKPbJLwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 80vh;
            z-index: 0;
        }

        .info.legend {
            background-color: white;
            padding: 1em;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        .loader {
            position: absolute;
            bottom: 50%;
            margin: auto;
            z-index: 10000000;
            opacity: 1;
        }
        .countryLabel{
            color: white;
            background: rgba(255, 255, 255, 0);
            border:0;
            border-radius:0px;
            box-shadow: 0 0px 0px;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body id="OpenSidebar">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn" style="margin-right: 1em;"></i>
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo-jember.png') }}" alt="">
                <span class="d-none d-lg-block">DBD JEMBER</span>
            </a>
        </div><!-- End Logo -->

        <!-- <div class="input-group mt-0">
            <input type="text" name="date" id="date" onchange="" class="form-control " value=""
                placeholder="Pilih Periode">
            <span class="input-group-text" id="search"> <i class="fa fa-calendar"></i></span>
        </div> -->



    </header><!-- End Header -->

    @php
    $triwulan = array(
    1 => "Triwulan 1",
    2 => "Triwulan 2",
    3 => "Triwulan 3",
    4 => "Triwulan 4"
    );

    @endphp
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <h5 class=" text-capitalize text-center mt-3 ">Potensi Demam Berdarah</h5>
            <hr class="my-0" />
            {{-- <form> --}}
                <div class="d-flex flex-column px-4 mt-2">
                    <div class="mb-3">
                        <p class="mb-1">Periode</p>
                        <div class="input-group mt-0">
                            <input type="text" name="date" id="date" onchange="" class="form-control " value="2021"
                                placeholder="Pilih Periode">
                            <span class="input-group-text" id="search"> <i class="fa fa-calendar"></i></span>
                        </div>

                        <p class="mt-3 mb-1">Triwulan</p>
                        <div class="input-group mt-0">
                            <select id="triwulan" name="triwulan"
                                class="select2 form-select  @error('triwulan') is-invalid @enderror">
                                <option value="1"> Pilih triwulan </option>
                                @foreach ($triwulan as $key => $value )
                                @if ( old('triwulan') == $key)
                                <option value="1" selected>{{ $value
                                    }}
                                </option>
                                @else
                                <option value="{{ $key }}">{{ $value }}
                                </option>
                                @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="check[]" value="potensi"
                                id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck3">Potensi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="check[]" value="penyebaran"
                                id="defaultCheck2"  />
                            <label class="form-check-label" for="defaultCheck3">Penyebaran</label>
                        </div>
                    </div>
                </div>
                <div class="px-4 ">
                    <button class="btn btn_set btn-primary me-2"
                        style="background-color: #696CFF; color: rgb(255, 255, 255)" id="setButton">Tampilkan</button>

                </div>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-warning loader" id="spinner" role="status" hidden>
                        </div>
                    </div>
                    <div id="map">

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>

    {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-fe/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-fe/vendor/tinymce/tinymce.min.js') }}"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('assets-fe/js/main.js') }}"></script>

    <!-- Please Wait Loader -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.min.js"
        integrity="sha512-mEe6gLbPz5ZrXPgwBNL6KSNLjE1zvv4G31w/UdsGkaYrmFBLhGRH4iRI5SeoUppqdq/Ydn5A+ctDO2felJ8p5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var loading_screen = pleaseWait({
            logo: "{{ asset('assets/img/logo-jember.png') }}",
            backgroundColor: '#112042f1',
            loadingHtml: "<h2 class='loading-message' style='color:yellow'>Peta Kerawanan Demam Berdarah</h2>"
        });

        window.loading_screen.finish();
    </script>

    <!-- DATETIME  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js">
    </script>
    <script>
        $(function() {
            $('.fa-calendar').click(function(){
            $('#date').focus();
        })
        $('#date').datepicker({
            autoclose: true,
            viewMode: 'years',
            format: 'yyyy',
            minViewMode: "years",
            zIndexOffset : 999,
        });
    });
    </script>


    <!-- Leaflet JS  -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
    <script src='https://unpkg.com/@mapbox/leaflet-pip@latest/leaflet-pip.js'></script>


    <script>
        // var randomPointsOnPolygon = require('random-points-on-polygon');
        // var turf = require('turf');
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        });

        var map = L.map('map', {
            center: [-8.2029128, 113.6366055],
            zoom: 10.8,
            layers: [osm]
        });

        let controlLayers = L.control.layers('', null, { collapsed: false }).addTo(map);

        // GeoJSON BOUNDARY SURABAYA
        var geoJsonUrl = "https://gist.githubusercontent.com/Sealorent/05eb6b97d06ea51bc65a781de3bdeee0/raw/a5596ea1f5d651d06f6b1470e03b34e5a8574533/boundary_jember_kecamatan.geojson";

        // Base Layer
        $.ajax({
            dataType: "json",
            url: geoJsonUrl,
        }).done(function(data){
            var baseLayer = L.geoJson(data).addTo(map);
            controlLayers.addOverlay(baseLayer, 'Kecamatan');
            var layerGroup = L.geoJSON(data, {
                onEachFeature: function (feature, layer) {
                    layer.bindPopup( `<p> Kecamatan : `+feature.properties.kecamatan +`</p>`).addTo(baseLayer);
                }
            });
        });


        function getColourPotensi(d) {
            if (d === 'tinggi')
                return '#a40404';
            else if (d === 'sedang')
                return '#D5DC0B';
            else if (d === 'rendah')
            return '#80b918';
            else
                return 'white';
        }


        function getColorPotensi(param) {
            return {
                weight: 1,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7,
                fillColor: getColourPotensi(param),
            };
        }


        // map.on('click', function(e) {
        //     alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
        // });

        

        // Get Potensi
        var potensi = null;
        function getPotensi (result) {
            if(potensi != null){
                map.removeLayer(potensi);
                legend.remove(potensi);
                controlLayers.removeLayer(potensi);
            }
            legend = L.control({position: 'bottomright'});
            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'info legend'),
                    grades = ['tinggi', 'sedang', 'rendah'],
                    labels = [];
                // loop through our density intervals and generate a label with a colored square for each interval
                for (var i = 0; i < grades.length; i++) {
                    div.innerHTML +=
                        '<i style="background:' + getColourPotensi(grades[i]) + '"></i> ' +
                        grades[i] +  '<br>' ;
                }
                return div;
            };
            legend.addTo(map);

            const rand = (min, max) => Math.floor(Math.random() * (max - min + 1) + min)

            $.ajax({
            dataType: "json",
            url: geoJsonUrl,
            }).done(function(data){
                potensi = L.geoJson(data).addTo(map);
                controlLayers.addOverlay(potensi, 'Potensi');
                var layerGrou = L.geoJSON(data, {
                onEachFeature: function (feature, layer) {
                    result.forEach(res => {
                            if (res.kecamatan == feature.properties.kecamatan) {
                                layer.bindPopup( `<p style="font-weight: bold;"> `+feature.properties.kecamatan +`</p><p> Potensi `+ res.potensi +`</p><p> Bulan: `+ res.triwulan +`</p><p> Jumlah Kasus DBD: `+ res.kasus_dbd +`</p><p> Tindakan: `+ res.tindakan +`</p>`).addTo(potensi);
                                // var bounds = layer.getBounds().getCenter();
                                layer.bindTooltip(
                                    feature.properties.kecamatan,
                                    {
                                        permanent:true,
                                        direction:'center',
                                        className: 'countryLabel'
                                    }
                                );
                                // console.log(bounds);
                                layer.setStyle(getColorPotensi(res.potensi));
                            }
                        });
                    },
                weight : 1,
                });
            if (layerGrou != null) {
                $("#spinner").attr("hidden",true);
            }
            });
        }

        function giveIndex(index){
            let n = 33;
            let nn= 42;
            // for (let i = 0; i < 33 ; i++) {
                    // for (let j = 0; j < 42 ; j++) {
                        // }
                // } 
        }

        // Penyebaran
        function penyebaran(result){
            $("#spinner").attr("hidden",true);

            $.ajax({
            dataType: "json",
            url: geoJsonUrl,
            }).done(function(data){
                // penyebaran = L.geoJson(data);
                let bbox = turf.bbox(data);
                let options = { units: "kilometers"};
                let squareGrid = turf.squareGrid(
                bbox,
                2,
                options
                );
                penyebaran = L.geoJSON(squareGrid).addTo(map);
                controlLayers.addOverlay(penyebaran, 'Potensi');
                squareGrid.features[100].properties.state = 2;
                // squareGrid.features[36].properties.state = 2;

                console.log(squareGrid.features[1].geometry);

                let n = 33;
                let nn= 42;
                var array_index = [];
                let c = 0;
                for (let i = 1; i < n ; i++) {
                    for (let j = 1; j < nn ; j++) {
                        array_index[c] = [i,j].toString();
                        c++;
                    }
                } 
                // console.log(array_index[0]);
                if(array_index[0] === [1,1].toString()){
                    console.log('ttai');

                }

                L.geoJSON(squareGrid,{
                    onEachFeature:function(feature3, layer3){
                        // for (let a = 0; a < result.length ; a++) {
                            // points = turf.point(result[a]);
                                // console.log(feature3.properties.index);   
                                if(feature3.properties.state == 2){
                                // // if(feature3.properties.index == [32,41]){

                                //     console.log(feature3);
                                    layer3.setStyle({fillColor:'red'}).addTo(map);
                                }
                                // if (turf.inside(points, feature3)){
                                //     layer3.setStyle({fillColor:'red'}).addTo(map);
                                //     // State Sakit
                                //     feature3.properties.state = 2;
                                // }else{
                                //     // layer3.setStyle({fillColor:'green'}).addTo(map);
                                // }
                        // }
                    }
                });
            });
        }
            

        function insidePoint(polygon, point){
            let odd = false;
    //For each edge (In this case for each point of the polygon and the previous one)
            for (let i = 0, j = polygon.length - 1; i < polygon.length; i++) {
                //If a line from the point into infinity crosses this edge
                if (((polygon[i][1] > point[1]) !== (polygon[j][1] > point[1])) // One point needs to be above, one below our y coordinate
                    // ...and the edge doesn't cross our Y corrdinate before our x coordinate (but between our x coordinate and infinity)
                    && (point[0] < ((polygon[j][0] - polygon[i][0]) * (point[1] - polygon[i][1]) / (polygon[j][1] - polygon[i][1]) + polygon[i][0]))) {
                    // Invert odd
                    odd = !odd;
                }
                j = i;

            }
            //If the number of crossings was odd, the point is in the polygon
            return odd;
        }

        var data = '';
        $("input").on("click", function() {
            data = $("input:checked").val();
        });
        // Button
        $("#setButton").on('click',function () {
            $("#spinner").attr("hidden",false);
            if($('#date').val() == '' || $('#triwulan').val() == '' ) {
                alert('Please select a date');
                $("#spinner").attr("hidden",true);

            }else{

                if (window.matchMedia('(max-width: 767px)').matches) {
                        $("#OpenSidebar").removeClass("toggle-sidebar")
                        console.log('a');
                }

                if(data == 'potensi'){
                    $.ajax({
                    type: "get",
                    url: "/filter",
                    data: {
                        date: $('#date').val(),
                        triwulan: $('#triwulan').val(),
                    },
                    }).done(function (result) {
                        if(result.length === 0){
                            alert('data masih belum tersedia');
                            $("#spinner").attr("hidden",true);
                        }else{
                            getPotensi(result);
                        }
                    });
                }else{
                    $.ajax({
                    type: "get",
                    url: "/penyebaran",
                    data: {
                        date: $('#date').val(),
                        triwulan: $('#triwulan').val(),
                    },
                    }).done(function (result) {
                        if(result.length === 0){
                            alert('data masih belum tersedia');
                            $("#spinner").attr("hidden",true);
                        }else{
                            penyebaran(result);
                        }
                    });
                }

            }
        });



    </script>

</body>

</html>
