@extends('layouts.app')

@section('content')
@if (count($services) > 0)

    @foreach ($services as $service)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Service') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@updateService')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="form-group">
    <label>Service Name</label>
    <input type="text" class="form-control" name="service-name" value="{{$service->name}}" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="service-id" value="{{ $service->id }}" />
    
</div>
<div class="form-group">
    <label>About Service</label>
    <textarea class="form-control" name="content" placeholder="Enter a brief info about the service here">
        {{$service->content}}
    </textarea>
    
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

@endforeach

@endif

@endsection
