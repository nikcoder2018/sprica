<table id="example1" class="table table-responsive-md table-striped table-hover">
    <thead>
        <tr style="background-color:grey">
            <th width="50">ID</th>
            <th>Name</th>
            <th>Benutzername</th>
            <th>Email Addresse</th>
            <th>Role</th>
            <th width="100">Status</th>
            <th width="120">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($employees) > 0)
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td><a style="color:black" href="{{route('admin.employees.details', $employee->id)}}">{{$employee->name}}</a></td>
                    <td>{{$employee->username}}</td> 
                    <td>{{$employee->email}}</td>
                    <td><button class="btn btn-sm @if($employee->myrole->name == 'admin') btn-warning @else btn-info @endif" disabled="">{{ucfirst($employee->myrole->name)}}</button></td> 
                    <td>
                        @if($employee->status == 1)
                            <button class="btn btn-sm btn-success" disabled title="Active"><i class="fas fa-power-off"></i></button>
                        @else 
                            <button class="btn btn-sm btn-danger" disabled title="Disabled"><i class="fas fa-power-off"></i></button>
                        @endif
                    </td>
                    <td width="139" href="javascript:void(0);">
                        <div class="btn-group">
                            <a href="{{route('admin.employees.details', $employee->id)}}" class="btn btn-block btn-info btn-sm mr5 " disabled=""><i class="fa fa-eye"></i></a>
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item btn-edit" data-id="{{$employee->id}}">Bearbeiten</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach 
        @endif
    </tbody>
</table>