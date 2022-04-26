@extends('layouts/app')
@section ('content')
<div class="container">
<div class="row">
  @if(Session::has('update'))
  <div class="panel panel-success"><div class="panel-heading">
    <div class="row">
      <div class="col-md-12">
        <div class="alert-success">
          {{Session::get('update')}}
        </div>
      </div>
    </div>
  </div></div>
    @endif
    @if(Session::has('delete'))
    <div class="panel panel-success"><div class="panel-heading">
    <div class="row">
      <div class="col-md-12">
        <div class="alert-success">
          {{Session::get('delete')}}
        </div>
      </div>
    </div>
  </div></div>
    @endif
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    @if (count($my_articles) > 0)
    @foreach ($my_articles as $my_article)
    <div class="card card-body">
      <div class="card-title"><h2>{{$my_article->title}}</h2>
          <form action="/update_article/{{ $my_article->id }}" method="GET">
          <button  class="btn btn-dark">{{__('Update')}}</button>
          </form>
          <form action="/delete_article/{{ $my_article->id }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button class="btn btn-dark">{{__('Delete')}}</button>
          </form>
      </div>
      <div class="card-text">
        <p>
          <button class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#a{{$my_article->id}}">{{__('Read more')}} >></button>
        </p>
        <div class="collapse" id="a{{$my_article->id}}">
          <div class="card card-body">
            {{$my_article->content}}
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @else
    <h2>{{__('Article not found')}}</h2>
    @endif
  </div>
  <div class="col-sm-3"></div>
</div>
</div>
@endsection




