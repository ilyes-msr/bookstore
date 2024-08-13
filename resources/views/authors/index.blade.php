@extends('layouts.main')

@section('head')
<style>
  a {
    text-decoration: none
  }
</style>
@endsection
@section('content')
<div class="container">
  <h5 class="text-center">{{$title}}</h5>
  <form method="GET" action="{{route('authors.search')}}">
    <div class="mb-3 row d-flex justify-content-center">
      <input type="text" class="col-3 mx-sm-3 mb-2" name="term" value="{{$term ?? ''}}">
      <button type="submit" class="col-1 btn btn-secondary bg-secondary mb-2">بحث</button>
    </div>

  </form>
    <div class="card mx-auto" style="max-width: 36rem;">
      <div class="card-header">
        جميع المؤلفين
      </div>
    
      @forelse($authors as $author)
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a href="{{route('gallery.authors.show', $author)}}">
              {{$author->name}}
            </a>
            <span>({{$author->books()->count()}})</span>
          </li>    
        </ul>
      @empty
        <p class="text-center mt-3">لا يوجد مؤلفون متوفرة</p>
      @endforelse
      
    </div>
</div>

@endsection