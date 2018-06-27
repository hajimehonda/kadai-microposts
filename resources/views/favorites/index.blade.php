<ul class="media-list">
@foreach ($favorites as $favorite)
    <?php $user = $favorite->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($favorite->content)) !!}</p>
            </div>
            <div>
                @if(Auth::user()->is_favoriting($favorite->id))
                     {!! Form::open(['route' => ['user.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                     {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-xs"]) !!}
                     {!! Form::close() !!}
                
                @else
                {!! Form::open(['route' => ['user.favorite', $favorite->id], 'method' => 'store']) !!}
                        {!! Form::submit('Favorite', ['class' => 'btn btn-primary btn-xs']) !!}
                        {!! Form::close() !!}
                    @endif
            <div>
                </div>
        </div>
    </li>
@endforeach