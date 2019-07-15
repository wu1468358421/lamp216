@extends('admin.layout.index')


@section('content')


@if ($errors->any())
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div class="mws-panel grid_8">
		<div class="mws-panel-header">
	    	<span>Inline Form</span>
	    </div>
	    <div class="mws-panel-body no-padding">
	    	<form class="mws-form" action="/admin/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	    	{{ method_field('PUT') }}
	    		<div class="mws-form-inline">
	    			<div class="mws-form-row">
	    				<label class="mws-form-label">用户名</label>
	    				<div class="mws-form-item">
	    					<input type="text" name="uname" class="small" disabled value="{{ $user->uname }}">
	    				</div>
	    			</div>

					
					<div class="mws-form-row">
	    				<label class="mws-form-label">邮箱</label>
	    				<div class="mws-form-item">
	    					<input type="text" name="email" class="small" value="{{ $user->email }}">
	    				</div>
	    			</div>
	    			
	    			<div class="mws-form-row">
	    				<label class="mws-form-label">手机号</label>
	    				<div class="mws-form-item">
	    					<input type="text" name="phone" class="small" value="{{ $user->phone}}">
	    				</div>
	    			</div>
					
					<div class="mws-form-row">
	    				<label class="mws-form-label"></label>
	    				<img src="/uploads/{{ $user->userinfo->profile }}" alt="..." class="img-thumbnail" style="width: 200px; padding-left: 15px;" >
	    			</div>
					
					<input type="hidden" name="old_profile" value="{{ $user->userinfo->profile }}">
	    			<div class="mws-form-row" style="width:740px;">
	    				<label class="mws-form-label">头像</label>
	    				<div class="mws-form-item" style="width:740px;">
	    					<input type="file" name="profile" class="small">
	    				</div>
	    			</div>

	    		</div>
	    		<div class="mws-button-row">
	    			<input type="submit" value="提交" class="btn btn-danger">
	    			<input type="reset" value="重置" class="btn ">
	    		</div>
	    	</form>
	    </div>    	
    </div>

@endsection