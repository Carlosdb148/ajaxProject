@extends('base')
@section('modalContent')

        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img src="{{ url('assets/img/product-img/product-1.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">Boutique Silk Dress</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">$120.99 <span>$130</span></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                            <a href="#">View Full Product Details</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <form class="cart" method="post">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>

                                        <div class="share_wf mt-30">
                                            <p>Share With Friend</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->
        @error('message')
            <div style="width:100%; " class="mt-100">
               <span class="alert alert-danger" style="width:300px; display:block; margin:0 auto; text-align:center">{{ $message }}</span>
            </div>
        @enderror
        
        @if(Auth::user())
            <?php $user = Auth::user() ?>
            @if($user->email == 'cadibe148@gmail.com')
                <div style="width:100%; " class="mt-100">
                    <div style=" margin:0 auto; width:200px; height:50px; ;background:#ff084e; display:flex; justify-content:center; align-items:center;">
                        <a href="{{ url( 'shop/create' ) }}" style="color:white;">CREATE PRODUCT</a>
                    </div>
                </div>
            @endif
        @endif

        <section class="shop_grid_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="shop_sidebar_area">
                            <form action="{{ $url ?? url('shop') }}">
                                <div class="input-group">
                                    <input value="{{$search ?? ''}}" type="text" name="q" value="{{ $q ?? '' }}" class="form-control" >
                                    <input type="hidden" name="orderby" value="{{ $orderby ?? '' }}">
                                    <input type="hidden" name="ordertype" value="{{ $ordertype ?? '' }}">
                                    <input type="hidden" name="ordercategory" value="{{ $ordercategory ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <button type="submit" class="search"><i style="color:red;" class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                           
                            <div class="widget catagory mb-50">
                                <!--  Side Nav  -->
                                <div class="nav-side-menu">
                                    <h6 class="mb-0 mt-50">Categories</h6>
                                    <div class="menu-list">
                                        <ul id="menu-content2" class="menu-content collapse out">
                                            <!-- Single Item -->
                                            <li >
                                                <a href="{{ $order[$orderby][$ordertype]['women'] }}">Woman wear</a>
                                            </li>
                                            <!-- Single Item -->
                                            <li >
                                                <a href="{{ $order[$orderby][$ordertype]['men'] }}">Man Wear</a>
                                            </li>
                                            <!-- Single Item -->
                                            <li>
                                                <a href="{{ $order[$orderby][$ordertype]['child'] }}">Children</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="widget price mb-50">
                                <h6 class="widget-title mb-30">Order by Price</h6>
                                <div class="widget-desc">
                                    <div class="menu-list">
                                        <ul id="menu-content2" class="menu-content collapse out">
                                            <!-- Single Item -->
                                            <li >
                                                <a href="{{ $order['price']['desc'][$ordercategory] }}">Expensive to Cheap</a>
                                            </li>
                                            <!-- Single Item -->
                                            <li >
                                                <a href="{{ $order['price']['asc'][$ordercategory] }}">Cheap to Expensive</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="widget size mb-50">
                                <h6 class="widget-title mb-30">Filter by Size</h6>
                                <div class="widget-desc">
                                    <ul class="d-flex justify-content-between">
                                        <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                    </ul>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="shop_grid_product_area">
                            <div class="row">
                                @foreach($shops as $shop)
                                <!-- Single gallery Item -->
                                <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="data:image/jpeg;base64,{{ $shop->thumbnail }}" alt="">
                                        <div class="product-quicview">
                                            <a href="{{ url('shop/'. $shop->id) }}" ><i class="ti-plus"></i></a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <h4 class="product-price">{{ $shop->price }}€</h4>
                                        <p>{{ $shop->name }}</p>
                                        <!-- Add to Cart -->
                                        <!--<a href="#" class="add-to-cart-btn">ADD TO CART</a>-->
                                        @if(Auth::user())
                                            @if(Auth::user()->email == 'cadibe148@gmail.com')
                                                <a href="{{ url('shop/' . $shop->id . '/edit') }}" class="add-to-cart-btn mt-3">EDIT</a>
                                                <a href="javascript: void(0);"
        			                                        class = "deleteRow add-to-cart-btn mt-3"
        			                                        data-name="{{ $shop->name }}"
        			                                        data-url="{{ url('shop/' . $shop->id ) }}"
        			                                        data-toggle="modal"
        			                                        data-target="#modalDelete"
        			                                        style="text-decoration:none; "><i class="fa fa-reply" aria-hidden="true"></i> DELETE</a>
			                                 @endif
			                             @endif
			                             
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        {{ $shops->onEachSide(2)->links() }}

                        

                    </div>
                </div>
            </div>
        </section>
        
<form action="" method="post" id="deleteForm">
            @csrf
            @method('delete')
        </form>        

    
@endsection