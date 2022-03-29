@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Blog') }}</div>

                <div class="card-body">
    
<form action="{{ action('App\Http\Controllers\PagesController@postBlog')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter blog title" />
    <input type="hidden" class="form-control" name="poster" value="{{ Auth::user()->name }}" />
    <input type="hidden" class="form-control" name="poster_id" value="{{ Auth::user()->id }}" />
</div>
<div class="form-group">
    <label>Blog Content</label>
    <textarea class="form-control" name="content" placeholder="Enter your content here"></textarea>
    
</div>

<div class="form-group">
    <input type="file" name="blog-img" id="blog-img" />
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
<br />

@if (count($blogs) > 0)

    @foreach ($blogs as $blog)
        <div class="well cnt cnt-body">
            <div class="row center">
            <div class="col-md-4 col-sm-4">
             <img style="width: 100%" src="{{ asset('storage/img/blog/'.$blog->blog_img)}}" />
            </div>
            <div class="col-md-4 col-sm-4">
                <h4>{{$blog->title}}</h4>
                {{$blog->cnt}} 
                <small>{{$blog->created_at}}  |  <a href="{{ url('dashoard/delete_blog/'.$blog->id) }}"> Delete </a></small>
            </div>

            </div>
         
        </div>
    @endforeach
   
       
   @else
       <p>No blog post found</p>
@endif

@endsection
