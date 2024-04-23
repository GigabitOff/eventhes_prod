<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonFile extends Model
{
    protected $table = 'lesson_files'; // Указываем, что модель связана с таблицей lesson_files

    // Здесь укажите столбцы, которые вы хотите, чтобы были доступны для массового назначения
    protected $fillable = [
        'user_id', // предполагая, что у вас есть такой столбец
        'events_id', // и этот тоже, примеры столбцов
        'lesson_chapter',
        'text',
        // и так далее, в зависимости от структуры вашей таблицы
    ];

    // Если в таблице есть поля created_at и updated_at и они должны обновляться автоматически, эту строку можно опустить
    public $timestamps = true;

    // Определение отношения с событием
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    // Определение отношения с уроком (если это применимо и есть соответствующий идентификатор урока в таблице)
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_chapter'); // Предполагается, что у вас есть 'lesson_id' в таблице 'lesson_files'
    }


}

