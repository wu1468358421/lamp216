@extends('admin.layout.index')
@section('css')
<style>
    #page_page ul,#page_page li{
        margin:0;
        padding:0;
        list-style-type: none;
    }

    #page_page a, #page_page span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
#page_page .active span{
    background:#40959d;
    color:#fff;
}
</style>
@endsection
@section('content')
<form action="/admin/goods" method="get" class="form-inline" style="margin:20px;">
  <div class="form-group" style="display: inline-block;">
    <label for="exampleInputName2">商品名:</label>
    <input type="text" name="search_title" class="form-control" id="exampleInputName2" placeholder="关键字" value="{{ $params['search_title'] or '' }}">
  </div>
  
  <input type="submit" class="btn btn-info" value="搜索">
</form>
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> Simple Table</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品名称</th>
                    <th>商品图片</th>
                    <th>商品描述</th>
                    <th>价格</th>
                    <th>库存</th>
                    <th>点击量</th>
                    <th>商品编号</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($goods_data as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->title }}</td>
                    <td>
                    	<img src="/uploads/{{ $v->img }}" alt="" style="width: 70px;">
                    </td>
                    <td>{{ $v->desc }}</td>
                    <td>{{ $v->price }}</td>
                    <td>{{ $v->num }}</td>
                    <td>{{ $v->pv }}</td>
                    <td>{{ $v->pro_no }}</td>
                    <td>{{  date('Y-m-d H:i:s',$v->add_time ) }}</td>
                    <td>
                    	<a href="/admin/goods/{{ $v->id }}/edit">修改</a>
                    	<form action="/admin/goods/{{ $v->id }}" method="post">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input type="submit" value="删除" class="btn btn-danger">
						
						</form>
                    </td>
                </tr>
            @endforeach 
            </tbody>
        </table>

        <div id="page_page">

            {{ $goods_data->appends($params)->links() }}

        </div>

    </div>
</div>

@endsection