@extends('layouts.admin')

@section('title','Post Homestay-Resort')

@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> --}}

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
        
@endsection

@section('map')
    <script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js"
        integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ=="
        crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js"
        integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w=="
        crossorigin=""></script>
@endsection

@section('content')

    <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{$data->name}}</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.manager.post.list') }}">Quản lý bài đăng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Homestay-Resort</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form"  id='form-post' enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div  class="col-12">
                                                <div class="form-group ">
                                                    <label for="name">Tên Homestay-Resort</label>
                                                    <input type="text" id="name" class="form-control " placeholder="Name Homestay-Resort" value="{{ $data->name }}" name="name">
                                                    <span class="text-danger error-text name_err"></span>
                                                  
                                                </div>
                                                   <div class="form-group ">
                                                    <label for="first-name-column">Loại hình</label>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1" value="0" {{$data->type == 0 ? 'checked':''}}>
                                                                    <label class="form-check-label" for="type1">
                                                                        Homestay
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2" value="1" {{$data->type == 1 ? 'checked':''}} >
                                                                    <label class="form-check-label" for="type2">
                                                                    Resort
                                                                    </label>
                                                                </div>
                                                            </div>
        
                                                        </div>  
                                                </div>
                            
                                                <div class="divider">
                                                    <div class="divider-text"> <h4>Thông tin địa chỉ</h4></div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="location">Tỉnh/Thành phố</label>
                                                    <select class="form-control" id="location" name='id_location'>
                                                        <option value="">--- Chọn Tỉnh/Thành ---</option>
                                                        @forelse ($locations as $item)
                                                            <option value="{{ $item->id }}" {{ $data->location->id == $item->id? 'selected':'' }}>{{ $item->province }}</option>
                                                        @empty
                                                            <option value="">--- No data ---</option>                                                          
                                                        @endforelse
                                                    </select>

                                                    <span class="text-danger error-text id_location_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Đường</label>
                                                    <input type="text" id="streets" class="form-control" placeholder="Street" name="streets" value="{{$data->streets}}">
                                                    <span class="text-danger error-text streets_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Quận/Phường/Huyện</label>
                                                    <input type="text" id="district" class="form-control" placeholder="District" name="district" value="{{$data->district}}">
                                                    <span class="text-danger error-text district_err"></span>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="first-name-column">Địa chỉ</label>
                                                    <input type="text" id="address" class="form-control" placeholder="Address" name="address" value="{{$data->address}}">
                                                    <span class="text-danger error-text address_err"></span>
                                                </div>

                                                 <div class="divider">
                                                    <div class="divider-text"><h4>Thông tin liên hệ</h4></div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input type="text" id="phone" class="form-control" placeholder="Phone number" name="phone" value="{{$data->phone}}">
                                                    <span class="text-danger error-text phone_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{$data->email}}">
                                                    <span class="text-danger error-text email_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="link">URL Trang web</label>
                                                    <input type="text" id="link" class="form-control" placeholder="URL Web" name="link" value="{{$data->link}}">
                                                    <span class="text-danger error-text link_err"></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Bản đồ</label>
                                                     <div  id="map" style="height: 375px; width: 100%;"></div> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="lat_add">Vĩ độ</label>
                                                            <input type="text" id="lat_add" class="form-control" placeholder="Latitude" name="latitude" value="{{$data->latitude}}">
                                                            <span class="text-danger error-text latitude_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="long_add">Kinh độ</label>
                                                            <input type="text" id="long_add" class="form-control" placeholder="Longtitude" name="longtitude" value="{{$data->longtitude}}">
                                                            <span class="text-danger error-text longtitude_err"></span>
                                                        </div>
                                                    </div>

                                                    <div class="divider">
                                                        <div class="divider-text"> <h4>Khác</h4></div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ mở cửa</label>
                                                            <input type="time" id="open" class="form-control" placeholder="Open time" name="open" value="{{str_replace('h', ':', $data->open)}}">
                                                            <span class="text-danger error-text open_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ đóng cửa</label>
                                                            <input type="time" id="closes" class="form-control" placeholder="Close time" name="closes"value="{{str_replace('h', ':', $data->closes)}}">
                                                            <span class="text-danger error-text closes_err"></span>
                                                        </div>
                                                    </div>

                                                       <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối thiểu</label>
                                                            <input type="number" id="min_guest" class="form-control" placeholder="Min guest" name="min_guest"  value="{{$data->min_guest}}">
                                                            <span class="text-danger error-text min_guest_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối đa</label>
                                                            <input type="number" id="max_guest" class="form-control" placeholder="Max guest" name="max_guest" value="{{$data->max_guest}}">
                                                            <span class="text-danger error-text max_guest_err"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="first-name-column">Giới thiệu</label>
                                                <textarea class="form-control" id="introduce" rows="4" name="introduce">{{$data->introduce}}</textarea>  
                                                <span class="text-danger error-text introduce_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                  
                                  
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                            <div class="divider">
                                                <div class="divider-text"> <h4>Tiện ích và loại phòng</h4></div>
                                            </div>
                                    </div>
                               
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#list-amenity">
                                       Chọn các tiện ích
                                    </button>
                                    <div class="row mt-4" id="select-amenity">
                                         @forelse ($data->amenity as $item)
                                            <div class="col-3">
                                                <input type='checkbox' class="form-check-input me-2" name="amenity[]" value="{{$item->id}}"  checked>{{$item->name}}
                                            </div>
                                        @empty
                                            <span>Không có dữ liệu</span>
                                        @endforelse
                                        <div class="row mt-4" id="edit-amenity">

                                        </div>
                                    </div>
                                    <span class="text-danger error-text amenity_err"></span>

                                    <hr>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#list-roomtype">
                                       Chọn các loại phòng
                                    </button>
                                    <div class="row mt-4" id="select-roomtype">
                                        @forelse ($data->roomtype as $item)
                                            <div class="col-3">
                                                <input type='checkbox' class="form-check-input me-2" name='roomtype[]' value="{{$item->id}}"  checked>{{$item->name}}
                                            </div>
                                        @empty
                                            <span>Không có dữ liệu</span>
                                        @endforelse
                                    </div>
                                    <div class="row mt-4" id="edit-roomtype">

                                    </div>
                                    <span class="text-danger error-text roomtype_err"></span>

                                    <div class="col-12 mb-2">
                                            <div class="divider">
                                                <div class="divider-text"> <h4>Ảnh</h4></div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="first-name-column">Ảnh đại diện</label>
                                    
                                            <input class="form-control" type="file" name='img_avatar' id="avatar"  oninput="pic1.src=window.URL.createObjectURL(this.files[0])" >
                                       
                                             <img id="pic1" src='{{$data->img_avatar}}' alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                                        </div>
                                        <span class="text-danger error-text img_avatar_err"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="wall">Ảnh nền</label>
                         
                                            <input class="form-control" type="file" name='img_wall' id="wall"  oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
  
                                            <img id="pic2" src='{{$data->img_wall}}' alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
             
                                        </div>
                                        <span class="text-danger error-text img_wall_err"></span>
                                    </div>

                                    <div class="col-12 mb-2">
                                            <div class="divider">
                                                <div class="divider-text"> <h4>Ảnh khác</h4></div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="first-name-column">Ảnh về Homestay-Resort</label>
                                            {{-- <input type="file" class="form-control" id="photo" name='photo[]' multiple accept="image/jpg,image/png,image/jpeg,image/gif" />
                                            <div class="row" id="show-image"> --}}

                                                <div class="row">
                                                    @forelse ($data->photo as $item)
                                                        <div class="col-md-4 pt-2 photo">
                                                            <img id="" src="{{$item->path}}" class="data-img" alt="" style="height: 200px; width:100%; object-fit:cover" class="pre-img">
                                                            <i class="bi bi-x-circle delete-photo"></i>
      
                                                        </div>
                                                    @empty
                                                        <span>Không có dữ liệu</span>
                                                    @endforelse
                                                </div>
                                                <span class="text-danger error-text photo_err"></span>

                                                <input type="file" class="image-resize-filepond mt-3"  name="photo[]" data-max-file-size="3MB" value="{{ old('photo') }}" multiple>

                                                <div id="note">

                                                </div>
                                              

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 d-flex justify-content-end pr-4">
                                    @if ($data->status == 3)
                                        <button  class="btn btn-primary me-1 mb-1" id='btn-post'>Đăng bài</button>
                                    @endif
                                    <button  class="btn btn-light-secondary me-1 mb-1" id="btn-save-post">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
