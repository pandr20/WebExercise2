@extends('master')

@section('content')
    <div
        style="background-image: url('{{ asset('imgs/login.jpg') }}'); background-size: cover; position: relative"
        class="h-100">
        <div style="position: absolute;background-color: black;height: 100%;width: 100%;opacity: 50%"></div>
        <div class="card shadow-sm"
             style="width: 500px; top: 50%;left: 50%;  transform: translate(-50%, -50%);position: absolute">
            <div class="card-header">
                <h3 class="mb-0">Login</h3>
            </div>
            <div class="card-body">
                <!-- Task 3 Guest, step 5: add the HTTP method and url as instructed-->
                <form method="post" action="login">
                    @csrf


                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control email" id="email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div class="form-text text-danger">{{ $errors->first('email') }}</div>
                        @endif

                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control password" id="password" >
                        @if($errors->has('password'))
                            <div class="form-text text-danger">{{ $errors->first('password') }}</div>
                        @endif

                </div>

                    <!-- Task 3 Guest, step 3: add login fields as instructed-->
                    <!-- Tip: you can use the same style as the registration form -->
                    <div class="d-flex justify-content-between align-items-center">

                        
                            <!-- Task 2 Guest, step 4: add submit button-->
    
                            <button type="login" class="p-3 mb-2 bg-primary text-white rounded py-2 px-4 login-submit" >Login</button>
                        
                        <!-- Task 3 Guest, step 4: add submit button-->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection