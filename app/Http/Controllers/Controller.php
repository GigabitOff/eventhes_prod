<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

// Добавлен этот импорт

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
            return $next($request);
        });
    }

    public function faqs()
    {
        // Здесь можно добавить логику для отображения страницы с контактами
        return view('layouts.faqs');// Предположим, что у вас есть шаблон с именем 'contactus.blade.php'
    }


    public function contactus()
    {
        // Здесь можно добавить логику для отображения страницы с контактами
        return view('layouts.contactus');// Предположим, что у вас есть шаблон с именем 'contactus.blade.php'
    }

    public function aboutus()
    {
        // Здесь можно добавить логику для отображения страницы с контактами
        return view('layouts.aboutus');// Предположим, что у вас есть шаблон с именем 'contactus.blade.php'
    }
}

