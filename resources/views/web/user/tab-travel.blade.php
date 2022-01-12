@forelse ($travels as $item)
    <div class="row new-feed mb-3">
        <div class="col-12">
            <div class="row">
                <div class="col-1">
                    <img src="{{$user->img_avatar}}" class="avatar" alt="">
                </div>
                <div class="col-10 pl-4">
                    <span>
                        <strong><a href="" style="color: black">{{$user->fullname()}}</a></strong>
                        <span class="action-after-name">đã tạo Chuyến đi</span>
                    </span><br>
                    <span class="font-date">{{ date('d', strtotime($item->created_at)) }} thg {{ date('m, Y', strtotime($item->created_at)) }}</span>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    @if ($user->id == Auth::id())
                        <div class="btn-group">
                            <i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item delete-travel" data-id="{{$item->id}}" type="button">Xoá</button>
                                
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 mt-3 box-travel " >
            @if ($item->post->count()!=0)
                <img src="{{$item->post->first()->img_avatar}}" class="img-travel-post" alt="">
            @else
                <div class="null-post">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>         
            @endif
            <div class="travel-avatar-user">
                <img src="{{$user->img_avatar}}" alt="" class="avatar">
            </div>
        
        </div>
        <div class="col-12 ">
            <div class="title-travel">
                <h4><a href="{{route('travel.info',['slug' => Str::slug($item->title),'id' => $item->id])}}" target="_blank">{{$item->title}}</a></h4>
                <span>bởi <strong>{{$user->first_name}}</strong></span>
                <p>{!! \Illuminate\Support\Str::limit(nl2br($item->note), 40, $end = '...') !!}</p>
            </div>
            <div class="mt-2">
                @if ($item->post->count() > 0)
                    <div id="carousel-post-{{$item->id}}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                           @for ($i = 0; $i < $item->post->count(); $i=$i+2)
                                @if ($i==0)
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-6 pr-2 pl-2">
                                                <div class="d-flex border">
                                                    <img src="{{$item->post[$i]->img_avatar}}" class="avatar-post" alt="">                
                                                    <div class="title-post">
                                                        <span>
                                                            <strong>
                                                                <a href="{{route('post.show',['slug' => Str::slug($item->post[$i]->name),'id' => $item->post[$i]->id]) }}">
                                                                    {!! \Illuminate\Support\Str::limit(nl2br($item->post[$i]->name), 40, $end = '...') !!}
                                                                </a>
                                                            </strong>
                                                        </span>
                                                        <div class="d-flex">
                                                            <fieldset class="rating" >
                                                                <input type="radio" value="5" @if($item->post[$i]->getSinglePost()->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                                                <input type="radio" value="4.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 4.5 and $item->post[$i]->getSinglePost()->avg_rate < 5  )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="4" @if($item->post[$i]->getSinglePost()->avg_rate >= 4 and $item->post[$i]->getSinglePost()->avg_rate < 4.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="3.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 3.5 and $item->post[$i]->getSinglePost()->avg_rate < 4  )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="3" @if($item->post[$i]->getSinglePost()->avg_rate >= 3 and $item->post[$i]->getSinglePost()->avg_rate < 3.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="2.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 2.5 and $item->post[$i]->getSinglePost()->avg_rate < 3 )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="2" @if($item->post[$i]->getSinglePost()->avg_rate >= 2 and $item->post[$i]->getSinglePost()->avg_rate < 2.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="1.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 1.5 and $item->post[$i]->getSinglePost()->avg_rate < 2 )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="1" @if($item->post[$i]->getSinglePost()->avg_rate >= 1 and $item->post[$i]->getSinglePost()->avg_rate < 1.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="0.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 0.5 and $item->post[$i]->getSinglePost()->avg_rate < 1 )checked @endif /><label class="half"></label>
                                                            </fieldset>
                                                            <p>{{$item->post[$i]->getSinglePost()->count_review}} đánh giá</p>
                                                        </div>
                                                        <p>{{$item->post[$i]->location->province}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->post->count() > $i+1)
                                                <div class="col-md-6 pr-2 pl-2">
                                                    <div class="d-flex border">
                                                        <img src="{{$item->post[$i+1]->img_avatar}}" class="avatar-post" alt="">                
                                                        <div class="title-post">
                                                            <span>
                                                                <strong>
                                                                    <a href="{{route('post.show',['slug' => Str::slug($item->post[$i+1]->name),'id' => $item->post[$i+1]->id]) }}">
                                                                        {!! \Illuminate\Support\Str::limit(nl2br($item->post[$i]->name), 40, $end = '...') !!}
                                                                    </a>
                                                                </strong>
                                                            </span>
                                                            <div class="d-flex">
                                                                <fieldset class="rating" >
                                                                    <input type="radio" value="5" @if($item->post[$i+1]->getSinglePost()->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                                                    <input type="radio" value="4.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 4.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 5  )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="4" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 4 and $item->post[$i+1]->getSinglePost()->avg_rate < 4.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="3.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 3.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 4  )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="3" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 3 and $item->post[$i+1]->getSinglePost()->avg_rate < 3.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="2.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 2.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 3 )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="2" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 2 and $item->post[$i+1]->getSinglePost()->avg_rate < 2.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="1.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 1.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 2 )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="1" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 1 and $item->post[$i+1]->getSinglePost()->avg_rate < 1.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="0.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 0.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 1 )checked @endif /><label class="half"></label>
                                                                </fieldset>
                                                                <p>{{$item->post[$i+1]->getSinglePost()->count_review}} đánh giá</p>
                                                            </div>
                                                            <p>{{$item->post[$i+1]->location->province}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-6 pr-2 pl-2">
                                                <div class="d-flex border">
                                                    <img src="{{$item->post[$i]->img_avatar}}" class="avatar-post" alt="">                
                                                    <div class="title-post">
                                                        <span>
                                                            <strong>
                                                                <a href="{{route('post.show',['slug' => Str::slug($item->post[$i]->name),'id' => $item->post[$i]->id]) }}">
                                                                    {!! \Illuminate\Support\Str::limit(nl2br($item->post[$i]->name), 40, $end = '...') !!}
                                                                </a>
                                                            </strong>
                                                        </span>
                                                        <div class="d-flex">
                                                            <fieldset class="rating" >
                                                                <input type="radio" value="5" @if($item->post[$i]->getSinglePost()->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                                                <input type="radio" value="4.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 4.5 and $item->post[$i]->getSinglePost()->avg_rate < 5  )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="4" @if($item->post[$i]->getSinglePost()->avg_rate >= 4 and $item->post[$i]->getSinglePost()->avg_rate < 4.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="3.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 3.5 and $item->post[$i]->getSinglePost()->avg_rate < 4  )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="3" @if($item->post[$i]->getSinglePost()->avg_rate >= 3 and $item->post[$i]->getSinglePost()->avg_rate < 3.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="2.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 2.5 and $item->post[$i]->getSinglePost()->avg_rate < 3 )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="2" @if($item->post[$i]->getSinglePost()->avg_rate >= 2 and $item->post[$i]->getSinglePost()->avg_rate < 2.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="1.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 1.5 and $item->post[$i]->getSinglePost()->avg_rate < 2 )checked @endif /><label class="half"></label>
                                                                <input type="radio" value="1" @if($item->post[$i]->getSinglePost()->avg_rate >= 1 and $item->post[$i]->getSinglePost()->avg_rate < 1.5 )checked @endif /><label class = "full"></label>
                                                                <input type="radio" value="0.5" @if($item->post[$i]->getSinglePost()->avg_rate >= 0.5 and $item->post[$i]->getSinglePost()->avg_rate < 1 )checked @endif /><label class="half"></label>
                                                            </fieldset>
                                                            <p>{{$item->post[$i]->getSinglePost()->count_review}} đánh giá</p>
                                                        </div>
                                                        <p>{{$item->post[$i]->location->province}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->post->count() > $i+1)
                                                <div class="col-md-6 pr-2 pl-2">
                                                    <div class="d-flex border">
                                                        <img src="{{$item->post[$i+1]->img_avatar}}" class="avatar-post" alt="">                
                                                        <div class="title-post">
                                                            <span>
                                                                <strong>
                                                                    <a href="{{route('post.show',['slug' => Str::slug($item->post[$i+1]->name),'id' => $item->post[$i+1]->id]) }}">
                                                                        {!! \Illuminate\Support\Str::limit(nl2br($item->post[$i]->name), 40, $end = '...') !!}
                                                                    </a>
                                                                </strong>
                                                            </span>
                                                            <div class="d-flex">
                                                                <fieldset class="rating" >
                                                                    <input type="radio" value="5" @if($item->post[$i+1]->getSinglePost()->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                                                    <input type="radio" value="4.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 4.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 5  )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="4" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 4 and $item->post[$i+1]->getSinglePost()->avg_rate < 4.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="3.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 3.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 4  )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="3" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 3 and $item->post[$i+1]->getSinglePost()->avg_rate < 3.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="2.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 2.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 3 )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="2" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 2 and $item->post[$i+1]->getSinglePost()->avg_rate < 2.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="1.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 1.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 2 )checked @endif /><label class="half"></label>
                                                                    <input type="radio" value="1" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 1 and $item->post[$i+1]->getSinglePost()->avg_rate < 1.5 )checked @endif /><label class = "full"></label>
                                                                    <input type="radio" value="0.5" @if($item->post[$i+1]->getSinglePost()->avg_rate >= 0.5 and $item->post[$i+1]->getSinglePost()->avg_rate < 1 )checked @endif /><label class="half"></label>
                                                                </fieldset>
                                                                <p>{{$item->post[$i+1]->getSinglePost()->count_review}} đánh giá</p>
                                                            </div>
                                                            <p>{{$item->post[$i+1]->location->province}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                           @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carousel-post-{{$item->id}}" style="z-index: 100" role="button" data-slide="prev">
                            <div class="prev-post">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </div>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-post-{{$item->id}}" style="z-index: 100" role="button" data-slide="next">
                            <div class="next-post">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </div>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>           
                @else
                
                @endif
            </div>
            
        </div>
        <div class="col-lg-6">
            
        </div>
        <div class="col-12 mt-2">
           
        </div>
    </div>
@empty
    
@endforelse