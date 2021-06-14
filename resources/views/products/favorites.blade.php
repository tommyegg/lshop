@extends('layouts.app')
@section('title', '我的收藏')

@section('content')
    <div class="card">
      <div class="card-header">我的收藏</div>
      <div class="card-body">
        <form action="{{ route('products.index') }}">
          <div class="product-list-header">
          </div>
        </form>
        <div class="products-list">
          @foreach($products as $product)
            <div class="product-item">
              <div class="product-content">
                <div class="product-img">
                  <a href="{{ route('products.show', ['product' => $product->id]) }}">
                    <img src="{{ $product->image_url }}" alt="">
                  </a>
                </div>
                <div class="title">
                  <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
                </div>
                <div class="price"><b>$</b>{{ $product->price }}</div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="products-page">{{ $products->render() }}</div>
      </div>
    </div>
@endsection
