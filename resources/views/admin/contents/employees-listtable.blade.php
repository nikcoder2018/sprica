


<table id="example1" class="table table-responsive-md table-striped table-hover">
    <thead>
        <tr>
         <!--   <th width="50">ID</th> -->
            <th>Name</th>
            <th>Benutzername</th>
            <th>Lohnvorschuss</th>
            <th>Unterweisung</th>
            <th>Email Addresse</th>
            <th>Role</th>
            <th style="text-align:center" width="100">Status</th>
            <th style="text-align:center" width="120">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($employees) > 0)
            @foreach($employees as $employee)
                <tr>
         <!--           <td>{{$employee->id}}</td>  -->
                    <td><a style="display:block; color:black" href="{{route('admin.employees.details', $employee->id)}}" class="clickable-row">{{$employee->name}}</a></td>
                    <td>{{$employee->username}}</td>
                    <td>0,00 €</td> 
                    <td>12.02.2020</td> 
                    <td>{{$employee->email}}</td>
                    <td>
                   <!--     <button class="btn btn-sm @if($employee->myrole->name == 'admin') btn-warning @else btn-light @endif" ="">{{ucfirst($employee->myrole->name)}}</button> -->
                        
                        <span class="badge  @if($employee->myrole->name == 'admin') btn-warning @else btn-light @endif" ="" >{{ucfirst($employee->myrole->name)}}</span>
                    </td> 
                    <td style="text-align:center">
                        @if($employee->status == 1)
                            
                        
                        
                        <div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="customSwitch1" checked disabled>
  <label class="custom-control-label" for="customSwitch1" ></label>
</div>
                        
                        
                    
                        
                        
                        @else 
                            <div class="custom-control custom-switch on">
                          <label class="custom-control-label" checked></label>
                        </div>
                        @endif
                    </td>
                    <td style="text-align:center" width="139" href="javascript:void(0);">
                        <div class="btn-group">
                            <a href="{{route('admin.employees.details', $employee->id)}}" class="btn btn-block btn-info btn-sm mr5 " disabled=""><i class="fa fa-eye"></i></a>
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu pull-left">
                                <button class="dropdown-item btn-edit" data-id="{{$employee->id}}">Profil</button>
                                <button class="dropdown-item btn-edit" data-id="{{$employee->id}}">Bearbeiten</button>
                                <button class="dropdown-item btn-delete" data-id="{{$employee->id}}">Löschen</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach 
        @endif
    </tbody>
</table>
