@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/column/store" method="get">
                    	
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">栏目名称sadasds</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="cname" class="small">
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