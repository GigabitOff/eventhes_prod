<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    protected $table = 'lesson_type'; // Указываем, что модель связана с таблицей lesson_files

    // Здесь укажите столбцы, которые вы хотите, чтобы были доступны для массового назначения
    protected $fillable = [
        'events_id', // и этот тоже, примеры столбцов
        'type',
        // и так далее, в зависимости от структуры вашей таблицы
    ];

    // Если в таблице есть поля created_at и updated_at и они должны обновляться автоматически, эту строку можно опустить
    public $timestamps = true;
}
