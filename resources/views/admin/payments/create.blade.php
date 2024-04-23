@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Cards data') }}</h1>
                </div>
            </div>
            <h4>{{ __('translate.Your summ') }} - $ 7.98</h4>
        </div>
    </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('admin.payments.create') }}">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('translate.Data card') }} (Visa / MasterCard)</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ __('translate.Number card') }}:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control" id="reserv" placeholder="____-____-____-____" name="reserv" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('translate.Payment summ') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('translate.Count') }} :</label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control" placeholder="0.00" id="workDayInput" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"  class="btn btn-primary">{{ __('translate.Save') }}</button>
                </form>
                </div>
            </div>
        </section>
</div>

@include('admin.footer_adm')

