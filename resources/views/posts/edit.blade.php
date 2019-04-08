@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card uper">
            <div class="card-header">
              Edit Post
            </div>
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div><br />
              @endif
                <form method="post" action="{{ route('posts.update', $post->id) }}">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">Post Name:</label>
                        <input type="text" class="form-control" name="title" value="{{$post->title}}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Book ISBN Number :</label>
                        <textarea class="form-control" name="description">{{$post->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
          </div>
          </div>
    </div>
</div>    
@endsection