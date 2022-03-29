@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('News Letter') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@SendNewsLetter')}}" method="POST">
   @csrf
    <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter title" />
    <input type="hidden" class="form-control" name="poster" value="{{ Auth::user()->name }}" />
    <input type="hidden" class="form-control" name="sender" value="{{ Auth::user()->email }}" />
    
</div>
<div class="form-group">
    <label> Content</label>
    <textarea class="form-control" name="content" placeholder="Enter your content here"></textarea>
    
</div>

<button type="submit" class="btn btn-primary">Send</button>
<br />
<input type="checkbox" id="select-all" onselect="selectAll(this.id)">Select All
@if (count($newsLetters) > 0)

    @foreach ($newsLetters as $news)
        <div class="cnt cnt-body">
           
            @if ($news->active == 0)
    <input type="checkbox" disabled value="">
            @else
    <input type="checkbox" id="news-email" name="news-email" value="{{$news->email}}">
            @endif
            
         <a href="mailto:{{$news->email}}"> {{$news->email}} </a>
         
        </div>
    @endforeach

@endif

</form>
</div>
</div>
</div>
</div>
</div>




@endsection
