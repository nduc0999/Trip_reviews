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
                <h3>Quản lý Câu hỏi</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý Câu hỏi</li>
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
                                  
                                   <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formAdd">
                                        <i class="bi bi-plus-circle d-flex justify-content-center"></i>
                                   </button>
                                
                                </div>
                                <!-- table striped -->
                                <div id="table-data">
                                    @include('admin.question.table-data')
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Sửa Câu hỏi
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='edit-question' >
                   @csrf
                   <input type="hidden" name="id" id = 'id'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question">Câu hỏi</label>
                                    <textarea class="form-control" id="question" rows="3" name="question"></textarea>    
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Đặt Câu hỏi
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
        
            <div class="modal-body">
               <form id='add-question' >
                   @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="question">Câu hỏi</label>
                                    <textarea class="form-control" id="question_add" rows="3" name="question"></textarea>    
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
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" onclick="addQuestion()">
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
            let id = $(this).closest('tr').find('input[type=hidden]').val();
            let question = $(this).closest('tr').find('td').eq(1).html();
            $('#id').val(id);
            $('#question').val(question);
        })
    }

    function loadPage(page){
        $.ajax({
            url: "{{ route('admin.manager.question') }}?page="+page,
            type: "GET",
            data: { 'count' :  $('#count').val() },
            success: function(result){
                $('#table-data').html(result);
                showEdit()
                deleteData();
                saveActivity();
            }
        })
    }


    function addQuestion(){
        let form = $("#add-question");
        var data = new FormData(form[0]);

        $.ajax({
            url: "{{ route('admin.manager.question.store') }}",
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
                    $('#question_add').val('');
            
                }else{
                      Toast.fire({
                        icon: 'warning',
                        title: result.mess,
                        })
                    $('formAdd').modal('show');
                }      
            }
        })

    }

    function saveEdit(){
      
        let form = $("#edit-question");
        var data = new FormData(form[0]);
        $.ajax({
            url: "{{ route('admin.manager.question.update') }}",
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
                    loadPage(page);
                    $('#formEdit').modal('show')
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
                        url: "{{ route('admin.manager.question.delete') }}",
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


     function activityQuestion(id,question){
    

            Swal.fire({
                title: 'Bạn có muốn thay hoạt động câu hỏi này',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.manager.question.activity') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(result){
                            if(result.status){
                                loadPage(page);
                                Swal.fire(
                                    'Đã thay đổi trạng thái câu hỏi!',
                                    '',
                                    'success'
                                    )
                            }else{
                                Swal.fire(result.mess)
                            }
                       
                        }
                    })
                }else {
                    if($(question).is(':checked')){ 
                        $(question).prop("checked", false);
                    }else{
                        $(question).prop("checked", true);
                    }

                }
                })

    }

     function saveActivity(){
        $('.activity-question').click(function(){
            let id = $(this).data('id');
            activityQuestion(id,this)
        })
    }

    $(document).ready(function(){
        Pagination();
        showEdit();
        deleteData();
        saveActivity();
    });

    $('#count').change(function(){
        count = $(this).val();
        
       loadPage(1);
    })
    


</script>

@endsection