@extends('layouts.main')

@section('title', "Đề xuất" )

@section('head')

    <link rel="stylesheet" href="{{ asset('main/css/loading2.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/search2.css') }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
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

@endsection

@section('content')
    <div class="loading d-none" id="loading">
      <div class="loader"></div>
    </div>
    <div class="heading-page header-text">
        <div class="container ">
            
        </div>
      
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('main/images/propose.svg') }}" style="width:100%" alt="">
                        </div>
                        <div class="col-12">
                            <h5>Quý vị có phải là chủ sở hữu, nhân viên hoặc đại diện chính thức của địa điểm này</h5>
                            <div class="section mt-2">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <input class="checkbox-tools" type="radio" name="owner" id="tool-1" value="1" >
                                        <label class="for-checkbox-tools" for="tool-1">
                                            Có
                                        </label>
                                        <input class="checkbox-tools" type="radio" name="owner" id="tool-2" value="0">
                                        <label class="for-checkbox-tools" for="tool-2">
                                            Không
                                        </label>
                                        
                                    </div>
                                </div>
                                <span class="text-danger error-text owner_err "></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <span>Bạn có thể tìm kiếm bên dưới để kiểm tra Homestay- Resort đã tồn tại hay chưa:</span>
                            <div class="col-12 p-0 mt-3">
                                <form action="" class="search-bar d-flex">
                                    @csrf
                                    <input type="search" name="search" >
                                    <button class="search-btn" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="card mt-4 d-none" id='show-result'>
                                <h5 class="card-header">Kết quả tìm kiếm</h5>
                                <div class="card-body">
                                    <div class="result-search">
                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="row match-height">
                        <div class="col-12">
                            <h3>Đề xuất Homestay - Resort</h3>
                            <h3>Làm thế nào chúng tôi có thể tìm thấy địa điểm này?</h3>
                        </div>
                        <div class="col-12">
                            <div class="card">
                              
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form"  id='form-post' enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="row">
                                                        <div  class="col-12">
                                                            <div class="form-group ">
                                                                <label for="name">Tên Homestay-Resort</label>
                                                                <input type="text" id="name" class="form-control " placeholder="Name Homestay-Resort" value="{{ old('name') }}" name="name">
                                                                <span class="text-danger error-text name_err"></span>
                                                            
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="first-name-column">Loại hình</label>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="type1" name="type" class="custom-control-input" value="0"  checked="">
                                                                                <label class="custom-control-label" for="type1">Homestay</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="type2" name="type" class="custom-control-input" value="1">
                                                                                <label class="custom-control-label" for="type2">Resort</label>
                                                                            </div>
                                                                        </div>
                    
                                                                    </div>  
                                                            </div>
                                        
                                                            <div class="mb-4 mt-4">
                                                                <hr data-content="Thông tin địa chỉ" class="hr-text">
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="location">Tỉnh/Thành phố</label>
                                                                <select class="form-control" id="location" name='id_location'>
                                                                    <option value="">--- Chọn Tỉnh/Thành ---</option>
                                                                    @forelse ($locations as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->province }}</option>
                                                                    @empty
                                                                        <option value="">--- No data ---</option>                                                          
                                                                    @endforelse
                                                                </select>

                                                                <span class="text-danger error-text id_location_err"></span>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="first-name-column">Đường</label>
                                                                <input type="text" id="streets" class="form-control" placeholder="Street" name="streets">
                                                                <span class="text-danger error-text streets_err"></span>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="first-name-column">Quận/Phường/Huyện</label>
                                                                <input type="text" id="district" class="form-control" placeholder="District" name="district">
                                                                <span class="text-danger error-text district_err"></span>
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label for="first-name-column">Địa chỉ</label>
                                                                <input type="text" id="address" class="form-control" placeholder="Address" name="address">
                                                                <span class="text-danger error-text address_err"></span>
                                                            </div>

                                                              <div class="mb-4 mt-4">
                                                                <hr data-content="Thông tin liên hệ" class="hr-text">
                                                            </div>

                                                            <div class="form-group ">
                                                                <label for="phone">Số điện thoại</label>
                                                                <input type="text" id="phone" class="form-control" placeholder="Phone number" name="phone">
                                                                <span class="text-danger error-text phone_err"></span>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="email">Email</label>
                                                                <input type="email" id="email" class="form-control" placeholder="Email" name="email">
                                                                <span class="text-danger error-text email_err"></span>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="link">URL Trang web</label>
                                                                <input type="text" id="link" class="form-control" placeholder="URL Web" name="link">
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
                                                                <div  id="map" style="height: 375px; width: 100%;z-index:1;"></div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="lat_add">Vĩ độ</label>
                                                                        <input type="text" id="lat_add" class="form-control" placeholder="Latitude" name="latitude">
                                                                        <span class="text-danger error-text latitude_err"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="long_add">Kinh độ</label>
                                                                        <input type="text" id="long_add" class="form-control" placeholder="Longtitude" name="longtitude">
                                                                        <span class="text-danger error-text longtitude_err"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="mb-4 mt-4">
                                                                        <hr data-content="Khác" class="hr-text">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="first-name-column">Giờ mở cửa</label>
                                                                        <input type="time" id="open" class="form-control" placeholder="Open time" name="open">
                                                                        <span class="text-danger error-text open_err"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="first-name-column">Giờ đóng cửa</label>
                                                                        <input type="time" id="closes" class="form-control" placeholder="Close time" name="closes">
                                                                        <span class="text-danger error-text closes_err"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="first-name-column">Số khách tối thiểu</label>
                                                                        <input type="number" id="min_guest" class="form-control" placeholder="Min guest" name="min_guest">
                                                                        <span class="text-danger error-text min_guest_err"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="first-name-column">Số khách tối đa</label>
                                                                        <input type="number" id="max_guest" class="form-control" placeholder="Max guest" name="max_guest">
                                                                        <span class="text-danger error-text max_guest_err"></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <label for="first-name-column">Giới thiệu</label>
                                                            <textarea class="form-control" id="introduce" rows="5" name="introduce"></textarea>  
                                                            <span class="text-danger error-text introduce_err"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-4 mt-4">
                                                        <hr data-content="Tiện ích loại phòng" class="hr-text">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    {{-- <i class="btn btn-primary" data-toggle="modal" data-target="#list-amenity">Chọn tiện ích</i> --}}
                                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#list-amenity">
                                                        Chọn các tiện ích
                                                    </button>
                                                    <div class="row mt-4" id="select-amenity">
                                
                                                    </div>
                                                    <span class="text-danger error-text amenity_err"></span>
                                                    <hr>
                                                </div>

                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#list-roomtype">
                                                        Chọn các loại phòng
                                                    </button>
                                                    <div class="row mt-4" id="select-roomtype">
                                
                                                    </div>
                                                    <span class="text-danger error-text roomtype_err"></span>
                                                </div>


                                                <div class="col-12 mb-2">
                                                    <div class="mb-4 mt-4">
                                                        <hr data-content="Ảnh" class="hr-text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label for="first-name-column">Ảnh đại diện</label>
                                                        {{-- <input type="file" class="image-preview-filepond"> --}}
                                                        
                                                         <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name='img_avatar' id="avatar"  oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                                        </div>
                                                
                                                        <img id="pic1" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                                                    </div>
                                                    <span class="text-danger error-text img_avatar_err"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label for="wall">Ảnh nền</label>
                                                        {{-- <input type="file" class="image-preview-filepond"> --}}
                                                       
                                                        <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name='img_wall' id="wall"  oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                                                            <label class="custom-file-label" for="wall">Choose file</label>
                                                        </div>
            
                                                        <img id="pic2" alt="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">

                                                                            
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

                                                            <input type="file" class="image-resize-filepond"  name="photo[]" data-max-file-size="3MB" value="{{ old('photo') }}" multiple>

                                                            <div id="note">

                                                            </div>
                                                            <span class="text-danger error-text photo_err"></span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button  class="btn btn-primary me-1 mb-1" id='btn-post'>Đề xuất</button>
                                           
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <div class="modal fade" id="list-amenity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chọn tiện ích</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="data-amenity">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="list-roomtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chọn loại phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="data-roomtype">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

   

