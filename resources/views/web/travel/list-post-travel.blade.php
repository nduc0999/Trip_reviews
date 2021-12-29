<div class="row">
    <div class="col-md-12" style="background-color: white">
        <div class="row mt-4">
            <div class="col-12 p-3">
                <img src="{{Auth::user()->img_avatar}}" class='avatar' alt="">
                <div class="btn-group float-right">
                    <i class="fa fa-ellipsis-h " data-toggle="dropdown" ></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-edit-travel">Chỉnh sửa chuyến đi</button>
                        @if ($travel->status == 0)
                            <button class="dropdown-item btn-change-status" data-status="1" type="button">Công khai chuyến đi</button>
                        @else
                            <button class="dropdown-item btn-change-status" data-status="0" type="button">Chuyển chuyến đi sang chế độ riêng tư</button>
                        @endif
                        <button class="dropdown-item delete-travel" data-id-travel="{{$travel->id}}" type="button">Xoá chuyến đi</button>
                    </div>
                </div>
                
            </div>
            <div class="col-12"></div>
            <div class="col-12 mb-4">
                <h3>{{$travel->title}}</h3>
                <span>Bởi <strong>{{Auth::user()->first_name}}</strong>,</span><br>
                <div class="mt-2 mb-2">
                    @if ($travel->note == null)
                        <span class="add-note" data-toggle="modal" data-target="#modal-edit-travel">+ Thêm mô tả</span>
                    @else
                        <span>{!! nl2br($travel->note) !!}</span>
                    @endif
                </div>
                <p>{{count($posts)}} mục, Cập nhật vào tháng {{date('m', strtotime($travel->updated_at))}} năm {{date('Y', strtotime($travel->updated_at))}}</p>
                <div class="col-12 p-0 mt-3" >
                    <div class="search-bar d-flex">
                       
                        <input type="search" name="search" placeholder="Tìm kiếm Homestay-Resort" id='search' >
                        <button class="search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        
                    </div>
                    <div style="position: relative;">
                        <div  id='result-search' style="position: absolute; " >
                           
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-12" >
                <hr>

                @forelse ($posts as $item)
               
                    <div class="card mb-3">
                    
                        <img class="card-img" src="{{$item->img_avatar}}" alt="Bologna">

                        <div class="card-body">
                            <div class="col-12 p-0 d-flex align-items-center justify-content-between">
                                <h5 class="card-title hover-post"  data-lat="{{ $item->latitude }}" data-long = "{{ $item->longtitude }}">
                                    <a href="{{route('post.show',['slug' => Str::slug($item->name),'id' => $item->id])}}" class="name-post" style="color: black;" >{{$item->name}}
                                    </a>
                                </h5>
                                <div class="btn-group">
                                    <i class="fa fa-ellipsis-h " data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item remove-post" data-id-post="{{$item->id}}" data-id-travel="{{$travel->id}}" type="button">Xoá khỏi danh sách</button>
                                    </div>
                                </div>
                            </div>

            
                            <div class="d-flex align-items-center">
                                <fieldset class="rating">
                                    <input type="radio" value="5" @if($item->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                    <input type="radio" value="4.5" @if($item->avg_rate >= 4.5 and $item->avg_rate < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" value="4" @if($item->avg_rate >= 4 and $item->avg_rate < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                                    <input type="radio" value="3.5" @if($item->avg_rate >= 3.5 and $item->avg_rate < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" value="3" @if($item->avg_rate >= 3 and $item->avg_rate < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                                    <input type="radio" value="2.5" @if($item->avg_rate >= 2.5 and $item->avg_rate < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" value="2" @if($item->avg_rate >= 2 and $item->avg_rate < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" value="1.5" @if($item->avg_rate >= 1.5 and $item->avg_rate < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" value="1" @if($item->avg_rate >= 1 and $item->avg_rate < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                                    <input type="radio" value="0.5" @if($item->avg_rate >= 0.5 and $item->avg_rate < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                <span class="pl-2">{{$item->count_review}}</span>
                            </div>
                            <span style="font-size: 12px;">{{ $item->address.', '.$item->district.', '.$item->location->province }}</span>
                        
                
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                            <div class="views">Bao gồm: 0 mục
                            </div>
            
                        </div>
                    </div>
        
                    
                @empty
                    <div class="card card-size d-flex justify-content-center align-items-center">
                        <div class="heart-travel-empty" >
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </div>
                        <h3  style="text-align: center;">Bạn đã tạo một chuyến đi!</h3>
                        <span style="text-align: center;" >Băt đầu lưu các địa điểm mình thích, rồi lên kế hoạch và xem kế hoạch trên bản đồ</span>
                        
                    </div>
                @endforelse
    
            </div>
        </div>
    </div>
    
</div>