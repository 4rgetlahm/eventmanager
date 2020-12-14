<!DOCTYPE HTML>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE_edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
    <link href="app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <script src="app.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>



    <!--ICONS !-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- ICONS END !-->
    <title>Renginių platforma</title>
  </head>
  <body>
      <div class="fill" style="margin-top: 15%"></div>
      <div class="container text-center">
          <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                  <center><img src="logo_dark.png"></center>
                  <br>
                  <p>„Renginių platforma“ - svetainė skirta palengvinti mokykloje ir už jos ribų vykstančių renginių organizavimą. Ši svetainė suteikia itin patogias valdymo funkcijas administracijai, o vartotojams - itin patogų valdymą ir registracijas į vykstamus renginius.</p>
                  <div class="fill" style="margin-top: 80px"></div>
                  <h5>Pasirinkite savo ugdymo įstaiga</h5>
                  <div class="fill" style="margin-top: 15px"></div>
                    <select onchange="change()" class="form-control form-control-sm" id="schoolSelection">
                        <option> </option>
                        <option value="1">Klaipėdos „Ąžuolyno“ gimnazija</option>
                    </select>
                </div>
          </div>
      </div>
      <script>
            function change(){
                val = document.getElementById("schoolSelection").value;
                if(val == 1){
                    window.location.replace("https://azuolynogimnazija.renginiai.it");
                }
            }
      </script>
  </body>
</html>
