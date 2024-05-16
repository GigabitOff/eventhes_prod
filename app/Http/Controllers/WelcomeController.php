<?php


namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\Shedule;
use App\Models\User;

class WelcomeController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $events = Event::where('status', 1)
            ->where('category', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $goods= Event::where('status', 1)
            ->where('category', 4)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $courses = Event::where('status', 1)
            ->where('category', 3)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $services = Event::where('status', 1)
            ->where('category', 2)
            ->inRandomOrder()
            ->take(3)
            ->get();




        $eventsall = Event::latest()->where('status', 1)->get();

        foreach ($eventsall as $event) {
            $schedule = Shedule::where('event_id', $event->id)->first();
            if ($schedule) {
                $event->reserv = $schedule->reserv;
            } else {
                $event->reserv = null;
            }
        }

        if ($user && $user->role_id == 1) {
            return view('welcome', ['showTestRecord' => true, 'currentLocale' => $currentLocale, 'goods' => $goods,  'services' => $services,  'courses' => $courses, 'events' => $events, 'eventsall' => $eventsall]);
        } else {
            $currentLocale = app()->getLocale();
            return view('welcome', ['showTestRecord' => false, 'currentLocale' => $currentLocale, 'goods' => $goods,  'services' => $services, 'courses' => $courses, 'events' => $events, 'eventsall' => $eventsall]);
        }

    }

    public function Shedule($id)
    {
        $schedule = Shedule::find($id);
        if ($schedule) {
            return $schedule->reserv;
        } else {
            return "Запись с ID $id не найдена в таблице schedules.";
        }

    }

    public function filter(Request $request)
    {

        $searchTerm = $request->input('what');
        $selectedCategory = $request->input('category');

        $user = User::where('id', 1)->where('role_id', 1)->first();
        $phone = $user->phone;

        $eventsQuery = Event::where('title', 'like', '%' . $searchTerm . '%')
            ->where('events.status', 1);

        if (!empty($selectedCategory)) {
            $eventsQuery->where('category', $selectedCategory);
        }

        $events = $eventsQuery->join('shedules', 'events.id', '=', 'shedules.event_id')
            ->orderBy('events.id')
            ->limit(3)
            ->get();

       // return view('events.yesearch', compact('events', 'searchTerm', 'phone'));
    }

    //...
    public function search(Request $request)
    {
        $regions = Region::take(100)->get();

        $cities = [];
        if ($regions->isNotEmpty()) {
            $firstRegion = $regions->first();
            $cities = $firstRegion->towns;
        }

        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $searchTerm = $request->input('what');
        $rng1 = $request->input('rng');
        $rng2 = $request->input('rng2');
        $selectedCategory = $request->input('cat');
        $user_id = $request->input('salesman');

        $eventsQuery = Event::where('title', 'like', '%' . $searchTerm . '%')
            ->where('status', 1);

        if ($rng1 !== null && $rng2 !== null) {
            $eventsQuery->whereBetween('amount', [$rng1, $rng2]);
        }

        if ($selectedCategory !== null && $selectedCategory !== '') {
            $eventsQuery->where('category', $selectedCategory);
        }

        if ($user_id !== null) {
            $eventsQuery->where('user_id', $user_id);
        }

        $events = $eventsQuery->orderBy('events.id')->paginate(10);

        return view('events.yesearch', [
            'events' => $events,
            'currentLocale' => $currentLocale,
            'searchTerm' => $searchTerm,
            'rng1' => $rng1,
            'user_id' => $user_id, // Исправлено на user_id
            'regions' => $regions,
            'cities' => $cities,
            'salesman' => $user_id, // Добавлена переменная salesman
            'rng2' => $rng2
        ]);
    }


}

