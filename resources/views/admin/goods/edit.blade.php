@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Inline Form</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/goods/{{ $data->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">商品名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="title" value="{{ $data->title }}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品价格</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="price" value="{{ $data->price }}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品库存</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="num" value="{{ $data->num }}">
                    </div>
                </div>
                <div class="mws-form-row" style="width: 900px;">

                    <label class="mws-form-label"></label>
                    
                    <div class="mws-form-item">
                        <img src="/uploads/{{ $data->img }}" alt="" style="width:300px;">
                    </div>
                </div>
                
                <div class="mws-form-row" style="width: 900px;">

                    <label class="mws-form-label">商品主图</label>
                    <div class="mws-form-item">
                        <input type="file" class="small" name="img">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品描述</label>
                    <div class="mws-form-item">
                        <textarea rows="" cols="" class="large" name="desc">{{ $data->desc }}</textarea>
                    </div>
                </div>
                
            </div>
            <div class="mws-button-row">
                <input type="submit" value="Submit" class="btn btn-danger">
                <input type="reset" value="Reset" class="btn">
            </div>
        </form>
    </div>      
</div>
@endsection