@extends('layouts.admin')

@section('title','Manager Amenities')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">

    <style>
        #tbl-info td{
            padding-right: 20px;
        }
    </style>
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý Người dùng</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý Người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
           <section class="section">
                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                           
                            <div class="card-content">
                                <div class="card-body d-flex justify-content-between">
                                    
                                    <select name="count" id="count">
                                        <option value="5" selected>5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                    </select>

                                   <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAdd" id="btn-add">
                                        <i class="bi bi-plus-circle d-flex justify-content-center"></i>
                                   </button>
                                
                                </div>
                                <!-- table striped -->
                                <div id="table-data">
                                    @include('admin.user.table-data')
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
</div>



<div  class="modal fade " id="formProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      
        <div class="container-profile">
            <div class="cover-photo">
                <img src="" class="profile" id="avatar-user">
            </div>
            <div id='name-user' class="profile-name"></div>
            <div class="divider divider-left-center mt-3">
                <div class="divider-text" style="background-color: transparent"><strong>Thông tin người dùng</strong></div>
            </div>
            <div class="container d-flex justify-content-center">
                
                <table id='tbl-info'class="text-start">
                    <tr>
                        <td>Email:</td>
                        <td id='email'>nduc@gmai.com</td>
                    </tr>
                    <tr> 
                        <td>Ngày sinh:</td>
                        <td id="dob">03/04/2007</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td id="phone">01234566789</td>
                    </tr>
                    <tr>
                        <td>Quê quán:</td>
                        <td id="country">Hạ Long Nam Định</td>
                    </tr>
                </table>

            </div>
            <div class="divider divider-left-center mt-3">
                <div class="divider-text" style="background-color: transparent"><strong>Giới thiệu bản thân</strong></div>
            </div>
            <div class="container">
                <p class="about" id="introduce"></p>
            </div>

            <div class="mb-3">
                <button class="msg-btn">Message</button>
                <button class="follow-btn">Following</button>
            </div>
           
        </div>
    
    </div>
</div>


@endsection

@section('script')
<script>
    var page
</script>
<script src="{{ asset('dashboard/js/custom.js') }}"></script>
<script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    
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
        })



    function loadPage(page){
        $.ajax({
            url: "{{ route('admin.manager.user') }}?page="+page,
            type: "GET",
            data: { 'count' :  $('#count').val() },
            success: function(result){
                $('#table-data').html(result);
                save_ban_unban();
                viewProfile();
            }
        })
    }


    function addUser(){
        let form = $("#add-user");
        var data = new FormData(form[0]);

        $.ajax({
            url: "{{ route('admin.manager.user.store') }}",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(result){
                if(result.status){
                    loadPage(1)
                    Toast.fire({
                        icon: 'success',
                        title: 'Thêm mới thành công'
                        })
                    $('#province_add').val('');
                    $('#lat_add').val('');
                    $('#long_add').val('');
                }else{
                   Toast.fire({
                        icon: 'warning',
                        title: result.mess,
                        });
                    $('#formAdd').modal('show');
                }
              
            }
        })

    }

    function ban_unban_Review(id,user){
            let alert;
            if($(user).val() == 0){
                alert = {
                    title: 'Bạn muốn cấm đánh giá người này?',
                    success: 'Đã cấm đánh giá!',
                }
            }else{
                alert = {
                    title: 'Bạn muốn huỷ cấm đánh giá người này?',
                    success: 'Đã huỷ cấm đánh giá!',
                }
            }

            Swal.fire({
                title: alert.title,
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.manager.user.ban.unban.review') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                            if(result.status){
                                loadPage(page);
                                Swal.fire(
                                    alert.success,
                                    '',
                                    'success'
                                    )
                            }else{
                                Swal.fire(result.mess)
                            }
                       
                        }
                    })
                }else {
                    if($(user).is(':checked')){ 
                        $(user).prop("checked", false);
                    }else{
                        $(user).prop("checked", true);
                    }

                }
                })

    }

    $(document).ready(function(){
        Pagination();
        save_ban_unban();
        viewProfile();
        
 
    });
    
    function save_ban_unban(){
        $('.ban-unban-review').click(function(){
            id = $(this).data('id');
            ban_unban_Review(id,this)
        })
    }

    function viewProfile(){
          $('.bi-eye-fill').click(function(){
            
            let id = $(this).closest('tr').find('input[type=hidden]').val();

            $.ajax({
                url:"{{ route('admin.manager.user.profile') }}",
                type: "POST",
                data: {
                    "_token" : '{{csrf_token()}}',
                    id,
                },
               
                success: function(result){
                    if(result.status){
                        console.log(result.data);
                        name = result.data.first_name +" "+result.data.last_name;
                        $('#name-user').html(name);
                        $('#avatar-user').attr('src', result.data.img_avatar);
                        $('.cover-photo').css("background-image", `url('${result.data.img_wall}')`);
                        $('#email').html(result.data.email);
                        $('#dob').html(result.data.date_of_birth);
                        $('#phone').html(result.data.phone);
                        $('#country').html(result.data.country);
                        $('#introduce').html(result.data.introduce);
                        $('#formProfile').modal('show');
                    }
                }

            })
          });
    }

    $('#count').change(function(){
        loadPage(1);
    })
</script>
@endsection