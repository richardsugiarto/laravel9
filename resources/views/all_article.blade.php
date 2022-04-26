@extends('layouts/app')
@section ('content')
<div class="container">
@php($ctr=0)
  @if (count($articles) > 0)
    @foreach ($articles as $article)
      @if($ctr==0)
      <div class="row">
      @endif
      <div class="col-sm-4">
        <div class="card card-body">
          <div class="card-title"><h2>{{$article->title}}</h2></div>
            <div class="card-text">
              <p><button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#a{{$article->id}}"  aria-expanded="false" aria-controls="collapseExample">{{__('Read more')}} >></button></p>
              <div class="collapse" id="a{{$article->id}}">
                <div class="card card-body">
                  {{$article->content}}
                </div>
              </div>
            </div>
        </div>
      </div>
      @php($ctr+=1)
      @if($ctr>=3)
        </div>
        @php($ctr=0)
      @endif
    @endforeach
  @else
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6"><h2>{{__('No Article')}}</h2></div>
    <div class="col-sm-3"></div>
  </div>
  @endif
</div>
@endsection




