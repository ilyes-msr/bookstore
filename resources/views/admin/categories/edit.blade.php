@extends('theme.default')

@section('title')
  تعديل بيانات الصنف 
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
    
  <form action="{{route('categories.update', $category)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <label for="name" class="form-label">اسم الصنف</label>
      <input type="text" class="form-control" id="name" placeholder="اسم الصنف" name="name" value="{{ $category->name }}">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">الوصف</label>
      <textarea class="form-control" id="description" rows="3" name="description">{{$category->description}}</textarea>
    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit">تعديل</button>
    </div>
  </form>
  
</div>
</div>
</div>
@endsection