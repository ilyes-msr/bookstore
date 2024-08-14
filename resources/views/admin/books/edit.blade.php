@extends('theme.default')


@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('title')
  تعديل كتاب  
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
    
  <form action="{{route('books.update', $book)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="mb-3">
      <label for="title" class="form-label">عنوان الكتاب</label>
      <input type="text" class="form-control" id="title" placeholder="عنوان الكتاب" name="title" value="{{ $book->title }}">
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">صنف الكتاب</label>
      <select class="form-select" aria-label="Default select example" id="category" name="category">
        <option>اختر الصّنف</option>
        @forelse($categories as $category)
        <option value="{{$category->id}}" {{ $category->id == $book->category_id ? 'selected' : '' }}>{{$category->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="publisher" class="form-label">الناشر</label>
      <select class="form-select" aria-label="Default select example" id="publisher" name="publisher">
        <option>اختر الناشر</option>
        @forelse($publishers as $publisher)
        <option value="{{$publisher->id}}" {{$publisher->id == $book->publisher_id ? 'selected' : ''}}>{{$publisher->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="authors" class="form-label">المؤلفون</label>
      <select class="form-select" aria-label="Default select example" id="authors" name="authors[]" multiple>
        @php
        $old_authors = $book->authors->isNotEmpty() ? $book->authors->pluck('id')->toArray() : [];
        @endphp
        @forelse($authors as $author)
        <option value="{{$author->id}}" {{ in_array($author->id, $old_authors) ? 'selected' : ''}}>{{$author->name}}</option>
        @empty
        @endforelse
      </select>
    </div>

    <div class="mb-3">
      <label for="isbn" class="form-label">الرقم التسلسلي</label>
      <input type="text" class="form-control" id="isbn" placeholder="ISBN" name="isbn" value="{{$book->isbn}}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">وصف الكتاب</label>
      <textarea class="form-control" id="description" rows="3" name="description">{{$book->description}}</textarea>
    </div>
    <div class="mb-3">
      <label for="publish_year" class="form-label">سنة الإصدار</label>
      <input type="number" class="form-control" id="publish_year" placeholder="سنة الإصدار" name="publish_year" value="{{$book->publish_year}}">
    </div>
    <div class="mb-3">
      <label for="number_of_pages" class="form-label">عدد الصفحات</label>
      <input type="number" class="form-control" id="number_of_pages" placeholder="عدد الصفحات" name="number_of_pages" value="{{$book->number_of_pages}}">
    </div>
    <div class="mb-3">
      <label for="number_of_copies" class="form-label">عدد النسخ</label>
      <input type="number" class="form-control" id="number_of_copies" placeholder="عدد النسخ" name="number_of_copies" value="{{$book->number_of_copies}}">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">السعر</label>
      <input type="text" class="form-control" id="price" placeholder="السعر" name="price" value="{{$book->price}}">
    </div>
    <div class="mb-3 text-center">
      
      <label for="cover_image" class="form-label">غلاف الكتاب</label>
      
      <input class="form-control" type="file" id="cover_image" name="cover_image" accept="image/*" onchange="readCoverImage(this)">

      <img class="img-fluid img-thumbnail" alt="" id="cover-image-thumb" style="max-width: 500px; max-height: 500px; margin-top: 10px" src={{asset('storage/' . $book->cover_image)}}>

    </div>

    <div class="mb-3">
      <button class="btn btn-primary" type="submit">تعديل</button>
    </div>
  </form>
  
</div>
</div>
</div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#authors').select2();
    });
    function readCoverImage(input) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#cover-image-thumb').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection