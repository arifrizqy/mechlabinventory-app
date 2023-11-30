@extends('app')

@section('body-content')
<body class="bg-gradient-primary d-flex align-items-center" style="height: 100vh">

    <div class="bg-info container-fluid fixed-top py-3">
        <div class="d-flex">
            @foreach ($items as $item)
                <div class="card shadow mr-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->description }}</h5>
                        <h6 class="badge badge-success py-1 px-3">Tersedia</h6> : {{ $item->stock }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background:url({{ asset('img/login-thumbnail.jpg') }});background-position:center;background-size:cover;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">MechLabInventory<small><sup>APP</sup></small></h1>
                                    </div>
                                    <form class="user" action="/login" method="POST">
                                        @csrf
                                        @if ($errors->has('credentials'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('credentials') }}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputusername" aria-describedby="UsernamelHelp"
                                                placeholder="Enter Username..." name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <button  class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- JavaScript - Library --}}
    @include('partials.script')

</body>
@endsection
