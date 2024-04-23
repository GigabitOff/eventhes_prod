<?php
namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\Shedule;



class AdminPaymentController extends Controller
{

    public function index()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $payments = Payment::all();

        return view('admin.payments.index', compact('admins','currentAdmin', 'payments'));
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.payments.create',compact('currentAdmin','admins'));
    }

}

