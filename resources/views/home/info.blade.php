@extends('layouts.app')

@section('content')
@if (count($infos) > 0)

@foreach ($infos as $info)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Site Info') }}</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ action('App\Http\Controllers\PagesController@updateInfo')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('mobile') is-invalid @enderror" name="phone" value="{{ $info->phone }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $info->mobile }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $info->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">{{ $info->address }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $info->facebook }}" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="twitter" class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

                            <div class="col-md-6">
                                <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $info->twitter }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="linkedin" class="col-md-4 col-form-label text-md-right">{{ __('Linkedin') }}</label>

                            <div class="col-md-6">
                                <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $info->linkedin }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                            <div class="col-md-6">
                                <input id="instagram" type="text" class="form-control" name="instagram" value="{{ $info->instagram }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="youtube" class="col-md-4 col-form-label text-md-right">{{ __('Youtube') }}</label>

                            <div class="col-md-6">
                                <input id="youtube" type="text" class="form-control " name="youtube" value="{{ $info->youtube }}" >

                                
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control" name="logo">
                                @if ($info->logo != "")
                                    <img src="{{asset('storage/img/logo/'.$info->logo)}}" width="100" />
                                @endif
                               
                            </div>

                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>

                            <div class="col-md-6">
                                <input id="icon" type="file" class="form-control" name="icon">
                                @if ($info->icon != "")
                                    <img src="{{asset('storage/img/icon/'.$info->icon)}}" width="100" />
                                @endif
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client Capacity') }}</label>

                            <div class="col-md-6">
                                <input id="client" type="number" class="form-control " name="client" value="{{ $info->client_capacity }}" >

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project" class="col-md-4 col-form-label text-md-right">{{ __('Projects Done') }}</label>

                            <div class="col-md-6">
                                <input id="project" type="number" class="form-control " name="project" value="{{ $info->project_done }}" >

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="award" class="col-md-4 col-form-label text-md-right">{{ __('Award won') }}</label>

                            <div class="col-md-6">
                                <input id="award" type="number" class="form-control " name="award" value="{{ $info->awards }}" >

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="countries" class="col-md-4 col-form-label text-md-right">{{ __('Countries Reached') }}</label>

                            <div class="col-md-6">
                                <input id="countries" type="number" class="form-control " name="countries" value="{{ $info->countries_reached }}" >

                                
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Info') }}
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
