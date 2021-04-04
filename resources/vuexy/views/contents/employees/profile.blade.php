@extends('layouts.main')
@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-profile.css')}}">
@endsection

@section('content')
<section class="app-user-view">
    <!-- User Card & Plan Starts -->
    <div class="row">
        <!-- User Card starts-->
        <div class="col-xl-9 col-lg-8 col-md-7">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="media mb-2">
                                    @if($user->avatar != '')
                                        <img class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" src="{{$user->avatar}}" height="104" width="104" alt="User avatar" />
                                    @else 
                                        <img class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" src="{{asset(env('APP_THEME').'/app-assets/images/avatars/noface.png')}}" height="104" width="104" alt="User avatar" />
                                    @endif
                                    <div class="media-body mt-50">
                                        <h4>{{$user->name}}</h4>
                                        <span class="card-text">{{$user->email}}</span>
                                        <div class="col-12 d-flex mt-1 px-0">
                                            <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                <span class="d-none d-sm-block">Change</span>
                                                <input class="form-control" type="file" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg" />
                                                <span class="d-block d-sm-none">
                                                    <i class="mr-0" data-feather="edit"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center user-total-numbers">
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-primary">
                                        <i data-feather="briefcase" class="text-primary"></i>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$user->projects_count}}</h5>
                                        <small>Projects Involved</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="color-box bg-light-success">
                                        <i data-feather="trending-up" class="text-success"></i>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">{{$user->tasks_count}}</h5>
                                        <small>Tasks Completed</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                            <div class="user-info-wrapper">
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <i data-feather="user" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Username</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->username}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="check" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Department</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->department}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="star" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Date Registered</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->created_at->format('Y-m-d')}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="flag" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Address</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->street}} {{$user->postal_code}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="phone" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Birthday</span>
                                    </div>
                                    <p class="card-text mb-0">{{date('Y-m-d', strtotime($user->date_of_birth))}}</p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <i data-feather="phone" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Nationality</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->nationality}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->

    </div>
    <!-- User Card & Plan Ends -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#salary" role="tab" aria-controls="salary" aria-selected="true">
                                Salary
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">
                                Leaves
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#trainings" role="tab" aria-controls="trainings" aria-selected="false">
                                Training
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#psa" role="tab" aria-controls="psa" aria-selected="false">
                                PSA
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#debts" role="tab" aria-controls="debts" aria-selected="false">
                                Debts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#dokum" role="tab" aria-controls="dokum" aria-selected="false">
                                Dokum.
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab-justified">
                            <div class="list-group mb-3">
                                <li class="list-group-item active"><strong>Persönliche Daten</strong></li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Steuerklasse</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->tax_status}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>St. ID Nr.</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->STIDNUM}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Sozialvers. Nr.</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->sg_number}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Krankenkasse</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->health_insurance}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Kinderfreibetrag</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->tax_status}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Familienstand</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->STIDNUM}}</p>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <ul class="list-group mb-3">
                                <li class="list-group-item active"><strong>Bankdaten</strong></li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Bankname</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->bank}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>IBAN</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->IBAN}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>BIC</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->BIC}}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                           <ul class="list-group mb-3">
                            <li class="list-group-item active"><strong>Sonstiges</strong></li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Führerschein</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->driving_license}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>VdS Ausweis</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$user->vds_identity}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Hubarbeitsbühne</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p></p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Stapler</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p></p>
                                    </div>
                                </div>
                            </li>
                           </ul>
                        </div>
                        <div class="tab-pane" id="salary" role="tabpanel" aria-labelledby="salary-tab-justified">
                            <ul class="list-group mb-3">
                                <li class="list-group-item active"><strong>Gehalt & Urlaub</strong></li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Gehalt</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->hour_fee}} €</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Urlaubsanspruch</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->day_off}} Tage</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="leaves" role="tabpanel" aria-labelledby="leaves-tab-justified">
                            
                        </div>
                        <div class="tab-pane" id="training" role="tabpanel" aria-labelledby="training-tab-justified">
                            
                        </div>
                        <div class="tab-pane" id="psa" role="tabpanel" aria-labelledby="psa-tab-justified">
                            
                        </div>
                        <div class="tab-pane" id="debts" role="tabpanel" aria-labelledby="debts-tab-justified">
                            
                        </div>
                        <div class="tab-pane" id="dokum" role="tabpanel" aria-labelledby="dokum-tab-justified">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section> 
@endsection

@section('external_js')
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('scripts')
    <script>
        $(function() {
            'use strict';

            var changePicture = $('#change-picture'),
                userAvatar = $('.user-avatar');

            // Change user profile picture
            if (changePicture.length) {
                $(changePicture).on('change', function(e) {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function() {
                        if (userAvatar.length) {
                            userAvatar.attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);

                    var myFormData = new FormData();
                    myFormData.append('image', files[0]);
                    myFormData.append('id',"{{$user->id}}");
                    myFormData.append('_token', $('meta[name=csrf-token]').attr('content'));

                    $.ajax({
                        url: "{{route('employees.changephoto')}}",
                        type: 'POST',
                        processData: false, // important
                        contentType: false, // important
                        dataType : 'json',
                        data: myFormData,
                        success: function(resp){
                            if(resp.success){
                                toastr['success'](resp.msg, 'Success!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                            }
                        }
                    });
                });
            }
        });
    </script>
@endsection