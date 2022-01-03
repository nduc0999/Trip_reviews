@extends('layouts.admin')

@section('title','Hiển thị thông tin đề xuất')

@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> --}}

        
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
                <h3>Duyệt đề xuất</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.approval.post') }}">Duyệt các đề xuất</a></li>  
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
                        <h4 class="card-title">Duyệt</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form >
  
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div  class="col-12">
                                                <div class="form-group ">
                                                    <label for="name">Tên Homestay-Resort</label>
                                                    <input type="text" id="name" class="form-control " placeholder="Name Homestay-Resort" value="{{ $data->name }}" name="name" disabled>
                                                    <span class="text-danger error-text name_err"></span>
                                                  
                                                </div>
                                                   <div class="form-group ">
                                                    <label for="first-name-column">Loại hình</label>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1" value="0" {{$data->type == 0 ? 'checked':''}} disabled>
                                                                    <label class="form-check-label" for="type1">
                                                                        Homestay
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2" value="1" {{$data->type == 1 ? 'checked':''}} disabled>
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
                                                    <label for="location">Tỉnh/Thành phố</label><br>
                                                    <input type="text" value="{{$data->location->province}}" name="" id="location" disabled>

                                                    <span class="text-danger error-text id_location_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Đường</label>
                                                    <input type="text" id="streets" class="form-control" placeholder="Street" name="streets" value="{{$data->streets}}" disabled>
                                                    <span class="text-danger error-text streets_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Quận/Phường/Huyện</label>
                                                    <input type="text" id="district" class="form-control" placeholder="District" name="district" value="{{$data->district}}" disabled>
                                                    <span class="text-danger error-text district_err"></span>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="first-name-column">Địa chỉ</label>
                                                    <input type="text" id="address" class="form-control" placeholder="Address" name="address" value="{{$data->address}}" disabled>
                                                    <span class="text-danger error-text address_err"></span>
                                                </div>

                                                 <div class="divider">
                                                    <div class="divider-text"><h4>Thông tin liên hệ</h4></div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input type="text" id="phone" class="form-control" placeholder="Phone number" name="phone" value="{{$data->phone}}" disabled >
                                                    <span class="text-danger error-text phone_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{$data->email}}" disabled>
                                                    <span class="text-danger error-text email_err"></span>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="link">URL Trang web</label>
                                                    <input type="text" id="link" class="form-control" placeholder="URL Web" name="link" value="{{$data->link}}" disabled>
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
                                                            <input type="text" id="lat_add" class="form-control" placeholder="Latitude" name="latitude" value="{{$data->latitude}}" disabled>
                                                            <span class="text-danger error-text latitude_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="long_add">Kinh độ</label>
                                                            <input type="text" id="long_add" class="form-control" placeholder="Longtitude" name="longtitude" value="{{$data->longtitude}}" disabled>
                                                            <span class="text-danger error-text longtitude_err"></span>
                                                        </div>
                                                    </div>

                                                    <div class="divider">
                                                        <div class="divider-text"> <h4>Khác</h4></div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ mở cửa</label>
                                                            <input type="text" id="open" class="form-control" placeholder="Open time" name="open"  value="{{$data->open}}" disabled>
                                                            <span class="text-danger error-text open_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ đóng cửa</label>
                                                            <input type="text" id="closes" class="form-control" placeholder="Close time" name="closes"  value="{{$data->closes}}" disabled>
                                                            <span class="text-danger error-text closes_err"></span>
                                                        </div>
                                                    </div>

                                                       <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối thiểu</label>
                                                            <input type="number" id="min_guest" class="form-control" placeholder="Min guest" name="min_guest"  value="{{$data->min_guest}}" disabled >
                                                            <span class="text-danger error-text min_guest_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối đa</label>
                                                            <input type="number" id="max_guest" class="form-control" placeholder="Max guest" name="max_guest"  value="{{$data->max_guest}}" disabled>
                                                            <span class="text-danger error-text max_guest_err"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="first-name-column">Giới thiệu</label>
                                                <textarea class="form-control" id="introduce" rows="4" name="introduce" disabled>{{$data->introduce}}</textarea>  
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
                                        Các tiện ích
                                    </button>
                                    <div class="row mt-4" id="select-amenity">
                                        @forelse ($data->amenity as $item)
                                            <div class="col-3">
                                                <input type='checkbox' class="form-check-input me-2" disabled  checked>{{$item->name}}
                                            </div>
                                        @empty
                                            <span>Không có dữ liệu</span>
                                        @endforelse
                                    </div>
                                    <span class="text-danger error-text amenity_err"></span>

                                    <hr>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#list-roomtype">
                                       Các loại phòng
                                    </button>
                                    <div class="row mt-4" id="select-roomtype">
                                        @forelse ($data->roomtype as $item)
                                            <div class="col-3">
                                                <input type='checkbox' class="form-check-input me-2" disabled  checked>{{$item->name}}
                                            </div>
                                        @empty
                                            <span>Không có dữ liệu</span>
                                        @endforelse
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

                                            
                                                <img id="pic1" src="{{$data->img_avatar}}" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                                        </div>
                                        <span class="text-danger error-text img_avatar_err"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="wall">Ảnh nền</label>
                                    
                                            <img id="pic2" src="{{$data->img_wall}}" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
             
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
                                                <div class="row">
                                                    @forelse ($data->photo as $item)
                                                        <div class="col-md-4 pt-2">
                                                             <img id="" src="{{$item->path}}" alt="" style="height: 200px; width:100%; object-fit:cover" class="pre-img">
                                                        </div>
                                                    @empty
                                                        <span>Không có dữ liệu</span>
                                                    @endforelse
                                                </div>
                                            <span class="text-danger error-text photo_err"></span>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button  class="btn btn-primary me-1 mb-1" data-status="0" id='btn-approval'>Chấp nhận</button>
                                    <button  class="btn btn-light-secondary me-1 mb-1" data-status="3" id="btn-not-approval">Không chấp nhận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
