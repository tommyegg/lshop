@extends('layouts.app')
@section('title', ($address->id ? '修改': '新增') . '收件地址')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-lg-1">
      <div class="card">
        <div class="card-header">
          <h2 class="text-center">
            {{ $address->id ? '修改': '新增' }}收件地址
          </h2>
        </div>
        <div class="card-body">
          <!-- if error from backend start-->
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <h4>錯誤：</h4>
              <ul>
                @foreach ($errors->all() as $error)
                  <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif
        <!-- if error backend end -->
          <user-addresses-create-and-edit inline-template>
            @if($address->id)
              <form class="form-horizontal" role="form" action="{{ route('user_addresses.update', ['user_address' => $address->id]) }}" method="post">
                {{ method_field('PUT') }}
            @else
              <form class="form-horizontal" role="form" action="{{ route('user_addresses.store') }}" method="post">
            @endif

            {{ csrf_field() }}
              <select-district :init-value="{{ json_encode([old('city', $address->city), old('district', $address->district)]) }}" @change="onDistrictChanged" inline-template>

                <div class="form-group row">

                  <label class="col-form-label col-sm-2 text-md-right">縣市鄉鎮</label>
                  <div class="col-sm-3">
                    <select class="form-control" v-model="cityId">
                      <option value="">請選擇縣市</option>
                      <option v-for="(name, id) in cities" :value="id">@{{ name }}</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-control" v-model="districtId">
                      <option value="">請選擇鄉鎮</option>
                      <option v-for="(name, id) in districts" :value="id">@{{ name }}</option>
                    </select>
                  </div>
                </div>
              </select-district>
              <input type="hidden" name="city" v-model="city">
              <input type="hidden" name="district" v-model="district">
              <div class="form-group row">
                <label class="col-form-label text-md-right col-sm-2">詳細地址</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="address" value="{{ old('address', $address->address) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label text-md-right col-sm-2">郵遞區號</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="zip" value="{{ old('zip', $address->zip) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label text-md-right col-sm-2">姓名</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name', $address->contact_name) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label text-md-right col-sm-2">電話</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone', $address->contact_phone) }}">
                </div>
              </div>
              <div class="form-group row text-center">
                <div class="col-12">
                  <a href="{{ route('user_addresses.index') }}" class="btn btn-secondary">返回</a>
                  <button type="submit" class="btn btn-primary">儲存</button>
                </div>
              </div>
            </form>
          </user-addresses-create-and-edit>
        </div>
      </div>
    </div>
  </div>
@endsection
