@include('admin.header_adm')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users All{{ __('translate.Save') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -55px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="/admin/events/create" type="submit" value="Create new User" class="btn btn-success float-right">+ {{ __('translate.Events') }}</a>
                </div>
            </div>
        </div>
        <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('translate.Responsive Hover Table') }}</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="{{ __('translate.Save') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('translate.User') }}</th>
                                    <th>{{ __('translate.Email') }}</th>
                                    <th>{{ __('translate.Date') }}</th>
                                    <th>{{ __('translate.Data') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr data-user-id="{{ $user->id }}"  style="cursor: pointer;">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="{{ route('admin.users.redact', $user->id) }}" class="btn btn-info btn-sm">{{ __('translate.Edit') }}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('admin.users.storeData') }}" method="POST">
                            @csrf
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Данные:</label>
                                                    <input type="hidden" name="user_id" id="user-id" value="">
                                                    <textarea name="settings" id="summernote"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translate.Close') }}</button>
                                            <input type="submit" class="btn btn-primary" value="{{ __('translate.Save changes') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('table.table-hover tbody tr').on('click', function(){
            $('#myModal').modal('show');
        });
        $('table.table-hover tbody tr .btn-info').on('click', function(e){
            e.stopPropagation();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.user-table tbody tr').on('click', function() {
            var userId = $(this).data('user-id');

            $('#user-id').val(userId);

            $('#myModal').modal('show');
        });
    });
</script>


@include('admin.footer_adm')






