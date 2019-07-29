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
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="/layui/layui.js"></script>
@endsection
@section('content')
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer;
  
 
});
</script> 
<form action="/admin/goods" method="get" class="form-inline" style="margin:20px;">
  <div class="form-group" style="display: inline-block;">
    <label for="exampleInputName2">商品名:</label>
    <input type="text" name="bname" class="form-control" id="exampleInputName2" placeholder="关键字" value="{{ $params['bname'] or '' }}">
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
                    <th>品牌名</th>
                    <th>品牌图标</th>
                    <th>品牌简述</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $k=>$v)
                <tr id="{{ $v->id }}">
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->bname }}</td>
                    <td>
                    	<img src="/uploads/{{ $v->img }}" alt="" style="width: 70px;">
                    </td>
                    <td>{{ $v->desc }}</td>
                    <td>
                        <a href="/admin/brand/{{ $v->id }}/edit" class="btn btn-success">修改</a>
                        <!-- <a href="javascript:;"  onclick="create(this)" id="{{ $v->id }}" class="btn btn-success">修改</a> -->
                        <a href="javascript:;" onclick="del('{{ $v->id }}')" class="btn btn-danger">删除</a>
                    </td>
            
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="page_page">

            {{ $data->appends($params)->links() }}
      
        </div>

    </div>
</div>
<!-- 删除 -->
<script type="text/javascript">

    function del(a)
    {
        //获取id值
        let id = $('.btn-danger').attr('id');
        // console.log($('.btn-danger').parents().parents('tr').remove());
        confirm_ = confirm('你将删除此数据! 你确定吗?');

        if(confirm_){
            $.ajax({
                type:'delete',
                url:"/admin/brand/"+a+"?_token={{csrf_token()}}",
                // data:id,
                dataType:"json",
                success:function(msg){
                    if(msg.msg == 'success'){
                        layer.msg(msg.info,{time: 2000});
                        
                        $('#'+a).remove();
                    }else{
                        layer.msg(msg.info,{time: 2000});
                    }

                },
                error:function(msg){
                    console.log(msg);
                }
            });
        }
        
        window.location.href="/admin/brand/";
    }
    
</script>
@endsection