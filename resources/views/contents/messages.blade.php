@extends('layouts.app')

@section('content')
<iframe src="{{route('messenger')}}@if($sender)?sender={{$sender}} @endif" width="100%" height="600" style="border:none;">Your browser isn't compatible</iframe>
@endsection

@section('modals')

@endsection