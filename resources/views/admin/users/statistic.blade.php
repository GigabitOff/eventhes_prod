@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.Users All') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -55px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="/admin/events/create" type="submit" value="Create new Project" class="btn btn-success float-right">+ {{ __('translate.Events') }}</a>
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
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="{{ __('translate.Search') }}">
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('translate.Text') }}</th>
                                        <th>{{ __('translate.Created') }}</th>
                                        <th>{{ __('translate.Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($alertCount as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->text }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            @if ($data->status == 1)
                                                <td>
                                                    {{ __('translate.Views') }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($alertCount->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">{{ __('translate.Previous') }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $alertCount->previousPageUrl() }}">{{ __('translate.Previous') }}</a></li>
                @endif
                @for ($i = 1; $i <=  $alertCount->lastPage(); $i++)
                    @if ($i ==  $alertCount->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{  $alertCount->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                <!-- Кнопка "Следующий" -->
                @if ( $alertCount->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{  $alertCount->nextPageUrl() }}">{{ __('translate.Next') }}</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">{{ __('translate.Next') }}</span></li>
                @endif
            </ul>
        </nav>
    </section>
</div>

@include('admin.footer_adm')
