@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="uper">
            @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div><br />
            @endif
            <table class="table table-striped">
              <thead>
                  <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Created time</td>
                    <td colspan="2">Action</td>
                  </tr>
              </thead>
              <tbody>
                  <?php $Parsedown = new Parsedown(); ?>
                  @foreach($posts as $post)
                  <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->title}}</td>
                      <td>
                        <?php echo $Parsedown->text($post->description) ?>
                      </td>
                      <td>{{$post->created_at}}</td>
                      <td><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
                      <td>
                          <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          <div>
        </div>
    </div>
</div>    
@endsection