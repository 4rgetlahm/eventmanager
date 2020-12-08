@extends('layouts.design')
@section('content')
  <div class="filler_before"></div>
  <center><h2>Vartotojų valdymas</h2></center>
  <div class="filler_before"></div>
  @if(count($Users) >= 1)

      <script>
      function edit(el){
          var options = {
              'backdrop': 'static'
          };
          $('#edit-modal').modal(options).css("z-index", "1500");

          var userID = document.getElementsByName("userID")[0];
          var name = document.getElementsByName("name")[0];
          var classCode = document.getElementsByName("class")[0];
          var email = document.getElementsByName("email")[0];
          var role = document.getElementsByName("role")[0];

          userID.setAttribute('value', $(el).data('item-id'));
          name.value = $(el).data('item-name');
          classCode.value = $(el).data('item-class');
          email.value = $(el).data('item-email');
          if($(el).data('item-role') == {{ROLE_MODERATOR}}){
              role.value = 'Moderatorius';
          } else if($(el).data('item-role') == {{ROLE_ADMIN}}){
              role.value = 'Administratorius';
          } else if($(el).data('item-role') == {{ROLE_SYSTEM_ADMIN}}){
              role.value = 'Sistemos Administratorius';
          }
      }

      $('#edit-modal').on('hide.bs.modal', function() {
          $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
          $("#edit-form").trigger("reset");
      })
      </script>

      <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true" data-backdrop="false">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <div class="textedit">
                          <h5 class="modal-title" id="edit-modal-label">Vartotojo valdymas</h5>
                          <br>
                          <form id="user_form" method="POST" action={{url("/admin/edituser")}}>
                              {{ csrf_field()  }}
                              <input type="hidden" name="userID">
                              <input type="hidden" name="remove" value="0">
                                <div class="form-row justify-content-center">
                                  <div class="col-md-8 ml-auto">
                                    <label for="name">Vardas Pavardė</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Vartotojo vardas ir pavardė" required="required">
                                  </div>
                                  <div class="col-md-3 ml-auto">
                                    <label for="class">Klasė</label>
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
                                  </div>
                                </div>
                                <br>
                                <div class="form-row justify-content-center">
                                  <div class="col-md-7 ml-auto">
                                    <label for="description">El. pašto adresas</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Vartotojo el. paštas" required="required">
                                  </div>
                                  <div class="col-md-4 ml-auto">
                                    <label for="class">Rolė</label>
                                    <select class="custom-select my-1 mr-sm-2" id="role" name="role">
                                      <option selected>Nėra</option>
                                      <option value="Moderatorius">Moderatorius</option>
                                      <option value="Administratorius">Administratorius</option>
                                      <option value="Sistemos Administratorius">Sistemos Administratorius</option>
                                    </select>
                                  </div>
                                </div>

                                <br>

                                <div class="form-row justify-content-center">
                                  <div class="form-group col-md-11">
                                    <label for="description">Slaptažodžio keitimas</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Slaptažodžis">
                                  </div>
                                  <div class="form-group col-md-11">
                                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Slaptažodžio pakartojimas">
                                  </div>
                                </div>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-footer">
                          <button type="button" id="removeButton" class="btn btn-danger float-left" data-dismiss="modal">Pašalinti vartotoją</button>
                          <button type="button" id="saveButton" class="btn btn-success" data-dismiss="modal">Išsaugoti pakeitimus</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>


      <table class="table table-bordered table-light table-striped table-hover">
          <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Vardas Pavardė</th>
            <th scope="col">El. Pašto adresas</th>
            <th scope="col">Klasė</th>
            <th scope="col">Rolė</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($Users as $user)
            @if($user->role < ROLE_HEATHCLIFF && $user->verified > 0)
                    <tr onclick="edit(this);" data-item-id="{{$user->id}}" data-item-name="{{$user->name}}" data-item-email="{{$user->email}}" data-item-class="{{$user->class}}" data-item-role="{{$user->role}}">
                      <th scope="row">{{$user->id}}</th>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                  @if($user->role > ROLE_MODERATOR)
                      <td><a href="#" class="badge badge-secondary">-</a></td>
                  @elseif(strlen($user->class) == 3)
                      <td><a href="#" class="badge badge-success">{{$user->class}}</a></td>
                  @elseif (strlen($user->class) == 4 && !(strpos($user->class, 'V') !== false))
                      <td><a href="#" class="badge badge-warning">{{$user->class}}</a></td>
                  @elseif(strlen($user->class) == 4 && strpos($user->class, 'V') !== false)
                      <td><a href="#" class="badge badge-primary">{{$user->class}}</a></td>
                  @elseif (strlen($user->class) == 5)
                      <td><a href="#" class="badge badge-danger">{{$user->class}}</a></td>
                  @endif

                  @if($user->role == 0)
                      <td><a href="#" class="badge badge-secondary">Vartotojas</a></td>
                  @elseif($user->role == ROLE_MODERATOR)
                      <td><a href="#" class="badge badge-success">Moderatorius</a></td>
                  @elseif($user->role == ROLE_ADMIN)
                      <td><a href="#" class="badge badge-danger">Administratorius</a></td>
                  @elseif($user->role == ROLE_SYSTEM_ADMIN)
                      <td><a href="#" class="badge badge-warning">Sistemos Administratorius</a></td>
                  @endif
            @endif
            </tr>
            @endforeach

        </tbody>

      </table>
  @else
      <center><h3>Renginių nėra.</h3></center>
  @endif

  <script>
      $('#saveButton').click(function() {
          $('#user_form').submit();
      });
      $('#removeButton').click(function() {
          var removeInput = document.getElementsByName("remove")[0];
          removeInput.setAttribute('value', '1');
          $('#user_form').submit();
      });
  </script>
  @if(\Session::has('password_mismatch'))
      <script>
        alert("Slaptažodžiai nesutampa!");
      </script>
  @endif
  @if(\Session::has('user_error'))
      <script>
        alert("Įvyko klaida su vartotoju!");
      </script>
  @endif
  @if(\Session::has('success_edit'))
      <script>
        alert("Sėkmingai pakeista informacija!");
      </script>
  @endif
  @if(\Session::has('user_removed'))
      <script>
        alert("Vartotojas ištrintas!");
      </script>
  @endif
@endsection