</div>



<div class="modal fade" id="list-amenity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chọn tiện ích</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div id="data-amenity">

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="list-roomtype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chọn loại phòng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div id="data-roomtype">

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>

   

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="{{ asset('dashboard/js/uploadfile.js') }}"></script>
    
    <script>
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
        
        
            let lat = '{{$data->latitude}}';
            let long = '{{$data->longtitude}}';
            
            map.setView([lat,long],15);
        
            L.marker([lat,long]).addTo(map)
                .bindPopup(`<div class='maker-post'>
                                <span>{{$data->name}}</span>
                            </div>`)
                .openPopup();
            
            map.on('click', function(e) {
                $('#lat_add').val(e.latlng.lat);
                $('#long_add').val(e.latlng.lng);
                    L.popup().setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(map);
            });
    

            // [21.009516, 105.839284]
        

    </script>

    <script>

        
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            });

        $(document).ready(function(){
            loadAmenity();
            loadRoomtype();

            
        })
        
        function loadAmenity(){
            arr =[];
            $.ajax({
                url: "{{ route('admin.post.list.amenity') }}",
                type: "get",
                success: function(result){
                    $('#data-amenity').html(result);
                                    
                    $('.select').click(function(){
                        if($(this).is(':checked')){
                            id = $(this).data('id');
                            name = $(this).data('name');
                            obj = {
                                'id': id,
                                'name': name,
                            }
                            arr.push(obj);
                             arrHtml(arr,'amenity');
                        
                        }else{
                            arr.forEach((e,index) => {
                                if(e.id == $(this).data('id')){
                                    arr.splice(index,1);
                            
                                }
                            })
            
                             arrHtml(arr,'amenity');
                        }
                    });
                    
                    // actionTr();
                }
            })
        }


        function loadRoomtype(){
           
            let arr =[];
            $.ajax({
                url: "{{ route('admin.post.list.roomtype') }}",
                type: "get",
                success: function(result){
                    $('#data-roomtype').html(result);
                                    
                    $('.select-roomtype').click(function(){
                        if($(this).is(':checked')){
                            id = $(this).data('id');
                            name = $(this).data('name');
                            obj = {
                                'id': id,
                                'name': name,
                            }
                    
                            arr.push(obj);

                            console.log(arr);
                            arrHtml(arr,'roomtype');
                        
                        }else{
                            arr.forEach((e,index) => {
                                if(e.id == $(this).data('id')){
                                    arr.splice(index,1);
                            
                                }
                            })

            
                            arrHtml(arr,'roomtype');
                        }
                    });
                    
                    // actionTr();
                }
            })
        }


        function arrHtml(arr,string){
            let html = '';
        
            arr.forEach(i =>{
                html += `<div class="col-3">
                            <input type='checkbox' class="form-check-input me-2" name='${string}[]' value=${i.id} checked>${i.name}
                            </div>`;
            })
                let select = '#edit-'+ string;            
                $(select).html(html);
         
            
        }
        var arrDelete=[];
        $('.delete-photo').click(function(){
            $(this).closest('.photo').hide();
            src= $(this).closest('.photo').find('.data-img').attr('src');
            arrDelete.push(src);
  
        })

        var err;
        $('#btn-post').click(function(e){
           
            e.preventDefault();
            let form = $('#form-post');
            var data = new FormData(form[0]);
            data.append('status',0);
            $('#load').removeClass('d-none');
            $.ajax({
                url: "{{ route('admin.manager.post.edit.update') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    $('#load').addClass('d-none');
                    console.log(result);
                    if(result.status){
                        Toast.fire({
                        icon: 'success',
                        title: 'Đã lưu thay đổi'
                        })
                        location.reload();
                    }else{
                        printErrorMsg(result.error)
                    }
            
                
                },
                error: function(e){
                    $('#load').addClass('d-none');
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            });
         
        })

        $('#btn-save-post').click(function(e){
           
            e.preventDefault();
            let form = $('#form-post');
            var data = new FormData(form[0]);
            data.append('arrDelete',arrDelete);
            $('#load').removeClass('d-none');
            $.ajax({
                url: "{{ route('admin.manager.post.edit.update') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    $('#load').addClass('d-none');

                    console.log(result);
                    if(result.status){
                        Toast.fire({
                        icon: 'success',
                        title: 'Đăng bài thành công'
                        })
                        location.reload();
                    }else{
                        printErrorMsg(result.error)
                    }
                
                },
                error: function(e){
                    $('#load').addClass('d-none');
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            });
         
        })


        function printErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text(value);     
            });
            let e = Object.keys(msg)[0]+'_err';
            let top= $('.'+e).offset().top;
         
            $(window).scrollTop(top-200);
        
        }
        
        function removeErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text('');
            });
        
        }


        
    </script>
    
@endsection