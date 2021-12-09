
state ={
    location:{
        x: null,
        y: null
    }
}


navigator.geolocation.getCurrentPosition( (pos) => {
    this.state = {
        location:{
            x: pos.coords.latitude,
            y: pos.coords.longitude
        }
    }
    console.log(state)

    var position = [this.state.location.x, this.state.location.y];

    var map = L.map('map').setView(position, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // map googlemap
    //  L.tileLayer('https://{s}.google.com/vt/lyrs=m@221097413,traffic&x={x}&y={y}&z={z}', {
    //      attribution: '&copy; <a href="https://www.google.com/maps">Google Map</a> contributors',
    //     maxZoom: 20,
    //     minZoom: 2,
    //     subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    // }).addTo(map);

    //vệ tinh
    //  L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    //       attribution: '&copy; <a href="https://www.google.com/maps">Google Map</a> contributors',
    //         maxZoom: 20,
    //         subdomains:['mt0','mt1','mt2','mt3']
    //     }).addTo(map);

     
   $('#formAdd').on('show.bs.modal', function() {
        setTimeout(function() {
            map.invalidateSize();
        }, 10);
        });

     var searchControl = L.esri.Geocoding.geosearch({
            position: 'topright',
            placeholder: 'Enter an address or place e.g. 1 York St',
            useMapBounds: false,
            providers: [L.esri.Geocoding.arcgisOnlineProvider({
            apikey: 'AAPKd6a06d2c8c554d78805498d2886e3420s_yUJw1NPIVVKGIGKJ3qqjW-6Z41MBZTN-pUAkfk6G8kjnuVo4fh-xrCK_NzORfy',
            nearby: {
                lat: -33.8688,
                lng: 151.2093
            }
            })]
            }).addTo(map);
             var results = L.layerGroup().addTo(map);

        searchControl.on('results', function (data) {
            results.clearLayers();
            for (var i = data.results.length - 1; i >= 0; i--) {
            results.addLayer(L.marker(data.results[i].latlng));
            }
        });

    L.marker(position).addTo(map)
        .bindPopup(`<img src="https://chefjob.vn/wp-content/uploads/2020/04/homestay-duoc-nhieu-du-khach-lua-chon.jpg" alt="nha hang an cần" width="100px" height="100px">`)
        .openPopup();


        L.marker([21.003141127574143, 105.84323143972144]).addTo(map)
        .bindPopup(`<span>Đại học Xây Dựng Hà Nội</span>`)
        .openPopup();
    

    // [21.009516, 105.839284]


    $('#search').click(function(e){
        let lat = parseFloat($('#lat').val());
        let long = parseFloat($('#long').val());
        console.log(lat,long);
        L.marker([lat, long]).addTo(map)
        .bindPopup(`<img src="https://chefjob.vn/wp-content/uploads/2020/04/homestay-duoc-nhieu-du-khach-lua-chon.jpg" alt="nha hang an cần" width="100px" height="100px">`)
        .openPopup();
    
    })

    map.on('click', function(e) {
        $('#lat_add').val(e.latlng.lat);
        $('#long_add').val(e.latlng.lng);
            L.popup().setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);
    });
  

});