@endsection

@section('script')
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
    <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>
   

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="{{ asset('dashboard/js/uploadfile.js') }}"></script>
    <script>

        function searchToggle(obj, evt){
            var container = $(obj).closest('.search-wrapper');
                if(!container.hasClass('active')){
                    container.addClass('active');
                    evt.preventDefault();
                }
                else if(container.hasClass('active') && $(obj).closest('.input-holder').length == 0){
                    container.removeClass('active');
                    // clear input
                    container.find('.search-input').val('');
                }
        }
         $(document).ready(function(){
            loadAmenity();
            loadRoomtype();

            
        })
        
        function loadAmenity(){
            arr =[];
            $.ajax({
                url: "{{ route('post.list.amenity') }}",
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
                url: "{{ route('post.list.roomtype') }}",
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
              
                html += `<div class='col-3'>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input " id='${i.id}' name='${string}[]' value=${i.id} checked>
                                <label class="custom-control-label" for="${i.id}">${i.name}</label>
                            </div>
                        </div>`
            })
         
            let select = '#select-'+ string;            
            $(select).html(html);
        }

        var err;
        $('#btn-post').click(function(e){
           
            e.preventDefault();
            let form = $('#form-post');
            var data = new FormData(form[0]);
            let owner = $("input[name='owner']:checked").val();
            data.append('owner',owner);
            $('#loading').removeClass('d-none');
            $.ajax({
                url: "{{ route('post.propose.store') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    
                    $('#loading').addClass('d-none');
                    if(result.status){
                        window.location.href = "{{route('post.propose.success')}}";
                    }
                  
         
            
                
                },
                error: function(e){
                    $('#loading').addClass('d-none');
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

        $('.search-bar').submit(function(e){
            e.preventDefault();
            let form = $(this);
            var data = new FormData(form[0]);
            let html = '';
            $.ajax({
                url: "{{ route('post.search') }}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(result.status){
                        $('#show-result').removeClass('d-none');
                        if(result.data.length != 0){
                            result.data.forEach(i => {
                                html+=`<span>${i.name}, ${i.address},  ${i.district}, ${i.location.province}</span><hr>`
                            })    
                        }else{
                             html=`<span>Không tìm thấy thông tin</span><hr>`
                        }
                        $('.result-search').html(html);
                    }
                  
                },
                error: function(e){
                    console.log(e);
                }

            })
        })

    </script>
@endsection