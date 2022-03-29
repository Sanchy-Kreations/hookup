@extends('layouts.app')

@section('content')

@if (count($messages) > 0)

    @foreach ($messages as $message)
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    
            </div>
            <div class="col-md-4 col-sm-4">
<h4> <a href="#"> {{$message->subject}} </a></h4> 
          <small> {{$message->name}}  -  <a href="mailto:{{ $message->email }}"> {{$message->email}} </a> | <a href="{{ url('dashboard/delect_message/'.$message->id) }}"> Delete </a>
    - {{$message->created_at}} - <a href="{{ url('dashboard/messages') }}"> <---Go Back </a>
    </small>
       <p>{{$message->message}}</p> 

            </div>
            </div>
        </div>
    @endforeach

@endif

@endsection
