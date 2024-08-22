@extends('theme.default')

@section('heading')
جميع المشتريات
@endsection

@section('content')
  <div class="row">
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <th>عنوان الكتاب</th>
        <th>المشتري</th>
        <th>السعر</th>
        <th>عدد النسخ</th>
        <th>السعر الإجمالي</th>
        <th>تاريخ الشراء</th>
      </thead>
      <tbody>
        @foreach($allPurchases as $purchase)
        <tr>
          <td>{{$purchase->title}}</td>
          <td>{{$purchase->name}}</td>
          <td>{{$purchase->price}}</td>
          <td>{{$purchase->number_of_copies}}</td>
          <td>{{$purchase->number_of_copies * $purchase->price}}</td>
          <td>{{ \Carbon\Carbon::parse($purchase->created_at)->diffForHumans() }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection