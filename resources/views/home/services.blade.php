@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Service') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@postService')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="form-group">
    <label>Service Name</label>
    <input type="text" class="form-control" name="service-name" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="user" value="{{ Auth::user()->email }}" />
    
</div>
<div class="form-group">
    <label>About Service</label>
    <textarea class="form-control" name="content" placeholder="Enter a brief info about the service here"></textarea>
    
</div>

<div class="form-group">
    <input type="file" name="serv-img" id="serv-img" />
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>


@if (count($services) > 0)

    @foreach ($services as $service)
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    <img style="width: 100%" src="{{ asset('storage/img/services/'.$service->tag)}}" />
            </div>
            <div class="col-md-4 col-sm-4">
         <h4><a href="{{ url('dashboard/services/'.$service->id) }}"> {{$service->name}} </a></h4>
         {{$service->content}} 
       <small> {{$service->user}} 
        @if ($service->user == Auth::user()->email)
        <a href="{{ url('dashboard/edit_service/'.$service->id) }}" class="btn btn-default"> Edit </a> | <a href="{{ url('dashboard/delete_service/'.$service->id) }}" class="btn btn-danger"> Delete </a></small>
        @endif        
    </div>
            </div>
        </div>
    @endforeach

@endif

@endsection
