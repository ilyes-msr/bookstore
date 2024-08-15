@extends('theme.default')

@section('title')
  تعديل بيانات الناشر 
@endsection

@section('content')
<div class="container">
  
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
<div class="row">
  <div class="col-10">
    
  <form action="{{route('publishers.update', $publisher)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <label for="name" class="form-label">اسم الناشر</label>
      <input type="text" class="form-control" id="name" placeholder="اسم الناشر" name="name" value="{{ $publisher->name }}">
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">العنوان</label>
      <textarea class="form-control" id="address" rows="3" name="address">{{$publisher->address}}</textarea>
    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit">تعديل</button>
    </div>
  </form>
  
</div>
</div>
</div>
@endsection