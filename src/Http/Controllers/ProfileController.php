<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ry\Geo\Models\Adresse;
use Illuminate\Database\Eloquent\Model;
use Mail;
class ProfileController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
	
	public function getEdit() {
		return view("profile.form", ["row" => auth()->user()->profile]);
	}
	
	public function postEdit(Request $request) {
		$ar = $request->all();
		
		$address = Adresse::firstOrCreateFromBulk($ar["adresse"]);
		auth()->user()->profile->firstname = $ar["firstname"];
		auth()->user()->profile->lastname = $ar["lastname"];
		auth()->user()->profile->adresse_id = $address->id;
		auth()->user()->profile->save();
		
		auth()->user()->name = $ar["firstname"] . " " . $ar["lastname"];
		auth()->user()->save();
		
		return auth()->user()->profile;
	}
	
	public function getEditPass() {
		return view("profile.userform", ["row" => auth()->user()]);
	}
	
	public function postEditPass(Request $request) {
		$ar = $request->all();
		
		if(auth()->validate([
				"email" => auth()->user()->email,
				"password" => $ar["password_old"]
		]) && $ar["password"] == $ar["password_confirm"]) {
			auth()->user()->password = $ar["password"];
			auth()->user()->save();
			return  auth()->user();
		}
		
		return ["error"];
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