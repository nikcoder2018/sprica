@extends('layouts.main')
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-user.css')}}">
@endsection
@section('content')
<section class="app-user-view">
    <!-- User Card & Plan Starts -->
    <div class="row">
        <!-- User Card starts-->
        <div class="col-lg-4">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                    @if($user->avatar != '')
                                        <img class="img-fluid rounded" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}" height="104" width="104" />
                                    @else
                                    <img class="img-fluid rounded" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png') }}" height="104" width="104" />
                                    @endif
                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1">
                                            <h4 class="mb-0">{{$user->name}}</h4>
                                            <span class="card-text">{{$user->email}}</span>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <a href="./app-user-edit.html" class="btn btn-primary">Edit</a>
                                            <button class="btn btn-outline-danger ml-1">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="user-info-wrapper">
                                <div class="d-flex flex-wrap my-1">
                                    <div class="user-info-title">
                                        <i data-feather="user" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Username</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->username}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-1">
                                    <div class="user-info-title">
                                        <i data-feather="bookmark" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Department</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->department}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-1">
                                    <div class="user-info-title">
                                        <i data-feather="calendar" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Date Registered</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->created_at->format('Y-m-d')}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-1">
                                    <div class="user-info-title">
                                        <i data-feather="map-pin" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Address</span>
                                    </div>
                                    <p class="card-text mb-0">{{$user->street}} {{$user->postal_code}}</p>
                                </div>
                                <div class="d-flex flex-wrap my-1">
                                    <div class="user-info-title">
                                        <i data-feather="gift" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Birthday</span>
                                    </div>
                                    <p class="card-text mb-0">{{date('Y-m-d', strtotime($user->date_of_birth))}}</p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <i data-feather="flag" class="mr-1"></i>
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
        <div class="col-lg-8">
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
                            <ul class="list-group list-group-flush mb-3">
                                <div class="col-md-12">
                                 <label class="w-100 p-1 list-group-item-primary">Persönliche Daten</label>   
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Steuerklasse</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->tax_status}}</p>
                                        </div>
                                    </li>
                                     <li class="pl-2 row">
                                        <label class="col-md-3 control-label">St. ID Nr.</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->STIDNUM}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Sozialvers. Nr.</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->sg_number}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Krankenkasse</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->health_insurance}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Kinderfreibetrag</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->tax_status}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Familienstand</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->STIDNUM}}</p>
                                        </div>
                                </li>
                                    
                               </div>
                               
                            </ul>
                            <ul class="list-group list-group-flush mb-3">
                                <div class="col-md-12">
                                    <label class="w-100 p-1 list-group-item-primary">Bankdaten</label>   
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">Bankname</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">IBAN</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                        </div>
                                    </li>
                                    <li class="pl-2 row">
                                        <label class="col-md-3 control-label">BIC</label>
                                        <div class="col-md-3">
                                            <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                        </div>
                                    </li>
                               </div>
                            </ul>
                           <ul class="list-group list-group-flush mb-3">
                            <div class="col-md-12">              
                                <label class="w-100 p-1 list-group-item-primary">Sonstiges</label>   
                                <li class="pl-2 row">
                                    <label class="col-md-3 control-label">Führerschein</label>
                                    <div class="col-md-3">
                                        <p class="form-control-static linkify">{{$user->driving_license}}</p>
                                        </div>
                                </li>
                                <li class="pl-2 row">
                                   <label class="col-md-3 control-label">VdS Ausweis</label>
                                   <div class="col-md-3">
                                       <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                   </div>
                                </li>
                                <li class="pl-2 row">
                                   <label class="col-md-3 control-label">Hubarbeitsbühne</label>
                                   <div class="col-md-3">
                                       <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                    </div>
                                </li>
                                <li class="pl-2 row">
                                   <label class="col-md-3 control-label">Stapler</label>
                                   <div class="col-md-3">
                                       <p class="form-control-static linkify">{{$user->vds_identity}}</p>
                                    </div>
                                </li>  
                              </div>
                           </ul>
                        </div>
                        <div class="tab-pane" id="salary" role="tabpanel" aria-labelledby="salary-tab-justified">
                            <ul class="list-group list-group-flush mb-3">
                                <div class="col-md-12">
                                 <label class="w-100 p-1 list-group-item-primary">Gehalt & Urlaub</label>   
                                <li class="pl-2 row">
                                    <label class="col-md-3 control-label">Gehalt</label>
                                    <div class="col-md-3">
                                        <p class="form-control-static linkify">{{$user->hour_fee}} €</p>
                                    </div>
                                </li>
                                <li class="pl-2 row">
                                    <label class="col-md-3 control-label">Urlaubsanspruch</label>
                                    <div class="col-md-3">
                                        <p class="form-control-static linkify">{{$user->day_off}} Tage</p>
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
    <!-- User Card & Plan Ends -->
</section>
@endsection