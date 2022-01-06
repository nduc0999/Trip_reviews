@extends('layouts.admin')

@section('title','Duyệt Đề xuất')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-datatables/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
  
@endsection

@section('content')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Duyệt các Đề xuất</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Duyệt các Đề xuất</li>
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
                                    @include('admin.post.table-data-approval')
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
            url: "{{ route('admin.approval.post') }}?page="+page,
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
       
    });

   

    $('#count').change(function(){
        count = $(this).val();
       loadPage(1);
    })
</script>
@endsection