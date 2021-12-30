@extends('layouts.admin')

@section('title','Danh sách đánh giá')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('main/css/search2.css') }}">
  
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Danh sách các đánh giá</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách các Đánh giá</li>
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
                                  
                                     <div class="search-bar d-flex">
                                        <input type="search" name="search" placeholder="Tìm kiếm theo tiêu đề" id='search' >
                                        <button class="search-btn" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>    
                                    </div>

                                    <select name="" id="filter">
                                        <option value="3">Tất cả</option>
                                        <option value="1">Bị ẩn</option>
                                        <option value="0">Không bị ẩn</option>
                                    </select>
                                   
                                
                                </div>
                            
                             
                                <div id="table-data">
                                    @include('admin.review.table-data-review')
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
            url: "{{ route('admin.manager.list.review') }}?page="+page,
            type: "GET",
            data: { 
                'count' :  $('#count').val(), 
                'filter': $('#filter').val(),
                'search': $('#search').val(),
            },
            success: function(result){
                $('#table-data').html(result);
                readMore();
                hide_unhide_Review();

            }
        })
    }


     $(document).ready(function(){
        Pagination();
        readMore();
        hide_unhide_Review();
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

    function hide_unhide_Review(){
        $('.hide-unhide-review').click(function(){
            let element = $(this);
            let alert;
            if($(this).val() == 0){
                alert = {
                    title: 'Bạn muốn ẩn đánh giá này?',
                    success: 'Ẩn thành công',
                }
            }else{
                alert = {
                    title: 'Bạn muốn đánh giá hiển thị lại?',
                    success: 'Thay đổi thành công',
                }
            }
               Swal.fire({
                title: alert.title,
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
                            alert.success,
                            '',
                            'success'
                        )
                    }else{
                        if(element.is(':checked')){ 
                            element.prop("checked", false);
                        }else{
                            element.prop("checked", true);
                        }
                    }
                })
        
        })
    }

    function updatedStatus(element){
        let id = element.data('id');
        let status = element.data('change');

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

    $('#filter').change(function(){
        loadPage(1);
    })

    $('#search').keypress(function(e){
        if(e.which == 13){
            loadPage(1);
        }
    })
</script>
@endsection