@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/column/update/{{ $id }}" method="get">
                    	
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">栏目名称111ewrew;</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="cname" class="small" value="">
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