<div class="media post">
        @include('shared._vote',['model'=>$answer])
        <div class="d-fex flex-column vote-controls">

            <a class="vote-up {{ Auth::guest() ? 'off':'' }}" title="This answer is useful" onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"> <i class="fas fa-caret-up fa-3x"></i> </a>
            <form action="/answers/{{ $answer->id }}/vote" id="up-vote-answer-{{ $answer->id }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="vote" value="1">
            </form>
            <span class="votes-count">{{ $answer->votes_count }} </span>
            <a title="This answer is not useful" class="vote-down {{ Auth::guest() ? 'off':'' }}" onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"><i class="fas fa-caret-down fa-3x"></i></a>
            <form action="/answers/{{ $answer->id }}/vote" id="down-vote-answer-{{ $answer->id }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="vote" value="-1">
            </form>
            <a title="Click to mark as fovorite question (Click again to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off':($answer->is_favorited ? 'favorited':'') }}" onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $answer->id }}').submit();"><i class="fas fa-star fa-2x"></i> <span class="favorites-count">{{ $answer->favorites_count }}</span> </a>
            <form action="/answers/{{ $answer->id }}/favorites" id="favorite-question-{{ $answer->id }}" method="POST" style="display:none;">
                @csrf
                @if($answer->is_favorited)
                    @method('DELETE')
                @endif
            </form>
            
            

        </div>
        <div class="media-body">
            {!! $answer->body_html !!}
            <div class="row">
                <div class="col-4">
                    <div class="ml-auto">

                        @can('update',$answer)
                            <a href="{{ route('questions.answers.edit',[$answer->id,$answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                        @endcan

                        @can('delete',$answer)
                        <form class="form-delete" action="{{ route('questions.answers.destroy',[$answer->id,$answer->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endcan

                    </div>
                </div>
                <div class="col-4">

                </div>
                <div class="col-4">
                   @include('shared._author',['model'=>$answer,'label'=>'answerd'])
                </div>
            </div>
        </div>
    </div>