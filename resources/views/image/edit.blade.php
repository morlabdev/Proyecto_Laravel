@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div class="card">
                <div class="card-header">Editar imagen</div>
            
                <div class="card-body">
                    <form action="{{route('image.update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}">
                        <div class="row mb-3">
                            <label for="image_path" class="col-md-4 col-form-label text-md-end">Imagen</label>
                            <div class="col-md-6">
                                @if($image->user->image)
                                    <div class="card-title">
                                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="card-img-bottom">
                                    </div>
                                @endif
                                <input id="image_path" type="file" name="image_path" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}">

                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Descripción</label>
                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" required>{{$image->description}}</textarea>

                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="Actualizar imagen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection