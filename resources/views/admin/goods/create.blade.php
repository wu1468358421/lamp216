@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Inline Form</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/goods" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">商品名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="title">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品价格</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="price">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品库存</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name="num">
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
                        <textarea rows="" cols="" class="large" name="desc"></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">所属分类</label>
                    <div class="mws-form-item" id="cateChoice">

                        <select  name="gimg">
                            <option value="0">默认</option>
                            <option value="1">图片展示</option>
                            <option value="2">轮播展示</option>    
                           
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">所属分类</label>
                    <div class="mws-form-item" id="cateChoice">

                        <select  name="pid[]">
                            <option value="">请选择</option>
                                @foreach($cates as $k=>$v)
                                @if($v->pid == 0)
                                <option value="{{ $v->id }}"  change="d">{{ $v->cname }}</option>
                                @endif
                                @endforeach
                        </select>
                        <select  name="pid[]">
                            <option value="">请选择</option>
                            
                                
                           
                        </select>
                        <select  name="pid[]">
                            <option value="">请选择</option>
                            
                                
                           
                        </select>
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
<script type="text/javascript">
    $('#cateChoice select').on('change', function(){
        let val = $(this).val();
        let list = getList(val);
        let index = $(this).index();
        let selects =  $(this).parent().find('select');
        $.each(selects, function(k, v){
            // console.log(k);
            // console.log(index);

            if (k >= index) {
                let html = '<option value="">请选择</option>';
                if (k == index) {
                    for (var i = 0; i < list.length; i++) {
                        html += '<option value="'+list[i].id+'">'+list[i].cname+'</option>';
                    }
                }
                selects.eq(k + 1).html(html);
            }
        });
        // // console.log(index);
        
       
        // // let html = '<option value="">请选择</option>';
        // // for (var i = 0; i < list.length; i++) {
        // //     html+= '<option value="'+list[i].id+'">'+list[i].cname+'</option>';
        // // }
        // $(this).parent().find('select').eq(index + 1).html(html);


    })
    function getList(id){
        let list;
        // console.log(id);
        $.ajax({
            url:"/admin/goods/getCate",
            dataType:"json",
            data:{ id:id },
            type:"post",
            async:false,
            success:function(msg){
                list = msg;
                // console.log(list);
                // var html = "<option value=''>请选择</option>";
                // //遍历数组
                // for(var i=0;i<msg.length;i++){
                //     var ls = msg[i];
                //     html += "<option value="+ls.pid+">"+ls.cname+"</option>";
                // }
                // $(this).parent("select").next().html(html);
            },

            error:function(msg){
                console.log(msg);
            }
        });
        return list;
    }
</script>
@endsection