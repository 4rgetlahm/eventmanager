@extends('layouts.design')
@section('content')
<script language="JavaScript">
function setVisibility(id,visibility) {
    document.getElementById(id).style.display = visibility;
}
</script>
<div class="container">
    <div class="row">
<div class="container" style=" margin-top: 10px;align:center; width: 630px"><!--to do padding-left:32% --><!-- ploti reguliuoti-->
    <div class="col-md-8 col-md-offset-4"style="margin:auto;">
        <button type="button" class="btn btn-secondary" style="width:183px; align: center;" onclick="setVisibility('Registracija','inline'); setVisibility('Prisijungti','none');">Registruotis</button>
        <button type="submit" class="btn btn-secondary" style="width:183px; align:center;" onclick="setVisibility('Registracija','none'); setVisibility('Prisijungti','inline');">Prisijungti</button><!-- todo margin-left:-10px -->
    </div>
</div>
</div>
<div class="container">
<div id="Registracija" style="display:none; width: 400px; align: center; ">
        <div style=" align:center">
        <div class="text-center"><h1 class="h3 mb-3 font-weight-normal" style="margin-top:10px">Registracija</h1></div>
        <!--  <div class="registruotis" style="margin-left:31.5%; margin-top:10px">-->
              <div class="form-group" style="width: 400px; align: center; margin: auto; "><!-- 20px --><!--div class="registruotis" style="margin-left:31.5%; margin-top:10px"-->
              <div class="row" style="align: center;">
                  <div class="col-md-8 col-md-offset-2">
                      <div class="panel panel-default">
                        <!--  <div class="panel-heading">Register</div> -->
                          <div class="panel-body" style=" margin-top: -10px; margin: auto">
                              <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                  {{ csrf_field() }}
                                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                     <!-- <label for="name" class="col-md-4 control-label">Vardas Pavardė</label>-->
                                      <div class="col-md-6">
                                          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus, placeholder="Vardas Pavardė" style="width: 370px">
                                          @if ($errors->has('name'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                     <!-- <label for="email" class="col-md-4 control-label">El. pašto adresas</label>-->

                                      <div class="col-md-6">
                                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required, placeholder="El.pašto adresas"style="width: 370px"><!--370px visur ???171%?-->

                                          @if ($errors->has('email'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <!--  <label for="password" class="col-md-4 control-label">Slaptažodis</label>-->

                                      <div class="col-md-6">
                                          <input id="password" type="password" class="form-control" name="password" required, placeholder="Slaptažodis"style="width: 370px">

                                          @if ($errors->has('password'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group">
                                     <!-- <label for="password-confirm" class="col-md-4 control-label">Patvirtinti slaptažodį</label>-->

                                      <div class="col-md-6">
                                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required, placeholder="Patvirtinti slaptažodį"style="width: 370px">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-md-6 col-md-offset-4">
                                          <button type="submit" class="btn btn-primary"><!--32% -->
                                              Registruotis
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
<div id="Prisijungti">
    <div class="container" style="width: 400px; align: center"><!--400px -->
          <form class="form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="text-center"><h1 class="h3 mb-3 font-weight-normal" style="margin-top:10px">Prisijungimas</h1></div>
                        <div class="form-group" style="margin: auto; align: center">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="El. pašto adresas" required autofocus style="width:370px;" >
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-label-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Slaptažodis" required style="width:370px;margin-top: 10px">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    <div class="container" style="margin-left: -30px;"><!-- todo padding-->
                        <div class="form-group" style="margin-top:10px;">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Prisiminti mane
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:-15px;">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Prisijungti
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}"style="margin-left: -15px;">
                                    Pamiršote slaptažodį?
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
</div>
</div>
@endsection
