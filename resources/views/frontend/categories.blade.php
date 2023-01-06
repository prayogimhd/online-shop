@extends('layouts.frontend.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend') }}/images/bg.jpg);">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('shop') }}">All</a></li>
                        @php $url = request()->url(); @endphp
                        @foreach ($all_categories as $item)
                            <li><a href="{{ route('categories', $item->slug) }}"
                                    class="@if (route('categories', $item->slug) === request()->url()) active @endif">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="row showcategories">
                    @foreach ($data as $d)
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product" id="showproduct">
                                <a href="javascript:void(0)" class="img-prod" id="details"
                                    data-url="{{ route('details', $d->id) }}"
                                    data-img="{{ asset('backend/products/' . $d->thumbnails) }}"><img
                                        class="img-fluid" src="{{ asset('backend/products/' . $d->thumbnails) }}">
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="javascript:void(0)">{{ $d->product_name }}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span>{{ rupiah($d->price) }}</span></p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            <a href="javascript:void(0)" id="buynow"
                                                data-url="{{ route('details', $d->id) }}"
                                                data-img="{{ asset('backend/products/' . $d->thumbnails) }}"
                                                class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                            <form action="{{ route('wishlist.store') }}" method="POST" id="wishlists">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $d->id }}">
                                                <a href="javascript:void(0)"
                                                    onclick="this.closest('form').submit();return false;"
                                                    class="heart d-flex justify-content-center align-items-center ">
                                                    <span><i class="ion-ios-heart"></i></span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $data->links('custom') }}
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="detailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailLabel">Detail Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('carts.store') }}" method="POST">
                        @csrf
                        <div class="align-content-center text-center align-items-center">
                            <img id="products_img" src="" height="70%" width="70%"></img>
                            <hr>
                            <h4><span id="name"></span></h4>
                            <h5>Rp. <span id="price"></span> | <small id="weight"></small></h5>
                            <p><span id="descriptions"></span></p>
                            <div class="row mt-4">
                                <div class="col-md-3"></div>
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn" data-type="minus"
                                            data-field="">
                                            <i class="ion-ios-remove"></i>
                                        </button>
                                    </span>
                                    <input type="hidden" name="product_id" value="" id="product_id">
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number"
                                        value="1" min="1" max="100" style="text-align:center">
                                    <span class="input-group-btn ml-2">
                                        <button type="button" class="quantity-right-plus btn" data-type="plus"
                                            data-field="">
                                            <i class="ion-ios-add"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <a href="javascript:void(0)" onclick="this.closest('form').submit();return false;"
                                    class="btn btn-primary py-3 px-4">Add to cart</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
        <div class="container py-4">
            <div class="row d-flex justify-content-center py-5">
                <div class="col-md-6">
                    <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                    <span>Get e-mail updates about our latest shops and special offers</span>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" placeholder="Enter email address">
                            <input type="submit" value="Subscribe" class="submit px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
