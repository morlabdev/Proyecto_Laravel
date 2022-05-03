<div class="card mb-5">
    <div class="card-body">
        @if($image->user->image)
        <div class="card-title">
            <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="rounded-circle float-start" width="35" height="35" alt="Avatar" loading="lazy">
        </div>
        @endif

        <div class="card-text">
            <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="link-dark text-decoration-none">
                {{ $image->user->name.' '.$image->user->surname }}
                <span class="text-muted">{{ ' | @'.$image->user->nick }}</span>
            </a>
        </div>

    </div>
    <div class="ratio ratio-4x3">
        <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="card-img-bottom">
    </div>

    <div class="card-body">
        <div class="card-button">
            <!--<button type="button" class="btn btn-outline-warning"><i class="bi bi-star"></i></button>
                                <button type="button" class="btn btn-outline-warning"><i class="bi bi-chat-dots"> ({{count($image->comments)}})</i></button>-->

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <?php $user_like = false; ?>
                    @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                            <?php $user_like = true; ?>
                        @endif
                    @endforeach

                    @if($user_like)
                    <!--<button type="button" class="btn btn-warning"><i class="bi bi-star"></i></button>-->
                    <a class="btn btn-sm btn-warning bi bi-star" data-id="{{$image->id}}" href="{{route('like.delete', ['image_id' => $image->id])}}"></a>

                    @else
                    <!--<button type="button" class="btn btn-outline-warning"><i class="bi bi-star"></i></button>-->
                    <a class="btn btn-sm btn-outline-warning bi bi-star" data-id="{{$image->id}}" href="{{route('like.save', ['image_id' => $image->id])}}"></a>
                    @endif

                    <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="bi bi-chat-dots"> ({{count($image->comments)}})</i>
                    </button>
                    <div class="fst-italic">
                        {{count($image->likes)}} likes
                    </div>
                    <div class="card-text">
                        <small class="text-muted">{{'@'.$image->user->nick}}</small>
                        <small class="text-muted">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</small>
                        <p class="card-text">{{$image->description}}</p>
                    </div>


                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach($image->comments as $comment)
                            <p class="card-text">
                                {{$comment->content}}
                                <small class="text-muted">{{'@'.$comment->user->nick}}</small>
                                <small class="text-muted">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</small>

                                @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                    <a class="btn btn-sm btn-outline-danger" href="{{ route('comment.delete', ['id' => $comment->id]) }}" role="button"><i class="bi bi-trash3"></i></a>
                                @endif
                            </p>

                            @endforeach
                            <form action="{{ route('comment.save') }}" method="post">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                <p>
                                    <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}" required></textarea>
                                </p>
                                <button type="submit" class="btn btn-sm btn-outline-success">Publicar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>