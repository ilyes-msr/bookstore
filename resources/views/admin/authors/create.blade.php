@extends('theme.default')

@section('title')
  إضافة مؤلّفٍ جديدٍ 
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
    
  <form action="{{route('authors.store')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">اسم الكاتب</label>
      <input type="text" class="form-control" id="name" placeholder="اسم الكاتب" name="name" value="{{ old('title') }}">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">الوصف</label>
      <textarea class="form-control" id="description" rows="3" name="description">{{old('description')}}</textarea>
    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit">إضافة</button>
    </div>
  </form>
  
</div>
</div>
</div>
@endsection