@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card border-0 mb-5">
                    <div class="card-body">
                        <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="rounded-circle float-start" width="200" height="200" alt="Avatar" loading="lazy">
                        <div class="col-md-6 offset-md-4">
                            <h3 class="card-title">{{ '@'.$user->nick }}</h3>
                            <h2 class="card-title">{{ $user->name.' '.$user->surname }}</h2>
                            <a class="btn btn-warning" href="{{ route('image.create') }}" role="button">Subir imagen</a>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent">
                        <p class="card-text">{{ ' Miembro desde: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                    </div>
                </div>
                
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($user->images as $image)

                        <div class="col">
                            <div class="card">
                                <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                    <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="card-img-top" alt="...">
                                </a>
                            </div>
                        </div>
                    
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
@endsection