<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="{{$post->title}}" />
    <meta property="og:description" content="{{$post->title}}" />
    <meta property="og:url" content="{{ Request::url()  }}" />
    <meta property="og:type" content="article" />
    @if ($imgSrc)
        <meta property="og:image" content="{{ url($imgSrc) }}" />
    @endif
    <meta name="twitter:image:src" content="{{ url($imgSrc) }}">
    <meta name="twitter:site" content="@stephen29322578"><meta name="twitter:creator" content="@stephen29322578">
        
    <title>Earth and Mankind - {{$post->title}}</title>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lVidProject.css') }}" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css" rel="stylesheet">
        
    <!-- Fonts -->
    <link href="{{ asset('fonts/material-icons.css') }}" rel="stylesheet">
    <style>
        a {
            text-transform: capitalize;
            font-size: 1em;
            font-weight: 450;
        }
        .body {
            padding-bottom: 30px;
        }
        .text-muted {
            text-decoration: darkgray;
            font-weight: 500;
            font-style: oblique;
        }
        /* Nav */
        nav ul a:hover {
            background-color: black !important;
            color: #fff ;
        }
        nav .brand-logo {
            font-size: 1.5rem !important;
        }
        a {
            text-decoration: none !important;
        }
        /* Footer */
        footer {
            background-color: #f0f0f0 !important;
        }
        .page-footer .footer-copyright {
            min-height: 0px !important;
            padding: 2px 2px !important;
        }
        .page-footer {
            position: relative;
            top: 50px;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('includes.Nav')
        <div class="container mt-5">
            <div class="articles">
                <div class="main-container">
                    {{-- <div class="center" style="height:500px">
                        <div style="top:250px" class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-red-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div>
                        <div class="body row" id="body">
                            <div class="col s12 l11 m11">
                                <h1>{{$post->title}}</h1>
                                <p class="text-muted">Created on {{ Carbon\Carbon::parse($post->created_at)->isoFormat('MMMM Do YYYY')}}.</p>
                                <div >
                                    {!! $post->body !!}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.Footer')
    </div>
    
    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <p>
                <div>
                    Lagos Eyo Print Tee Shirt
                    ₦ 2,950
                </div>
            </p>
            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="3">
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

            <p>
                <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                </button>
            </p>
        </div>
    </div>
</form>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    <script src="{{ asset('js/materialize.js') }}" ></script>
    <script src="{{ asset('js/lVidProject.js') }}" ></script>
    
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f6233d08cd31b73"></script>
</body>
</html>
