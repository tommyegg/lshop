@extends('layouts.app')
@section('title', '商品列表')

@section('content')
  <div class="products-index-page">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('products.index') }}" class="search-form">
          <div class="product-list-header">
            <div class="product-list-header-item">
              <select name="order" class="form-control">
                <option value="">排序方式</option>
                <option value="price_asc">價格從低到高</option>
                <option value="price_desc">價格從高到低</option>
                <option value="sold_count_desc">銷量從高到低</option>
                <option value="sold_count_asc">銷量從低到高</option>
                <option value="rating_desc">評價從高到低</option>
                <option value="rating_asc">評價從低到高</option>
              </select>
            </div>
            <div class="product-list-header-item">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="請輸入商品名稱" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary search-product-btn" type="button">搜尋</button>
                </div>
              </div>
            </div>
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
        <div class="products-page">{{ $products->appends($filters)->render() }}</div>
      </div>
    </div>
  </div>
@endsection

@section('scriptsAfterJs')
  <script>
    let filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
      $('.search-form input[name=search]').val(filters.search);
      $('.search-form select[name=order]').val(filters.order);
      $('.search-form select[name=order]').on('change', function() {
        $('.search-form').submit();
      });
      $('.search-product-btn').on('click', function() {
        $('.search-form').submit();
      });
    })
  </script>
@endsection
