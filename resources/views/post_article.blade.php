@extends('layouts/app')
@section ('content')
<div class="container">
<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="panel panel-default">
    <div class="panel-heading"><h2>{{__('Post an Article')}}</h2>
        @if(Session::has('success'))
        <div class="row">
          <div class="col-md-12">
            <div class="alert-success">
              {{Session::get('success')}}
            </div>
          </div>
        </div>
        @endif
    </div>
    <div class="panel-body">
        <form action="post_article_action" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id_users" value="{{ucwords(Auth::user()->id)}}">
          <div class="form-group">
            <label for="title">{{__('Title')}}:</label>
            <input type="title" name="title" class="form-control" id="title" placeholder="Enter the title" >
            @if($errors->has('title')) <p style='color:red;'>{{$errors->first('title')}}</p> @endif
          </div>
          <div class="form-group">
            <label for="content">{{__('Content')}}:</label>
            <textarea rows='5' name="content" class="form-control" id="content" placeholder="Enter the content" ></textarea>
            @if($errors->has('content')) <p style='color:red;'>{{$errors->first('content')}}</p> @endif
          </div>
          <button type="submit" class="btn btn-dark">{{__('Post')}}</button>
        </form>
    </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>

</div>
@endsection



