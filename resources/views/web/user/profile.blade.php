@extends('layouts.main')
@section('title','Hồ sơ')

@section('head')

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@1.8.3/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('main/css/loading2.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/search2.css') }}">
    
    <style>
        body{
            background-color: #f2f2f2;
        }
        $custom-file-text: (
            vi: "Chọn file",         
        );
        
    </style>
@endsection

@section('content')
    <div class="loading d-none" id="loading">
        <div class="loader"></div>
    </div>
     <div class="heading-page header-text">
      
    </div>
  
    <div class="main-banner header-text">
        
    </div>

    <section class="blog-posts mt-0" style="position: relative">
        {{-- <div class="container p-0"> --}}
    <div class="fade-background" style="background-image:url({{$user->img_wall != null? $user->img_wall :'https://drive.google.com/uc?id=1k4YLSor3SKwcT6v_3HcX_MCiDYkssn9V&export=media'}}); ">

    </div>
    <div class="container bootdey">
        <div class="content-page">
                <div class="profile-banner" style="background:url({{$user->img_wall != null? $user->img_wall :'https://drive.google.com/uc?id=1k4YLSor3SKwcT6v_3HcX_MCiDYkssn9V&export=media'}});">
                    <div class="col-sm-3 avatar-container">
                       
                        <img src="{{$user->img_avatar != null ? $user->img_avatar :'https://drive.google.com/uc?id=19rNpGazIMmkqoPZjoDSfZaXGUUO_dHA5&export=media'}}" class="img-circle profile-avatar" alt="User avatar">
  
                    </div>
                    @if (Auth::id() == $user->id)
                        <div class="col-sm-12 profile-actions text-right">
                            <div class="btn-group">
                                <button type="button" class="btn-edit-profile" data-toggle="modal" data-target="#modal-edit-profile">Sửa hồ sơ</button>
                        
                                <i class="fa fa-cog" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-edit-profile">Sửa hồ sơ</button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-change-avatar">Sửa ảnh đại diện</button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-change-wall">Sửa ảnh hồ sơ</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-md-3">
                            <!-- Begin user profile -->
                            <div class="text-center user-profile-2" >
                                <ul class="list-group">
                                    <li class="list-group-item" style="text-align: center;">
                                        <h4>{{$user->fullName()}}</h4>
                                        <hr>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="float-left" ><strong>Giới thiệu</strong></span>
                                        
                                    </li>
                                    <li class="list-group-item country">
                                        @if(isset($user->country))
                                            <i class="fa fa-map-marker pr-2" aria-hidden="true"></i>
                                            <span>{{$user->country}}</span>
                                        @else
                                            @if (Auth::id() == $user->id)
                                                <i class="fa fa-plus-square-o pr-2" aria-hidden="true"></i>
                                                <span class="action-edit" data-toggle="modal" data-target="#modal-edit-profile">Thêm thành phố hiện tại</span>
                                                
                                            @endif
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-calendar pr-2" aria-hidden="true"></i>
                                        <span> Đã tham gia thg {{ date('m Y', strtotime($user->created_at)) }}</span>
                                    </li>
                                    <li class="list-group-item introduce">
                                        @if(isset($user->introduce))
                                            <span>{{$user->introduce}}</span>
                                        @else
                                            @if (Auth::id() == $user->id)
                                                <i class="fa fa-plus-square-o pr-2" aria-hidden="true"></i>
                                                <span  class="action-edit" data-toggle="modal" data-target="#modal-edit-profile">Viết vài điều về bạn</span>    
                                            @endif
                                        @endif
                                    </li>
                                </ul>
                                @if (Auth::id() == $user->id)
                                    <ul class="list-group mt-3">
                                        
                                        <li class="list-group-item">
                                            <span><strong>Chia sẻ lời khuyên du lịch của bạn</strong></span>
                                            
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-camera pr-2" aria-hidden="true"></i>
                                        <span class="user-action"  data-toggle="modal" data-target="#modal-post-image">Đăng ảnh</span>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-pencil-square-o pr-2" aria-hidden="true"></i>
                                        <a href="{{route('list.post.review')}}" class="user-action"><strong>Viết đánh giá</strong></a>
                                        </li>
                                    </ul>
                                    
                                @endif
                                  
                            </div><!-- End div .box-info -->
                            <!-- Begin user profile -->
                        </div><!-- End div .col-sm-4 -->
                        
                        <div class="col-md-9">
                            <div class="widget widget-tabbed">
                                <!-- Nav tab -->
                                <ul class="nav nav-tabs nav-justified" style="background-color: transparent">
                                <li class="nav-item"><a class="nav-link active"  href="#tab-feed-activity" data-toggle="tab"></i>Bản tin hoạt động</a></li>
                                <li class="nav-item"><a class="nav-link"  href="#travel" data-toggle="tab"></i>Chuyến đi</a></li>
                                {{-- <li class="nav-item"><a class="nav-link"  href="#user-activities" data-toggle="tab"></i>Ảnh</a></li> --}}
                                {{-- <li class="nav-item"><a class="nav-link"  href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i> Message</a></li> --}}
                                </ul>
                                <!-- End nav tab -->
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    
                                 
                                    <div class="tab-pane animated active fadeInRight" id="tab-feed-activity">
                                        <div id="show-feed-activity">
                                            @include('web.user.tab-feed-activity')
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12 d-flex justify-content-center " >
                                                <div class="read-more-feed" data-type="1">
                                                    <span>
                                                        Xem tiếp
                                                        <i class="fa fa-caret-down text-white" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Tab about -->
                                    <div class="tab-pane animated fadeInRight" id="travel">
                                        <div class="user-profile-content">
                                            <div id="show-tab-travel">
                                                @include('web.user.tab-travel')
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12 d-flex justify-content-center " >
                                                    <div class="read-more-travel" >
                                                        <span>
                                                            Xem tiếp
                                                            <i class="fa fa-caret-down text-white" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End div .user-profile-content -->
                                    </div><!-- End div .tab-pane -->
                                    <!-- End Tab about -->
                                    
                                    
                                    <!-- Tab user activities -->
                                    <div class="tab-pane animated fadeInRight" id="user-activities">
                                        <div class="scroll-user-widget">
                                            <ul class="media-list">
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>John Doe</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>
                                                    <br><i>2 minutes ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>John Doe</strong> Created an photo album  <strong>"Indonesia Tourism"</strong>
                                                    <br><i>8 minutes ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Annisa</strong> Posted an article  <strong>"Yogyakarta never ending Asia"</strong>
                                                    <br><i>an hour ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Ari Rusmanto</strong> Added 3 products
                                                    <br><i>3 hours ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Hana Sartika</strong> Send you a message  <strong>"Lorem ipsum dolor..."</strong>
                                                    <br><i>12 hours ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Johnny Depp</strong> Updated his avatar
                                                    <br><i>Yesterday</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>John Doe</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>
                                                    <br><i>2 minutes ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>John Doe</strong> Created an photo album  <strong>"Indonesia Tourism"</strong>
                                                    <br><i>8 minutes ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Annisa</strong> Posted an article  <strong>"Yogyakarta never ending Asia"</strong>
                                                    <br><i>an hour ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Ari Rusmanto</strong> Added 3 products
                                                    <br><i>3 hours ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Hana Sartika</strong> Send you a message  <strong>"Lorem ipsum dolor..."</strong>
                                                    <br><i>12 hours ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                    <p><strong>Johnny Depp</strong> Updated his avatar
                                                    <br><i>Yesterday</i></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- End div .scroll-user-widget -->
                                    </div><!-- End div .tab-pane -->
                                    <!-- End Tab user activities -->
                                    
                                   
                                </div><!-- End div .tab-content -->
                            </div><!-- End div .box-info -->
                        </div>
                    </div>
                </div>	
        </div>
    </div>
    
        {{-- </div> --}}
    </section>

