@extends('layouts.app')

@section('content')


@if (count($requests) > 0)

    @foreach ($requests as $request)
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    
            </div>
            <div class="col-md-8 col-sm-8">
         <h4> <a href="{{ url('dashboard/service_request/'.$request->id) }}"> {{$request->service}} </a></h4> 
       <small> {{$request->name}}  -  <a href="mailto:{{ $request->email }}"> {{$request->email}} </a> | <a href="{{ url('dashboard/delect_request/'.$request->id) }}"> Delete </a>
    - {{$request->created_at}} - <a href="{{ url('dashboard/service_request') }}"> <---Go Back </a>
    </small>
       <p>{{$request->note}}</p>        
        </div>
            
            </div>
        </div>
    @endforeach

@endif

@endsection
