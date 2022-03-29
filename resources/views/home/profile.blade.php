@extends('layouts.app')

@section('content')
@if (count($users) > 0)
@foreach ($users as $user)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if ($user->img != "")
                        <img src="{{ asset('storage/img/users/'.$user->email.'/'.$user->img)}}" width="150" >
                    @endif
                    {{ $user->name }}
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ action('App\Http\Controllers\PagesController@updateProfile')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession/Role') }}</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control" name="profession" value="{{ $user->profession }}" >

                                
                            </div>
                        </div>

                        

                        

                        

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $user->facebook }}" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="twitter" class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

                            <div class="col-md-6">
                                <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $user->twitter }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="linkedin" class="col-md-4 col-form-label text-md-right">{{ __('Linkedin') }}</label>

                            <div class="col-md-6">
                                <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $user->linkedin }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                            <div class="col-md-6">
                                <input id="instagram" type="text" class="form-control" name="instagram" value="{{ $user->instagram }}">

                            </div>
                        </div>

                        


                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                                
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endif

@endsection
