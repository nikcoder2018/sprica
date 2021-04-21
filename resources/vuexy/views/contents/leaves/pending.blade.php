@extends('layouts.main')

@section('header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        @include('partials.breadcrumbs', ['title' => $title])
    </div>
@endsection

@section('content')
    <section class="pendings-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-start">
                            <a href="{{route('leaves.index')}}" class="btn btn-info mr-1"><i data-feather="list"></i> All Leaves</a>
                            <a href="" class="btn btn-primary mr-1"><i data-feather="calendar"></i> Calendar</a>
                            <a href="{{route('leaves.create')}}" class="btn btn-success mr-1"><i data-feather="plus"></i> Assign Leave</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($leaves as $leave)
            <div class="col-md-4" id="request-{{$leave->id}}">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="font-normal w-100">{{$leave->type->name}} Leave Request</h5>
                        <div class="m-b-15">
                            @if($leave->user->avatar != '')
                            <span class="avatar">
                                <img class="round" src="{{$leave->user->avatar}}" alt="avatar" height="30" width="30">
                            </span>
                            <span class="m-l-5"><a href="">{{$leave->user->name}}</a></span>
                            @else 
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="avatar mr-1" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" data-original-title="${row.leader.name}">
                                        <span class="avatar-content">{{strtoupper(System::get_avatar($leave->user->name))}}</span>
                                    </div>
                                    <span class="emp_name text-truncate font-weight-bold">
                                        {{$leave->user->name}}
                                    </span>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center p-t-20 p-b-20 m-l-n-25 m-r-n-25">

                            {{$leave->date}} ({{\Carbon\Carbon::parse($leave->date)->format('l')}})

                            <div class="progress m-l-30 m-r-30 m-t-15">
                                <div class="progress-bar progress-bar-info" aria-valuenow="93.333333333333" aria-valuemin="0" aria-valuemax="100" style="width: 93.333333333333%" role="progressbar"> <span class="sr-only">93.333333333333% Complete</span> </div>
                            </div>

                            <div class="m-l-30 m-r-30 m-t-15">
                                {{$leave->user->day_off-$leave->user->day_off_used}} Remaining Leaves                                
                            </div>
                        </div>
                        <div class="pt-3">
                            <h6 class="font-normal">Reason</h6>
                            <div class="pb-1 font-12" style="height: 130px; overflow-y: auto;">
                                {{$leave->reason}}
                            </div>

                            <div class="pt-2 d-flex justify-content-center m-l-n-25 m-r-n-25">
                                <a href="javascript:;" data-leave-id="{{$leave->id}}" data-leave-action="approved" class="btn btn-sm btn-success btn-rounded leave-action mr-1"><i class="fa fa-check"></i> Accept</a>
                                <a href="javascript:;" data-leave-id="{{$leave->id}}" data-leave-action="rejected" class="btn btn-sm btn-danger btn-rounded leave-action"><i class="fa fa-times"></i> Reject</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            @endforelse
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict';

           var leaveAction = $('.leave-action');
           leaveAction.on('click', function(){
                var data = $(this).data();
                $.ajax({
                    url: "{{route('leaves.request-action')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content'),
                        action: data.leaveAction,
                        id: data.leaveId
                    },
                    success: function(resp){
                        Swal.fire({
                            title: 'Success',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            $('#request-'+resp.leave_id).fadeOut(600);
                        });
                    }
                });
           });
        });
    </script>
@endsection