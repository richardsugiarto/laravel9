@extends('layouts/app')
@section ('content')
<div class="container">
<div class="row">
  <div class="col-sm-3">
    <form action="/my_article" method="GET">
    <button class="btn btn-dark">{{__('Back')}}</button>
    </form>
  </div>
  <div class="col-sm-6">
    <div class="panel panel-default">
    <div class="panel-heading"><h2>{{__('Update an Article')}}</h2>
    </div>
    <div class="panel-body">
        <form action="/update_article_action" method="POST">
          {{ method_field('PUT') }}
          <input type="hidden" name="_token" value="{{csrf_token()}}">
           <input type="hidden" name="id" value="{{$my_articles->id}}">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="title" name="title" class="form-control" id="title" placeholder="Enter the title" value="{{$my_articles->title}}">
            @if($errors->has('title')) <p style='color:red;'>{{$errors->first('title')}}</p> @endif
          </div>
          <div class="form-group">
            <label for="content">Content:</label>
            <textarea rows='5' name="content" class="form-control" id="content" placeholder="Enter the content">{{$my_articles->content}}</textarea>
            @if($errors->has('content')) <p style='color:red;'>{{$errors->first('content')}}</p> @endif
          </div>
          <button type="submit" class="btn btn-dark">{{__('Update')}}</button>
        </form>
    </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>
</div>
@endsection



