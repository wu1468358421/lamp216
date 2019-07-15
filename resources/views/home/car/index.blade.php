@extends('home.layout.index')

@section('css')
<script type="text/javascript" src="/h/js/n_nav.js"></script>
@endsection


<!-- 导航隐藏标签 -->
@section('div')
  <div class="leftNav none">
@endsection

@section('content')
<div class="i_bg">  
    <div class="content mar_20">
    	<img src="/h/images/img1.jpg" />        
    </div>
    
    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
    @if(!$data)
		<img src="https://img02.hua.com/pc/images/gwc_k2.jpg" alt="">
    @else
    	<table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
          <tr>
            <td class="car_th" width="490">商品名称</td>
            <td class="car_th" width="140">属性</td>
            <td class="car_th" width="150">购买数量</td>
            <td class="car_th" width="130">小计</td>
            <td class="car_th" width="140">返还积分</td>
            <td class="car_th" width="150">操作</td>
          </tr>
          <?php $i = 1 ?>
          @foreach($data as $k=>$v)

          <tr style="{{ $i%2 == 0 ? 'background-color:#f6f6f6' : '' }}">
			    <?php $i++ ?>
            <td>
            	<div class="c_s_img"><img src="/h/images/c_1.jpg" width="73" height="73" /></div>
                {{ $v->goods->title }}
            </td>
            <td align="center">颜色：灰色</td>
            <td align="center">
            	<div class="c_num">
                    <input type="button" value="" onclick="updateCart($(this), -1);" class="car_btn_1" />
                	<input type="text" value="{{ $v->num }}" name="" class="car_ipt" />  
                    <input type="button" value="" onclick="updateCart(jq(this), 1);" class="car_btn_2" />
                </div>
            </td>
            <td align="center" style="color:#ff4e00;">￥{{ $v->goods->price * $v->num}}</td>
            <td align="center">26R</td>
            <td align="center"><a onclick="ShowDiv('MyDiv','fade')">删除</a>&nbsp; &nbsp;<a href="#">加入收藏</a></td>
          </tr>
          @endforeach
          
          <tr height="70">
          	<td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
            	<label class="r_rad"><input type="checkbox" name="clear" checked="checked" /></label><label class="r_txt">清空购物车</label>
                <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;">￥{{ $priceCount }}</b></span>
            </td>
          </tr>
          <tr valign="top" height="150">
          	<td colspan="6" align="right">
            	<a href="#"><img src="/h/images/buy1.gif" /></a>&nbsp; &nbsp; <a href="/home/order/account"><img src="/h/images/buy2.gif" /></a>
            </td>
          </tr>
        @endif
        </table>
        
    </div>
	<!--End 第一步：查看购物车 End--> 
    
    
    <!--Begin 弹出层-删除商品 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="/h/images/close.gif" /></span>
            </div>
            <div class="notice_c">
           		
                <table border="0" align="center" style="font-size:16px;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td>您确定要把该商品移除购物车吗？</td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td><a href="#" class="b_sure">确定</a><a href="#" class="b_buy">取消</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <script type="text/javascript">
      function updateCart(that, type)
      {
        let num = that.siblings('.car_ipt').val();
        // num = parseInt(num) + type;
        // that.siblings('.car_ipt').val(num);
        //alert($);
        //console.log(type);

        $.get('/home/car/goodsadd',{type:type,num},function(res){
          console.log(res);
        },'html');
      }

      $('.c_num .car_ipt').on('change', function(){
          let num = $(this).val();
          $.get('/home/car/goodsadd',{num:num},function(res){
            console.log(res);
        },'html');
      })
    </script>

@endsection