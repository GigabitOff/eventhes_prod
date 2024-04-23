@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.Events All') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="col-12">
                        <a href="/admin/events/create" type="submit" value="Create new Events" class="btn btn-success float-right">+ {{ __('translate.Events') }}</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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
                                    <th>{{ __('translate.Title') }}</th>
                                    <th>{{ __('translate.Date') }}</th>
                                    <th>{{ __('translate.Status') }}</th>
                                    <th>QR</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td><a style="text-decoration: underline;" href="/admin/events/{{$event->id }}/edit">{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->created_at}}</td>
                                        <td class="{{ $event->status == 1 ? 'active' : 'deactive' }}">{{ $event->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#qrModal{{ $event->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                                    <path d="M2 2h2v2H2z"/>
                                                    <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                                    <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                                    <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                                    <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                                </svg></a></td>
                                        <td><a href="{{ route('events.show', $event->id) }}" target="_blank"  class="btn btn-primary btn-sm">{{ __('translate.Views') }}</a></td>
                                        <td>
                                            <form  action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">{{ __('translate.Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($events as $event)
            <div class="modal fade" id="qrModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="qrModal{{ $event->id }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrModal{{ $event->id }}Label">QR Code for Event {{ $event->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $event->qrCodeData }}" style="width: 100%;" alt="QR Code">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($events->onFirstPage())
                <li class="page-item disabled"><span class="page-link">{{ __('translate.Previous') }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $events->previousPageUrl() }}">{{ __('translate.Previous') }}</a></li>
            @endif
            @for ($i = 1; $i <= $events->lastPage(); $i++)
                @if ($i == $events->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor
            @if ($events->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $events->nextPageUrl() }}">{{ __('translate.Next') }}</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">{{ __('translate.Next') }}</span></li>
            @endif
        </ul>
    </nav>
</div>
@include('admin.footer_adm')






