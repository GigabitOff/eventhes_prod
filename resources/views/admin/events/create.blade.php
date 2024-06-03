@include('admin.header_adm')
<style>
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
    }
    .file-input-wrapper input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-input-label {
        padding: 10px 15px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }
    .file-input-label:hover {
        background-color: #e0e0e0;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Events Create') }} - <a href="https://vimeo.com/924352541" target="_blank">(help)</a></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf
            @if($sheduleRes != 0)
                <button type="submit" style="margin-top: -40px;" class="btn btn-primary" >{{ __('translate.Create') }}</button>
            @else
                <span type="submit" style="margin-top: -40px;" class="btn btn-default">{{ __('translate.Create') }}</span>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Category') }}</label>
                                    @if(isset($event->category))
                                    <select name="category" id="category" class="form-control" disabled>
                                    <option {{ $event->category == "4" ? 'selected' : '' }}>{{ __('translate.Goods') }}</option>
{{--                                    <option {{ $event->category == "3" ? 'selected' : '' }}>{{ __('translate.Event') }}</option>--}}
                                    <option {{ $event->category == "2" ? 'selected' : '' }}>{{ __('translate.Service') }}</option>
{{--                                    <option {{ $event->category == "1" ? 'selected' : '' }}>{{ __('translate.Courses') }}</option>--}}
                                    @else
                                         <select name="category" id="category" class="form-control" >
                                        <option value="0">Select options</option>
                                        <option value="4">{{ __('translate.Goods') }}</option>
{{--                                        <option value="2">{{ __('translate.Event') }}</option>--}}
                                        <option value="3">{{ __('translate.Service') }}</option>
{{--                                        <option value="1">{{ __('translate.Courses') }}</option>--}}
                                    @endif
                                </select>
                            </div>
                            <div id="content"></div>
                            <div class="form-group">
                                <label for="title">{{ __('translate.Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>{{ __('translate.US phone mask:') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="shedule_id">{{ __('translate.Shedule') }}</label>
                                <select name="shedule_id" id="shedule_id" class="form-control">
                                    @foreach($admins as $admin)
                                        @foreach($schedules[$admin->id] as $schedule)
                                            <option value="{{ $schedule->id }}">{{ $schedule->reserv }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if($sheduleRes == 0)
                                    <span style="color: red;">{{ __('translate.Create a schedule first') }}! (<a href="{{ route('admin.shedules.create') }}">Создать</a>)</span>
                                @endif
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="foto_folder_id">{{ __('translate.Payment') }}</label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" value="0" class="form-control"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Event paymant') }}</label>
                                <select name="type_pay" id="type_pay" class="form-control"  onchange="showHidePanel()">
                                    <option value="1" >{{ __('translate.Оплата з календарем') }}</option>
                                    <option value="0" >{{ __('translate.Оплата без календаря') }}</option>
                                    <option value="2" >{{ __('translate.Календарь без оплати') }}</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="discount">{{ __('translate.Discount') }}</label>
                                <input type="text" name="discount"  class="form-control" placeholder="0" >
                            </div>
                            <div class="form-group" id="piple_panel" >
                                <label for="amount_id">{{ __('translate.Piple') }}</label>
                                <input type="text" name="piple" id="piple_id" class="form-control" placeholder="0">
                            </div>
                            <div class="form-group" id="amount_panel" style="display: none;">
                                <label for="amount_id">{{ __('translate.Price') }}</label>
                                <input type="text" name="amount" id="amount_id" class="form-control" placeholder="0">
                            </div>
                            <div class="form-group" id="currency_panel" style="display: none;">
                                <label for="amount_id">{{ __('translate.Currency') }}</label>
                                <select name="currency"  class="form-control"  onchange="showHidePanel()">
                                    <option value="0">$</option>
                                    <option value="1">&#8381;</option>
                                    <option value="2">&euro;</option>
                                    <option value="3">&#8372;</option>
                                    <option value="4">Z&#322;</option>
                                    <option value="5">{{ __('translate.No') }}</option>
                                </select>
                            </div>
                            <input type="hidden" name="additional_fields" id="additional_fields" value="">
                            <div class="form-group">
                            <div class="card-body-duble">
                            </div>
                            </div>
                        </div>
                        <button type="button" id="add_field_button" class="btn btn-success">{{ __('translate.Add Field') }}</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default" >
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Socals links</a></label>
                            </div>
                        </div>
                        <div class="card-header"  id="toggleContent"  style="display: none;">
                            <div class="form-group">
                                <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
                                    </svg></label>
                                <input type="text" name="social_show_facebook"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"></path>
                                    </svg></label>
                                <input type="text" name="social_show_instagram"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"></path>
                                    </svg></label>
                                <input type="text" name="is_live"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"></path>
                                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"></path>
                                    </svg></label>
                                <input type="text" name="is_links"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"></path>
                                    </svg>
                                </label>
                                <input type="text" name="social_show_youtube"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"></path>
                                    </svg>
                                </label>
                                <input type="text" name="social_show_telegram"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="social_show_facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"></path>
                                    </svg>
                                </label>
                                <input type="text" name="social_show_x"  class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="allfoto">{{ __('translate.All photos') }}</label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="allfoto[]" id="allfoto" class="form-control"multiple>
                                    <div class="file-input-label" id="fileInputLabelAll">{{ __('translate.Click here to select file') }}</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('translate.Description') }}</label>
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Summernote
                                            </h3>
                                        </div>
                                        <div class="card-body">
              <textarea id="summernote" name="description">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                </div>
            </div>
            <br>
            @if($sheduleRes != 0)
                <button type="submit" style="margin-top: -40px;" class="btn btn-primary" >{{ __('translate.Create') }}</button>
            @else
                <span type="submit" style="margin-top: -4px;" class="btn btn-default" >{{ __('translate.Create') }}</span>
            @endif
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="{{ asset('storage/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/all.js') }}"></script>
<script src="{{ asset('storage/css/sidebar.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById('allfoto');
        const label = document.getElementById('fileInputLabelAll');

        input.addEventListener('change', function() {
            const fileNames = [];
            for (let i = 0; i < this.files.length; i++) {
                fileNames.push(this.files[i].name);
            }
            label.textContent = fileNames.join(', ');
        });
    });
</script>
<script>
    $(document).ready(function () {
        Dropzone.options.myDropzone = {
            paramName: "file",
            maxFilesize: 2,
            acceptedFiles: ".jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Remove",
            init: function () {
                this.on("success", function (file, response) {
                    console.log(response);
                });
                this.on("error", function (file, errorMessage) {
                    console.log(errorMessage);
                });
            }
        };
    });

    function showHidePanel() {
        var selectElement = document.getElementById("type_pay");
        var fotoPanel = document.getElementById("amount_panel");
        var fotoPanelTu = document.getElementById("currency_panel");

        if (selectElement.value === "2") {  // Если выбрано "Календарь без оплати"
            fotoPanel.style.display = "none";
            fotoPanelTu.style.display = "none";
        } else {
            fotoPanel.style.display = "block";
            fotoPanelTu.style.display = "block";
        }
    }

    // Вызываем функцию при загрузке страницы
    window.onload = showHidePanel;

</script>
<script>
    $(document).ready(function(){
        var max_fields = 10;
        var wrapper = $(".card-body-duble");
        var add_button = $("#add_field_button");
        var additional_fields = [];

        $(add_button).click(function(e){
            e.preventDefault();
            if(additional_fields.length < max_fields){
                var new_field_name = "field_" + additional_fields.length;
                additional_fields.push(new_field_name);
                $(wrapper).append('<div><label>'+ new_field_name +'</label><input type="text" name="' + new_field_name + '" class="form-control additional_field" required><input type="radio" name="r3" class="radio_field"> Field for File <a href="#" class="remove_field">X </a></div>');
                updateAdditionalFieldsValue();
            }
        });

        $(wrapper).on("click", ".remove_field", function(e){
            e.preventDefault();
            var removed_field_name = $(this).parent('div').find('input[type=text]').attr('name');
            $(this).parent('div').remove();
            var removed_index = additional_fields.indexOf(removed_field_name);
            additional_fields.splice(removed_index, 1);
            updateAdditionalFieldsValue();
        });

        $(wrapper).on("input", ".additional_field", function() {
            updateAdditionalFieldsValue();
        });

        $(wrapper).on("change", "input[type=radio][name=r3]", function() {
            updateAdditionalFieldsValue();
        });

        function updateAdditionalFieldsValue() {
            var additional_fields_values = [];
            $(".additional_field").each(function() {
                var field_name = $(this).attr('name');
                var field_value = $(this).val();
                additional_fields_values.push({ name: field_name, value: field_value });
            });

            var radio_value = $('input[type=radio][name=r3]:checked').val();
            if (radio_value) {
                additional_fields_values.push({ name: 'radio_button', value: radio_value });
            }

            $('#additional_fields').val(JSON.stringify(additional_fields_values));
        }
    });

</script>
<script>
    document.getElementById('toggleLink').addEventListener('click', function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение ссылки
        var content = document.getElementById('toggleContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
            this.textContent = 'Close';
        } else {
            content.style.display = 'none';
            this.textContent = 'Раскрыть';
        }
    });


    $(document).ready(function() {
        $('#category').change(function() {
            var category = $(this).val();
            var url = '';

            switch(category) {
                case '4':
                    url = '/category/goods';
                    break;
                case '3':
                    url = '/category/event';
                    break;
                case '2':
                    url = '/category/trade';
                    break;
                case '1':
                    url = '/category/courses';
                    break;
            }
            if (url) {
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            }
        });
    });

</script>

</body>
</html>



