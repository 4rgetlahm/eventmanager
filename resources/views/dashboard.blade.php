@extends('layouts.design')
@section('content')
<div class="filler_before">
@php
    $user = \Auth::user();
    $role = $user->role;
@endphp
    @if($role > ROLE_USER)
    <div class="card-deck mb-3 text-center">
        @if($role >= ROLE_ADMIN)
            <div class="card mb-4 box-shadow" style="background-color: #edecec">
                <div class="card-body">
                    <a href="{{url('/dashboard/create')}}"><img src="{{asset('img/art.svg')}}" width="100" height="100"></img></a>
                    <div class="small_filler"></div>
                    <h3>Renginio kūrimas</h3>
                </div>
            </div>
        @endif
        @if($role >= ROLE_ADMIN)
            <div class="card mb-4 box-shadow" style="background-color: #edecec">
                <div class="card-body">
                    <a href="{{url('/dashboard/edit')}}"><img src="{{asset('img/edit.svg')}}" width="100" height="100"></img></a>
                    <div class="small_filler"></div>
                    <h3>Renginių redagavimas</h3>
                </div>
            </div>
        @endif
        @if($role >= ROLE_MODERATOR)
            <div class="card mb-4 box-shadow" style="background-color: #edecec">
                <div class="card-body">
                    <a href="{{url('/dashboard/statistics')}}"><img src="{{asset('img/bar-chart.svg')}}" width="100" height="100"></img></a>
                    <div class="small_filler"></div>
                    <h3>Renginių statistika</h3>
                </div>
            </div>
        @endif
        @if($role >= ROLE_SYSTEM_ADMIN)
            <div class="card mb-4 box-shadow" style="background-color: #edecec">
                <div class="card-body">
                    <a href="{{url('/dashboard/users')}}"><img src="{{asset('img/user.svg')}}" width="100" height="100"></img></a>
                    <div class="small_filler"></div>
                    <h3>Vartotojų valdymas</h3>
                </div>
            </div>
        @endif
        <div class="card mb-4 box-shadow" style="background-color: #edecec">
            <div class="card-body">
                <div class="small_filler"></div>
                <a href="#"><img src="{{asset('img/gear.svg')}}" width="100" height="100"></img></a>
                <div class="small_filler"></div>
                <h3>Parametrai</h3>
            </div>
        </div>
      </div>
  @else
      <h1>Vieta kurioje galima bus tvarkyti savo nustatymus. <small class="text-muted">ateityje</small></h1>
  @endif

@endsection
