@extends('layouts.main')
@section('title','Chuyến đi')

@section('head')


    <link rel="stylesheet" href="{{ asset('main/css/tab2.css') }}">
    <style>
       .btn-status {
            outline: none !important;
            box-shadow: none !important;
            }

    </style>
@endsection

@section('content')
     <div class="heading-page header-text">
      {{-- <section class="page-heading">
        <div class="container">
          
        </div>
      </section> --}}
    </div>
  
    <div class="main-banner header-text mt-2">
        <div class="container" >
           

            
            {{-- <div class="page">
                <h1>Chuyến đi</h1>			
        
                
                <!-- tabs -->
                <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                    <input type="radio" name="pcss3t" checked  id="tab1"class="tab-content-first">
                    <label for="tab1">Tất cả chuyến đi</label>
                    
                    <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                    <label for="tab2">Chuyến đi riêng tư</label>
                    
                    <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                    <label for="tab3">Chuyến đi công khai</label>
                    
                    <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
                    <label for="tab5">Mục đã lưu của tôi</label>
                    
                    <ul>
                        <li class="tab-content tab-content-first typography">
                           <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                        <div class="card">
                                            <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" alt="Vans">
                                            <div class="card-img-overlay d-flex justify-content-end">
                                            <a href="#" class="card-link text-danger like">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            </div>
                                            <div class="card-body">
                                            <h4 class="card-title">Vans Sk8-Hi MTE Shoes</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                                            <p class="card-text">
                                                The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool.             </p>
                                            <div class="options d-flex flex-fill">
                                                <select class="custom-select mr-1">
                                                    <option selected>Color</option>
                                                    <option value="1">Green</option>
                                                    <option value="2">Blue</option>
                                                    <option value="3">Red</option>
                                                </select>
                                                <select class="custom-select ml-1">
                                                    <option selected>Size</option>
                                                    <option value="1">41</option>
                                                    <option value="2">42</option>
                                                    <option value="3">43</option>
                                                </select>
                                            </div>
                                            <div class="buy d-flex justify-content-between align-items-center">
                                                <div class="price text-success"><h5 class="mt-4">$125</h5></div>
                                                <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                        <div class="card">
                                            <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" alt="Vans">
                                            <div class="card-img-overlay d-flex justify-content-end">
                                            <a href="#" class="card-link text-danger like">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            </div>
                                            <div class="card-body">
                                            <h4 class="card-title">Vans Sk8-Hi MTE Shoes</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                                            <p class="card-text">
                                                The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool.             </p>
                                            <div class="options d-flex flex-fill">
                                                <select class="custom-select mr-1">
                                                    <option selected>Color</option>
                                                    <option value="1">Green</option>
                                                    <option value="2">Blue</option>
                                                    <option value="3">Red</option>
                                                </select>
                                                <select class="custom-select ml-1">
                                                    <option selected>Size</option>
                                                    <option value="1">41</option>
                                                    <option value="2">42</option>
                                                    <option value="3">43</option>
                                                </select>
                                            </div>
                                            <div class="buy d-flex justify-content-between align-items-center">
                                                <div class="price text-success"><h5 class="mt-4">$125</h5></div>
                                                <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                        <div class="card">
                                            <img class="card-img" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" alt="Vans">
                                            <div class="card-img-overlay d-flex justify-content-end">
                                            <a href="#" class="card-link text-danger like">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            </div>
                                            <div class="card-body">
                                            <h4 class="card-title">Vans Sk8-Hi MTE Shoes</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                                            <p class="card-text">
                                                The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool.             </p>
                                            <div class="options d-flex flex-fill">
                                                <select class="custom-select mr-1">
                                                    <option selected>Color</option>
                                                    <option value="1">Green</option>
                                                    <option value="2">Blue</option>
                                                    <option value="3">Red</option>
                                                </select>
                                                <select class="custom-select ml-1">
                                                    <option selected>Size</option>
                                                    <option value="1">41</option>
                                                    <option value="2">42</option>
                                                    <option value="3">43</option>
                                                </select>
                                            </div>
                                            <div class="buy d-flex justify-content-between align-items-center">
                                                <div class="price text-success"><h5 class="mt-4">$125</h5></div>
                                                <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </li>
                        
                        <li class="tab-content tab-content-2 typography">
                            <h1>Leonardo da Vinci</h1>
                            <p>Italian Renaissance polymath: painter, sculptor, architect, musician, mathematician, engineer, inventor, anatomist, geologist, cartographer, botanist, and writer. His genius, perhaps more than that of any other figure, epitomized the Renaissance humanist ideal. Leonardo has often been described as the archetype of the Renaissance Man, a man of "unquenchable curiosity" and "feverishly inventive imagination". He is widely considered to be one of the greatest painters of all time and perhaps the most diversely talented person ever to have lived. According to art historian Helen Gardner, the scope and depth of his interests were without precedent and "his mind and personality seem to us superhuman, the man himself mysterious and remote". Marco Rosci states that while there is much speculation about Leonardo, his vision of the world is essentially logical rather than mysterious, and that the empirical methods he employed were unusual for his time.</p>
                            <p class="text-right"><em>Find out more about Leonardo da Vinci from <a href="http://en.wikipedia.org/wiki/Leonardo_da_Vinci" target="_blank">Wikipedia</a>.</em></p>
                        </li>
                        
                        <li class="tab-content tab-content-3 typography">
                            <h1>Albert Einstein</h1>
                            <p>German-born theoretical physicist who developed the general theory of relativity, one of the two pillars of modern physics (alongside quantum mechanics). While best known for his mass–energy equivalence formula E = mc2 (which has been dubbed "the world's most famous equation"), he received the 1921 Nobel Prize in Physics "for his services to theoretical physics, and especially for his discovery of the law of the photoelectric effect". The latter was pivotal in establishing quantum theory.</p>
                            <p>Near the beginning of his career, Einstein thought that Newtonian mechanics was no longer enough to reconcile the laws of classical mechanics with the laws of the electromagnetic field. This led to the development of his special theory of relativity. He realized, however, that the principle of relativity could also be extended to gravitational fields, and with his subsequent theory of gravitation in 1916, he published a paper on the general theory of relativity.</p>
                            <p class="text-right"><em>Find out more about Albert Einstein from <a href="http://en.wikipedia.org/wiki/Albert_Einstein" target="_blank">Wikipedia</a>.</em></p>				
                        </li>
                        
                        <li class="tab-content tab-content-last typography">
                            <div class="typography">
                                <h1>Isaac Newton</h1>
                                <p>English physicist and mathematician who is widely regarded as one of the most influential scientists of all time and as a key figure in the scientific revolution. His book Philosophiæ Naturalis Principia Mathematica ("Mathematical Principles of Natural Philosophy"), first published in 1687, laid the foundations for most of classical mechanics. Newton also made seminal contributions to optics and shares credit with Gottfried Leibniz for the invention of the infinitesimal calculus.</p>
                                <p>Newton's Principia formulated the laws of motion and universal gravitation that dominated scientists' view of the physical universe for the next three centuries. It also demonstrated that the motion of objects on the Earth and that of celestial bodies could be described by the same principles. By deriving Kepler's laws of planetary motion from his mathematical description of gravity, Newton removed the last doubts about the validity of the heliocentric model of the cosmos.</p>
                            <p class="text-right"><em>Find out more about Isaac Newton from <a href="http://en.wikipedia.org/wiki/Isaac_Newton" target="_blank">Wikipedia</a>.</em></p>		
                            </div>
                        </li>
                    </ul>
                </div>
            </div> --}}

        </div>
    </div>

    <section class="blog-posts">
        <div class="container" >
            <h2>Chuyến đi</h2>
           
            <div class="row">
                {{-- <div class="col-1"></div> --}}
                <div class="col-10 d-flex select-status">
                    <button type="button" class="btn btn-outline-dark btn-status  btn-sm mr-1 active" data-status = '3'>Tất cả chuyến đi</button>
                    <button type="button" class="btn btn-outline-dark btn-status  btn-sm mr-1" data-status = '0'>Chuyến đi riêng tư</button>
                    <button type="button" class="btn btn-outline-dark btn-status  btn-sm mr-1" data-status = '1'>Chuyến đi công khai</button>
                    <button type="button" class="btn btn-outline-dark btn-status  btn-sm mr-1" data-status='4'>Mục đã lưu của tôi</button>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row mt-2">

                {{-- <div class="col-md-1"></div> --}}
                <div class="col-md-12">
                    <div class="row list-travel">

                            @include('web.travel.list-travel')
                  
                    </div>
                </div>
                {{-- <div class="col-md-1"></div> --}}

                
            </div>
          
        </div>
    </section>
    