@if (Auth::id() == $user->id)
    <div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thông tin hồ sơ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-profile">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-sm-6  col-md-6">
                                <label for="first_name">Tên</label>
                                <input id="first_name" type="text" class="form-control " name="first_name" value="{{ $user->first_name }}" required autocomplete="firstname">
                                <span class="text-danger error-text first_name_err"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                                <label for="last_name">Họ</label>
                                <input id="last_name" type="text" class="form-control " name="last_name" value="{{ $user->last_name }}" required autocomplete="lastname">
                                <span class="text-danger error-text last_name_err"></span>
                        </div>

                    </div>

                    <div class="form-group first">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control " name="" value="{{ $user->email }}" disabled>
                        <span class="text-danger error-text email_err"></span>

                    </div>

                    <div class="form-group first">
                        <label for="date-of-birth">Ngày sinh</label>
                        <input id="date-of-birth" type="date" class="form-control " name="date-of-bỉth" value="{{ $user->date_of_birth }}" >
                        <span class="text-danger error-text date_of_birth_err"></span>

                    </div>
                    <div class="form-group last mb-4">
                        <label for="country">Nơi ở hiện tại</label>
                        <input id="country" type="text" class="form-control " name="country" value="{{ $user->country }}">
                        <span class="text-danger error-text country_err"></span>

                    </div>
                    <div class="form-group last mb-4">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        <span class="text-danger error-text phone_err"></span>

                    </div>
                    <div class="form-group">
                        <label for="introduce">Giới thiệu</label>
                        <textarea class="form-control" id="introduce" rows="3" placeholder="Viết vài điều về bạn" name="introduce">{{ $user->introduce }}</textarea>
                        <span class="text-danger error-text introduce_err"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-primary" id="btn-save-profile">Lưu</button>
            </div>
        </div>
    </div>
    </div>   


    <div class="modal fade" id="modal-change-avatar" style="z-index: 1041" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thay đổi ảnh đại diện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form-change-avatar" class="d-flex justify-content-center"  style="flex-direction: column" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="img_avatar" lang="vi" accept="image/*" oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" id='label-avatar' for="avatar">Chọn ảnh đại diện</label>
                            </div>
                            <img id="pic1" src="{{ asset('main/images/user-avatar.png') }}" alt="" class="img-fluid mt-3 ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} pre-avatar">
                        </form>
                        <span class="text-danger mt-3 error-text img_avatar_err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save-avatar">Lưu</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-change-wall" style="z-index: 1041" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thay đổi ảnh nền</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form-change-wall" class="d-flex justify-content-center"  style="flex-direction: column" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="wall" name="img_wall" lang="vi" accept="image/*" oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="avatar" id='label-wall'>Chọn ảnh nền cho hồ sơ</label>
                            </div>
                            <img id="pic2" src="{{ asset('main/images/user-wall.jpg') }}" alt="" class="img-fluid mt-3 ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} pre-wall">
                        </form>
                        <span class="text-danger mt-3 error-text img_wall_err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                
                    <button type="button" class="btn btn-primary" id="btn-save-wall">Lưu</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-post-image" style="z-index: 1041" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng ảnh</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form id="form-post-photo" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea class="form-control" id="content" name="content" rows="3"  spellcheck="false"></textarea>
                            <span class="text-danger mt-3 error-text content_err"></span>
                        </div>
                        <div>
                            <input type="file" class="image-resize-filepond" id="abc" name="photo[]" data-max-file-size="10MB"  multiple>
                            <div id="note" >
                        
                            </div>
                        </div>
                        <span class="text-danger mt-3 error-text photo_err"></span>

                    </form>
                
                    <div>
                        <h5><strong>Mẹo & hướng dẫn</strong></h5>
                        <p>Bạn có thể tải lên tối đa 10 ảnh một lúc, cần chọn hết ảnh rồi mô tả.</p>
                        <p>Chấp nhận các định dạng ảnh như .jpg .jpeg .gif và .png</p>
                        <p>Kích cỡ mỗi tệp phải nhỏ hơn 3MB</p>

                    </div>
                </div>
                <div class="modal-footer">
                
                    <button type="button" class="btn btn-primary" id="btn-post-photo">Đăng ảnh</button>
                </div>
            </div>
        </div>
    </div>
    
@endif

@endsection

@section('script')
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
       <script src="https://cdn.jsdelivr.net/npm/lightgallery@1.8.3/dist/js/lightgallery-all.min.js"></script>
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

    <script>
            $('#avatar').on('change',function(e){
                var fileName = e.target.files[0].name;
              
                $(this).next('.custom-file-label').html(fileName);
            })

             $('#wall').on('change',function(e){
                var fileName = e.target.files[0].name;
              
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
    <script>
        $(document).ready(function(){
            $("#search").focus(function() {
            $(".search-box").addClass("border-searching");
            $(".search-icon").addClass("si-rotate");
            });
            $("#search").blur(function() {
            $(".search-box").removeClass("border-searching");
            $(".search-icon").removeClass("si-rotate");
            });
            $("#search").keyup(function() {
                if($(this).val().length > 0) {
                $(".go-icon").addClass("go-in");
                }
                else {
                $(".go-icon").removeClass("go-in");
                }
            });
            $(".go-icon").click(function(){
            $(".search-form").submit();
            });

            
        });

        $(".add-heart").click(function(){
          $(this).find('i').toggleClass('d-none');
        });

    </script>

    <script>
            // register desired plugins...
        FilePond.registerPlugin(
            // validates the size of the file...
            FilePondPluginFileValidateSize,
            // validates the file type...
            FilePondPluginFileValidateType,

            // calculates & dds cropping info based on the input image dimensions and the set crop ratio...
            FilePondPluginImageCrop,
            // preview the image file type...
            FilePondPluginImagePreview,
            // filter the image file
            FilePondPluginImageFilter,
            // corrects mobile image orientation...
            FilePondPluginImageExifOrientation,
            // calculates & adds resize information...
            FilePondPluginImageResize,

            FilePondPluginFileMetadata,
        );


        
        count = 0;
            // Filepond: Image Resize
        const pond = FilePond.create(document.querySelector('.image-resize-filepond'), {
            allowImagePreview: false,
            allowImageFilter: false,
            allowImageExifOrientation: false,
            allowImageCrop: false,
            allowImageResize: true,
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            imageResizeMode: 'cover',
            imageResizeUpscale: true,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg','image/gif'],
            storeAsFile: true,
            allowFileMetadata: true,
        
            // labelIdle:`<p>Kéo và thả file ảnh của bạn</p>`,
            fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
      
                resolve(type);
            })
        });

          
        pond.on('addfile',(error,file) =>{
        
                let html='';
                pond.getFiles().forEach((e,index) => {
                    let nameClass= e.filename.replace('\.','\_');
                    html += `   <div class="row" >
                                    <div class="col-md-5">
                                        <img class="pic3 pre-photo-user" src="${window.URL.createObjectURL(e.file)}" alt="" >
                                        <span class="text-danger mt-3 error-text photo_${index}_err"></span>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label><strong>Thêm mô tả</strong></label>
                                            <textarea class="form-control" id="" rows="4" name="description['${e.filename}']" placeholder="Hãy giới thiệu cho khách du lịch về ảnh của bạn" spellcheck="false"></textarea>
                                            <span class="text-danger mt-3 error-text description_${nameClass}_err"></span>
                                            <div class="search-bar d-flex mt-2">
                                                
                                                <input type="text" placeholder='Thêm thẻ địa điểm' data-class=".${e.id}-pt" class='search'>
                                                <input type="hidden" name="post['${e.filename}']" value=''>
                                                <button class="search-btn" type="submit">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                                <span class="text-danger mt-3 error-text post_${nameClass}_err"></span>
                                            <div style="position: relative;">
                                                <div  class='${e.id}-pt result-search' style="position: absolute; background-color: white; z-index:3 " >
                                                
                                                </div> 
                                            </div>
                                          
                                            <button class="btn btn-primary btn-delete-img mt-2" data-id='${e.id}' >Xoá ảnh</button>
                                        </div>
                                    </div>
                                </div><hr>`;

                    $('#note').html(html);
                })

             
                    //   console.log(file);
                    //     let nameClass= file.filename.replace('\.','\_');
                    //     let html = `<div class="row" >
                    //                 <div class="col-5">
                    //                     <img class="pic3 pre-photo-user" src="${window.URL.createObjectURL(file.file)}" alt="" >
                    //                     <span class="text-danger mt-3 error-text photo_${index}_err"></span>
                    //                 </div>
                    //                 <div class="col-7">
                    //                     <div class="form-group">
                    //                         <label><strong>Thêm mô tả</strong></label>
                    //                         <textarea class="form-control" id="" rows="4" name="description['${file.filename}']" placeholder="Hãy giới thiệu cho khách du lịch về ảnh của bạn" spellcheck="false"></textarea>
                    //                         <span class="text-danger mt-3 error-text description_${nameClass}_err"></span>
                    //                         <div class="search-bar d-flex mt-2">
                                                
                    //                             <input type="text" placeholder='Thêm thẻ địa điểm' data-class=".${file.id}-pt" class='search'>
                    //                             <input type="hidden" name="post['${file.filename}']" value=''>
                    //                             <button class="search-btn" type="submit">
                    //                                 <i class="fa fa-search" aria-hidden="true"></i>
                    //                             </button>
                    //                         </div>
                    //                             <span class="text-danger mt-3 error-text post_${nameClass}_err"></span>
                    //                         <div style="position: relative;">
                    //                             <div  class='${file.id}-pt result-search' style="position: absolute; background-color: white; z-index:3 " >
                                                
                    //                             </div> 
                    //                         </div>
                                          
                    //                         <button class="btn btn-primary btn-delete-img mt-2" data-id='${file.id}' >Delete image</button>
                    //                     </div>
                    //                 </div>
                    //             </div><hr>`;

                    // $('#note').append(html);

                searchPost();
                $('.btn-delete-img').click(function(){
                    let id = $(this).data('id');
                    pond.removeFile(id);
                    $(this).closest('.row').html('');
                })
              
          
         })

        function searchPost(){
            $('.search').keyup(function(){
                search = $(this).val();
                let rs = $(this).data('class');
                let element= $(this);
                $.ajax({
                    url: "{{route('travel.search')}}",
                    type: "GET",
                    data:  {
                        'search': search,
                    },
                    success: function(result){
                        console.log(result.data);
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
                        element.autocomplete({
                            source : arr,
                            appendTo: rs,
                            minLength: 0,
                            select: function(event,ui){
                             
                                if(result.status){
                                    element.next('input[type=hidden]').val(ui.item.id_post);
                                }else{
                                    console.log(result);
                                }
                            }
                        });
                        
                        
                    }
                })
            })
        }
    
   
    </script>

    <script>
        $(document).ready(function() {
            let data1 = {!! json_encode($list_data) !!};
            previewPhoto(data1);
            like();
            $('.carousel').carousel({
              touch: true,
              ride: true,
              interval: false,
              wrap: false,
            });
            deleteTravel();
            deleteReview();
            deletePostPhoto();
        });
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

        function previewPhoto(data){
          
                data.forEach(e => {    
                    if(e.type == 'postPhoto'){
                        $(`#lightgallery-${e.id}-feed-activity`).lightGallery({
                            download : false,
                            width: '90vw',
                            share: false,
                            rotate : false,
                            getCaptionFromTitleOrAlt: true,
                        });
                    }
                })
        }

        $('.btn-read-more').click(function(){
            $(this).closest('.box-read-less').addClass('d-none');
            $(this).closest('.box-read-less').next('.box-read-more').removeClass('d-none');
        })
        $('.btn-read-less').click(function(){
            $(this).closest('.box-read-more').addClass('d-none');
            $(this).closest('.box-read-more').prev('.box-read-less').removeClass('d-none');
        })

        function changeIntroduce(){
            let country = $('#country').val();
            let html_country;
            if(country != ''){
                html_country = `<i class="fa fa-map-marker pr-2"></i>
                            <span style='text-transform: capitalize;' >${country}</span>`;
            }else{
                html_country = `<i class="fa fa-plus-square-o pr-2" aria-hidden="true"></i>
                            <span class="action-edit" data-toggle="modal" data-target="#modal-edit-profile">Thêm thành phố hiện tại</span>`;
            }
            $('.country').html(html_country);

            let introduce = $('#introduce').val();
            let html_introduce;
            if(introduce != ''){
                html_introduce = `<span>${introduce}</span>`;
            }else{
                html_introduce = `<i class="fa fa-plus-square-o pr-2" aria-hidden="true"></i>
                            <span  class="action-edit" data-toggle="modal" data-target="#modal-edit-profile">Viết vài điều về bạn</span>`
            }
                $('.introduce').html(html_introduce);
        }

        var err;
        $('#btn-save-profile').click(function(){
            let form = $('#form-edit-profile');
            let data = new FormData(form[0]);
            
            $.ajax({
                url: "{{ route('profile.update') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    console.log(result);
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    if(result.status){
                        Toast.fire({
                            icon: 'success',
                            title: 'Cập nhật hồ sơ thành công'
                        })
                        changeIntroduce();
                        $('#modal-edit-profile').modal('hide');
                    }
                },
                error: function(e){
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            })
        })

        $('#btn-save-avatar').click(function(){
            let form = $('#form-change-avatar');
            let data = new FormData(form[0]);
             $('#loading').removeClass('d-none');
            $.ajax({
                url: "{{ route('profile.change.avatar') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                 
                     $('#loading').addClass('d-none');
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    if(result.status){
                        Toast.fire({
                            icon: 'success',
                            title: 'Đổi ảnh đại điện thành công!'
                        })
                        $('.profile-avatar').attr('src',result.img);
                        $('#avatar').val('');
                        $('#label-avatar').html('');
                        $('#pic1').attr('src',"{{ asset('main/images/user-avatar.png') }}")
                        $('#modal-change-avatar').modal('hide');
                    }else{
                        console.log(result.mess);
                    }
                },
                error: function(e){
                    $('#loading').addClass('d-none');
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            })
        })

        $('#btn-save-wall').click(function(){
            let form = $('#form-change-wall');
            let data = new FormData(form[0]);
             $('#loading').removeClass('d-none');
            $.ajax({
                url: "{{ route('profile.change.wall') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                     $('#loading').addClass('d-none');
                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    if(result.status){
                        Toast.fire({
                            icon: 'success',
                            title: 'Đổi ảnh nền hồ sơ thành công!'
                        })
                        $('.fade-background').css('background-image','url(' + result.img + ')');
                        $('.profile-banner').css('background-image','url(' + result.img + ')');
                      
                        $('#wall').val('');
                        $('#label-wall').html('');
                        $('#pic2').attr('src',"{{ asset('main/images/user-wall.jpg') }}");
                        $('#modal-change-wall').modal('hide');
                    }else{
                        console.log(result.mess);
                    }
                },
                error: function(e){
                    $('#loading').addClass('d-none');
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            })
        })
      
        $('#btn-post-photo').click(function(){
            let form = $('#form-post-photo');
            let data = new FormData(form[0]);
            $('#loading').removeClass('d-none');
         
            $.ajax({
                url: "{{ route('user.post.photo') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    console.log(result);
                    $('#loading').addClass('d-none');

                    if(err != null){
                        removeErrorMsg(err);     
                    }
                    if(result.status){
                        Toast.fire({
                            icon: 'success',
                            title: 'Đăng ảnh thành công!'
                        })
                        $('#note').html('');
                        $('#content').text('');
                        pond.removeFiles();
                        $('#modal-post-image').modal('hide');
                        // loadPage(1,1);
                        location.reload();
                    }else{
                        console.log(result.mess);
                    }
                },
                error: function(e){
                    $('#loading').addClass('d-none');
                
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            })

        })

        function like(){
            $('.fa-thumbs-o-up').click(function(){
                let id = $(this).data('id');
                let like = $(this);
                let type = $(this).data('type');
                if(type == 0){
                    $.ajax({
                        url: "{{route('review.like')}}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                            console.log(result);
                            if(result.status){
                            
                            count = result.count+ ' cảm ơn';
                            like.prev('.count-like').html(count);
                            }else{
                            if(like.hasClass('like')){
                                like.removeClass('like');
                                }else{
                                like.addClass('like');
                                }
                        
                            console.log(result.mess);
                            }
                        },
                        error: function(e){
                            if(like.hasClass('like')){
                                like.removeClass('like');
                            }else{
                                like.addClass('like');
                            }
                        }
                    })
                }else{
                    $.ajax({
                        url: "{{route('postphoto.like')}}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                            console.log(result);
                            if(result.status){
                            
                            count = result.count+ ' cảm ơn';
                            like.prev('.count-like').html(count);
                            }else{
                            if(like.hasClass('like')){
                                like.removeClass('like');
                                }else{
                                like.addClass('like');
                                }
                        
                            console.log(result.mess);
                            }
                        },
                        error: function(e){
                            if(like.hasClass('like')){
                                like.removeClass('like');
                            }else{
                                like.addClass('like');
                            }
                        }
                    })
                }
                
                if(like.hasClass('like')){
                like.removeClass('like');
                }else{
                like.addClass('like');
                }
            
            });
        }

        function loadPage(page,type){
            $.ajax({
                url: "{{route('profile.user',['name' => Str::slug($user->fullName()),'id'=>$user->id])}}",
                type: 'GET',
                data: {
                    "currentPage": page,
                    "type": type,
                },
                success: function(result){
                    let totalPage = '{{$totalPage}}';
                   
                    if(currentPage <= totalPage){
                        $('#show-feed-activity').append(result);
                        previewPhoto(data2);
                        like();
                        deleteReview();
                        deletePostPhoto();
                    }else{
                        $('.read-more-feed').find('span').text('Đã hết');
                    }
                }
            })
        }

        var currentPage=1;
        $('.read-more-feed').click(function(){
            currentPage++;
            let type = $(this).data('type');
            loadPage(currentPage,type);
        })

        var currentPageTravel=1;
        $('.read-more-travel').click(function(){
            currentPageTravel++;
            $.ajax({
                url: "{{route('profile.user',['name' => Str::slug($user->fullName()),'id'=>$user->id])}}?travelPage="+currentPageTravel,
                type: 'GET',
                success: function(result){
                    if(result != ''){
                        $('#show-tab-travel').append(result);
                        deleteTravel();
                         $('.carousel').carousel({
                            touch: true,
                            ride: true,
                            interval: false,
                            wrap: false,
                            });
                    }else{
                        $('.read-more-travel').find('span').text('Đã hết');
                    }
                },
                error: function(e){
                    console.log(e);
                }
            })
        })

        function deleteTravel(){
             $('.delete-travel').click(function(){
                let element = $(this);
                let id_travel = $(this).data('id');
               
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
                                    element.closest('.new-feed').html('');
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã xoá!'
                                    })
                                
                                }else{
                                    console.log(result.mess)
                                }
                            }
                        })

                    }
                })
            })
        }

        function deleteReview(){
            $('.delete-review').click(function(){
                let element = $(this);
                let id = element.data('id');
                Swal.fire({
                    title: 'Bạn có muốn xoá đánh giá?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            url: "{{route('review.remove')}}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id" : id,
                            },
                            success: function(result){
                                if(result.status){
                                    element.closest('.new-feed').html('');
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã xoá!'
                                    })
                            
                                }else{
                                    console.log(result.mess)
                                }
                            }
                        })

                    }
                })
            })
        }

        function deletePostPhoto(){
            $('.delete-post-photo').click(function(){
                let element = $(this);
                let id = element.data('id');
                 Swal.fire({
                    title: 'Bạn có muốn xoá đánh giá?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loading').removeClass('d-none');                 
                        $.ajax({
                            url: "{{route('post.photo.delete')}}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id" : id,
                            },
                            success: function(result){
                                $('#loading').addClass('d-none');

                                console.log(result);
                                if(result.status){

                                    element.closest('.new-feed').html('');
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã xoá!'
                                    })
                            
                                }else{
                                    console.log(result.mess)
                                }
                            }
                        })

                    }
                })
            })
        }

        function printErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                let newKey = key.replace('\.','\_');
                let description = newKey.includes('description');
                let post = newKey.includes('post');
                if(description || post){
                    let b = newKey.replace('\'','');
                    let c = b.replace('\.','\_');
                    newKey = c.replace('\'','');
                
                }
                $('.'+newKey+'_err').text(value);
                $('#'+newKey).addClass('is-invalid');
            });
            let e = Object.keys(msg)[0].replace('\.','\_');
            let newE = e +'_err';
            let top= $('.'+newE).offset().top;
         
            $(window).scrollTop(top-200);
        
        }
        
        function removeErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                let newKey = key.replace('\.','\_');
                let description = newKey.includes('description');
                let post = newKey.includes('post');
                if(description || post){
                    let b = newKey.replace('\'','');
                    let c = b.replace('\.','\_');
                    newKey = c.replace('\'','');
           
                }
                $('.'+newKey+'_err').text('');
                $('#'+newKey).removeClass('is-invalid');
            });
        
        }
    </script>

@endsection