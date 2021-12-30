@forelse ($travels as $item)
    <div class="row item-travel" data-id-travel='{{$item->id}}'>
        <div class="col-3 d-flex justify-content-center">
            <div class="square-travel">
            @if (count($item->post) != 0)
                <img src="{{$item->post->first()->img_avatar}}" alt="">
            @else
            <i class="fa fa-heart-o" ></i>
            @endif
            </div>
        </div>
        <div class="col-7 d-flex align-items-center">
            @if ($item->status == 0)
            <div class="icon-status-private">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </div>
            @else
            <div class="icon-status-public">
                <i class="fa fa-unlock" aria-hidden="true"></i>
            </div>
                
            @endif
            <h6 class="pl-2">
                {{$item->title}}
            </h6>
        </div>
        <div class="col-2 d-flex align-items-center show-heart" data-heart="{{$item->heart}}">
            @if ($item->heart)
                <i class="fa fa-heart" style='color: #ff5d5d;'></i>
            @else

            @endif
        </div>
    </div>
@empty
    <h4>Chưa có chuyến đi gì</h4>
@endforelse