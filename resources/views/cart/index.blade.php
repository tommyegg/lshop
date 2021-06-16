@extends('layouts.app')
@section('title', '購物車')

@section('content')
  <div class="row">
    <div class="col-lg-10 offset-lg-1">
      <div class="card">
        <div class="card-header">我的購物車</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
            <tr>
              <th></th>
              <th>商品名稱</th>
              <th>售價</th>
              <th>數量</th>
            </tr>
            </thead>
            <tbody class="product_list">
            @foreach($cartItems as $item)
              <tr data-id="{{ $item->productSku->id }}">
                <td class="delete-icon">
                  <a><i class="far fa-trash-alt btn-remove"></i></a>
                </td>
                <td class="product_info">
                  <div @if(!$item->productSku->product->on_sale) class="not_on_sale" @endif>
              <span class="product_title">
                <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">{{ $item->productSku->product->title }}</a>
              </span>
                    <span class="sku_title">{{ $item->productSku->title }}</span>
                    @if(!$item->productSku->product->on_sale)
                      <span class="warning">該商品已下架</span>
                    @endif
                  </div>
                </td>
                <td><span class="price">${{ $item->productSku->price }}</span></td>
                <td>
                  <input type="text" class="form-control form-control-sm amount" @if(!$item->productSku->product->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scriptsAfterJs')
  <script>
    $(document).ready(function () {
      $('.btn-remove').click(function () {
        let id = $(this).closest('tr').data('id');
        swal({
          title: "確定要刪除這個商品嗎？",
          icon: "warning",
          buttons: ['取消', '確定'],
          dangerMode: true,
        })
          .then(function(willDelete) {
            if (!willDelete) {
              return;
            }
            axios.delete('/cart/' + id)
              .then(function () {
                location.reload();
              })
          });
      });
    });
  </script>
@endsection
