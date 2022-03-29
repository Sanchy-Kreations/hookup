@extends('layouts.app')

@section('content')

@if (count($messages) > 0)

    @foreach ($messages as $message)
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    
            </div>
            <div class="col-md-4 col-sm-4">
         <h4> <a href="{{ url('dashboard/messages/'.$message->id) }}"> {{$message->subject}} </a></h4> 
       <small> {{$message->name}}  | <a href="mailto:{{ $message->email }}"> {{$message->email}} </a> | <a href="{{ url('dashboard/delect_messages/'.$message->id) }}"> Delete </a></small>
            </div>
            </div>
        </div>
    @endforeach

@endif

@endsection
