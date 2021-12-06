@extends('layouts.admin')

@section('title','Manager Amenities')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
  
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý tiện ích</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý tiện ích</li>
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
                                <div class="card-body d-flex justify-content-end">
                                  
                                   <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAdd">
                                        <i class="bi bi-plus-circle d-flex justify-content-center"></i>
                                   </button>
                                
                                </div>
                            
                                <!-- table striped -->
                                <div id="table-data">
                                    @include('admin.amenity.table-data')
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Sửa tiện ích
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='edit-amenity' >
                   @csrf
                   <input type="hidden" name="id" id = 'id'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>    
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

<div class="modal fade" id="formAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Thêm tiện ích
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='add-amenity' >
                   @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" id="name_add" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="description_add" rows="3" name="description"></textarea>    
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
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" onclick="addAmenity()">
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
            let name = $(this).closest('tr').find('td').eq(1).html();
            let description = $(this).closest('tr').find('td').eq(2).html();
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(description);
        })
    }

    function loadPage(page){
        $.ajax({
            url: "{{ route('admin.manager.amenity') }}?page="+page,
            type: "GET",
            success: function(result){
                $('#table-data').html(result);
                showEdit()
                deleteData();
            }
        })
    }


    function addAmenity(){
        let form = $("#add-amenity");
        var data = new FormData(form[0]);

        $.ajax({
            url: "{{ route('admin.manager.amenity.store') }}",
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
                    $('#name_add').val('');
                    $('#description_add').val('');
                }else{
                    Toast.fire({
                        icon: 'warning',
                        title: result.mess,
                        })
                        $('#formAdd').modal('show');
                }
              
            }
        })

    }

    function saveEdit(){
      
        let form = $("#edit-amenity");
        var data = new FormData(form[0]);
        $.ajax({
            url: "{{ route('admin.manager.amenity.update') }}",
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
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.manager.amenity.delete') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                        if(result.status){
                            loadPage(page);
                              Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
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

    

    $('#count').change(function(){
        alert($(this).val());
    })
</script>
@endsection