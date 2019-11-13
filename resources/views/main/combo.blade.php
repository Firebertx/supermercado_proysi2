@extends ('layouts.app')
@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>N</span>uestros
                <span>C</span>ombos</h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- product left -->
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">

                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Combos de nuestros distintos productos</h3>
                            <div class="row">

                                @foreach($combos as $combo)
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img height="150px" width="150px" class="img-thumbnail" src="{{asset('images/combos/'.$combo->image)}}" alt="{{$combo->image}}">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        @if($combo->id === 1)
                                                            <a href="{{url('/combo1')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 2)
                                                            <a href="{{url('/combo2')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 3)
                                                            <a href="{{url('/combo3')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 4)
                                                            <a href="{{url('/combo4')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 5)
                                                            <a href="{{url('/combo5')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 6)
                                                            <a href="{{url('/combo6')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @elseif($combo->id === 7)
                                                            <a href="{{url('/combo7')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver detalles</i> </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="product-new-top">Precio: {{$combo->price}} Bs.</span>
                                            </div>

                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <h4>{{$combo->name}}</h4>
                                                    </br>
                                                    <a>{{$combo->description}}</a>
                                                    <br> </br>
                                                </h4>
                                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <fieldset>
                                                        @if($combo->id === 1)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 2)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 3)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 4)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 5)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 6)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @elseif($combo->id === 7)
                                                            @include('/in_shopping_carts.form_package',['package'=>$combo])
                                                        @endif
                                                    </fieldset>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- //first section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection