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
          <form method="post" action="{{ url('admin/search') }}">
              <div class="form-group">
                  @csrf
                  <label for="name">Created time:</label>
                  <input type='text' name="created_at" value="" class="form-control" placeholder="YYYY-MM-DD" />
              </div>
              <div class="form-group">
                <label for="name">Status:</label>
                <select name="status" class="form-control">
                      <option value="all" selected>ALL</option>
                      <option value="1">Publish</option>
                      <option value="0">Unpublish</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="name">Order By:</label>
                  <select name="order_by" class="form-control">
                        <option value="created_at">Created time</option>
                        <option value="status">Status</option>
                    </select>
              </div>
              <button type="submit" class="btn btn-primary">Filter</button>
          </form>
        </div>
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
                    <td>Action</td>
                    <td>Set auto publish on time</td>
                  </tr>
              </thead>
              <tbody>
                  @csrf
                  <?php $Parsedown = new Parsedown(); ?>
                  @foreach($posts as $post)
                  <tr id='sortable' style="{{($post->status==0)? 'background-color: #FFFF00':''}}">
                      <td>{{$post->id}}</td>
                      <td>{{$post->title}}</td>
                      <td>
                            <?php echo $Parsedown->text($post->description); ?>
                      </td>
                      <td>{{$post->created_at}}</td>
                      <td>
                          <a class="btn btn-primary" href="javascript:;" onclick="publish({{$post->id}})">{{($post->status)?'Un-Publish':'Publish'}}</button>
                      </td>
                      <td>
                        @if ($post->status || $post->auto_publish)
                          {{$post->publish_time}}
                        @else
                          <form action="{{ url('admin/auto_publish/').'/'.$post->id}}" method="post">
                            @csrf
                            <input type='text' name="publish_time" value="" class="form-control" placeholder="{{date('Y-m-d h:i:s')}}" />
                            <button class="btn btn-primary" type="submit">Save</button>
                          </form>
                        @endif
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          <div>
        </div>
    </div>
</div>    
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    function publish(post_id) {
      $.ajax({
        type:'GET',
        url:'/admin/publish/'+ post_id,
        success:function(data){
          if(data.status){
            alert(data.message);
            location.reload();
          }
        }
      });
    }
    $('sortable').sortable();
</script>
@endsection