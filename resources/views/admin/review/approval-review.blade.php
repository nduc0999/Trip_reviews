@extends('layouts.admin')

@section('title','Duyệt Đánh giá')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
  
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Duyệt các đánh giá</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Duyệt các Đánh giá</li>
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
                                  
                               
                                
                                </div>
                            
                             
                                <div id="table-data">
                                    @include('admin.review.table-data-approval')
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
            url: "{{ route('admin.manager.approval.review') }}?page="+page,
            type: "GET",
            data: { 'count' :  $('#count').val() },
            success: function(result){
                $('#table-data').html(result);
                readMore();
                approval();
                hidden();
            }
        })
    }


     $(document).ready(function(){
        Pagination();
        readMore();
        approval();
        hidden();
    });

    function readMore(){
        $('.read-more').click(function(e){
            e.preventDefault();

            if($(this).hasClass('read-less')){
                $(this).closest('td').find('.less').removeClass('d-none');
                $(this).closest('td').find('.full').addClass('d-none');
                $(this).removeClass('read-less');
                $(this).text('[Đọc thêm]');
            }else{
                $(this).closest('td').find('.less').addClass('d-none');
                $(this).closest('td').find('.full').removeClass('d-none');
                $(this).addClass('read-less');
                $(this).text('[Thu gọn]');
                
            }

        })
    }

    function approval(){
        $('.bi-check2-square').click(function(){
            let element = $(this);
            Swal.fire({
                title: 'Bạn có chấp nhận đánh giá',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                        updatedStatus(element);
                         Swal.fire(
                        'Xác nhận thành công',
                        '',
                        'success'
                    )
                    }
                })
        })
    }

    function hidden(){
        $('.bi-slash-circle').click(function(){
            let element = $(this);
            Swal.fire({
                title: 'Bạn muốn ẩn đánh giá này',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                        updatedStatus(element);
                         Swal.fire(
                        'Ẩn thành công',
                        '',
                        'success'
                    )
                    }
                })
        })
    }

    function updatedStatus(element){
        let id = element.data('id');
        let status = element.data('status');

        $.ajax({
            url: "{{ route('admin.manager.review.status.update') }}",
            type: "POST",   
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                'status': status,
            },
            success: function(result){
                if(result.status){
                    loadPage(page);
                   
                }else{
                    console.log(result.mess);
                }
            }
        })
    }

    $('#count').change(function(){
        count = $(this).val();
       loadPage(1);
    })
</script>
@endsection