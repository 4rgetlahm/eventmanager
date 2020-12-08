@extends('layouts.design')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" style="margin-top: 20px;">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 col-md-offset-2"> </div>
        <div class="col-md-8 col-md-offset-2">
                <div class="registruotis" style="margin-left:5%; margin-top:20px"><h2>Slaptažodžio atkūrimas</h2><br></div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">El. pašto adresas</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Atkurti slaptažodį
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
