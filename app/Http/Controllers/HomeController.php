<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\User;
use App\Models\Like;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\Event;
use App\Models\Order;
use App\Models\UserData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processReferral(Request $request)
    {
        $user = auth()->user();
        $randomCode = Str::random(6);
        $user->update(['code_part' => $randomCode]);

        return response()->json(['message' => 'Success']);
    }

    public function handleLikeNo(Request $request)
    {
        $eventId = $request->input('event_id');
        $sessionHash = $request->session()->get('uuid');
        $userId = auth()->check() ? auth()->id() : null;

        $like = Like::where('event_id', $eventId)
            ->where(function ($query) use ($userId, $sessionHash) {
                $query->where('user_id', $userId)
                    ->orWhere('hash', $sessionHash);
            })
            ->first();

        if ($like) {
            $like->delete(); // Удаляем запись
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Like not found.']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function member(Request $request)
    {
        $user = Auth::user();
        $use = User::where('email', $user->email)->first();

        $orders = Order::where('email', $user->email)->get();
        $uuidValue = $request->session()->get('uuid');

        Like::updateOrCreate(
            ['hash' => $uuidValue],
            ['user_id' => $user->id]
        );

        $likes = Like::where('user_id', $user->id)->get();
        $events = [];

        foreach ($likes as $like) {
            $event = Event::find($like->event_id);
            if ($event) {
                $events[] = $event;
            }
        }

        $ordersData = $user->ordersWithStatus(3)->get();

        $ordersdata = [];

        foreach ($ordersData as $orddata) {
            $eventDat = Event::where('id', $orddata->order_id)->first(); // Предполагается, что order_id в Order соответствует id в Event
            if ($eventDat) {
                $ordersdata[] = $eventDat;
            }
        }

        $userDataRecords = UserData::where('user_id', $user->id)->get();
        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        if ($user->role_id == 1 or $user->role_id == 3) {
            return view('partner', ['showTestRecord' => true, 'use' => $use, 'ordersdata' => $ordersdata, 'userDataRecords' => $userDataRecords, 'currentLocale' => $currentLocale, 'events' => $events, 'orders' => $orders]);
        } elseif ($user->role_id == 2) {
            return view('partner', ['showTestRecord' => true, 'ordersdata' => $ordersdata, 'use' => $use, 'currentLocale' => $currentLocale, 'userDataRecords ' => $userDataRecords, 'events' => $events, 'orders' => $orders]);
        }

    }


    public function open($id)
    {
        $user = Auth::user();
        $orders = $user->orders;

        $online = Event::where('id', $id)->first();

        $userDataRecords = UserData::where('user_id', $user->id)->get();
        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $lessonRecords = Lesson::where('events_id', $id)->where('lesson_chapter', 0)->get();

        if (!$lessonRecords) {
            return redirect()->back()->withErrors('Lesson not found.');
        }

        return view('open', [
            'showTestRecord' => true,
            'online' => $online->online,
            'userDataRecords' => $userDataRecords,
            'currentLocale' => $currentLocale,
            'orders' => $orders,
            'lessonRecords' => $lessonRecords
        ]);
    }

    public function openLesson($id, $lesson_id)
    {
        $user = Auth::user();
        $orders = $user->orders()->get();

        $userDataRecords = UserData::where('user_id', $user->id)->get();
        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $specificLesson = Lesson::where('events_id', $id)->first();

        if (!$specificLesson) {
            return redirect()->back()->withErrors('Specific lesson not found.');
        }

        $lessonRecords = Lesson::where('events_id', $id)->get();

        if (!$lessonRecords) {
            return redirect()->back()->withErrors('Lesson not found.');
        }

        $lessonRecords = Lesson::where('events_id', $id)->get();
        $lessonFiles = LessonFile::where('events_id', $id)
            ->where('lesson_chapter', $specificLesson->lesson_chapter)
            ->get();

        $lessonsWithFiles = DB::table('lesson')
            ->leftJoin('lesson_files', function ($join) use ($id) {
                $join->on('lesson.events_id', '=', 'lesson_files.events_id')
                    ->on('lesson.lesson_chapter', '=', 'lesson_files.lesson_chapter')
                    ->where('lesson.events_id', '=', $id);
            })
            ->select('lesson.*', 'lesson_files.text as lessonFileText')
            ->get();

        return view('open_lesson', [
            'showTestRecord' => true,
            'specificLesson' => $specificLesson,
            'lessonsWithFiles' => $lessonsWithFiles,
            'lessonFiles' => $lessonFiles,
            'currentLocale' => $currentLocale,
            'orders' => $orders,
            'lessonRecords' => $lessonRecords
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        if ($user->role_id == 1 or $user->role_id == 3) {
            return view('home', ['showTestRecord' => true, 'currentLocale' => $currentLocale]);
        }

        if ($user->role_id == 2) {
            return view('partner', ['showTestRecord' => true, 'currentLocale' => $currentLocale]);
        }

        return view('home', ['showTestRecord' => false, 'currentLocale' => $currentLocale]);

    }
}
