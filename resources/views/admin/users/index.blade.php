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

<form action="/admin/users" method="get" class="form-inline" style="margin:20px;">
  <div class="form-group" style="display: inline-block;">
    <label for="exampleInputName2">用户名:</label>
    <input type="text" name="search_uname" class="form-control" id="exampleInputName2" placeholder="关键字" value="{{ $params['search_uname'] or '' }}">
  </div>
  <div class="form-group" style="display: inline-block;margin-left: 10px;">
    <label for="exampleInputEmail2">邮箱:</label>
    <input type="text" name="search_email" class="form-control" id="exampleInputEmail2" placeholder="关键字" value="{{ $params['search_email'] or '' }}">
  </div>
  <input type="submit" class="btn btn-info" value="搜索">
</form>
<!-- <form action="/admin/users" method="get">
	用户名：<input type="text" name="search_uname" value="">

	邮箱：<input type="text" name="search_email" value="">
	<input type="submit" class="btn btn-info">
</form> -->
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 用户列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>手机号</th>
                    <th>头像</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->uname }}</td>
                    <td>{{ $v->email }}</td>
                    <td>{{ $v->phone }}</td>
                    <td>
                    	<img src="/uploads/{{ $v->userinfo->profile }}" style="width: 65px;">
                    </td>
                    <td>{{ $v->created_at }}</td>
                    <td>
						<a href="/admin/users/{{ $v->id }}/edit" class="btn btn-wraning">修改</a>
						<form action="/admin/users/{{ $v->id }}" method="post">
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

        	{{ $users->appends($params)->links() }}

        </div>
    </div>
</div>
@endsection