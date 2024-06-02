
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Детали заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                    <h1 class="m-0"><?php echo e(__('translate.Statistic')); ?> - <a href="https://vimeo.com/924351429" target="_blank">(help)</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="col-12">
                        <a href="/admin/events/create" type="submit" value="Create new Events" class="btn btn-success float-right">+ <?php echo e(__('translate.Event')); ?></a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e(__('translate.New')); ?>-<?php echo e($newOrderCount); ?></h3>
                            <p><?php echo e(__('translate.Orders')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/orders/all" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo e($statisticsWithEventsUnic); ?><sup style="font-size: 20px"></sup></h3>
                            <p>Canceled orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($statisticsWithEvents); ?></h3>
                            <p><?php echo e(__('translate.Oll Visitors')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo e($statisticsWithEventsUnic); ?></h3>
                            <p><?php echo e(__('translate.Unique Visitors')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
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
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>ID</th>
                                    <th><?php echo e(__('translate.Events')); ?> ID</th>
                                    <th><?php echo e(__('translate.Order date')); ?></th>
                                    <th><?php echo e(__('translate.Amount')); ?></th>
                                    <th><?php echo e(__('translate.Created')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style=" cursor: pointer;" data-toggle="modal" data-order-id="<?php echo e($order->id); ?>" data-target="#exampleModal"
                                    onclick="fillOrderDetails('<?php echo e($order->id); ?>')">
                                    <td style="color: #0e0f10;"><?php echo e($order->code); ?></td>
                                    <td><?php echo e($order->id); ?></td>
                                    <td><a style="text-decoration: underline;" href="/admin/events/{{$order->order_id }}/edit"><?php echo e($order->order_id); ?></td>
                                    <td><?php echo e($order->order_date); ?></td>
                                    <td><?php echo e($order->amount); ?></td>
                                    <td><?php echo e($order->created_at); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo e(__('translate.Visitors')); ?></h3>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
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


