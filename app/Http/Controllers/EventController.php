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

    public function loadMoreEvents($lastEventId)
    {
        $events = Event::where('id', '>', $lastEventId)->where('status', 1)
            ->orderBy('id')
            ->limit(3)
            ->get();

        $html = '';

        foreach ($events as $event) {
            $html .= '<span>&nbsp;</span>
    <div class="row event" data-id="' . $event->id . '" style="min-height:233px; border: 1px solid #dddddd; border-radius: 5px;">
        <div class="col-lg-4 col-md-4">
            <div class="ribbon_3 popular"><span>Popular</span></div>
            <div class="img_list">
                <a href="/' . $event->id . '">
                    <img src="' . asset('files/' . $event->user_id . '/' . $event->foto_title) . '" alt="Image">
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="tour_list_desc">
                <div class="rating">';
            for ($i = 0; $i < mt_rand(1, 7); $i++) {
                $html .= '<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                            </svg></i>';
            }
            $html .= '</div>
                <a href="http://eventhes.com/tours/galata-tower" class="tour_title"><strong>' . $event->title . '</strong></a>
                <p style="width: 100%; white-space: nowrap; overflow: hidden; "></p>
                <p style="width: 100%; white-space: nowrap; overflow: hidden; font-weight: bold; border-radius: 5px; background-color: #eeeeee">' . $this->Shedule($event->shedule_id) . '</p>
                <p style="width: 100%; white-space: nowrap; overflow: hidden; ">' . $event->phone . '</p>
                <i style="font-size: 30px; cursor: pointer;" onclick="likeButtonClicked(' . $event->id . ');"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
</svg></i>
            </div>
        </div>
        <div class="col-lg-2 col-md-2">
            <div class="price_list">
                <div>
                    ' . (($event->amount == 0) ? 'FREE' : $event->amount . '$') . '
                    <span class="normal_price_list"></span>
                    <small>*Per person</small>
                    <p><a href="/' . $event->id . '" class="btn_1" target="_blank">Details</a></p>
                </div>
            </div>
        </div>
    </div>';
        }

        $loadedEventsCount = count($events);
        $noMoreEvents = $loadedEventsCount < 3;

        return response()->json(['html' => $html, 'noMoreEvents' => $noMoreEvents]);
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
        if (!$event) {
            return abort(404);
        }

        $data = [
            [
                'patch' => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
                'client' => $_SERVER["HTTP_USER_AGENT"],
                'ip' => $_SERVER["REMOTE_ADDR"],
                'event_id' => $_SERVER["REQUEST_URI"]
            ],
        ];

        $response = Http::withToken(env('NODEJS_API_TOKEN'))
            ->post('http://88.218.28.99:3000/api/statistics', $data);
        if (!$response->successful()) {
            return response('Ошибка при отправке данных на сервер Node.js', 500);
        }

        $user = $event->user;
        $images = PortfolioFoto::where('event_id', $id)->get();
        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = (object)[
                'path' => asset('files/' . $event->user_id . '/' . $id . '/' . $image->title),
                'description' => $image->description,
            ];
        }

        $shedule = Shedule::where('event_id', $id)->first();

        if ($shedule) {
            $reserv = $shedule->reserv;
            $time = $shedule->time;
            $mono = $shedule->mono;
            $datapicker = $shedule->datapicker; // Move this inside the conditional block
        } else {
            $reserv = 'Default Value';
            $time = null;
            $mono = null;
            $datapicker = null; // or whatever default value you want to assign
        }

        $busyDates = [];

        if ($mono == 1) {
        } else {
            $busyDates = Order::where('order_id', $event->id)->pluck('order_date')->toArray();
        }

        $formattedBusyDates = [];

        foreach ($busyDates as $date) {
            try {
                $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
                $formattedBusyDates[] = $formattedDate;
            } catch (\Exception $e) {
                // Log or handle the invalid date gracefully
                // For example:
                // Log::error("Invalid date encountered: $date");
                // Skip the invalid date
                continue;
            }
        }

        $lessonType = LessonType::where('events_id', $event->id)
            ->orderBy('updated_at', 'desc')
            ->first();

        // Найдем все записи из таблицы timeworks, принадлежащие определенному shedule_id
        $timeworks = Timework::join('shedules', 'timeworks.shedule_id', '=', 'shedules.id')
            ->where('shedules.event_id', $id)
            ->get();
        return view('events.show', compact('event', 'lessonType', 'reserv', 'time', 'imageData', 'formattedBusyDates', 'user', 'timeworks', 'datapicker'));

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
