<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register | Layanan Civitas SV</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


 
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="col-xl-6 col-lg-6 col-md-6 mx-auto">  
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <img src="img/logo_sv.png" alt="Logo 1" width="100">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun Si Maskot!</h1>
              </div>
              <form action="{{ route('register.simpan') }}" method="POST" class="user">
                @csrf
                <div class="form-group">
                  <input name="nama" type="text" class="form-control form-control-user @error('nama')is-invalid @enderror" id="exampleInputName" placeholder="Name">
                  @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <input name="nip" type="text" class="form-control form-control-user @error('nip')is-invalid @enderror" id="exampleInputNip" placeholder="NIP">
                  @error('nip')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group" >
                    <select id="level" onchange="cekItem()" name="level" class="form-control form-control-user @error('level')is-invalid @enderror"  id="exampleInputLevel">
                      
                      <option value="0">Pilih Role</option>
                      @foreach ($roles as $row)
                      <option value="{{ $row->role }}">{{ $row->role }}</option>
                      @endforeach
                    </select>
                  @error('level')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group" id="unit">
                    <select name="unit" class="form-control form-control-user @error('unit')is-invalid @enderror"  id="exampleInputUnit">
                      <option value="umum" selected>Pilih Unit</option>
                      @foreach ($units as $row)
                      <option value="{{ $row->nama_unit }}">{{ $row->nama_unit }}</option>
                      @endforeach
                    </select>
                  @error('unit')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" id="exampleInputEmail" placeholder="Email Address"
                  pattern=".+@staff\.uns\.ac\.id$" required>
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                    @error('password_confirmation')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script>
    document.getElementById("unit").style.display="none";
    function cekItem(){
      d = document.getElementById("level").value;
      if(d=="0" || d=="Super Admin" || d=="Dekan"){
        document.getElementById("unit").style.display="none";
      }else{
        document.getElementById("unit").style.display="block";
      
      }
}
  </script>
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
