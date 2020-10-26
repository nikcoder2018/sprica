<tr>
                                                  <td>
                                                      <a>
                                                          {{$task->title}}
                                                      </a>
                                                  </td>
                                                  <td>
                                                      @if(count($task->assigned) > 0)
                                                      <ul class="list-inline">
                                                          @foreach($task->assigned as $user)
                                                          <li class="list-inline-item">
                                                              <a href="#" title="{{$user->name}}">
                                                                  @if($user->avatar != '')
                                                                      <img alt="Avatar" class="table-avatar" src="{{asset($user->avatar)}}">
                                                                  @else 
                                                                      <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar.png')}}">
                                                                  @endif
                                                              </a> 
                                                          </li>
                                                          @endforeach
                                                      </ul>
                                                      @endif
                                                  </td>
                                                  <td>
                                                      {{date('d-m-Y', strtotime($task->due_date))}}  
                                                  </td>
                                                  <td class="project-state">
                                                      @if($task->status == 'incomplete')
                                                          <span class="badge badge-warning">{{$task->status}}</span>
                                                      @elseif($task->status == 'completed')
                                                          <span class="badge badge-success">{{$task->status}}</span>
                                                      @endif
                                                  </td>
                                                  <td class="project-actions text-right">
                                                      <button class="btn btn-info btn-sm btn-edit" data-id="{{$task->id}}">
                                                          <i class="fas fa-pencil-alt">
                                                          </i>
                                                      </button>
                                                      <button type="button" class="btn btn-danger btn-sm btn-delete-task" data-id="{{$task->id}}">
                                                          <i class="fas fa-trash">
                                                          </i>
                                                      </button>
                                                  </td>
                                              </tr>