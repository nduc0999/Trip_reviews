    <div class="col-12 col-md-4 mb-2 p-1">
        <div class="card card-size" data-toggle="modal" data-target="#modal-create-travel">
            <span class="create-travel">
                <i class="fa fa-plus-circle" aria-hidden="true">
                </i>
                <strong>Tạo một chuyến đi</strong>
            </span>
        </div>
    </div>

    @forelse ($list as $item)
        <div class="col-12 col-md-4 mb-2 p-1">
            <a href="{{route('travel.info',['slug' => Str::slug($item->title),'id' => $item->id])}}">
                <div class="card card-size">
                    @if (count($item->post)!=0)
                        <img class="card-img" src="{{$item->post->first()->img_avatar}}" alt="Bologna">
                    @else
                        <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="Bologna">

                    @endif
                    <div class="card-img-overlay">
                        <img src="{{ Auth::user()->img_avatar }}" class="avatar avatar-30" alt="">
                        <div class="icon-status">
                            @if ($item->status == 1)
                                <i class="fa fa-unlock" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-lock" aria-hidden="true"></i>

                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>
                    
                    <p class="card-text">Bời <strong style="color: black">{{Auth::user()->first_name}}</strong></p>
                    
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                        <div class="views">Bao gồm: {{count($item->post)}} mục
                        </div>

                    </div>
                </div>
            </a>
        </div>
    @empty
        
    @endforelse

