<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin | Login</title>
  <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

  <link rel="shortcut icon" href="{{asset('public/backend/images/favicon.png')}}">
</head>
<body>
   <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
    
                    <div class="text-center">
                      <img src="{{asset('public/backend/images/logo.png')}}"
                        style="width: 185px; margin-bottom: 25px" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1">We are An Hoai Motor Team</h4>
                    </div>
    
                    <form>
                      <p>Please login to your account</p>
    
                      <div class="form-outline mb-4">
                        <input type="email" id="form2Example11" class="form-control"/>
                          {{-- placeholder="Username" /> --}}
                        <label class="form-label" for="form2Example11">Username</label>
                      </div>
    
                      <div class="form-outline mb-4">
                        <input type="password" id="form2Example22" class="form-control" />
                        <label class="form-label" for="form2Example22">Password</label>
                      </div>
    
                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Login</button>
                        {{-- <a class="text-muted" href="#!">Forgot password?</a> --}}
                      </div>
    
                      {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <button type="button" class="btn btn-outline-danger">Create new</button>
                      </div> --}}
    
                    </form>
    
                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">We are more than just a company</h4>
                    <p class="small mb-0">Tìm kiếm một nơi bạn có thể đạt được nhiều hơn là những thành tựu công việc? Cùng khám phá ngay xem An Hoài Motor Việt Nam còn điều gì đáng mong chờ!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   </body>
</html>
