@extends('layouts.admin')

@section('title','Post Homestay-Resort')

@section('head')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    
@endsection

@section('content')

    <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Đăng Thông tin về Homestay-Resort</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đăng bài</li>
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
                        <h4 class="card-title">Đăng bài</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div  class="col-12">
                                                <div class="form-group ">
                                                    <label for="name">Tên Homestay-Resort</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Name Homestay-Resort" name="name">
                                                </div>
                                                   <div class="form-group ">
                                                    <label for="first-name-column">Loại hình</label>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type" checked>
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Homestay
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
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
                                                    <label for="first-name-column">Tỉnh/Thành phố</label>
                                                    <input type="text" id="province" class="form-control" placeholder="Province" name="province">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Đường</label>
                                                    <input type="text" id="street" class="form-control" placeholder="Street" name="street">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="first-name-column">Quận/Phường</label>
                                                    <input type="text" id="district" class="form-control" placeholder="District" name="district">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="first-name-column">Địa chỉ</label>
                                                    <input type="text" id="address" class="form-control" placeholder="Address" name="address">
                                                </div>

                                                 <div class="divider">
                                                    <div class="divider-text"><h4>Thông tin liên hệ</h4></div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input type="text" id="phone" class="form-control" placeholder="Phone number" name="phone">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Email" name="email">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="link">URL Trang web</label>
                                                    <input type="text" id="link" class="form-control" placeholder="URL Web" name="link">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Bản đồ</label>
                                                     <div  id="map" style="height: 40vh; width: 36vw;"></div> 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Vĩ độ</label>
                                                            <input type="text" id="lat_add" class="form-control" placeholder="Lattitude" name="lattitude">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Kinh độ</label>
                                                            <input type="text" id="long_add" class="form-control" placeholder="Longtitude" name="longtitude">
                                                        </div>
                                                    </div>

                                                    <div class="divider">
                                                        <div class="divider-text"> <h4>Khác</h4></div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ mở cửa</label>
                                                            <input type="text" id="open" class="form-control" placeholder="Open time" name="open">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giờ đóng cửa</label>
                                                            <input type="text" id="closes" class="form-control" placeholder="Close time" name="closes">
                                                        </div>
                                                    </div>

                                                       <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối thiểu</label>
                                                            <input type="number" id="min_guest" class="form-control" placeholder="Min guest" name="min_guest">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Số khách tối đa</label>
                                                            <input type="number" id="max_guest" class="form-control" placeholder="Max guest" name="max_guest">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="first-name-column">Giới thiệu</label>
                                                <textarea class="form-control" id="introduce" rows="4" name="introduce"></textarea>  
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
                                    {{-- <i class="btn btn-primary" data-toggle="modal" data-target="#list-amenity">Chọn tiện ích</i> --}}
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#list-amenity">
                                       Chọn các tiện ích
                                    </button>
                                    <div class="row mt-4" id="select-amenity">
                 
                                    </div>

                                    <hr>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#list-roomtype">
                                       Chọn các loại phòng
                                    </button>
                                    <div class="row mt-4" id="select-roomtype">
                 
                                    </div>

                                    <div class="col-12 mb-2">
                                            <div class="divider">
                                                <div class="divider-text"> <h4>Ảnh</h4></div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="first-name-column">Ảnh đại diện</label>
                                            {{-- <input type="file" class="image-preview-filepond"> --}}
                                            <input class="form-control" type="file" name='avatar' id="avatar"  oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                       
                                             <img id="pic1" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="first-name-column">Ảnh nền</label>
                                            {{-- <input type="file" class="image-preview-filepond"> --}}
                                            <input class="form-control" type="file" name='wall' id="wall"  oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
  
                                            <img id="pic2" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
             
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                            <div class="divider">
                                                <div class="divider-text"> <h4>Ảnh khác</h4></div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="first-name-column">Ảnh nền</label>
                                            <input type="file" class="form-control" id="photo" name='photo[]' multiple/>
                                            <div id="show-image">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="{{ asset('main/js/map.js') }}"></script>

    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="{{ asset('dashboard/js/uploadfile.js') }}"></script>

    <script>


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
         
            let select = '#select-'+ string;            
            $(select).html(html);
        }

       function readURL(input) {
        for(var i =0; i< input.files.length; i++){
            if (input.files[i]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                var img = $('<img id="dynamic" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"><input type="text" name="note[]">');
                img.attr('src', e.target.result);
                img.appendTo('#show-image');  
                }
                reader.readAsDataURL(input.files[i]);
            }
            }
        }

        $("#photo").change(function(){
            readURL(this);
        });


        // function actionTr(){
        //     $('tr').click(function(){
        //         let input = $(this).find('input');
        //         if(input.is(':checked')){
        //             input.prop('checked', false);
        //         }else{
        //             input.prop('checked', true);
        //         }
                
        //     })
        // }
    </script>
    
@endsection