<div class="modal fade" id="modal-create-travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-heart-o" aria-hidden="true"></i> Tạo một chuyến đi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="form-create-travel">
            @csrf
            <div class="modal-body">
                <div class="container">
                    
                        <div class="form-group">
                            <label for="title">Tên chuyến đi</label>
                            <input type="text" class="form-control" name="title" id="title"  value="">
                            <span class="text-danger error-text title_err"></span>
                        </div>
                        <p>Chọn những người có thể thấy Chuyến đi của bạn</p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="private" name="status" class="custom-control-input" value="0" checked="">
                            <label class="custom-control-label" for="private">
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center mr-3">
                                        <div class="icon-status-modal">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <p><strong class="text-dark">Riêng tư</strong></p>
                                        <p style="line-height: 1.2;">Không hiển thị với người dùng và thành viên TripReview khác, trừ bạn và bạn bè được chia sẻ Chuyến đi.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        <div class="custom-control custom-radio mt-3">
                            <input type="radio" id="public" name="status" class="custom-control-input" value="1" >
                            <label class="custom-control-label" for="public">
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center mr-3">
                                        <div class="icon-status-modal">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <p><strong class="text-dark">Công khai</strong></p>
                                        <p style="line-height: 1.2;">Hiển thị với mọi khách du lịch trên TripReview, bao gồm mọi bạn bè được bạn chia sẻ Chuyến đi</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" type="submit" class="btn btn-primary btn-create-travel" disabled>Tạo</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

