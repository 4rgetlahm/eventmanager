@extends('layouts.design')
@section('content')
  <div class="filler_before"></div>
  <center><h2>Renginių statistika</h2></center>
  <div class="filler_before"></div>
  @if(count($Events) >= 1)

      <script>
      function read(el){
          var options = {
              'backdrop': 'static'
          };
          $('#read-modal').modal(options).css("z-index", "1500");

          var title = document.getElementsByName("title")[0];
          var slots = document.getElementsByName("slots")[0];
          var regCount = document.getElementsByName("regcount")[0];
          var registered = document.getElementsByName("registered")[0];

          title.textContent = $(el).data('item-title');
          slots.textContent = $(el).data('item-slots');
          regCount.textContent = $(el).data('item-regcount');
          if($(el).data('item-regcount') > 0){
              registered.value = $(el).data('item-registered');
          } else{
              registered.value = 'Nėra registruotų vartotojų!';
          }
      }

      $('#read-modal').on('hide.bs.modal', function() {
          $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
          $("#read-form").trigger("reset");
      })
      </script>

      <div class="modal fade" id="read-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true" data-backdrop="false">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <div class="textedit">
                          <h5 class="modal-title" id="edit-modal-label">Renginio statistika</h5>
                          <br>
                                <div class="form-row justify-content-center">
                                  <div class="col-md-6 ml-auto">
                                    <label>Renginio pavadinimas:</label>
                                    <br>
                                    <strong><label name="title"></label></strong>
                                  </div>
                                  <div class="col-md-4 ml-auto">
                                    <label>Galimas vartotojų skaičius: <label class="badge badge-success" name="slots">0</label></label>
                                    <label>Užsiregistravusiųjų vartotojų skaičius: <label class="badge badge-warning" name="regcount">0</label></label>
                                  </div>
                                </div>
                                <br>
                                <div class="form-row justify-content-center">
                                  <div class="form-group col-md-10">
                                    <label for="registered">Užsiregistravę vartotojai</label>
                                    <textarea class="form-control" name="registered" placeholder="Užsiregistravę vartotojai" rows="8"></textarea>
                                  </div>
                                </div>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>



      <table class="table table-bordered table-light table-striped table-hover">
          <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pavadinimas</th>
            <th scope="col">Galimas registracijų kiekis</th>
            <th scope="col">Likusios vietos</th>
            <th scope="col">Užsiregistravusiųjų skaičius</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($Events as $event)
                @php
                    $registeredUsers = explode(";", $event->registered);
                    $regCount = sizeof($registeredUsers)-1;
                    $regArray = "";
                    foreach($registeredUsers as $userEmail){
                        str_replace(';', '', $userEmail);
                        $currName = $Users->where('email',$userEmail)->first()['name'];
                        $currClass = $Users->where('email',$userEmail)->first()['class'];
                        $regArray = $regArray.$currName." ".$currClass."\n";
                    }
                @endphp

            <tr onclick="read(this);" data-item-id="{{$event->id}}" data-item-title="{{$event->title}}" data-item-slots="{{($event->slots)+$regCount}}" data-item-registered="{{$regArray}}" data-item-regcount="{{$regCount}}">
              <th scope="row">{{$event->id}}</th>
              <td>{{$event->title}}</td>
              <td><a href="#" class="badge badge-success">{{($event->slots)+$regCount}}</a></td>
              <td><a href="#" class="badge badge-danger">{{$event->slots}}</a></td>
              <td><a href="#" class="badge badge-warning">{{$regCount}}</a></td>
            </tr>
            @endforeach

        </tbody>

      </table>
  @else
      <center><h3>Renginių nėra.</h3></center>
  @endif
@endsection
