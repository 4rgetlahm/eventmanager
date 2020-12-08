@extends('layouts.design')
@section('content')


    @if (session('success'))
        <div style="margin-top: 40px;"></div>
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
    @endif
    @if (session('warning'))
        <div style="margin-top: 40px;"></div>
        <div class="alert alert-warning">
            {!! Session::get('warning') !!}
        </div>
    @endif
    @if (session('danger'))
        <div style="margin-top: 40px;"></div>
        <div class="alert alert-danger">
            {!! Session::get('danger') !!}
        </div>
    @endif

@if(count($Events) >= 1)
<div style="margin-top: 40px;"></div>
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="textedit">
                    <h5 class="modal-title" id="edit-modal-label">Ar tikrai norite registruotis į šį renginį ?</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="registration_form" method="POST" action={{url("/events/register")}}>
                    {{ csrf_field()  }}
                    <input type="hidden" name="eventID">
                    <input type="hidden" name="reg">
                    <button type="button" id="registerButton" class="btn btn-success" data-dismiss="modal">Registruotis</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', "#edit-item", function() {
            $(this).addClass('edit-item-trigger-clicked');
            var options = {
                'backdrop': 'static'
            };
            $('#edit-modal').modal(options).css("z-index", "1500");;
        })

        $('#registerButton').click(function() {
            $('#registration_form').submit();
        });

        $('#edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked");
            var id = el.data('item-id');
            var Title = el.data('item-title');

            var Register = el.data('item-reg');
            var regValue = document.getElementsByName("reg")[0];
            regValue.setAttribute('value', Register);


            if (Register == true) {
                $(".textedit h5").html("Ar tikrai norite registuotis į renginį: " + Title + " ?");
                var button = document.getElementById("registerButton");
                button.setAttribute('class', "btn btn-success");
                button.innerText = "Registruotis";
            } else {
                $(".textedit h5").html("Ar tikrai norite išsiregistruoti iš renginio: " + Title + " ?");
                var button = document.getElementById("registerButton");
                button.setAttribute('class', "btn btn-danger");
                button.innerText = "Išsiregistruoti";
            }
            var eventID = document.getElementsByName("eventID")[0];
            eventID.setAttribute('value', id);
        })

        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })

    })
</script>

@foreach ($Events as $event)
<div class="row" style=" background-color: #eae9e7;">
    <div class="col-xl-12">
        <div class="float-right" style="margin-top:5px;">
            <!--<a href="#" class="badge badge-secondary">{{date('Y-m-d', strtotime($event->date))}}</a> !-->
            <small class="text-muted">{{date('Y-m-d', strtotime($event->date))}}</small>
        </div>
        <div class="filler_before"></div>
        <h4 class="display-4" style="margin-left: 15px; font-size: 35px;">{{$event->title}}</h3>
            <p style="word-wrap:break-word; font-size: 13px; margin-left:35px;">{{$event->description}}</p>
            @php
            $slots = $event->slots;
            $lithuanian = "";
            if($slots % 10 == 0 || ($slots > 10 && $slots
            < 20) ){ $lithuanian="VIETŲ" ; } else if(($slots-1) % 10==0){ $lithuanian="VIETA" ; } else { $lithuanian="VIETOS" ; } @endphp
            <div class="container">
                @if($event->slots > 0)
                    <h5 style="text-align: right; margin-right: 5px;">LIKO {{$slots}} {{$lithuanian}}
        </h4>
        @endif
        @if(!(Auth::guest()))
            @php
                $user = \Auth::user();
                $regList = $event->registered;
                $email = $user->email;
            @endphp
        @if($event->slots > 0)
            @if(!(strpos($regList, $email) !== false))
                <button type="button" class="btn btn-outline-dark my-2 my-sm-0" style="float: right;" id="edit-item" data-item-id="{{$event->id}}" data-item-title="{{$event->title}}" data-item-reg="true">REGISTRUOTIS</button>
            @else
                <button type="button" class="btn btn-outline-danger my-2 my-sm-0" style="float: right;" id="edit-item" data-item-id="{{$event->id}}" data-item-title="{{$event->title}}" data-item-reg="false">IŠSIREGISTRUOTI</button>
            @endif

            @else
                @if(strpos($regList, $email) !== false)
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" style="float: right;" id="edit-item" data-item-id="{{$event->id}}" data-item-title="{{$event->title}}" data-item-reg="false">IŠSIREGISTRUOTI</button>
                @else
                <button type="button" class="btn btn-outline-primary my-2 my-sm-0" disabled style="float: right;">REGISTRACIJA IŠJUNGTA</button>
                @endif
            @endif

            @else
                @if($event->slots <= 0)
                    <button type="button" class="btn btn-outline-primary my-2 my-sm-0 float-right" onclick="login();">REGISTRACIJA IŠJUNGTA</button>
                @else
                    <button type="button" class="btn btn-outline-dark my-2 my-sm-0 float-right" onclick="login();">REGISTRUOTIS</button>
                @endif
            @endif
    </div>
        <div class="filler_after"></div>
</div>
</div>
<div class="gap"></div>

@endforeach
@else
<div class="container" style="margin-top: 40px;">
    <center>
        <h1>Renginių šiuo metu nėra.</h1>
    </center>
</div>
@endif


@if(\Session::has('event_created'))
    <script>
        alert("Sukūrėte renginį!");
    </script>
@endif
@if(\Session::has('event_edit'))
    @if(\Session::get('event_edit') == 'remove')
        <script>
            alert("Panaikinote renginį!");
        </script>
    @endif
    @if(\Session::get('event_edit') == 'true')
        <script>
            alert("Pakeitėte renginį!");
        </script>
    @endif
@endif

@endsection
