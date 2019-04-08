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
              <a href="{{url('/')}}">Home</a> >>Post Detail
            </div>
            <div class="card-body">
              <?php $Parsedown = new Parsedown(); ?>
              <div>
                  <h5>
                      {{$post->title}}
                  </h5>
                  <div>
                      <?php
                          echo $Parsedown->text($post->description); 
                      ?>
                  </div>
                  <p>Posted by
                      <a href="#">{{$post->user->name}}</a>
                      {{$post->created_at}}
                  </p>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>    
@endsection