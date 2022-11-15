<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Koala - Authentication</title>
        <link rel="stylesheet" href="{{asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
    </head>
    <body>
        <section class="vh-100" style="background-color: #9A616D;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="{{asset('assets/images/cow.jpg')}}"
                          alt="login form" class="img-fluid" height="700" style="border-radius: 1rem 0 0 1rem;" />
                      </div>
                      {{$slot}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
        <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
        <script src="{{asset('assets/js/off-canvas.js')}}"></script>
        <script src="{{asset('assets/js/misc.js')}}"></script>
    </body>
</html>
