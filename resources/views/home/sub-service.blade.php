@extends('layouts.app')

@section('content')
@if (count($services) > 0)

    @foreach ($services as $service)
    @if ($service->user == Auth::user()->email)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$service->name}} {{ __('SubService Form') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@postSubService')}}" method="POST">
   @csrf
    <div class="form-group">
    <label>SubService Name</label>
    <input type="text" class="form-control" name="service-name" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="service-id" value="{{ $service->id }}" />
    
</div>
<div class="form-group">
    <label>Portfolio URL(link)</label>
    <input type="text" class="form-control" name="service-link" placeholder="Enter your service link such as(http://...)" />
    
</div>


<button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endif

@if (count($subServices) > 0)

    @foreach ($subServices as $subService)
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
            
            </div>
            <div class="col-md-4 col-sm-4">
         <h4><a href="{{ $subService->url }}"> {{$subService->name}} </a></h4>
       <small> {{$subService->url}} 
        @if ($service->user == Auth::user()->email)
         <a href="{{ url('dashboard/delete_sub_service/'.$subService->id) }}" class="btn btn-danger"> Delete </a></small>
        @endif        
    </div>
            </div>
        </div>
    @endforeach

@endif

@endforeach

@endif

@endsection
