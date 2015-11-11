<header class="main-header no-margin-bottom">
    <div class="container">
        <h1 class="page-title">{{ $title }}</h1>

        @if( !empty($navs) )
        <ol class="breadcrumb pull-right">
        <?php $count = 1; ?>
            <li><a href="{{ route('front.index') }}">Accueil</a></li>
            @foreach( $navs as $nav  )
            @if( $count != count($navs) )
            <li><a href="{{ $nav['link'] }}">{{ $nav['title'] }}</a></li>
            @else
            <li class="active">{{ $nav['title'] }}</li>
            @endif
            <?php $count++; ?>
            @endforeach
        </ol>
        @endif
    </div>
</header>