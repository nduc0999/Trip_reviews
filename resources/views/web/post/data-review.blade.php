<div class="content">
    <ul>
        @forelse ($reviews as $item)
        <li class="row">
            <div class="author-thumb col-md-2">
            <img src="{{$item->user->img_avatar}}" alt="" class="avatar">
            </div>
            <div class="right-content col-md-10">
            <h4>{{ $item->user->first_name.' '.$item->user->last_name }}<span>{{$item->created_at}}</span>
                @auth
                @if (Auth::user()->isAdmin())
                    <div class="btn-group float-right" >
                    <i class="fa fa-ellipsis-h"  data-toggle="dropdown" ></i>
            
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item hidden-review" type="" data-id="{{$item->id}}">Ẩn đánh giá</button>
                    
                    </div>
                    </div>
                @endif
                @endauth
            </h4>

            </div>
            <div class="col-md-12">
            <fieldset class="rating" >
                <input type="radio" {{$item->rate == 5 ?'checked':''}} disabled/><label class = "full"></label>
                <input type="radio" {{$item->rate == 4 ?'checked':''}} disabled/><label class = "full"></label>
                <input type="radio" {{$item->rate == 3 ?'checked':''}} disabled/><label class = "full"></label>
                <input type="radio" {{$item->rate == 2 ?'checked':''}} disabled/><label class = "full"></label>
                <input type="radio" {{$item->rate == 1 ?'checked':''}} disabled/><label class = "full"></label>
            </fieldset>

            </div>
            <br><br>
            <div class="col-md-12 comment">
            <h5>{{$item->title}}</h5>
            <hr>
            <p>"{{$item->comment}}"</p>
            <div class=" show-more" style="display: none">
                <p>
                <strong>Ngày lưu trú: </strong>{{ 'tháng '.date('m', strtotime($item->trip_when)).' năm '.date('Y', strtotime($item->trip_when))}} <br>
                <strong>Loại chuyến đi: </strong>{{$item->trip_type}}
                </p>
                <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  {{$item->rate_service == 5 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_service == 4 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_service == 3 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_service == 2 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_service == 1 ?'checked':''}} disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Dịch vụ</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio" {{$item->rate_value == 5 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio" {{$item->rate_value == 4 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio" {{$item->rate_value == 3 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio" {{$item->rate_value == 2 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio" {{$item->rate_value == 1 ?'checked':''}} disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Giá trị</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  {{$item->rate_sleep == 5 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_sleep == 4 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_sleep == 3 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_sleep == 2 ?'checked':''}} disabled/><label class = "full"></label>
                        <input type="radio"  {{$item->rate_sleep == 1 ?'checked':''}} disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="" >Giấc ngủ</label>
                </div>
                </div>
            </div>
            <div class="d-flex align-items-center read-more">
                <p style="text-decoration: underline;color:orange;font-size:14px">Đọc thêm</p><i class="fa fa-caret-down ml-2" aria-hidden="true"></i>
            </div>
            <hr style="margin-top: 0px;margin-bottom: 0px;">
            <p style="font-size: 10px;">Đánh giá này là ý kiến chủ quan của một thành viên TripReview chứ không phải của TripReview LLC.</p>
            </div>
            <div class="col-md-12 mb-4 nav-like-rep">
                <div class="row review-activity">
                    <p class="count-like col-12">{{$item->likereview->count()}} cảm ơn</p>
                    @auth
                    <div class="col-md-6">
                    @if ($item->like)
                        <i class="fa fa-thumbs-o-up like" data-id="{{$item->id}}"> Hữu ích</i>
                    @else
                        <i class="fa fa-thumbs-o-up " data-id="{{$item->id}}"> Hữu ích</i>
                    @endif 
                    
                    </div>
                    
                    @if (Auth::user()->role != 0)
                    @if ($item->rep == null)
                    <div class="col-md-6">
                        <i class="fa fa-comment-o " data-id='{{ $item->id }}' data-id_post= '{{$post->id}}'> Trả lời đánh giá</i>  
                    </div>
                    <hr>
                    <div class="col-12 write-rep">
                       
                    </div>
                    @endif
                    @endif
                    
                    
                    @endauth
                </div>
            @if ($item->rep != null)
                <hr>
                <div class="col-12">
                <div class="row">
                    <div class="col-1">
                        <img src="{{ asset('main/images/admin.svg') }}"  class="avatar" style="width:30px;height:30px" alt="">
                    </div>
                    <div class="col-11 rep">
                        <p style="color: black;">Phản hồi từ {{ $post->name }}, Manager tại {{$post->name}}</p>
                        <p style="font-size: 11px">Đã phản hồi {{ date('d-m-Y', strtotime($item->updated_at)) }}</p>
                        
                        <p class="show-rep-dot">{!! \Illuminate\Support\Str::words(nl2br($item->rep), 52, $end = '...') !!}</p>
                        <p  class="show-rep d-none" >{!! nl2br($item->rep) !!}</p>
                        
                        <p style="text-decoration: underline;color:orange;font-size:14px" class="read-more-rep">Đọc thêm <i class="fa fa-caret-down ml-2" aria-hidden="true"></i></p>
                        <hr>

                        @if ($item->id_respondent == Auth::id())
                            <div class="row">
                                <div class="col-6">
                                    <i class="fa fa-pencil-square-o" data-id_review ='{{$item->id}}' data-toggle="modal" data-target="#edit-rep" aria-hidden="true"> Chỉnh sửa</i>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-trash-o" data-id_review ='{{$item->id}}' aria-hidden="true"> Xoá</i>
                                </div>
                            </div>
                            
                        @endif
                    </div>
                </div>
                </div>   
            @endif
            </div>
        </li>
            
        @empty
            <h5>Chưa có đánh giá nào</h5>
        @endforelse
        
    </ul>
</div>
   <div class="d-flex justify-content-center mt-4">
        {!! $reviews->links('web.pagination') !!}
    </div>