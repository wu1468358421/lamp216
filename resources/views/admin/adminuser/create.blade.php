@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/adminuser" method="post" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">用户名</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="uname" class="small">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">密码</label>
                    				<div class="mws-form-item">
                    					<input type="password"  name="upass" class="small">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">确认密码</label>
                    				<div class="mws-form-item">
                    					<input type="password"  name="repass" class="small">
                    				</div>
                    			</div>
                    			<div class="mws-form-row" style="width: 600px;">
                    				<label class="mws-form-label">头像</label>
                    				<div class="mws-form-item">
                    					<input type="file" name="profile" class="large">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Radio Buttons</label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list inline">
                    						@foreach($roles_data as $k=>$v)
				        						<li><input type="radio" name="rid" {{ $v->rname == '普通员工'?'checked':'' }} value="{{ $v->id  }}"> <label>{{ $v->rname }}</label></li>
				        					@endforeach	
                    					</ul>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>

@endsection