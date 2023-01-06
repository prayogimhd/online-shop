@extends('layouts.frontend.app')
@section('content')
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>My Wishlist</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $item)
                                    <tr class="text-center">
                                        <td class="product-remove"><a href="{{ route('wishlist.delete', $item->id) }}"><span
                                                    class="ion-ios-close"></span></a></td>
                                        <td class="image-prod">
                                            <img class="img"
                                                src="{{ asset('backend/products/' . $item->products->thumbnails) }}"></img>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{ $item->products->product_name }}</h3>
                                            <p>{{ $item->products->product_descriptions }}</p>
                                        </td>
                                    </tr><!-- END TR-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
