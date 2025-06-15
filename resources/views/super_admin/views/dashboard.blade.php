@extends('super_admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h1>{{ $admins }}</h1>
    
    </br>

    <h1>{{ $doctors }}</h1>
    
    </br>

    <h1>{{ $students }}</h1>
    
    </br>

@endsection