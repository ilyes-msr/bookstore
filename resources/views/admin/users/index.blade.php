@extends('theme.default')

@section('heading')
  المستخدمون
@endsection

@section('title')
  قائمة المستخدمين
@endsection

@section('content')

<hr>
<div class="row">
    <div class="col-md-12">
        <table id="users-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>اسم المستخدم</th>
                    <th>البريد الإلكتروني</th>
                    <th>نوع المستخدم</th>
                    <th>خيارات</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->isSuperAdmin() ? 'مدير عام' : ($user->isAdmin() ? 'مدير' : 'مستخدم عادي')}}</td>
                        <td>
                          <form action="{{route('users.update', $user)}}" method="POST" class="ml-4 form-inline">
                            @csrf
                            @method('PATCH')
                            <select name="administration_level" id="" class="form-control form-control-sm">
                              <option disabled selected>اختر نوعاً</option>
                              <option value="0">مستخدم عادي</option>
                              <option value="1">مدير</option>
                              <option value="2">مدير عام</option>
                            </select>
                            <button type="submit" class="btn btn-info btn-sm">
                              <i class="fa fa-edit"></i>
                              تعديل
                            </button>
                          </form>

                          <form action="{{route('users.destroy', $user)}}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            @if(auth()->user() != $user)
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متأكد')"><i class="fa fa-trash"></i>حذف</button>
                            @else
                              <div class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>حذف</div>
                            @endif
                          </form>
                        </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection