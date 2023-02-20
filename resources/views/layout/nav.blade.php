<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharma</title>
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/niceselect.css')}}">

    <style>

  
    </style>

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://kit.fontawesome.com/4ac6de9435.js" crossorigin="anonymous"></script>

</head>

<body class=" bg-l">
    @auth
    <div class="d-flex" id="wrapper">
        <div class=" n-g text-center hover-overlay" id="sidebar-wrapper">
            <div class="sidebar-heading"><span
                    class="ml-2 t-c">shaBeauty</span></div>
            <div class="list-group list-group-flush mt-4">


                <a href="{{ route('sale') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-shopping-cart" aria-hidden="true"></i>
                    sale
                </a>
        
                @if (Auth::user()->rule == 1)
                <a href="{{ route('sold') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-list-alt" aria-hidden="true"></i>
                    sold
                </a>
                
                <a href="{{ route('buy') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-money" aria-hidden="true"></i>
                    products
                </a>

                @endif
                
                <a href="{{ route('expire') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-calendar-times-o" aria-hidden="true"></i>
                    expire 
                    @if ($notfy >= 1)
                    <i style="font-size: 18px;" class="fas fa-bell text-danger position-absolute right-3"></i>
                    @endif
                </a>
                
                <a href="{{ route('notleft') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-battery-empty" aria-hidden="true"></i>
                    notleft
                </a>
                

                @if (Auth::user()->rule == 1)

                <a href="{{ route('supplier') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-user" aria-hidden="true"></i>
                    supplier
                </a>
                
                <a href="{{ route('debtlist') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-credit-card" aria-hidden="true"></i>
                    debtlist
                </a>

                <a href="{{ route('Cashier') }}" class="t-c t-b btn btn-lg mr-3 ml-3 mt-2 mb-2 radius-10">
                    <i style="font-size: 18px;" class=" d-flex float-left fa fa-user-plus" aria-hidden="true"></i>
                    cashier 
                </a>

                @endif




                <form action="logout" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-lg mt-5 mb-3 w-75 shadow-none ">
                        <i class="fas fa-sign-out-alt" style="display: flex; float: left; font-size: 18px;"></i>
                        logout                  
                    </button>
                </form>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="navbar navbar-expand-lg navbar-light  p-2 ">
                <button class="btn t-cb t-b border-darker radius-20 " id="menu-toggle"><i class="fas fa-bars "> </i>
                    Menu</button>


                @if ($notfy >= 1)
                <form action="expire" class="position-absolute right-2 ">
                    @csrf
                    <button class="btn border-danger t-cb radius-20 " id="menu-toggle"><i
                            class="fas fa-bell text-danger"></i></button>
                </form>
                @endif


            </div>

            <div class="container-fluid">
                @endauth

                @yield('content')

                @auth
            </div>
            
        </div>
    </div>
    @endauth





    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $(document).ready(function() {
        $('select').niceSelect();
    });

    </script>

    


</body>

</html>
