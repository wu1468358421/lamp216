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
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">角色名称</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles_data as $k=>$v)
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $v->id }}</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $v->rname }}</font></font></td>
                                    <td>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            <a href="">修改角色权限</a>
                                        </font></font>
                                    </td>
                                   
                                </tr>
                            @endforeach
                                
                              
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection