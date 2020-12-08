@extends('layouts.design')
@section('content')
    @if (session('success'))
        <div style="margin-top: 10px;"></div>
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div style="margin-top: 10px;"></div>
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    @if (session('danger'))
        <div style="margin-top: 10px;"></div>
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
  <div class="fill" style="margin-top:20px;"></div>
  <center><h2>Renginio kūrimas</h2></center>
  <div class="filler_before"></div>

  <div class="container">
    <form method="POST" action="{{url('/admin/createvent')}}">
    {{ csrf_field()}}
      <div class="form-row justify-content-center">
        <div class="form-group col-md-6">
          <label for="title">Rengino pavadinimas</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Renginio pavadinimas" required="required">
        </div>
        <div class="form-group col-md-2">
          <label for="slots">Žmonių skaičius</label>
          <input type="text" name="slots" class="form-control" id="slots" placeholder="1" required="required">
        </div>
      </div>
      <div class="form-row justify-content-center">
        <div class="form-group col-md-8">
          <label for="description">Aprašymas</label>
          <textarea class="form-control" name="description" id="description" placeholder="Renginio aprašymas" rows="4" required="required"></textarea>
        </div>
      </div>
      <div class="form-row justify-content-center">
          <div class="form-group col-md-6">
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
      <center><button type="submit" class="btn btn-success">Sukurti renginį</button></center>
    </form>
  </div>
@endsection
