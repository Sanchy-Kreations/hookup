@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Site Content') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@updateContent')}}" method="POST">
   @csrf
    <div class="form-group">
    <label>Field</label>
    <select id="cnt-name" name="cnt-name">
        @if (count($contents) > 0)

        @foreach ($contents as $content)
         <option value="{{$content->name}}">{{$content->name}}</option>
        @endforeach

        @endif
    </select>

</div>
<div class="form-group">
    <label>Content</label>
    <textarea class="form-control" name="content" placeholder="Enter content here"></textarea>
    
</div>


<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>

@endsection
