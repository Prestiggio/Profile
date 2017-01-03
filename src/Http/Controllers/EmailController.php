<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ry\Profile\Models\Emailconfirmation;
use Mail;

class EmailController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
	
	public function getIndex(Request $request) {
		$confirmation = auth()->user()->confirmation()->where("hash", "LIKE", $request->get("hash"))->first();
		if($confirmation) {
			$confirmation->valide = true;
			$confirmation->save();
			return view("profile.emails.confirmed");
		}
		return redirect("/home");
	}
	
	public function getResend() {
		$user = auth()->user();
		$confirmation = $user->confirmation;
		Mail::queue('ryprofile::emails.confirm', ["row" => $user, "confirmation" => $confirmation], function($message) use ($user){
			$message->to($user->email, $user->name)->subject('Bienvenue sur aportax!');
		});
		return redirect()->back();
	}
}