@extends ('layouts.app')
@section('content')

    <!-- banner -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item item1 active">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Por esta temporada obten el
                                <span>10%</span> de descuento todos los días Lunes</p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">En tus compras de
                                <span>Carnes</span>
                            </h3>
                            <a class="button2" href="{{url('/promotions1')}}">Ver promoción</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item2">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Por esta temporada obten el
                                <span>15%</span> de descuento todos los días Martes</p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">En tus compras de
                                <span>Frutas y verduras</span>
                            </h3>
                            <a class="button2" href="{{url('/promotions2')}}">Ver promoción</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item3">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Por esta temporada obten el
                                <span>10%, 20% y 30%</span> de descuento todos los días Miercoles</p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">En tus compras de
                                <span>Panes y Lacteos</span>
                            </h3>
                            <a class="button2" href="{{url('/promotions3')}}">Ver promoción</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item4">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Por esta temporada obten el
                                <span>10%, 20%, 30% y 40%</span> de descuento todos los días Jueves</p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">En tus compras de
                                <span>Vinos y Bebidas</span>
                            </h3>
                            </h3>
                            <a class="button2" href="{{url('/promotions4')}}">Ver promoción</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    <!-- //banner -->

    <!-- top Products -->
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>T</span>odos
                <span>N</span>uestros
                <span>P</span>roductos</h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- product left -->
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">

                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Promociones</h3>
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

                        <!-- second section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Combos</h3>
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
                        <!-- //second section -->

                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Categorías </h3>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img height="150px" width="150px" class="img-thumbnail" src="{{Storage::url($category->image)}}">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        @if($category->id === 1)
                                                            <a href="{{url('/category1')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 2)
                                                            <a href="{{url('/category2')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 3)
                                                            <a href="{{url('/category3')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 4)
                                                            <a href="{{url('/category4')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 5)
                                                            <a href="{{url('/category5')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 6)
                                                            <a href="{{url('/category6')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 7)
                                                            <a href="{{url('/category7')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 8)
                                                            <a href="{{url('/category8')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 9)
                                                            <a href="{{url('/category9')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 10)
                                                            <a href="{{url('/category10')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 11)
                                                            <a href="{{url('/category11')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @elseif($category->id === 12)
                                                            <a href="{{url('/category12')}}"
                                                               class="link-product-add-cart"
                                                            ><i class="fa fa-eye">Ver Productos</i> </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="product-new-top">{{$category->id}}</span>
                                            </div>

                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a>{{$category->name}}</a>
                                                    <br> </br>
                                                </h4>
                                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <fieldset>
                                                        @if($category->id === 1)
                                                            <a href="{{url('/category1')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 2)
                                                            <a href="{{url('/category2')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 3)
                                                            <a href="{{url('/category3')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 4)
                                                            <a href="{{url('/category4')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 5)
                                                            <a href="{{url('/category5')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 6)
                                                            <a href="{{url('/category6')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 7)
                                                            <a href="{{url('/category7')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 8)
                                                            <a href="{{url('/category8')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 9)
                                                            <a href="{{url('/category9')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 10)
                                                            <a href="{{url('/category10')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 11)
                                                            <a href="{{url('/category11')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
                                                            </a>
                                                        @elseif($category->id === 12)
                                                            <a href="{{url('/category12')}}">
                                                                <input  type="submit" value="Ver Productos" class="button btn" />
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


                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    <!-- //top products -->
@endsection
