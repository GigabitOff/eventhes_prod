
@include('admin.header_adm')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Детали заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Здесь будут детали заказа -->
                <p id="orderDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.Orders All') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -60px;">
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
                                <h3 class="card-title"><?php echo e(__('translate.Orders')); ?></h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive" >
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>ID</th>
                                        <th><?php echo e(__('translate.Events')); ?> ID</th>
                                        <th><?php echo e(__('translate.Order date')); ?></th>
                                        <th><?php echo e(__('translate.Amount')); ?></th>
                                        <th><?php echo e(__('translate.Created')); ?></th>
                                        <th><?php echo e(__('translate.Status')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style=" cursor: pointer;" data-toggle="modal" data-order-id="<?php echo e($order->id); ?>" data-target="#exampleModal"
                                        onclick="fillOrderDetails('<?php echo e($order->id); ?>')">
                                        <td style="color: #0e0f10;"><?php echo e($order->code); ?></td>
                                        <td><?php echo e($order->id); ?></td>
                                        <td><?php echo e($order->order_id); ?></td>
                                        <td><?php echo e($order->order_date); ?></td>
                                        <td><?php echo e($order->amount); ?></td>
                                        <td><?php echo e($order->created_at); ?></td>
                                        <td>
                                            <div class="form-group">
                                                 <span style="background-color: {{ $order->status === 0 ? 'yellow' : '' }};border-radius: 4px;">{{ $order->status === 0 ? 'No Pay' : ($order->status === 1 ? 'Pay' : ($order->status === 2 ? 'Pending' : ($order->status === 3 ? 'Canceled' : 'Close'))) }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($orders->onFirstPage())
                <li class="page-item disabled"><span class="page-link">{{ __('translate.Previous') }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">{{ __('translate.Previous') }}</a></li>
            @endif
            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                @if ($i == $orders->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor
            <!-- Кнопка "Следующий" -->
            @if ($orders->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">{{ __('translate.Next') }}</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">{{ __('translate.Next') }}</span></li>
            @endif
        </ul>
    </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function fillOrderDetails(orderId) {
        // Выполняем AJAX-запрос для получения данных о заказе
        $.ajax({
            url: '/admin/get-order-details/' + orderId,
            type: 'GET',
            success: function(response) {
                console.log(response); // Выводим данные о заказе в консоль для отладки
                // В данном примере просто выводим данные о заказе в модальном окне
                // Формируем HTML для таблицы с данными заказа
                var html = '<table class="table">';
                html += '<tr><td>ID:</td><td>' + response.id + '</td></tr>';
                html += '<tr><td>Name:</td><td>' + response.name + '</td></tr>';
                html += '<tr><td>First:</td><td>' + response.first + '</td></tr>';
                html += '<tr><td>Email:</td><td>' + response.email + '</td></tr>';
                html += '<tr><td>Amount:</td><td>' + response.amount + '</td></tr>';
                html += '<tr><td>Phone:</td><td>' + response.phone + '</td></tr>';
                html += '<tr><td>Order Date:</td><td>' + response.order_date + '</td></tr>';
                html += '<tr><td>Order ID:</td><td>' + response.order_id + '</td></tr>';
                // Здесь вы можете добавить другие поля заказа
                html += '</table>';

                // Выводим HTML в модальное окно
                $('#orderDetails').html(html);
                updateOrderStatus(response.id);

            },
            error: function(xhr, status, error) {
                console.error(error); // Выводим ошибку в консоль, если запрос завершился с ошибкой
            }
        });
    }

    function updateOrderStatus(orderId) {
        $.ajax({
            url: '/admin/update-order-status/' + orderId,
            type: 'GET', // Предполагается, что это должен быть метод POST
            data: {
                status: 0
            }, // Отправляем новый статус заказа
            success: function(response) {
                console.log(response); // Выводим ответ сервера в консоль
                // Здесь вы можете добавить дополнительную обработку после успешного обновления статуса заказа
            },
            error: function(xhr, status, error) {
                console.error(error); // Выводим ошибку в консоль, если запрос завершился с ошибкой
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: '/admin/get-orders-with-status',
            type: 'GET',
            success: function(response) {
                response.forEach(function(order) {
                    $('tr[data-order-id="' + order.id + '"]').css('background-color', '#17a2b8').css('color', '#000000');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

</script>
@include('admin.footer_adm')




