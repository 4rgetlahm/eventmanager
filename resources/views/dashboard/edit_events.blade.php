@extends('layouts.design')
@section('content')
  <div class="filler_before"></div>
  <center><h2>Renginių redagavimas</h2></center>
  <div class="filler_before"></div>
  @if(count($Events) >= 1)

      <script>
      function edit(el){
          var options = {
              'backdrop': 'static'
          };
          $('#edit-modal').modal(options).css("z-index", "1500");

          var eventID = document.getElementsByName("eventID")[0];
          var title = document.getElementsByName("title")[0];
          var slots = document.getElementsByName("slots")[0];
          var description = document.getElementsByName("description")[0];
          var date = document.getElementsByName("date")[0];

          eventID.setAttribute('value', $(el).data('item-id'));
          title.value = $(el).data('item-title');
          slots.value = $(el).data('item-slots');
          description.value = $(el).data('item-description');
          date.value = $(el).data('item-date');
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
                          <h5 class="modal-title" id="edit-modal-label">Renginio tvarkymas</h5>
                          <br>
                          <form id="edit_form" method="POST" action={{url("/admin/editevent")}}>
                              {{ csrf_field()  }}
                              <input type="hidden" name="eventID">
                              <input type="hidden" name="remove" value="0">
                                <div class="form-row justify-content-center">
                                  <div class="col-md-6 ml-auto">
                                    <label for="title">Rengino pavadinimas</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Renginio pavadinimas" required="required">
                                  </div>
                                  <div class="col-md-4 ml-auto">
                                    <label for="slots">Žmonių skaičius</label>
                                    <input type="text" name="slots" class="form-control" id="slots" placeholder="1" required="required">
                                  </div>
                                </div>
                                <br>
                                <div class="form-row justify-content-center">
                                  <div class="col-md-6 ml-auto">
                                    <label for="description">Aprašymas</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Renginio aprašymas" rows="4" required="required"></textarea>
                                  </div>
                                  <div class="col-md-4 ml-auto">
                                    <label for="title">Renginio data</label>
                                    <input autocomplete="off" type="text" class="form-control" name="date" id="datepicker" placeholder="Renginio data" required="required">
                                  </div>
                                  <script>
                                        $( function() {
                                          $( "#datepicker" ).datepicker({
                                            dateFormat: 'yy-mm-dd',
                                            changeMonth: true,
                                            changeYear: true
                                          });
                                        } );
                                    </script>
                                </div>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-footer">
                          <button type="button" id="removeButton" class="btn btn-danger float-left" data-dismiss="modal">Naikinti renginį</button>
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
            <th scope="col">Pavadinimas</th>
            <th scope="col">Aprašymas</th>
            <th scope="col">Kiekis</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($Events as $event)
            <tr onclick="edit(this);" data-item-id="{{$event->id}}" data-item-title="{{$event->title}}" data-item-description="{{$event->description}}" data-item-slots="{{$event->slots}}" data-item-date="{{date('Y-m-d', strtotime($event->date))}}">
              <th scope="row">{{$event->id}}</th>
              <td>{{$event->title}}</td>
              <td>{{$event->description}}</td>
              <td><a href="#" class="badge badge-success">{{$event->slots}}</a></td>
            </tr>
            @endforeach

        </tbody>

      </table>
  @else
      <center><h3>Renginių nėra.</h3></center>
  @endif

  <script>
      $('#saveButton').click(function() {
          $('#edit_form').submit();
      });
      $('#removeButton').click(function() {
          var removeInput = document.getElementsByName("remove")[0];
          removeInput.setAttribute('value', '1');
          $('#edit_form').submit();
      });
  </script>
@endsection
