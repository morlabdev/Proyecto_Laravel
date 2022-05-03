@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Usuarios</h1>

                <form action="{{ route('user.index') }}" method="get" id="buscador">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary bi bi-search" type="submit" id="button-addon2"></button>
                        <input type="text" id="search" class="form-control" placeholder="Search users" aria-label="Search users" aria-describedby="button-addon2">
                    </div>
                </form>

                @foreach($users as $user)
                    <div class="card border-0">
                        <div class="card-body">
                            <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="rounded-circle float-start" width="97" height="97" alt="Avatar" loading="lazy">
                            
                            <div class="card-title mt-4 offset-2">
                                <a href="{{ route('profile', ['id' => $user->id]) }}" class="link-dark text-decoration-none">
                                    <h5 class="card-title">{{ $user->name.' '.$user->surname.' | '.'@'.$user->nick }}</h5>
                                </a>
                                <p class="card-text">{{ ' Miembro desde: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                            </div>
                            
                        </div>
                        <div class="card-footer bg-transparent"></div>
                    </div>
                @endforeach

                {{$users->links()}}

            </div>
            
        </div>
    </div>
@endsection