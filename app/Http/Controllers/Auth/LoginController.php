<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {

        // Выполняем middleware для установки локали перед AuthenticateUsers
        $this->middleware(function ($request, $next) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
            return $next($request);
        });

        // Применяем middleware AuthenticateUsers
        $this->middleware('guest')->except('logout');
    }


    protected function redirectTo()
    {
//        // Проверяем роль пользователя после аутентификации
//        if (auth()->user()->role_id == 1 or auth()->user()->role_id == 3 ) {
//            return '/admin'; // Если роль равна 1, перенаправляем в админскую панель
//        };
//        if (auth()->user()->role_id == 2) {
            return '/partner'; // Иначе перенаправляем на главную страницу
//        }
//        if (auth()->user()->role_id == 0) {
//            return '/restricted-access'; // Если роль равна 0, перенаправляем на страницу ограниченного доступа
//        }
    }
}
