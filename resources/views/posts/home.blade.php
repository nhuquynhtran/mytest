@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-10 mx-auto">
                                <?php $Parsedown = new Parsedown(); ?>
                                @foreach($posts as $post)
                                <div>
                                    <h5>
                                        <a href="{{url('/post-detail').'/'.$post->id}}">
                                        {{$post->title}}
                                        </a>
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
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
