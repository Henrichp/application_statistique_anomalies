@extends('layout._layout')

@section('content')



  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <table class="datatable">
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function(){
          $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.serverSide') }}'
          });
        });
      </script>
    </div>

  </div>
@endsection
