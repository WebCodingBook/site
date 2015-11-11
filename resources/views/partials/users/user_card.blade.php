<div class="col-sm-3 col-md-3">
    <div class="panel panel-default panel-card">
        <div class="panel-heading text-center">
            <img src="{{ asset('assets/img/demo/card1.jpg') }}">
            @if( isset($canAdd) && $canAdd )
            <button class="btn btn-success btn-ar btn-sm right" role="button"><i class="fa fa-user-plus"></i> Ajouter</button>
            @elseif( isset($accept) && $accept )
            <a href="#" class="btn btn-danger btn-ar btn-sm" role="button"><i class="fa fa-times"></i> Refuser</a>
            <a href="#" class="btn btn-success btn-ar btn-sm" role="button"><i class="fa fa-check"></i> Accepter</a>
            @endif
        </div>
        <div class="panel-figure">
            <img class="img-responsive img-circle" src="{{ $u->avatar() }}">
        </div>
        <div class="panel-body text-center">
            <h4 class="panel-header"><a href="{{ route('user.view', ['username' => $u->username]) }}">{{ $u->full_name }}</a> @if( $u->username != $u->full_name )<small>({{ $u->username }})</small>@endif</h4>
            @if( !empty($u->location) )
            <small>{{ $u->location }}</small>
            @else
            <small>{{ $u->created_at }}</small>
            @endif
        </div>
        <div class="panel-thumbnails">
            <div class="row">
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img src="http://placemi.com/mzwlj/60x60">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img src="http://placemi.com/yboaj/60x60">
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img src="http://placemi.com/gv3bp/60x60">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>