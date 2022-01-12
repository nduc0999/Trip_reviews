@forelse ($list_data as $item)
    @if ($item->type == 'review')
        <div class="row new-feed mb-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-1">
                        <img src="{{$user->img_avatar}}" class="avatar" alt="">
                    </div>
                    <div class="col-10 pl-4">
                        <span>
                            <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                            <span class="action-after-name"> đã viết đánh giá</span>
                        </span><br>
                        <span class="font-date">{{ date('d', strtotime($item->created_at)) }} thg {{ date('m, Y', strtotime($item->created_at)) }}</span>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        @if ($item->user->id == Auth::id())
                            <div class="btn-group">
                                <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item delete-review" data-id="{{$item->id}}" type="button">Xoá</button>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <fieldset class="rating">
                    <input type="radio" {{$item->rate == 5 ?'checked':''}} disabled/><label class = "full"></label>
                    <input type="radio" {{$item->rate == 4 ?'checked':''}} disabled/><label class = "full"></label>
                    <input type="radio" {{$item->rate == 3 ?'checked':''}} disabled/><label class = "full"></label>
                    <input type="radio" {{$item->rate == 2 ?'checked':''}} disabled/><label class = "full"></label>
                    <input type="radio" {{$item->rate == 1 ?'checked':''}} disabled/><label class = "full"></label>
                </fieldset>
            </div>
            <div class="col-12">
                <div class="box-read-less">
                    <span ><strong>{{$item->title}}</strong></span><br>
                    <span>"
                        {!! \Illuminate\Support\Str::words(nl2br($item->comment), 37, $end = '...') !!}"
                    </span><p class="btn-read-more" style="cursor: pointer" >[Đọc thêm] <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                    <span><strong>Ngày lưu trú:</strong> tháng {{ date('m', strtotime($item->trip_when))}} năm {{ date('Y', strtotime($item->trip_when))}}</span>
                </div>
                <div class="box-read-more d-none">
                     <span ><strong>{{$item->title}}</strong></span><br>
                    <span>"
                        {{$item->comment}}"
                    </span><br>
                    <span><strong>Ngày lưu trú:</strong> tháng {{ date('m', strtotime($item->trip_when))}} năm {{ date('Y', strtotime($item->trip_when))}}</span>
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
                    <p class="btn-read-less" style="cursor: pointer">[Thu gọn] <i class="fa fa-caret-up" aria-hidden="true"></i></p>
                </div>
                
            </div>
            <div class="col-lg-6">
                <div class="d-flex border">
                    <img src="{{$item->post->first()->img_avatar}}" class="avatar-post" alt="">                
                    <div class="title-post">
                        <span><strong><a href="{{ route('post.show',['slug' => Str::slug($item->post->first()->name),'id' => $item->post->first()->id]) }}">{{$item->post->first()->name}}</a></strong></span>
                        <div class="d-flex">
                            <fieldset class="rating" >
                                <input type="radio" value="5" @if($item->post->first()->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                <input type="radio" value="4.5" @if($item->post->first()->avg_rate >= 4.5 and $item->post->first()->avg_rate < 5  )checked @endif /><label class="half"></label>
                                <input type="radio" value="4" @if($item->post->first()->avg_rate >= 4 and $item->post->first()->avg_rate < 4.5 )checked @endif /><label class = "full"></label>
                                <input type="radio" value="3.5" @if($item->post->first()->avg_rate >= 3.5 and $item->post->first()->avg_rate < 4  )checked @endif /><label class="half"></label>
                                <input type="radio" value="3" @if($item->post->first()->avg_rate >= 3 and $item->post->first()->avg_rate < 3.5 )checked @endif /><label class = "full"></label>
                                <input type="radio" value="2.5" @if($item->post->first()->avg_rate >= 2.5 and $item->post->first()->avg_rate < 3 )checked @endif /><label class="half"></label>
                                <input type="radio" value="2" @if($item->post->first()->avg_rate >= 2 and $item->post->first()->avg_rate < 2.5 )checked @endif /><label class = "full"></label>
                                <input type="radio" value="1.5" @if($item->post->first()->avg_rate >= 1.5 and $item->post->first()->avg_rate < 2 )checked @endif /><label class="half"></label>
                                <input type="radio" value="1" @if($item->post->first()->avg_rate >= 1 and $item->post->first()->avg_rate < 1.5 )checked @endif /><label class = "full"></label>
                                <input type="radio" value="0.5" @if($item->post->first()->avg_rate >= 0.5 and $item->post->first()->avg_rate < 1 )checked @endif /><label class="half"></label>
                            </fieldset>
                            <p class="ml-3">{{$item->post->first()->count_review}} đánh giá</p>
                        </div>
                        <p>{{$item->post->first()->location->province}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                @if ($item->status == 0)
                    <p class="count-like col-12">{{$item->likereview->count()}} cảm ơn</p>
                    @if ($item->like)
                        <i class="fa fa-thumbs-o-up like" data-id="{{$item->id}}" data-type ='0'> Hữu ích</i>
                    @else
                        <i class="fa fa-thumbs-o-up " data-id="{{$item->id}}" data-type='0'> Hữu ích</i>
                    @endif    
                @elseif ($item->status == 2)
                    <p>Đang xét duyệt</p>
                    @else
                    <p>Đã bị ẩn</p>
                @endif
                
            </div>
        </div>     
    @endif

    @if ($item->type == 'postPhoto')
        <div class="row new-feed mb-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-1">
                        <img src="{{$user->img_avatar}}" class="avatar" alt="">
                    </div>
                    <div class="col-10 pl-4">
                        <span>
                            <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                            <span class="action-after-name"> đã đăng {{$item->count}} ảnh</span>
                        </span><br>
                        <span class="font-date">{{ date('d', strtotime($item->created_at)) }} thg {{ date('m, Y', strtotime($item->created_at)) }}</span>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        @if ($item->user->id == Auth::id() or Auth::user()->role == 1)
                            <div class="btn-group">
                                <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item delete-post-photo" data-id="{{$item->id}}" type="button">Xoá</button>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <span>" {{$item->content}} "</span>
            </div>
            <div class="col-12">
                <div id="lightgallery-{{$item->id}}-feed-activity">
              
                    @for ($i = 0; $i < $item->count; $i++)
                        @if ($i < 1 )
                            <a href="{{$item->photoUser[$i]->path}}" 
                                data-sub-html="<h4>{{$item->photoUser[$i]->description}}</h4>">
                                <img class="img-thumbnail" src="{{$item->photoUser[$i]->path}}">
                            </a>
                        
                        @endif
                        @if ($i == 1)
                            <a class="last-photo" href="{{$item->photoUser[$i]->path}}" data-sub-html="<h4>{{$item->photoUser[$i]->description}}</h4>" >
                                <img style="filter: blur(1px);" class="img-thumbnail" src="{{$item->photoUser[$i]->path}}">
                                <div class="more-photo"><span><strong>Xem thêm {{$item->count - $i}} ảnh</strong></span></div>
                            </a>
                        @endif
                        @if ($i > 1)
                            <a class="d-none" href="{{$item->photoUser[$i]->path}}" data-sub-html="<h4>{{$item->photoUser[$i]->description}}</h4>" >
                                <img class="img-thumbnail" src="{{$item->photoUser[$i]->path}}">
                            </a>
                        @endif
                              
                    @endfor
    
                </div>
                   
            </div>
            <div class="col-12">
                @foreach ($item->arrTag as $tag)
                    <h6 >
                        <a class="tag" href="{{ route('post.show',['slug' => Str::slug($tag->name),'id' => $tag->id]) }}">
                            #{{str_replace(' ', '_', $tag->name)}}
                        </a>
                    </h6>
                @endforeach
            </div>
            <div class="col-12 mt-2">
                @if ($item->status == 0)
                    <p class="count-like col-12">{{$item->LikePostPhoto()->count()}} cảm ơn</p>
                    @if ($item->like)
                        <i class="fa fa-thumbs-o-up like" data-id="{{$item->id}}" data-type='1'> Hữu ích</i>
                    @else
                        <i class="fa fa-thumbs-o-up " data-id="{{$item->id}}" data-type="1"> Hữu ích</i>
                    @endif    
                @elseif ($item->status == 2)
                    <p>Đang xét duyệt</p>
                    @else
                    <p>Đã bị ẩn</p>
                @endif

                
            </div>
        </div>
    @endif
@empty
@endforelse
<script>
     var data2 = {!! json_encode($list_data) !!};
</script>

{{-- <div class="row new-feed mb-3">
    <div class="col-12">
        <div class="row">
            <div class="col-1">
                <img src="{{$user->img_avatar}}" class="avatar" alt="">
            </div>
            <div class="col-10 pl-4">
                <span>
                    <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                    <span class="action-after-name"> đã đăng 4 ảnh</span>
                </span><br>
                <span class="font-date">{{ date('d', strtotime($item->created_at)) }} thg {{ date('m, Y', strtotime($item->created_at)) }}</span>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <div class="btn-group">
                    <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">Xoá</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <span>"Đây là nội dung đăng ảnh"</span>
    </div>
    <div class="col-12">
        <div id="lightgallery">
            
                <a
                href="https://images.pexels.com/photos/606453/pexels-photo-606453.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" 
                data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                
                <img class="img-thumbnail" 
                    src="https://images.pexels.com/photos/606453/pexels-photo-606453.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
                </a>
            
                <a
                href="https://images.pexels.com/photos/1640820/pexels-photo-1640820.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                data-sub-html="<h4>Đầu moi</h4>">
                <img class="img-thumbnail"
                    src="https://images.pexels.com/photos/1640820/pexels-photo-1640820.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" title="Đầu moi"> 
                </a>
            
                <a class="d-none"
                href="https://images.pexels.com/photos/235798/pexels-photo-235798.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
                <img class="img-thumbnail"
                    src="https://images.pexels.com/photos/235798/pexels-photo-235798.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
                </a>
                
        </div>
        <div id="caption2" style="display:none">
            <h4>Bowness Bay</h4>
            <p>
                A beautiful Sunrise this morning taken En-route to Keswick not one as
                planned but I'm extremely happy I was passing the right place at the
                right time....
            </p>
        </div>     
    </div>
    <div class="col-lg-6">
        
    </div>
    <div class="col-12 mt-2">
    
        <i class="fa fa-thumbs-o-up" aria-hidden="true"> Hữu ích</i>

        
    </div>
</div> --}}

{{-- <div class="row new-feed mb-3">
    <div class="col-12">
        <div class="row">
            <div class="col-1">
                <img src="{{$user->img_avatar}}" class="avatar" alt="">
            </div>
            <div class="col-10 pl-4">
                <span>
                    <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                    <span class="action-after-name"> đã viết đánh giá</span>
                </span><br>
                <span class="font-date">{{ date('d', strtotime($user->created_at)) }} thg {{ date('m, Y', strtotime($user->created_at)) }}</span>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <div class="btn-group">
                    <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">Xoá</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <fieldset class="rating">
            <input type="radio" id="star5" name="rate" checked disabled /><label class = "full" for="star5" title="Tuyệt vời"></label>
            <input type="radio" id="star4" name="rate"  disabled /><label class = "full" for="star4" title="Rất tốt"></label>
            <input type="radio" id="star3" name="rate"  disabled /><label class = "full" for="star3" title="Trung bình"></label>
            <input type="radio" id="star2" name="rate"  disabled /><label class = "full" for="star2" title="Tồi"></label>
            <input type="radio" id="star1" name="rate"  disabled /><label class = "full" for="star1" title="Kinh khủng"></label>
        </fieldset>
    </div>
    <div class="col-12">
        <div class="box-read-less">
            <a href="">Chuyến đi trải nghiệm</a><br>
            <span>Bản thân là một người thích du lịch phố cổ,bản thân muốn chọn một nơi giao thông thuận tiện
                nhưng vẫn muốn yên tĩnh nên mình đã quyết định chọn LA ba Nà...
            </span><p class="btn-read-more" >[Đọc thêm] <i class="fa fa-caret-down" aria-hidden="true"></i></p>
            <span><strong>Ngày lưu trú:</strong> tháng 9 năm 2021</span>
        </div>
        <div class="box-read-more d-none">
            <a href="">Chuyến đi trải nghiệm</a><br>
            <span>Bản thân là một người thích du lịch phố cổ,bản thân muốn chọn một nơi giao thông thuận tiện
                nhưng vẫn muốn yên tĩnh nên mình đã quyết định chọn LA ba Nà...
            </span><br>
            <span><strong>Ngày lưu trú:</strong> tháng 9 năm 2021</span>
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Dịch vụ</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Giá trị</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="" >Giấc ngủ</label>
                </div>
            </div>
            <p class="btn-read-less">[Thu gọn] <i class="fa fa-caret-up" aria-hidden="true"></i></p>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="d-flex border">
            <img src="https://chungcu365.com/uploads/22/a-119/20191211160802-763a.jpg" class="avatar-post" alt="">                
            <div class="title-post">
                <span><strong><a href="">Hà Nội villa accc</a></strong></span>
                <div class="d-flex">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <p>30 đánh giá</p>
                </div>
                <p>hà nội</p>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <i class="fa fa-thumbs-o-up" aria-hidden="true"> Hữu ích</i>
    </div>
</div>

<div class="row new-feed mb-3">
    <div class="col-12">
        <div class="row">
            <div class="col-1">
                <img src="{{$user->img_avatar}}" class="avatar" alt="">
            </div>
            <div class="col-10 pl-4">
                <span>
                    <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                    <span class="action-after-name"> đã viết đánh giá</span>
                </span><br>
                <span class="font-date">{{ date('d', strtotime($user->created_at)) }} thg {{ date('m, Y', strtotime($user->created_at)) }}</span>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <div class="btn-group">
                    <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">Xoá</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <fieldset class="rating">
            <input type="radio" id="star5" name="rate" checked disabled /><label class = "full" for="star5" title="Tuyệt vời"></label>
            <input type="radio" id="star4" name="rate"  disabled /><label class = "full" for="star4" title="Rất tốt"></label>
            <input type="radio" id="star3" name="rate"  disabled /><label class = "full" for="star3" title="Trung bình"></label>
            <input type="radio" id="star2" name="rate"  disabled /><label class = "full" for="star2" title="Tồi"></label>
            <input type="radio" id="star1" name="rate"  disabled /><label class = "full" for="star1" title="Kinh khủng"></label>
        </fieldset>
    </div>
    <div class="col-12">
        <div class="box-read-less">
            <a href="">Chuyến đi trải nghiệm</a><br>
            <span>Bản thân là một người thích du lịch phố cổ,bản thân muốn chọn một nơi giao thông thuận tiện
                nhưng vẫn muốn yên tĩnh nên mình đã quyết định chọn LA ba Nà...
            </span><p class="btn-read-more" >[Đọc thêm] <i class="fa fa-caret-down" aria-hidden="true"></i></p>
            <span><strong>Ngày lưu trú:</strong> tháng 9 năm 2021</span>
        </div>
        <div class="box-read-more d-none">
            <a href="">Chuyến đi trải nghiệm</a><br>
            <span>Bản thân là một người thích du lịch phố cổ,bản thân muốn chọn một nơi giao thông thuận tiện
                nhưng vẫn muốn yên tĩnh nên mình đã quyết định chọn LA ba Nà...
            </span><br>
            <span><strong>Ngày lưu trú:</strong> tháng 9 năm 2021</span>
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                        <input type="radio"  }} disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Dịch vụ</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="">Giá trị</label>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <label for="" >Giấc ngủ</label>
                </div>
            </div>
            <p class="btn-read-less">[Thu gọn] <i class="fa fa-caret-up" aria-hidden="true"></i></p>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="d-flex border">
            <img src="https://chungcu365.com/uploads/22/a-119/20191211160802-763a.jpg" class="avatar-post" alt="">                
            <div class="title-post">
                <span><strong><a href="">Hà Nội villa accc</a></strong></span>
                <div class="d-flex">
                    <fieldset class="rating" >
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                        <input type="radio"  disabled/><label class = "full"></label>
                    </fieldset>
                    <p>30 đánh giá</p>
                </div>
                <p>hà nội</p>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <i class="fa fa-thumbs-o-up" aria-hidden="true"> Hữu ích</i>
    </div>
</div> --}}