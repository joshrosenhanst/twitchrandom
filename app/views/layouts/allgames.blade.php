{{-- All Games --}}
@foreach($games->top as $game)
<div class="col-sm-2 game">
    <a href="/games/{{{ rawurlencode($game->game->name) }}}" title="{{{ $game->game->name }}}">
        <img src="{{{ $game->game->box->large }}}">
        <span class="title">{{{ $game->game->name }}}</span>
        <span class="viewers"><span class="glyphicon glyphicon-eye-open"></span>{{{ $game->viewers }}}</span>
    </a>
</div>
@endforeach