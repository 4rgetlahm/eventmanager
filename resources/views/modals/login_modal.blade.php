<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="textedit">
                    <h5 class="modal-title" id="edit-modal-label">Prisijungimas</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Uždaryti"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <div class="container float-left">
                <form id="form-signin" method="POST" action="{{ route('login') }}">
                              {{ csrf_field() }}
                              <div class="form-group">
                                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="El. pašto adresas" required autofocus>
                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                              </div>

                              <div class="form-label-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                      <input id="password" type="password" class="form-control" name="password" placeholder="Slaptažodis" required>
                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                              </div>

                            <br>

                          <div class="container">
                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Prisiminti mane
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-12 col-md-offset-4">
                                      <button type="submit" id="loginButton" class="btn btn-primary">
                                          Prisijungti
                                      </button>
                                      <a class="btn btn-link" href="{{ route('register') }}">
                                          Neturite paskyros?
                                      </a>
                                      <a class="btn btn-link" href="{{ url('password/reset') }}">
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

<script>
function login(){
    var options = {
        'backdrop': 'static'
    };
    $('#login-modal').modal(options).css("z-index", "1500");
}

$('#login-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#form-signin").trigger("reset");
})

$('#loginButton').click(function() {
    $('#form-signin').submit();
});
</script>
