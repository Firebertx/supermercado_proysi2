@extends ('layouts.app')
@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>N</span>uestras
                <span>P</span>romociones</h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- product left -->
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">

                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Promociones con distintos descuentos</h3>
                            <div class="row">

                                @foreach($promotions as $promotion)
                                <div class="col-md-4 product-men mt-5">
                                    <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item text-center">
                                            <img height="150px" width="150px" class="img-thumbnail" src="{{asset('images/promotions/'.$promotion->image)}}" alt="{{$promotion->image}}">
                                            <div class="men-cart-pro">
                                                <div class="inner-men-cart-pro">
                                                    @if($promotion->id === 1)
                                                        <a href="{{url('/promotions1')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 2)
                                                        <a href="{{url('/promotions2')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 3)
                                                        <a href="{{url('/promotions3')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 4)
                                                        <a href="{{url('/promotions4')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 5)
                                                        <a href="{{url('/promotions5')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 6)
                                                        <a href="{{url('/promotions6')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @elseif($promotion->id === 7)
                                                        <a href="{{url('/promotions7')}}"
                                                           class="link-product-add-cart"
                                                        ><i class="fa fa-eye">Ver promociones</i> </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="product-new-top">Nuevo</span>
                                        </div>

                                        <div class="item-info-product text-center border-top mt-4">
                                            <h4 class="pt-1">
                                                <a>{{$promotion->name}}</a>
                                                <br></br>
                                            </h4>
                                            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                <fieldset>
                                                    @if($promotion->id === 1)
                                                            <a href="{{url('/promotions1')}}">
                                                                <input  type="submit" value="Ver promociones" class="button btn" />
                                                            </a>
                                                    @elseif($promotion->id === 2)
                                                        <a href="{{url('/promotions2')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
                                                    @elseif($promotion->id === 3)
                                                        <a href="{{url('/promotions3')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
                                                    @elseif($promotion->id === 4)
                                                        <a href="{{url('/promotions4')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
                                                    @elseif($promotion->id === 5)
                                                        <a href="{{url('/promotions5')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
                                                    @elseif($promotion->id === 6)
                                                        <a href="{{url('/promotions6')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
                                                    @elseif($promotion->id === 7)
                                                        <a href="{{url('/promotions7')}}">
                                                            <input  type="submit" value="Ver promociones" class="button btn" />
                                                        </a>
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