</div>


<!-- Modal -->
<div class="modal fade" id="modal-show-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$data->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="show-img" src="" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
      </div>
      
    </div>
  </div>
</div>


@endsection

@section('script')
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    {{-- <script src="{{ asset('main/js/map.js') }}"></script> --}}

    <!-- filepond validation -->

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
            
            map.setView([lat,long],11);
          
            L.marker([lat,long]).addTo(map)
                .bindPopup(`<div class='maker-post'>
                                <span>{{$data->name}}</span>
                            </div>`)
                .openPopup();
        


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
        

            
        })
        
        $('.pre-img').click(function(){
            let src = $(this).attr('src');
            $('#modal-show-img').modal('show');
            $('#show-img').attr("src",src);
        })

   
        $('#btn-approval').click(function(e){
            e.preventDefault();
            let status = $(this).data('status');
            let id = "{{$data->id}}";
            $('#load').removeClass('d-none');
            $.ajax({
                url: "{{ route('admin.manager.post.status.update') }}",
                type: "POST",   
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    'status': status,
                },
                success: function(result){
                 
                    $('#load').addClass('d-none');
         
                    Toast.fire({
                    icon: 'success',
                    title: 'Đã duyệt thành công',
                    })
                    window.location.href = "{{route('admin.approval.post')}}";

                },
                error: function(e){
                    $('#load').addClass('d-none');
                   
                }
            });
         
        })

         $('#btn-not-approval').click(function(e){
           
            e.preventDefault();
             let status = $(this).data('status');
            let id = "{{$data->id}}";
            $('#load').removeClass('d-none');
            $.ajax({
                url: "{{ route('admin.manager.post.status.update') }}",
                type: "POST",   
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    'status': status,
                },
                success: function(result){
                  
                    $('#load').addClass('d-none');
             
                    Toast.fire({
                    icon: 'success',
                    title: 'Đã lưu trạng thái nháp'
                    })
                    window.location.href = "{{route('admin.approval.post')}}";
            
                
                },
                error: function(e){
                    $('#load').addClass('d-none');
                
                }
            });
         
        })

    


    </script>
    
@endsection