@extends('layouts.admin')

@section('title','Home admin')

@section('head')
@endsection

@section('content')
    
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldHome"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Số lượng Homestay</h6>
                                        <h6 class="font-extrabold mb-0">{{$count['homestay']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldHome"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Số lượng Resort</h6>
                                        <h6 class="font-extrabold mb-0">{{$count['resort']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Số lượng người dùng</h6>
                                        <h6 class="font-extrabold mb-0">{{$count['user']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldChat"></i>
                                    
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Số lượng đánh giá</h6>
                                        <h6 class="font-extrabold mb-0">{{$count['review']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <h4>Biểu đồ số lượng Homestay - Resort </h4>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <label for="">Từ ngày: </label>
                                        <input type="date" name="" id="date-from">
                                        <label for="">Đến ngày: </label>
                                        <input type="date" name="" id="date-to">    
                                       
                                    </div>

                                    <select name="filter" id="filter-chart">
                                        {{-- <option value="">Tuần</option> --}}
                                        <option value="0" selected>Tháng</option>
                                        <option value="1">Năm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                                <div id="chart-post-line" ></div>
                                <div id="chart-total-review"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Top 3 Homestay-Resort có đánh giá sao cao</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Địa chỉ</th>
                                                <th>Rate</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($postTop as $item)
                                                <tr>
                                                    <td class="col-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ $item->img_avatar }}" style='object-fit: cover; width:42px;height:42px' >
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">{{$item->name}}</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{ $item->address.", ".$item->district.', '.$item->streets.', '.$item->location->province }}</p>
                                                        
                                                    </td>
                                                    <td>
                                                        <p>{{$item->avg_rate}}</p>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">link</a>
                                                    </td>
                                                </tr>
                                                
                                            @empty
                                                <td colspan="3">
                                                    <span>Không có dữ liệu</span>
                                                </td>
                                            @endforelse
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ Auth::user()->img_avatar == null ? 'https://drive.google.com/uc?id=1k4YLSor3SKwcT6v_3HcX_MCiDYkssn9V&export=media': Auth::user()->img_avatar }}" style="object-fit: cover">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{Auth::user()->fullName()}}</h5>
                                <h6 class="text-muted mb-0"><a href="">Đăng xuất</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Người dùng có đánh giá tích cực</h4>
                    </div>
                    <div class="card-content pb-4">
                        @forelse ($users as $item)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ $item->user->img_avatar }}" style="object-fit: cover">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{ $item->user->fullName() }}</h5>
                                    <h6 class="text-muted mb-0">Số đánh giá: {{$item->total}}</h6>
                                </div>
                            </div>
                        @empty    
                            <h6 class="text-muted mb-0 ms-4">Không có dữ liệu</h6>
                        @endforelse
                            
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Tỷ lệ Homestay-Resort</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-pie-post"></div>
                    </div>
                </div>
               
                <div class="card">
                    <div class="card-header">
                        <h4>Người dùng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <svg class="bi text-primary" width="32" height="32" fill="blue"
                                        style="width:10px">
                                        <use
                                            xlink:href="{{ asset('dashboard/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                    </svg>
                                    <h6 class="mb-0 ms-3">Tổng người dùng</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0">{{$userActivity +$userBan}}</h5>
                            </div>
                            <div class="col-12">
                                <div id="chart-area-user"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <svg class="bi text-success" width="32" height="32" fill="blue"
                                        style="width:10px">
                                        <use
                                            xlink:href="{{ asset('dashboard/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                    </svg>
                                    <h6 class="mb-0 ms-3">Tỷ lệ</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0"></h5>
                            </div>
                            <div class="col-12">
                                <div id="chart-pie-user"></div>
                            </div>
                        </div>
                     
                    </div>
                </div>
    
            </div>
        </section>
    </div>
    
@endsection

@section('script')
    <script src="{{ asset('dashboard/vendors/apexcharts/apexcharts.js') }}"></script>
    <script>
        var config = {
            routes: {
                loadChart: "{{route('admin.dashboard.chart')}}",
            }
        };
        var totalPost = parseInt(`{{$count['homestay']}}`) + parseInt(`{{$count['resort']}}`);
        var percentPost = [];
        percentPost.push(parseInt(`{{$count['homestay']}}`)/totalPost *100);
        percentPost.push(parseInt(`{{$count['resort']}}`)/totalPost *100);
        var dataUser = {
           data:[],
           categories:[],
        };
        let userTotal = {!! json_encode($userTotal) !!};
        userTotal.forEach(element => {
            dataUser.data.push(element.data);
            dataUser.categories.push(element.categories);
        });
        var totalUser = parseInt(`{{$userActivity}}`) + parseInt(`{{$userBan}}`);
        var percentUser = [];
        percentUser.push(parseInt(`{{$userActivity}}`)/totalUser *100);
        percentUser.push(parseInt(`{{$userBan}}`)/totalUser *100);
    </script>
    <script src="{{ asset('dashboard/js/pages/dashboard.js') }}" ></script>
@endsection