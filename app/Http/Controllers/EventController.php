<?php

// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Shedule;
use App\Models\PortfolioFoto;
use App\Models\Order;
use App\Models\Timework;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Models\Like;
use App\Models\LessonType;
use Illuminate\Support\Facades\Http;
use App\Models\Region;
use App\Models\Town;


class EventController extends Controller
{
    public function index(Request $request)
    {
        $temporaryUserId = $request->session()->get('temporaryUserId');

        $events = Event::all();
        return view('events.index', compact('events'));
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

    public function all()
    {
        $regions = Region::take(100)->get();

        $cities = [];
        if ($regions->isNotEmpty()) {
            $firstRegion = $regions->first();
            $cities = $firstRegion->towns;
        }

        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $events = Event::with('shedule')
            ->where('status', 1)
            ->paginate(8);

        $user = User::where('id', 1)->where('role_id', 1)->first();
        $phone = $user->phone;

        $events->transform(function ($event) {
            $event->short_description = Str::limit(strip_tags($event->description), 270);

            // Получение первого изображения для события
            $firstImage = PortfolioFoto::where('event_id', $event->id)->first();
            if ($firstImage) {
                $event->first_image_path = asset('files/' . $event->user_id . '/' . $event->id . '/' . $firstImage->title);
            } else {
                $event->first_image_path = null;
            }

            if ($event->shedule) {
                $event->reserv = $event->shedule->reserv;
            } else {
                $event->reserv = 0;
            }

            return $event;
        });

        return view('events.all', compact('events', 'phone', 'currentLocale', 'regions', 'cities'));
    }


    public function getCitiesByRegion(Request $request, $region)
    {
        $cities = Region::findOrFail($region)->towns;

        return response()->json($cities);
    }

    public function handleLike(Request $request)
    {

        $eventId = $request->input('event_id');
        $sessionHash = $request->session()->get('uuid');
        $userId = auth()->id();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
            $request->session()->put('temporaryUserId', $sessionHash);
        }

        $like = Like::where('event_id', $eventId)
            ->where('user_id', $userId)
            ->where('hash', $sessionHash)
            ->first();
        if ($like) {
            $like->update(['liked' => true]);
        } else {
            $like = Like::create([
                'event_id' => $eventId,
                'user_id' => $userId,
                'hash' => $sessionHash,
                'liked' => true
            ]);
        }
        return response()->json(['success' => true]);

    }

    public function handleLikeNo(Request $request)
    {
        $eventId = $request->input('event_id');
        $sessionHash = $request->session()->get('uuid');
        $userId = auth()->id();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
            $request->session()->put('temporaryUserId', $sessionHash);
        }

        $like = Like::where('event_id', $eventId)
            ->where(function ($query) use ($userId, $sessionHash) {
                $query->where('user_id', $userId)
                    ->orWhere('hash', $sessionHash);
            })
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['success' => true, 'message' => 'Like removed']);
        } else {
            return response()->json(['success' => false, 'message' => 'Like not found']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function show($id,$code=null)
    {
        $this->middleware(function ($request, $next) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
            return $next($request);
        });

        $event = Event::find($id);
        $event_type_pay = $event->type_pay;
        $event_amount = $event->amount;
        $event_discount = $event->discount;

        if ($event) {
            $userId = $event->user_id;
            $events = Event::where('user_id', $userId)
                ->whereNotIn('id', [$id]) // исключаем выбранный $id
                ->take(6)
                ->get();
        } else {
            $events = collect();
        }

        if (!$event) {
            return abort(404);
        }

        $patch = isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"]) ? $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] : null;
        $client = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : null;
        $ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : null;
        $event_id = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : null;

        $data = [
            [
                'patch' => $patch,
                'client' => $client,
                'ip' => $ip,
                'event_id' => $event_id
            ],
        ];

//        $response = Http::withToken(env('NODEJS_API_TOKEN'))
//            ->post('http://88.218.28.99:3000/api/statistics', $data);
//        if (!$response->successful()) {
//            return response('Ошибка при отправке данных на сервер Node.js', 500);
//        }
        $user = $event->user;
        $images = PortfolioFoto::where('event_id', $id)->get();
        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = (object)[
                'path' => asset('files/' . $event->user_id . '/' . $id . '/' . $image->title),
                'description' => $image->description,
            ];
        }

        $eventss = Event::where('user_id', $userId)
            ->whereNotIn('id', [$id])
            ->take(6)
            ->get();


        $firstImages = [];
        foreach ($eventss as $eventt) {
            $firstImage = PortfolioFoto::where('event_id', $eventt->id)->first();
            if ($firstImage) {
                $firstImages[$eventt->id] = (object)[
                    'path' => asset('files/' . $eventt->user_id . '/' . $eventt->id . '/' . $firstImage->title),
                ];
            }
        }


        $shedule = Shedule::where('event_id', $id)->first();

        if ($shedule) {
            $reserv = $shedule->reserv;
            $time = $shedule->time;
            $mono = $shedule->mono;
            $datapicker = $shedule->datapicker;
        } else {
            $reserv = 'Default Value';
            $time = null;
            $mono = null;
            $datapicker = null;
        }

        $busyDates = [];

        if ($mono == 1) {
        } else {
            $busyDates = Order::where('order_id', $event->id)->pluck('order_date')->toArray();
        }

        $formattedBusyDates = [];

        if (!empty($busyDates)) {
            foreach ($busyDates as $date) {
                try {
                    $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
                    $formattedBusyDates[] = $formattedDate;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        $lessonType = LessonType::where('events_id', $event->id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $timeworks = Timework::join('shedules', 'timeworks.shedule_id', '=', 'shedules.id')
            ->where('shedules.event_id', $id)
            ->get();


       return view('events.show', compact('event', 'firstImages','event_type_pay', 'event_discount', 'event_amount', 'events','lessonType', 'reserv', 'time', 'imageData', 'formattedBusyDates', 'user', 'timeworks', 'datapicker'));

      //  return view('events.show', compact('event', 'event_type_pay', 'event_discount', 'event_amount', 'events','lessonType', 'reserv', 'time', 'imageData', 'formattedBusyDates', 'user', 'timeworks', 'datapicker'));

    }


    public function edit($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'foto' => 'required|string',
            // Другие правила валидации...
        ]);

        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }

        $event->update(['status' => 0]);

        return redirect()->route('admin.events.index')->with('success', 'Event status updated successfully');
    }

}
