@extends('layouts.design')
@section('content')

@if (session('success'))
    <div style="margin-top: 40px;"></div>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div style="margin-top: 40px;"></div>
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('danger'))
    <div style="margin-top: 40px;"></div>
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

<div style="margin:auto; align:center">
<div class="text-center"><h1 class="h3 mb-3 font-weight-normal" style="margin-top:10px">Registracija</h1></div>
  <div class="registruotis" style="margin-left:30%; margin-top:20px">
      <div class="row">
          <div class="col-md-7 col-md-offset-2">
              <div class="panel panel-default">
                <!--  <div class="panel-heading">Register</div> -->
                  <div class="panel-body" style=" margin-top: -10px; margin: auto">
                      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                             <!-- <label for="name" class="col-md-4 control-label">Vardas Pavardė</label>-->
                                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus, placeholder="Vardas Pavardė">
                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                             <!-- <label for="email" class="col-md-4 control-label">El. pašto adresas</label>-->

                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required, placeholder="El.pašto adresas"><!--370px visur ???171%?-->

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!--  <label for="password" class="col-md-4 control-label">Slaptažodis</label>-->
                                  <input id="password" type="password" class="form-control" name="password" required, placeholder="Slaptažodis">

                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div class="form-group">
                             <!-- <label for="password-confirm" class="col-md-4 control-label">Patvirtinti slaptažodį</label>-->
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required, placeholder="Patvirtinti slaptažodį">
                          </div>

                          <div class="form-group">
                              <select class="custom-select my-1 mr-sm-2" id="class" name="class">
                                <option selected>Klasė</option>
                                <option value="I A">I A</option>
                                <option value="I B">I B</option>
                                <option value="I C">I C</option>
                                <option value="I D">I D</option>
                                <option value="I E">I E</option>
                                <option value="II A">II A</option>
                                <option value="II B">II B</option>
                                <option value="II C">II C</option>
                                <option value="II D">II D</option>
                                <option value="II E">II E</option>
                                <option value="III A">III A</option>
                                <option value="III B">III B</option>
                                <option value="III C">III C</option>
                                <option value="III D">III D</option>
                                <option value="III E">III E</option>
                                <option value="IV A">IV A</option>
                                <option value="IV B">IV B</option>
                                <option value="IV C">IV C</option>
                                <option value="IV D">IV D</option>
                                <option value="IV E">IV E</option>
                              </select>
                              @if ($errors->has('class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                            @endif
                          </div>
                            <div class="form-group{{ $errors->has('recaptcha') ? ' has-error' : '' }}">
                                <div id="rc-imageselect">
                                {!! htmlFormSnippet() !!} <!--CAPTCHA !-->
                                </div>
                                @if($errors->has('recaptcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('recaptcha') }}</strong>
                                    </span>
                                @endif
                            </div>

                          <div class="form-group">
                                  <button type="submit" class="btn btn-primary"><!--32% -->
                                      Registruotis
                                  </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
</form>
  </div>
</div>
@endsection
