@forelse ($results as $item)
 <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}" class="text-dark">
    <div class="row p-2 bg-white border mb-2 rounded">
        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ $item->img_avatar }}"></div>
        <div class="col-md-6 mt-1">
            <h5>{{$item->name}}</h5>
            <div class="d-flex flex-row">
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
            </div>
            <div class="mt-1 mb-1 spec-1">
                <span>- {{ $item->address.', '.$item->district.', '.$item->location->province }}</span>
            </div>
                <p class="show-rep-dot">- {!! \Illuminate\Support\Str::words(nl2br($item->introduce), 12, $end = '...') !!} 
                   <span class="text-primary">[Đọc thêm]</span>
                </p>
        </div>
        <div class="align-items-center align-content-center col-md-3 border-left mt-1">

            <div class="d-flex">
                
                <fieldset class="rating">
                    <input type="radio" value="5" @if($item->avg_rate_service == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                    <input type="radio" value="4.5" @if($item->avg_rate_service >= 4.5 and $item->avg_rate_service < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" value="4" @if($item->avg_rate_service >= 4 and $item->avg_rate_service < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                    <input type="radio" value="3.5" @if($item->avg_rate_service >= 3.5 and $item->avg_rate_service < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                    <input type="radio" value="3" @if($item->avg_rate_service >= 3 and $item->avg_rate_service < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                    <input type="radio" value="2.5" @if($item->avg_rate_service >= 2.5 and $item->avg_rate_service < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" value="2" @if($item->avg_rate_service >= 2 and $item->avg_rate_service < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                    <input type="radio" value="1.5" @if($item->avg_rate_service >= 1.5 and $item->avg_rate_service < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                    <input type="radio" value="1" @if($item->avg_rate_service >= 1 and $item->avg_rate_service < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                    <input type="radio" value="0.5" @if($item->avg_rate_service >= 0.5 and $item->avg_rate_service < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
                <p>Dịch vụ</p>
            </div>

            <div class="d-flex">
                
                <fieldset class="rating">
                  <input type="radio" value="5" @if($item->avg_rate_value == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                  <input type="radio" value="4.5" @if($item->avg_rate_value >= 4.5 and $item->avg_rate_value < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                  <input type="radio" value="4" @if($item->avg_rate_value >= 4 and $item->avg_rate_value < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                  <input type="radio" value="3.5" @if($item->avg_rate_value >= 3.5 and $item->avg_rate_value < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                  <input type="radio" value="3" @if($item->avg_rate_value >= 3 and $item->avg_rate_value < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                  <input type="radio" value="2.5" @if($item->avg_rate_value >= 2.5 and $item->avg_rate_value < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                  <input type="radio" value="2" @if($item->avg_rate_value >= 2 and $item->avg_rate_value < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                  <input type="radio" value="1.5" @if($item->avg_rate_value >= 1.5 and $item->avg_rate_value < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                  <input type="radio" value="1" @if($item->avg_rate_value >= 1 and $item->avg_rate_value < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                  <input type="radio" value="0.5" @if($item->avg_rate_value >= 0.5 and $item->avg_rate_value < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
              <p>Giá trị</p>
            </div>

            <div class="d-flex">
              
                <fieldset class="rating">
                  <input type="radio" value="5" @if($item->avg_rate_sleep == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                  <input type="radio" value="4.5" @if($item->avg_rate_sleep >= 4.5 and $item->avg_rate_sleep < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                  <input type="radio" value="4" @if($item->avg_rate_sleep >= 4 and $item->avg_rate_sleep < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                  <input type="radio" value="3.5" @if($item->avg_rate_sleep >= 3.5 and $item->avg_rate_sleep < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                  <input type="radio" value="3" @if($item->avg_rate_sleep >= 3 and $item->avg_rate_sleep < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                  <input type="radio" value="2.5" @if($item->avg_rate_sleep >= 2.5 and $item->avg_rate_sleep < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                  <input type="radio" value="2" @if($item->avg_rate_sleep >= 2 and $item->avg_rate_sleep < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                  <input type="radio" value="1.5" @if($item->avg_rate_sleep >= 1.5 and $item->avg_rate_sleep < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                  <input type="radio" value="1" @if($item->avg_rate_sleep >= 1 and $item->avg_rate_sleep < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                  <input type="radio" value="0.5" @if($item->avg_rate_sleep >= 0.5 and $item->avg_rate_sleep < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
              <p>Giấc ngủ </p>
            
            </div>
            <div>
                <span>
                    Số đánh giá: {{$item->count_review}}.
                </span>
            </div>
        </div>
    </div>
</a>  
              
@empty
    <h2>Không tìm thấy kết quả.</h2>
@endforelse

@if (Count($results) >0)
<div class="d-flex justify-content-center mt-4 mb-4" >
    {!! $results->appends(request()->query())->links('web.pagination') !!}

</div>    
@endif
  