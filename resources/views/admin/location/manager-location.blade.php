@extends('layouts.admin')

@section('title','Manager Amenities')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý địa điểm</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý địa điểm</li>
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

                                    <select name="" id="">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                  
                                   <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAdd" id="btn-add">
                                        <i class="bi bi-plus-circle d-flex justify-content-center"></i>
                                   </button>
                                
                                </div>
                                <!-- table striped -->
                                <div id="table-data">
                                    @include('admin.location.table-data')
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
</div>

<div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Sửa địa điểm
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='edit-location' >
                   @csrf
                   <input type="hidden" name="id" id = 'id'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="province">Tên</label>
                                    <input type="text" class="form-control" id="province" name="province">
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Miền</label>
                                    <select class="form-select" aria-label="Default select example" id="region" name='region'>
                                        {{-- <option selected>Open this select menu</option> --}}
                                        <option >Miền Bắc</option>
                                        <option >Miền Trung</option>
                                        <option >Miền Nam</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Vĩ độ</label>
                                        <input type="number" class="form-control" id="lat" name="latitude">
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="name">Kinh độ</label>
                                        <input type="number" class="form-control" id="long" name="longtitude">
                                    </div>
                                </div>
                                
                            
                            </div>
                            
                        </div>
                    </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Đóng</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" onclick="saveEdit()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Lưu</span>
                </button>
            </div>
         
        </div>
    </div>
</div>

<div  class="modal fade " id="formAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Thêm địa điểm
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='add-location' >
                   @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="province_add">Tên</label>
                                    <input type="text" class="form-control" id="province_add" name="province">
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Miền</label>
                                    <select class="form-select" aria-label="Default select example" id="region_add" name='region'>
                                        {{-- <option selected>Open this select menu</option> --}}
                                        <option selected  >Miền Bắc</option>
                                        <option >Miền Trung</option>
                                        <option >Miền Nam</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Vĩ độ</label>
                                        <input type="number" class="form-control" id="lat_add" name="latitude">
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="name">Kinh độ</label>
                                        <input type="number" class="form-control" id="long_add" name="longtitude">
                                    </div>
                                </div>
                                      <div  id="map" style="height: 30vh; width: 48vw;"></div> 
                            </div>
                            
                        </div>
                    </div>
               </form>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Đóng</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" onclick="addLocation()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Thêm</span>
                </button>
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
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="{{ asset('main/js/map.js') }}"></script>
    
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

    function showEdit(){
           $('.bi-pencil-square').click(function(){
            let id = $(this).closest('tr').find('input').val();
            let province = $(this).closest('tr').find('td').eq(1).html();
            let region = $(this).closest('tr').find('td').eq(2).html();
            let lat = $(this).closest('tr').find('td').eq(3).html();
            let long = $(this).closest('tr').find('td').eq(4).html();

            $('#region option').each(function () {
                if ($(this).text() == region) {
                    $(this).prop('selected',true);
                    return;
                } 
            });
            $('#id').val(id);
            $('#province').val(province);
            $('#lat').val(lat);
            $('#long').val(long);
          
        })
    }

    function loadPage(page){
        $.ajax({
            url: "{{ route('admin.manager.location') }}?page="+page,
            type: "GET",
            success: function(result){
                $('#table-data').html(result);
                showEdit()
                deleteData();
            }
        })
    }


    function addLocation(){
        let form = $("#add-location");
        var data = new FormData(form[0]);

        $.ajax({
            url: "{{ route('admin.manager.location.store') }}",
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

    function saveEdit(){
      
        let form = $("#edit-location");
        var data = new FormData(form[0]);
        $.ajax({
            url: "{{ route('admin.manager.location.update') }}",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(result){
                if(result.status){
                    loadPage(page)
                      Toast.fire({
                        icon: 'success',
                        title: 'Sửa thành công'
                        })
                }else{
                    Toast.fire({
                        icon: 'warning',
                        title: result.mess,
                        })
                       $('#formEdit').modal('show');
                }
            }
        })

    }

    function deleteData(){
        $('.bi-trash').click(function(e){
            let id = $(this).data('id');

            Swal.fire({
                title: 'Bạn có chắc muốn xoá',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.manager.location.delete') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                        if(result.status){
                            loadPage(page);
                              Swal.fire(
                                'Đã xoá!',
                                '',
                                'success'
                                )
                        }else{
                             Swal.fire(result.mess)
                        }
                        }
                    })
                }
                })

        })
    }

    $(document).ready(function(){
        Pagination();
        showEdit();
        deleteData();
    });
    

</script>

@endsection