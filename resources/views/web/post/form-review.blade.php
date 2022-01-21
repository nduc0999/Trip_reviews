@extends('layouts.main')
@section('title','Viết đánh giá')

@section('head')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('content')

    <div class="heading-page header-text">

    </div>
    <section class="blog-posts grid-system">
        
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mb-4" >
                        <div class="col-2">
                            <img src="{{$post->img_avatar}}" alt="" style="height: 110px;width:110px; object-fit:cover;">
                        </div>
                        <div class="col-10 d-flex justify-content-center" style="flex-direction: column; padding: 0px 50px">
                            <h3>{{$post->name}}</h3>
                            <span>{{ $post->address.", ".$post->district.', '.$post->streets.', '.$location->province }}.</span>
                            <span class="text-danger error-text id_err "></span>
                        </div>
                    </div>
                    <h5>Kinh nghiệm của chính bạn thực sự có ích với khách du lịch khác.</h5>
                    <h5>Xin cảm ơn!</h5>
                    <hr>
                    <form  class="form-group" style="width:100%" id="form-review" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 rate-select">
                                <span class="font-weight-bold" id="rate">Xếp hạng tổng thể của bạn về cơ sở lưu trú này</span><br>
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rate" value="5" /><label class = "full" for="star5" title="Tuyệt vời"></label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label class = "full" for="star4" title="Rất tốt"></label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label class = "full" for="star3" title="Trung bình"></label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label class = "full" for="star2" title="Tồi"></label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label class = "full" for="star1" title="Kinh khủng"></label>
                                </fieldset>
                                <span class="badge badge-pill badge-success ml-3 mt-3 show-title">Nhấp để xếp hạng</span>

                            </div>
                            <span class="text-danger error-text rate_err ml-4 mb-4"></span>
                            <input type="hidden" name="id_post" value="{{$post->id}}">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold" id='title'>Tiêu đề bài đánh giá của bạn</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Tóm tắt chuyến đi của bạn hoặc nêu bật một chi tiết thú vị">
                                     <span class="text-danger error-text title_err "></span>
                                </div>
                                <div class="form-group">
                                    <label for="comment" class="font-weight-bold" id="comment">Đánh giá của bạn</label>
                                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"
                                        placeholder="Chia sẻ với mọi người về trải nghiệm của bạn: phòng, địa điểm và tiện nghi?"></textarea>
                                        <span class="text-danger error-text comment_err "></span>
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold" id="trip_type">Loại chuyến đi đó là gì?</label>

                                    <div class="section mt-2">
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <input class="checkbox-tools" type="radio" name="trip_type" id="tool-1" value="Doanh nghiệp" >
                                                <label class="for-checkbox-tools" for="tool-1">
                                                    Doanh nghiệp
                                                </label>
                                                    <input class="checkbox-tools" type="radio" name="trip_type" id="tool-2" value="Cặp đôi">
                                                <label class="for-checkbox-tools" for="tool-2">
                                                    Cặp đôi
                                                </label>
                                                    <input class="checkbox-tools" type="radio" name="trip_type" id="tool-3" value="Gia đình">
                                                <label class="for-checkbox-tools" for="tool-3">
                                                    Gia đình
                                                </label>
                                                    <input class="checkbox-tools" type="radio" name="trip_type" id="tool-4" value="Bạn bè">
                                                <label class="for-checkbox-tools" for="tool-4">
                                                    Bạn bè
                                                </label>
                                                    <input class="checkbox-tools" type="radio" name="trip_type" id="tool-5" value="Một mình">
                                                <label class="for-checkbox-tools" for="tool-5">
                                                    Một mình
                                                </label>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text trip_type_err "></span>
                                    </div>
		
                                </div>

                                <div class="form-group">
                                    <label for="trip_when" class="font-weight-bold" id="trip_when">Bạn đã đi du lịch khi nào?</label>
                                    <div class="col-4 p-0">
                                        <select class="form-control" id="trip_when" name="trip_when" style="border: 1px solid;">
                                            <option value="">Chọn một</option>
                                            @for ($i = 0; $i < 12; $i++)
                                                {{-- <option value="{{ now()->year.'-'.$i }}">Tháng {{$i}} {{ now()->year }}</option> --}}
                                                <option value="{{ \Carbon\Carbon::today()->subMonths($i)->format('Y-m') }}">Tháng {{ \Carbon\Carbon::today()->subMonths($i)->format('m')}} {{  \Carbon\Carbon::today()->subMonths($i)->format('Y') }}</option>
                                            @endfor
                                        </select>
                                         <span class="text-danger error-text trip_when_err "></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h5>Bạn có thể kể một chút nữa về chuyến đi đó không?&nbsp;</h5><span>(tuỳ chọn)</span>
                                </div>
                                <hr>
                            </div>
                            <div class="col-12 mb-4">
                                <span>Chúng tôi thích ý kiến của bạn! Mọi thứ bạn có thể chia sẻ sẽ giúp những khách du lịch khác chọn Homestay - Resort hoàn hảo của họ. Cảm ơn bạn.</span><br>
                                <label for="trip_when" class="font-weight-bold mt-4">Phong cách và tiện nghi Homestay - Resort</label>

                                @forelse ($questions as $item)
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <span>{{ $item->question }}</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="section mt-2">
                                                <div class="row justify-content-center">
                                                    <div class="col-12">
                                                        <input class="checkbox-tools" type="radio" name="answer[{{$item->id}}]" id="answer-{{$item->id}}-1" value="Có">
                                                        <label class="for-checkbox-tools" for="answer-{{$item->id}}-1">
                                                            Có
                                                        </label>
                                                        <input class="checkbox-tools" type="radio" name="answer[{{$item->id}}]" id="answer-{{$item->id}}-2" value="Không">
                                                        <label class="for-checkbox-tools" for="answer-{{$item->id}}-2">
                                                            Không
                                                        </label>
                                                        <input class="checkbox-tools" type="radio" name="answer[{{$item->id}}]" id="answer-{{$item->id}}-3" value="Không chắc">
                                                        <label class="for-checkbox-tools" for="answer-{{$item->id}}-3">
                                                            Không chắc
                                                        </label>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                    </div>
                                    <hr>
                                @empty
                                    <h3>No data</h3>
                                @endforelse

                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold" id="trip_service trip_value trip_sleep">Xếp hạng loại Homestay - Resort</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row mb-2 mt-2">
                                            <div class="col-6 d-flex align-items-center justify-content-center" style="flex-direction: column">
                                                Dịch vụ
                                                <span class="text-danger error-text rate_service_err"></span>
                                            </div>
                                            <div class="col-6 ">
                                                 <fieldset class="rating">
                                                    <input type="radio" id="rate_service5" name="rate_service" value="5" /><label class = "full" for="rate_service5" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="rate_service4" name="rate_service" value="4" /><label class = "full" for="rate_service4" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="rate_service3" name="rate_service" value="3" /><label class = "full" for="rate_service3" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="rate_service2" name="rate_service" value="2" /><label class = "full" for="rate_service2" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="rate_service1" name="rate_service" value="1" /><label class = "full" for="rate_service1" title="Sucks big time - 1 star"></label>
                                                </fieldset>
                                               
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6 d-flex align-items-center justify-content-center" style="flex-direction: column">
                                                Giá trị
                                                <span class="text-danger error-text rate_value_err"></span>
                                            </div>
                                            <div class="col-6">
                                                 <fieldset class="rating">
                                                    <input type="radio" id="rate_value5" name="rate_value" value="5" /><label class = "full" for="rate_value5" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="rate_value4" name="rate_value" value="4" /><label class = "full" for="rate_value4" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="rate_value3" name="rate_value" value="3" /><label class = "full" for="rate_value3" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="rate_value2" name="rate_value" value="2" /><label class = "full" for="rate_value2" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="rate_value1" name="rate_value" value="1" /><label class = "full" for="rate_value1" title="Sucks big time - 1 star"></label>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6 d-flex align-items-center justify-content-center" style="flex-direction: column">
                                                Giấc ngủ
                                                   <span class="text-danger error-text rate_sleep_err"></span>
                                            </div>
                                            <div class="col-6">
                                                 <fieldset class="rating">
                                                    <input type="radio" id="rate_sleep5" name="rate_sleep" value="5" /><label class = "full" for="rate_sleep5" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="rate_sleep4" name="rate_sleep" value="4" /><label class = "full" for="rate_sleep4" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="rate_sleep3" name="rate_sleep" value="3" /><label class = "full" for="rate_sleep3" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="rate_sleep2" name="rate_sleep" value="2" /><label class = "full" for="rate_sleep2" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="rate_sleep1" name="rate_sleep" value="1" /><label class = "full" for="rate_sleep1" title="Sucks big time - 1 star"></label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Chia sẻ ảnh --}}
                                {{-- <div class="row">
                                    <div class="col-12">
                                        <label for="" class="font-weight-blod">Bạn có muốn chia sẻ ảnh</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="image-resize-filepond"  name="photo[]" data-max-file-size="3MB" data-file-metadata-foo="bar" multiple>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="note">

                                        </div>
                                    </div>
                                </div> --}}


                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold">Gửi đánh giá của bạn</label>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="ip-terms" name='terms'>
                                            <label class="custom-control-label" for="ip-terms" style="font-size: 13px" id="terms">
                                                Tôi chứng nhận rằng đánh giá này được dựa trên trải nghiệm riêng của tôi 
                                                và là ý kiến chân thực của tôi về khách sạn và rằng tôi không có mối liên hệ cá nhân hay kinh doanh nào với cơ sở này 
                                                và không được cơ sở tặng bất kỳ khoản khuyến khích hay thanh toán nào để viết đánh giá</label>
                                        </div>
                                          <span class="text-danger error-text terms_err"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary" id="send">Gửi đánh giá</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col md-3">
                   
                </div>
            </div>
        </div>

    </section>
    
@endsection

@section('script')
      <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>
   

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="{{ asset('dashboard/js/uploadfile.js') }}"></script>

    <script>
         var err;
        $('#send').click(function(e){
            e.preventDefault();
            let form = $('#form-review');
            var data = new FormData(form[0]);

             $.ajax({
                url: "{{ route('review.store') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(result.status){
                        if(err != null){
                            removeErrorMsg(err);     
                        }

                        window.location.href = "{{route('review.success')}}";
                    }
                    
                    console.log(result);

                },
                error: function(e){
                
                    removeErrorMsg(err);
                    err = e.responseJSON.errors; 
                    printErrorMsg(e.responseJSON.errors);
                }
            });
         
        });

        function printErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text(value);
                $('#'+key).css('color','red');
                $(window).scrollTop(0);
            });
        
        }
        
        function removeErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text('');
                $('#'+key).css('color','black');
            });
        
        }

        $('.full').click(function(){
            a = $(this).attr('title');
            $('.show-title').text(a);
            console.log(a);
        })
        
    </script>
@endsection