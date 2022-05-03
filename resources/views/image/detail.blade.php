@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('includes.message')
                
                    <div class="card mb-5">
                        <div class="card-body">
                            @if($image->user->image)
                                <div class="card-title">
                                    <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="rounded-circle float-start"
                                    width="35" height="35" alt="Avatar" loading="lazy" >
                                </div>
                            @endif

                            <div class="card-text">
                                {{ $image->user->name.' '.$image->user->surname }}
                                <span class="text-muted">
                                    {{ ' | @'.$image->user->nick }}
                                </span>
                            </div>
                            
                        </div>
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="card-img-bottom">
                        <div class="card-body">
                            <div class="card-button">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <?php $user_like = false; ?>
                                        @foreach($image->likes as $like)
                                            @if($like->user->id == Auth::user()->id)
                                                <?php $user_like = true; ?>
                                            @endif
                                        @endforeach

                                        @if($user_like)
                                            <a class="btn btn-warning bi bi-star" href="{{route('like.delete', ['image_id' => $image->id])}}"></a>
                                        @else
                                            <a class="btn btn-outline-warning bi bi-star" href="{{route('like.save', ['image_id' => $image->id])}}"></a>
                                        @endif

                                        <button class="btn btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <i class="bi bi-chat-dots"> ({{count($image->comments)}})</i>
                                        </button>

                                        @if(Auth::user() && Auth::user()->id == $image->user->id)
                                            <a class="btn btn-sm btn-danger bi bi-backspace" href="{{route('image.edit', ['id' => $image->id])}}"> Editar</a>
                                            

                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger bi bi-trash3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Está a punto de borrar la imagen, ¿Desea continuar?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a class="btn btn-danger bi bi-trash3" href="{{route('image.delete', ['id' => $image->id])}}" role="button"> Eliminar</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

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
                                                            <!--<a href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>-->
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
                                        @if($errors->has('content'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
@endsection