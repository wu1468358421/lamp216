@extends('admin.layout.index')
@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 简单的表</font></font></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ID</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">名称</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $k=>$v)
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font>{{ $v->id }}</font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font>{{ $v->cname }}</font></td>
                                    <td>
                                    	<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
											<a href="/admin/column/destroy/{{ $v->id }}">删除</a>
											<a href="/admin/column/edit/{{ $v->id }}">修改</a>
                                    	</font></font>
                                    </td>
                            @endforeach    
                                </tr>
                          
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection