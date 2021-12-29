@extends('layouts.main')
@section('title','Chuyến đi')

@section('head')
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/search2.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js"
        integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ=="
        crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js"
        integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w=="
        crossorigin=""></script>  

     <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">


    <style>
        .full,.half{
            font-size: 12px;
        }

        .card-size {
            height: 320px;

        }
        .heart-travel-empty{
            background-color: #fcc;
            width: 54px;
            height: 54px;
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .heart-travel-empty i{
             font-size: 25px;
             color: #ff5d5d;
        }
        .dropdown-menu-right button{
            font-size: 14px;
        }
        
  
        
    </style>
   
@endsection

@section('content')
     <div class="heading-page header-text" style="padding-top: 70px">
     
    </div>
  

    <section class="blog-posts shadow">
        <div class="container-travel">
            <div class="info-travel col-md-4">
                @include('web.travel.list-post-travel')
            </div>
             <div class="container-map" >
                <div  id="map" style="height: 100vh; width: 100%;"></div> 
            </div>
        </div>
    </section>



<!-- Modal -->
<div class="modal fade" id="modal-edit-travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-heart-o" aria-hidden="true"></i> Chỉnh sửa chuyến đi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-edit-travel">
            @csrf
            <input type="hidden" name="id" value="{{$travel->id}}">
            <div class="modal-body">
                    @if (count($posts) != 0)
                        <img src="{{$posts->first()->img_avatar}}" style="width:100%; height:200px;object-fit:cover;" class="mb-2" alt="">
                    @else
                        <img src="https://www.keycdn.com/img/support/image-processing.png" style="width:100%; height:200px;object-fit:cover;" class="mb-2" alt="">
                    @endif
                    <div class="form-group">
                        <label for="title">Tên chuyến đi</label>
                        <input type="text" class="form-control" name="title" id="title"  value="{{$travel->title}}">
                        <span class="text-danger error-text title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea">Ghi chú</label>
                        <textarea class="form-control" id="note" rows="4" name='note' spellcheck="false">{{$travel->note}}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save-travel">Lưu</button>
            </div>
        </form>
    </div>
  </div>
</div>


@endsection

@section('script')
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
       
      const diadiem ={
          lat: 21.015531,
          long: 105.823979,
       };

      var position = [diadiem.lat, diadiem.long];
        var map = L.map('map');


      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

   
      var searchControl = L.esri.Geocoding.geosearch({
            position: 'topright',
            placeholder: 'Nhập tên địa chỉ hoặc đường phố',
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
       
        function loadMap(data){
            $(".leaflet-marker-icon").remove();
            $(".leaflet-popup").remove();
            let list_post;
            if(data.length == 0){
                list_post = {!! json_encode($posts) !!};
            }else{
                list_post = data;
            }

            console.log(list_post);

            if(list_post.length != 0){
                map.setView([list_post[0].latitude,list_post[0].longtitude],11);
                list_post.map( post => {
                    L.marker([post.latitude,post.longtitude]).addTo(map)
                        .bindPopup(`<div class='maker-post'>
                                        <span>${post.name}</span>
                                    </div>`)
                        .openPopup();
                });
            }else{
                map.setView([diadiem.lat,diadiem.long],11);
            }
        }

        //   L.marker([diadiem.lat,diadiem.long]).addTo(map)
        //   .bindPopup(`<span>Moi</span>`)
        //   .openPopup();

        // [21.009516, 105.839284]
      


      map.on('click', function(e) {
          $('#lat_add').val(e.latlng.lat);
          $('#long_add').val(e.latlng.lng);
              L.popup().setLatLng(e.latlng)
              .setContent("You clicked the map at " + e.latlng.toString())
              .openOn(map);
      });
      
 

    </script>
    <script>
    
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $(document).ready(function(){
            
            let data =[];
            
            loadMap(data);
            changeStatus();
            hoverPost();
            removePost();
            searchPost();
            deleteTravel();
           
        });


        function searchPost(){
            $('#search').keyup(function(){
                search = $(this).val();
            
                $.ajax({
                    url: "{{route('travel.search')}}",
                    type: "GET",
                    data:  {
                        'search': search,
                    },
                    success: function(result){
                        // console.log(result.data);
                        let arr=[];
                        result.data.forEach(i => {
                            let obj = {
                                label: `${i.name}, ${i.address}, ${i.district}, ${i.location.province}`,
                                value: `${i.name}, ${i.address}, ${i.district}, ${i.location.province}`,
                                lat: i.latitude,
                                long: i.longtitude,
                                id_post: i.id,
                            }
                            arr.push(obj);
                        })
                        // console.log(arr);
                        $('#search').autocomplete({
                            source : arr,
                            appendTo: "#result-search",
                            minLength: 0,
                            select: function(event,ui){
                                id_travel = parseInt("{{$travel->id}}");
                                if(result.status){
                                    map.setView([ui.item.lat,ui.item.long],15);
                                    L.marker([ui.item.lat,ui.item.long]).addTo(map)
                                    .bindPopup(`<div class='maker-post'>
                                                    <span>${ui.item.label}</span>
                                                    <button onclick="addPost(${id_travel},${ui.item.id_post})">Thêm</button>
                                                </div>`)
                                    .openPopup();
                                }else{
                                    console.log(result);
                                }
                            }
                        });
                        
                        
                    }
                })
            })
        }

    
        
        function loadPage(){
            let slug = '{{ Str::slug($travel->title)}}';
            $.ajax({
                url: "{{route('travel.info',['slug' => Str::slug($travel->title),'id' => $travel->id])}}",
                type: "GET",
                success: function(result){
                    $('.info-travel').html(result);
                    changeStatus();
                    hoverPost();
                    searchPost();
                    removePost();
                }
            })

          
        }

    
        $("#title").keyup(function() {
            if($(this).val() == ''){
               
                $('#btn-save-travel').attr('disabled', true);;
         
            }else{
                $('#btn-save-travel').attr('disabled', false);
            }
        });

         
        function changeStatus(){

            $('.btn-change-status').click(function(){
                let id = '{{$travel->id}}';
                let status = $(this).data('status');
                let click_change = $(this);
                $.ajax({
                    url: "{{route('travel.status')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "status" : status
                    },
                    success: function(result){
                        if(result.status){
                            loadPage();
                            Toast.fire({
                                icon: 'success',
                                title: 'Đã thay đổi trạng thái'
                            })
                        }else{
                            console.log(result.mess)
                        }
                        
                    }
                })
            });
        }

        var err;
        $('#btn-save-travel').click(function(e){
            e.preventDefault();
            let form = $('#form-edit-travel');
            let data = new FormData(form[0]);
            
            $.ajax({
                url: "{{route('travel.update')}}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(err != null){
                        removeErrorMsg(err);     
                    }      
                    if(result.status){
                        $('#modal-edit-travel').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Sửa thông tin thành công'
                        })
                        loadPage();
                    }else{
                        console.log(result.mess)
                    }
                   
                },
                error: function(e){
                    console.log(e);
                    removeErrorMsg(err);
                    printErrorMsg(e.responseJSON.errors);
                }

            })
        })

        function hoverPost(){
            $('.hover-post').hover(function(){
                let lat = $(this).data('lat');
                let long = $(this).data('long');
                let name  = $(this).find('.name-post').text();
                map.setView([lat,long],12,{
                    "animate": true,
                });
                 L.marker([lat,long]).addTo(map)
                .bindPopup(`<span>${name}</span>`)
                .openPopup();
               
            })
        }
        
        function removePost(){
            $('.remove-post').click(function(){
                let id_post = $(this).data('id-post');
                let id_travel = $(this).data('id-travel');
               
                Swal.fire({
                    title: 'Bạn có muốn xoá?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            url: "{{route('travel.remove.post')}}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id_post": id_post,
                                "id_travel" : id_travel,
                            },
                            success: function(result){
                                if(result.status){
                                    loadPage();
                                    loadMap(result.data);
                                    Swal.fire(
                                    'Đã được xoá',
                                    '',
                                    'success'
                                    )
                                }else{
                                    console.log(result.mess);
                                }
                            }
                        })

                    }
                })
            })

        }

        function deleteTravel(){
             $('.delete-travel').click(function(){
              
                let id_travel = $(this).data('id-travel');
               
                Swal.fire({
                    title: 'Bạn có muốn xoá chuyến đi?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            url: "{{route('travel.remove')}}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id_travel" : id_travel,
                            },
                            success: function(result){
                                if(result.status){
                                    window.location.href = "{{route('travel')}}";
                                }else{
                                    console.log(result.mes)
                                }
                            }
                        })

                    }
                })
            })
        }

        function addPost(id_travel,id_post){
            $.ajax({
                url: "{{route('travel.add.post')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_post": parseInt(id_post),
                    "id_travel" : parseInt(id_travel),
                },
                success: function(result){
                    if(result.status){
                        let data = [];
                        loadPage();
                        loadMap(data);
                        Toast.fire({
                            icon: 'success',
                            title: 'Đã thêm vào chuyến đi'
                        })
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: result.mess
                        })

                    }
                }
            })
        }   

        function printErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text(value);
            });
            
        
        }
        
        function removeErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text('');
            });
        
        }
    </script>

@endsection