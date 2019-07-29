@extends('admin.layout.index')

@section('css')
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
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Inline Form</span>
    </div>
    <form id="form">
        <div class="mws-panel-body no-padding">
            <div class="mws-form">
                
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">品牌名称</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name="bname" id="bname">
                        </div>
                    </div>
                    
                    <div class="mws-form-row" style="width: 900px;">
                        <label class="mws-form-label">品牌图标</label>
                        <div class="mws-form-item">
                            <input type="file" class="small" name="img" id="img">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">品牌描述</label>
                        <div class="mws-form-item">
                            <textarea rows="" cols="" class="large" name="desc" id="desc"></textarea>
                        </div>
                    </div>
                    
                </div>
                <div class="mws-button-row">
                   <!--  <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn"> -->
                    <button type="submit" class="btn btn-danger" onclick="">提交</button>
                </div>
            </div>
        </div>
    </form>     
</div>
<script type="text/javascript">
    $('#form').on('submit', function(e){
        e.preventDefault();
        let data = new FormData(this);
        
        $.ajax({
            url:'/admin/brand',
            type:'POST',
            async:true,
            data:data,
            dataType: "json",
            processData:false,//是数据不做处理
            contentType:false,//不要设置Content-Type请求头
            success:function(msg){
                // console.log(msg);
                if(msg.msg == 'success'){
                    
                    layer.msg(msg.info,{time: 2000});
                }else{
                    
                    layer.msg(msg.info,{time: 2000});
                }
            },

            error:function(msg){
                

                console.log(msg);
            }
        });
       
    })

    

</script>

@endsection