@section('script')
   
    <script>
        var status=2;
        $('.btn-status').click(function(){
            $(this).closest('.select-status').find('.active').removeClass('active');
            $(this).addClass('active');
            status = $(this).data('status');
            // loadPage();
        })

        
        function loadPage(){
            $.ajax({
                url: "{{route('travel')}}",
                type: "GET",
                data: {
                    'status' : status,
                },
                success: function(result){
                    $('.list-travel').html(result);
                }
            })
        }

        $('#modal-create-travel').on('shown.bs.modal', function () {
            let title = $('#title').focus();
        })

        $("#title").keyup(function() {
            if($(this).val() != '' ){
                $('.btn-create-travel').attr('disabled', false);;
            }else{
                $('.btn-create-travel').attr('disabled', true);;
            }
        });


        var err;
        $('.btn-create-travel').click(function(e){
            e.preventDefault();
            let form = $('#form-create-travel');
            let data = new FormData(form[0]);
            
            $.ajax({
                url: "{{ route('travel.store') }}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
                    if(err != null){
                        removeErrorMsg(err);     
                    }      
                    if(result.status){
                        $('#modal-create-travel').modal('hide');
                        $('#title').val('');
                        $("input[name=status][value=" + 0 + "]").prop('checked', true);
                        loadPage();

                    }else{
                        console.log(result.mess);
                    }
                 
                },
                error: function(e){
                    console.log(e);
                    removeErrorMsg(err);
                    printErrorMsg(e.responseJSON.errors);
                }

            })
        })

        function printErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text(value);
            });
            
        
        }
        
        function removeErrorMsg (msg) {
            
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text('');
            });
        
        }
    </script>

@endsection