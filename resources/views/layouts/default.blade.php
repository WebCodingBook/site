<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>@yield('title') :: Web Coding Book</title>

    @yield('meta')

    <link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico"/>

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/preload.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendors.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style-blue.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}"/>

    @yield('css')
</head>
<body>
<div id="sb-site">
    <div class="boxed">
        <nav class="navbar navbar-default navbar-dark yamm navbar-static-top" role="navigation" id="header">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <a id="ar-brand" class="navbar-brand" href="{{ route('front.index') }}"><i class="fa fa-globe"></i>  Web <span>Coding</span> Book</a>
                </div>

                <div class="pull-right">
                    <a href="javascript:void(0);" class="sb-icon-navbar sb-toggle-right"><i class="fa fa-bars"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('front.index') }}">Accueil</a></li>
                        @if( Auth::check() )
                        <li><a href="{{ route('user.view', ['username' => Auth::user()->username]) }}">{{ Auth::user()->full_name }}</a></li>
                        <li><a href="{{ route('front.index') }}">Evènements</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon profil</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="navbar-login">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p class="text-center">
                                                        <img src="{{ Auth::user()->avatar() }}" class="img-responsive img-rounded" alt="Ma photo de profil"/>
                                                    </p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p class="text-left"><strong>{{ Auth::user()->full_name }}</strong></p>
                                                    <p class="text-left small">{{ Auth::user()->email }}</p>
                                                    <p class="text-left">
                                                        <a href="{{ route('profile.edit') }}" class="btn btn-ar btn-primary btn-block btn-sm">Modifer mon profil</a>
                                                        <a href="{{ route('friends.index') }}" class="btn btn-ar btn-success btn-block btn-sm">Gérer mes contacts</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="navbar-login navbar-login-session">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>
                                                        <a href="{{ route('auth.signout') }}" class="btn btn-ar btn-danger btn-block">Me déconnecter</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @else
                        <li><a href="{{ route('auth.signin') }}">Se connecter</a></li>
                        <li><a href="{{ route('auth.signup') }}">S'enregistrer</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        @if( Route::current()->getName() == 'front.index' )
        <aside id="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="footer-widget-title">Sitemap</h3>
                        <ul class="list-unstyled three_cols">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="portfolio_sidebar.html">Portafolio</a></li>
                            <li><a href="portfolio_topvar.html">Works</a></li>
                            <li><a href="page_timeline_left.html">Timeline</a></li>
                            <li><a href="page_pricing.html">Pricing</a></li>
                            <li><a href="page_about2.html">About Us</a></li>
                            <li><a href="page_team.html">Our Team</a></li>
                            <li><a href="page_services.html">Services</a></li>
                            <li><a href="page_support.html">FAQ</a></li>
                            <li><a href="page_login_full.html">Login</a></li>
                            <li><a href="page_contact.html">Contact</a></li>
                        </ul>
                        <h3 class="footer-widget-title">Subscribe</h3>
                        <p>Lorem ipsum Amet fugiat elit nisi anim mollit minim labore ut esse Duis ullamco ad dolor veniam velit.</p>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Email Adress">
                    <span class="input-group-btn">
                        <button class="btn btn-ar btn-primary" type="button">Subscribe</button>
                    </span>
                        </div><!-- /input-group -->
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h3 class="footer-widget-title">Recent Post</h3>
                            <div class="media">
                                <a class="pull-left" href="#"><img class="media-object" src="assets/img/demo/m2.jpg" width="75" height="75" alt="image"></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">Lorem ipsum Duis quis occaecat minim lorem ipsum tempor officia labor</a></h4>
                                    <small>August 18, 2013</small>
                                </div>
                            </div>
                            <div class="media">
                                <a class="pull-left" href="#"><img class="media-object" src="assets/img/demo/m11.jpg" width="75" height="75" alt="image"></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">Lorem ipsum dolor excepteur sunt in lorem ipsum cillum tempor</a></h4>
                                    <small>September 14, 2013</small>
                                </div>
                            </div>
                            <div class="media">
                                <a class="pull-left" href="#"><img class="media-object" src="assets/img/demo/m4.jpg" width="75" height="75" alt="image"></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">Lorem ipsum Dolor cupidatat minim adipisicing et fugiat</a></h4>
                                    <small>October 9, 2013</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h3 class="footer-widget-title">Recent Works</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                    <a href="#" class="thumbnail"><img src="assets/img/demo/wf1.jpg" class="img-responsive" alt="Image"></a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                    <a href="#" class="thumbnail"><img src="assets/img/demo/wf2.jpg" class="img-responsive" alt="Image"></a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                    <a href="#" class="thumbnail"><img src="assets/img/demo/wf3.jpg" class="img-responsive" alt="Image"></a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                    <a href="#" class="thumbnail"><img src="assets/img/demo/wf4.jpg" class="img-responsive" alt="Image"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        @endif

        <footer id="footer">
            <p>&copy; {{ Date::now()->format('Y') }} <a href="#">Web Coding Book</a> - Tous Droits Réservés<br /><br/> Réalisé avec <i class="fa fa-heart text-danger"></i> par Alexandre Ribes, <a href="#">Développeur Web sur Perpignan</a></p>
        </footer>
    </div>
</div>

<div class="sb-slidebar sb-right">
    <form method="POST" action="{{ route('search.users') }}">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" name="search_user" class="form-control" placeholder="Rechercher une personne">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>

    <h2 class="slidebar-header no-margin-bottom">Mes contacts connectés</h2>
    <ul class="slidebar-menu">
        <li><a href="#"><i class="fa fa-user text-success"></i> SquallX</a></li>
        <li><a href="#"><i class="fa fa-user text-danger"></i> SquallX</a></li>
        <li><a href="#"><i class="fa fa-user text-danger"></i> SquallX</a></li>
        <li><a href="#"><i class="fa fa-user text-success"></i> SquallX</a></li>
    </ul>

    <h2 class="slidebar-header">Nous suivre</h2>
    <div class="slidebar-social-icons">
        <a href="#" class="social-icon-ar rss"><i class="fa fa-rss"></i></a>
        <a href="#" class="social-icon-ar facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="social-icon-ar twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="social-icon-ar google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="social-icon-ar youtube"><i class="fa fa-youtube"></i></a>
        <a href="#" class="social-icon-ar instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="social-icon-ar linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="social-icon-ar pinterest"><i class="fa fa-pinterest"></i></a>
        <a href="#" class="social-icon-ar git"><i class="fa fa-github"></i></a>
    </div>
</div>

<div id="back-top">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
</div>

<script src="{{ asset('js/vendors.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
@include('sweet::alert')
@yield('js')
</body>
</html>