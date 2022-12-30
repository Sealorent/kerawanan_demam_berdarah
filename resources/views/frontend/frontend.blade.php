<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DBD JEMBER</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-jember.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{  asset('assets/vendor/css/styles.css')  }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.css"
        integrity="sha512-LGdYsyO5vL18FjVLl4X0hpD6YfE/0GhsLu2+Z4W56CM/KlVNvfEe3BkKMFxqnSHEh2RpPF6ZoxHcisQKPbJLwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spinkit/2.0.1/spinkit.css"
        integrity="sha512-OZT9eXTvKtWjeXPDP5rDFG9X7rRDoj507dyi7os5jHhVgMtq7febcNmeMA3I/E9936YaewzVOKOd3xsXSZNbZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 100%;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }

        @media (max-width: 600px) {
            .mapss {
                height: 90% !important;
                margin-top: 4em !important;
            }

            .img-label {
                height: 40px;
                width: 40px;
            }
        }

        @media only screen and (min-width: 600px) {
            .mapss {
                height: 90% !important;
                margin-top: 6em !important;
            }

            .img-label {
                height: 40px;
                width: 40px;
            }
        }

        .myDivIcon {
            text-align: center;
            /* Horizontally center the text (icon) */
            line-height: 20px;
            /* Vertically center the text (icon) */
        }

        .form-check-input:checked {
            background-color: #696CFF;
            border-color: grey;
        }

        .legend {
            line-height: 18px;
            color: #555;
            padding: 5%;
            background: white;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        body.sb-nav-fixed {
            display: none;
        }

        body.sb-nav-fixed.pg-loading {
            display: block;
        }

        body.sb-nav-fixed.pg-loaded {
            display: block;
        }
    </style>

</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar  navbar-expand navbar-dark bg-primary " style="height: 10%">
        <button class="btn btn-link btn order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fa-sharp fa-solid fa-bars" style="color: white"></i></button>
        <a class="navbar-brand ps-3" href="index.html"><span><img class="img-label"
                    src="{{ asset('assets/img/logo-jember.png') }}" style="border: none" alt=""></span> DBD JEMBER </a>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav" style=" ">
            <nav class="sb-sidenav accordion sb-sidenav-light shadow bg-body rounded" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav mt-4">
                        <h5 class=" text-capitalize text-center mt-3 ">Filter Demam Berdarah</h5>
                        <hr class="my-0" />
                        <form action="" method="post">
                            @csrf
                            <div class="d-flex flex-column px-4 mt-2">
                                <div class="mb-3">
                                    <p>Periode</p>
                                    <div class="input-group mt-0">
                                        <input type="text" name="date" id="date" onchange="" class="form-control "
                                            value="" placeholder="Pilih Periode">
                                        <span class="input-group-text" id="search"> <i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check[]" value="kasus_dbd"
                                            id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck3">Kasus DBD</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check[]" value="potensi"
                                            id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck3">Potensi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check[]" value="vektor"
                                            id="defaultCheck3" />
                                        <label class="form-check-label" for="defaultCheck3">Vektor</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="check[]" value="perindukan"
                                            id="defaultCheck4" />
                                        <label class="form-check-label" for="defaultCheck3">Perindukan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 ">
                                <button class="btn btn_set btn-primary me-2"
                                    style="background-color: #696CFF; color: rgb(255, 255, 255">Tampilkan</button>
                                <button class="btn btn_clear btn-primary me-2"
                                    style="background-color: #696CFF; color: rgb(255, 255, 255" hidden>Clear</button>
                            </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="mapss" style=" z-index:0; position:fixed;width:100%; height: 100% ">
            <div id="map" style=""></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/vendor/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.min.js"
    integrity="sha512-mEe6gLbPz5ZrXPgwBNL6KSNLjE1zvv4G31w/UdsGkaYrmFBLhGRH4iRI5SeoUppqdq/Ydn5A+ctDO2felJ8p5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    var loading_screen = pleaseWait({
            logo: "{{ asset('assets/img/logo-jember.png') }}",
            backgroundColor: '#112042f1',
            loadingHtml: "<p class='loading-message'>A good day to you fine user!</p>"
        });

    window.loading_screen.finish();

    $(function() {
        $('.fa-calendar').click(function(){
            $('#date').focus();
        })
        $("#date").datepicker(
		    {viewMode: 'years',
		     format: 'yyyy-mm',
             autoclose: true,
             minViewMode: 1
	    });
    });

    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        });
    var _token = 'pk.eyJ1Ijoic2VhbG9yZW50IiwiYSI6ImNrejlzb2pldTF4amkyb28yMm84NDZmcjEifQ.rUUuGYxWEaFL6lDNl5i8zA';
    var streets =  L.tileLayer(
                            'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + _token, {
                                id: 'mapbox/streets-v11',
                                tileSize: 512,
                                zoomOffset: -1,
                                attribution: '© <a href="https://www.mapbox.com/contribute/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            });
                            // -7.2754438,112.642643,12z
    var map = L.map('map', {
        center: [-8.2029128, 113.6366055],
        zoom: 10.8,
        layers: [osm]
    });

    // add control layer
    let controlLayers = L.control.layers('', null, { collapsed: false }).addTo(map);

    // function for get color
    function getColour(d) {
        return d > 1000 ? '#a40404' :
            d > 500  ? '#dc2f02' :
        d > 200  ? '#d5440b' :
        d > 100  ? '#de7f11' :
        d > 50   ? '#edbf17' :
        d > 20   ? '#f9f91f' :
        d > 10   ? '#d4d700' : '#80b918';
    }

    function getColor(param) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColour(param)
        };
    }

    function getColourPotensi(d) {
        return d > 'tinggi' ? '#a40404' : '#80b918';
    }

    function getColorPotensi(param) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: param == 'tinggi' ? '#a40404' : '#80b918',
        };
    }


    var geoJsonUrl = "https://gist.githubusercontent.com/Sealorent/05eb6b97d06ea51bc65a781de3bdeee0/raw/a5596ea1f5d651d06f6b1470e03b34e5a8574533/boundary_jember_kecamatan.geojson";
    var clinicSurabaya = "http://127.0.0.1:8082/geoserver/surabaya/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=surabaya%3Aclinic_surabya&maxFeatures=50&outputFormat=application%2Fjson";

    var kasus_layer;
    var legend;
    function potensi_dbd (result) {
            // Legend Kasus DBD
        console.log(result);
        legend = L.control({position: 'bottomright'});
        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend'),
                grades = ['tinggi', 'rendah'],
                labels = [];
            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColourPotensi(grades[i] + 1) + '"></i> ' +
                    grades[i] +  '<br>' ;
            }
            return div;
        };
        legend.addTo(map);
        $.ajax({
        dataType: "json",
        url: geoJsonUrl,
        }).done(function(data){
            log(data);
            kasus_layer = L.geoJson(data).addTo(map);
            var layerGroup = L.geoJSON(data, {
            onEachFeature: function (feature, layer) {
                    layer.bindPopup( `<p> Kecamatan : `+feature.properties.name +`</p><p> Jumlah kasus DBD : ???</p>`).addTo(kasus_layer);
                    result.forEach(res => {
                        if (res.kecamatan == feature.properties.name) {
                            layer.bindPopup( `<p> Kecamatan : `+res.kecamatan +`</p><p> Potensi DBD : `+res.potensi +`</p>`).addTo(kasus_layer);
                            layer.setStyle(getColorPotensi(res.potensi));
                        }
                    });
                }
            });
        })
    }
    function kasus_dbd (result) {
            // Legend Kasus DBD
        console.log(result);
        legend = L.control({position: 'bottomright'});
        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 10, 20, 50, 100, 200, 500, 1000],
                labels = [];
            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColour(grades[i] + 1) + '"></i> ' +
                    grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
            }
            return div;
        };
        legend.addTo(map);
        $.ajax({
        dataType: "json",
        url: geoJsonUrl,
        }).done(function(data){
            kasus_layer = L.geoJson(data).addTo(map);
            var layerGroup = L.geoJSON(data, {
            onEachFeature: function (feature, layer) {
                    layer.bindPopup( `<p> Kecamatan : `+feature.properties.name +`</p><p> Jumlah kasus DBD : ???</p>`).addTo(kasus_layer);
                    result.forEach(res => {
                        if (res.kecamatan == feature.properties.name) {
                            layer.bindPopup( `<p> Kecamatan : `+res.kecamatan +`</p><p> Jumlah kasus DBD : `+res.jumlah_kasus_dbd +`</p>`).addTo(kasus_layer);
                            layer.setStyle(getColor(res.jumlah_kasus_dbd));
                        }
                    });
                }
            });
        })

    }
    var origin = window.location.origin + '/icon/';
     // Filter
    let controlSearch = L.control.layers('', null, { collapsed: false }).addTo(map);
    var data = '';
    $("input").on("click", function() {
        data = $("input:checked").val();
    });
    var jenisLokasi = {};
    var lbjenisLokasi =[];
    function setMarker (filterValue) {
        for (var i = 0; i < filterValue['jenis_lokasi'].length; i++){
            jenisLokasi[i] = filterValue['jenis_lokasi'][i]['jenis_lokasi'];
            lbjenisLokasi[i] = filterValue['jenis_lokasi'][i]['jenis_lokasi'];
            jenisLokasi[i] = L.layerGroup();
            controlSearch.addOverlay(jenisLokasi[i], lbjenisLokasi[i]);
            $.each(filterValue['arr'],function(key,value){
                var today = value['feature']['tgl_survey'].toString();
                var getvalues = today.split("-");
                var date = getvalues[2]+'-'+getvalues[1]+'-'+getvalues[0];
                if(lbjenisLokasi[i] == value['feature']['jenis_lokasi']){
                    var marker;
                    marker = new L.marker(value['longlat']
                    ,{
                        icon:  L.icon({
                            iconUrl: 'icon/'+value['feature']['icon'],
                            iconSize: [20, 20]
                        }),
                    }
                    ).bindPopup(
                        `<p>`+value['feature']['jenis_lokasi'] +`</p>
                        <p>`+value['feature']['nama_lokasi'] +`</p>
                        <p>aides aegepty : `+value['feature']['aides_ae'] +`</p>
                        <p>aides albopictus : `+value['feature']['aides_al'] +`</p>
                        <p>Tgl survey : `+ date  +`</p>
                        `);
                    marker.addTo(jenisLokasi[i]);
                }
            });
        };
    }
    $('.btn_clear').on('click', function(){
        location.reload();
    });
    var vektor;
    var perindukan;
    $("form").submit(function (event) {
        if($('#date').val() == '') {
            alert('Please select a date');
        }
        $('#defaultCheck1').attr('disabled', true);
        $('#defaultCheck2').attr('disabled', true);
        $('#defaultCheck3').attr('disabled', true);
        $('#defaultCheck4').attr('disabled', true);
        $('#search').attr('disabled', true);
        $('.btn_clear').attr('hidden', false);
        $('.btn_set').attr('hidden', true);
        $.ajax({
        type: "get",
        url: "/filter",
        data: {
            data: data,
            date: $('#date').val(),
        },
        }).done(function (result) {
            switch (data) {
                case 'vektor':
                    if(kasus_layer != null){
                        kasus_layer.remove();
                        legend.remove();
                    }
                    setMarker(result);
                    break;
                case 'perindukan':
                    if(kasus_layer != null){
                        legend.remove();
                    }
                    setMarker(result);
                    break;
                case 'kasus_dbd':
                    if(kasus_layer != null){
                        kasus_layer.remove();
                        legend.remove();
                    }
                    setMarker(result);
                    kasus_dbd(result['data']);
                    break;
                case 'potensi':
                    if(kasus_layer != null){
                        kasus_layer.remove();
                        legend.remove();
                    }
                    console.log(result['data']);
                    setMarker(result);
                    potensi_dbd(result['data']);
                    break;
                default:
                    null;
                }

            });
            $(".sb-nav-fixed").addClass("sb-sidenav-toggled");
            event.preventDefault();
        });
        // Base Layer
        var baseLayer;
        $.ajax({
            dataType: "json",
            url: geoJsonUrl,
        }).done(function(data){
            // var demografi;
            //     // get data demografi
            //     $.ajax({
            //         method: 'GET',
            //         url: 'data-demografi',
            //         async: false,
            //         success: function(result) {
            //             demografi = result;
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //         console.log(thrownError);
            //         }
            //     });
                // var DemografiLayer = L.geoJson(data).addTo(map);
                var baseLayer = L.geoJson(data).addTo(map);
                controlLayers.addOverlay(baseLayer, 'Base Layer');

                // controlLayers.addOverlay(DemografiLayer, 'Base Layer');
                var layerGroup = L.geoJSON(data, {
                onEachFeature: function (feature, layer) {
                            layer.bindPopup( `<p> Kecamatan : `+feature.properties.kecamatan +`</p>`).addTo(baseLayer);
                    }
                 });
        });
</script>

</html>
