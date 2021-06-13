@extends('layouts.app')
@section('title', '商品列表')

@section('content')
  <div class="row">
    <div class="col-lg-10 offset-lg-1">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('products.index') }}" class="search-form">
            <div class="form-row">
              <div class="col-md-9">
                <div class="form-row">
                  <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜尋"></div>
                  <div class="col-auto"><button class="btn btn-primary btn-sm">搜尋</button></div>
                </div>
              </div>
              <div class="col-md-3">
                <select name="order" class="form-control form-control-sm float-right">
                  <option value="">排序方式</option>
                  <option value="price_asc">價格從低到高</option>
                  <option value="price_desc">價格從高到低</option>
                  <option value="sold_count_desc">銷量從高到低</option>
                  <option value="sold_count_asc">銷量從低到高</option>
                  <option value="rating_desc">評價從高到低</option>
                  <option value="rating_asc">評價從低到高</option>
                </select>
              </div>
            </div>
          </form>
          <div class="row products-list">
            @foreach($products as $product)
              <div class="col-3 product-item">
                <div class="product-content">
                  <div class="top">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                      <img src="{{ $product->image_url }}" alt="">
                    </a>
                    <div class="price"><b>$</b>{{ $product->price }}</div>
                    <div class="title">
                      <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
                    </div>
                  </div>
                  <div class="bottom">
                    <div class="sold_count">已售出 <span>{{ $product->sold_count }}個</span></div>
                    <div class="review_count">評價 <span>{{ $product->review_count }}</span></div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="float-right">{{ $products->appends($filters)->render() }}</div>
        </div>
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
    })
  </script>
@endsection