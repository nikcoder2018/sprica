<tr>
    <td>
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                @if($member->member_detail->avatar != '')
                    <img alt="Avatar" class="table-avatar" title="{{$member->member_detail->name}}" src="{{asset($member->member_detail->avatar)}}">
                @else
                    <img alt="Avatar" class="table-avatar" title="{{$member->member_detail->name}}" src="{{asset('dist/img/avatar.png')}}">
                @endif
            </div>
            <div class="col-sm-8 col-xs-8">
                    {{$member->member_detail->name}}<br><span class="text-muted font-12">{{$member->member_detail->department}}</span>
            </div>
        </div>
    </td>
    <td>{{$member->member_detail->hour_fee}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td class="project-actions text-right">
        <button type="button" class="btn btn-danger btn-sm btn-delete-member" data-id="{{$member->member_detail->id}}">
            <i class="fas fa-trash">
            </i>
        </button>
    </td>
</tr>