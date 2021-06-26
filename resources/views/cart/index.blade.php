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

          <div>
            <form class="form-horizontal" role="form" id="order-form">
              <div class="form-group row">
                <label class="col-form-label col-sm-3 text-md-right">選擇收件地址</label>
                <div class="col-sm-9 col-md-7">
                  <select class="form-control" name="address">
                    @foreach($addresses as $address)
                      <option value="{{ $address->id }}">{{ $address->full_address }} {{ $address->contact_name }} {{ $address->contact_phone }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-sm-3 text-md-right">備註</label>
                <div class="col-sm-9 col-md-7">
                  <textarea name="remark" class="form-control" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="offset-sm-3 col-sm-3">
                  <button type="button" class="btn btn-primary btn-create-order">送出訂單</button>
                </div>
              </div>
            </form>
          </div>

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

      $('.btn-create-order').click(function () {
        let req = {
          address_id: $('#order-form').find('select[name=address]').val(),
          items: [],
          remark: $('#order-form').find('textarea[name=remark]').val(),
        };
        $('table tr[data-id]').each(function () {
          let $input = $(this).find('input[name=amount]');
          if ($input.val() === 0 || isNaN($input.val())) {
            return;
          }
          req.items.push({
            sku_id: $(this).data('id'),
            amount: $input.val(),
          })
        });
        axios.post('{{ route('orders.store') }}', req)
          .then(function (response) {
            swal('成功送出訂單', '', 'success');
          }, function (error) {
            if (error.response.status === 422) {
              let html = '<div>';
              _.each(error.response.data.errors, function (errors) {
                _.each(errors, function (error) {
                  html += error+'<br>';
                })
              });
              html += '</div>';
              swal({content: $(html)[0], icon: 'error'})
            } else {
              swal('系統錯誤', '', 'error');
            }
          });
      });
    });
  </script>
@endsection
