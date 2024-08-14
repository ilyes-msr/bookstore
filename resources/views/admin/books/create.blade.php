@extends('theme.default')


@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('title')
  إضافة كتاب جديد 
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

  <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">عنوان الكتاب</label>
      <input type="text" class="form-control" id="title" placeholder="عنوان الكتاب" name="title" value="{{ old('title') }}">
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">صنف الكتاب</label>
      <select class="form-select" aria-label="Default select example" id="category" name="category">
        <option>اختر الصّنف</option>
        @forelse($categories as $category)
        <option value="{{$category->id}}" {{ $category->id == old('category') ? 'selected' : '' }}>{{$category->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="publisher" class="form-label">الناشر</label>
      <select class="form-select" aria-label="Default select example" id="publisher" name="publisher">
        <option>اختر الناشر</option>
        @forelse($publishers as $publisher)
        <option value="{{$publisher->id}}" {{$publisher->id == old('publisher') ? 'selected' : ''}}>{{$publisher->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="authors" class="form-label">المؤلفون</label>
      <select class="form-select" aria-label="Default select example" id="authors" name="authors[]" multiple>
        @php
          $old_authors = old('authors') != null ? old('authors') : [];
        @endphp
        @forelse($authors as $author)
        <option value="{{$author->id}}" {{ in_array($author->id, $old_authors) ? 'selected' : ''}}>{{$author->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="isbn" class="form-label">ISBN</label>
      <input type="text" class="form-control" id="isbn" placeholder="ISBN" name="isbn" value="{{old('isbn')}}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">وصف الكتاب</label>
      <textarea class="form-control" id="description" rows="3" name="description">{{old('description')}}</textarea>
    </div>
    <div class="mb-3">
      <label for="publish_year" class="form-label">سنة الإصدار</label>
      <input type="number" class="form-control" id="publish_year" placeholder="سنة الإصدار" name="publish_year" value="{{old('publish_year')}}">
    </div>
    <div class="mb-3">
      <label for="number_of_pages" class="form-label">عدد الصفحات</label>
      <input type="number" class="form-control" id="number_of_pages" placeholder="عدد الصفحات" name="number_of_pages" value="{{old('number_of_pages')}}">
    </div>
    <div class="mb-3">
      <label for="number_of_copies" class="form-label">عدد النسخ</label>
      <input type="number" class="form-control" id="number_of_copies" placeholder="عدد النسخ" name="number_of_copies" value="{{old('number_of_copies')}}">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">السعر</label>
      <input type="text" class="form-control" id="price" placeholder="السعر" name="price" value="{{old('price')}}">
    </div>
    <div class="mb-3">
      <label for="cover_image" class="form-label">غلاف الكتاب</label>
      <input class="form-control" type="file" id="cover_image" name="cover_image">
    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit">إضافة</button>
    </div>
  </form>
</div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#authors').select2();
    });
  </script>
@endsection