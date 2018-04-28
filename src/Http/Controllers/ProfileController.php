<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ry\Geo\Models\Adresse;
use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Profile;
use Mail, Auth;
class ProfileController extends Controller
{
	public function __construct() {
		$this->middleware("web");
		$this->middleware("auth");
	}
	
	public function getEdit() {
		return view("profile.form", ["row" => auth()->user()->profile]);
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
			$message->from(env("contact", "manager@topmora.com"), env("SHOP", "TOPMORA SHOP"));
		});
		return redirect()->back();
	}
	
	public function postEdit(Request $request) {
		$ar = $request->all();
	
		$user = Auth::user();
	

		
		if(isset($ar["profile"]["adresse"]))
			$adresse = Adresse::firstOrCreateFromBulk($ar["profile"]["adresse"]);
		
		$data = [
				"pseudo" => isset($ar["profile"]["pseudo"]) ? $ar["profile"]["pseudo"] : null,
				"firstname" => isset($ar["profile"]["firstname"]) ? $ar["profile"]["firstname"] : null,
				"middlename" => isset($ar["profile"]["middlename"]) ? $ar["profile"]["middlename"] : null,
				"lastname" => isset($ar["profile"]["lastname"]) ? $ar["profile"]["lastname"] : null,
				"official" => isset($ar["profile"]["official"]) ? $ar["profile"]["official"] : null,
				"gender" => isset($ar["profile"]["gender"]) ? $ar["profile"]["gender"] : null,
				"relationship" => isset($ar["profile"]["relationship"]) ? $ar["profile"]["relationship"] : null,
				"about" => isset($ar["profile"]["about"]) ? $ar["profile"]["about"] : null,
				"birthday" => isset($ar["profile"]["birthday"]) ? $ar["profile"]["birthday"] : null,
				"adresse_id" => isset($adresse) ? $adresse->id : 0,
				"languages" => isset($ar["profile"]["languages"]) ? $ar["profile"]["languages"] : null
		];
		
		Profile::unguard();
		if(!$user->profile)
			$user->profile()->create($data);
		else {
			$user->profile()->update($data);
		}
		Profile::reguard();
		
		if(isset($ar["contacts"]))
			app("\Ry\Profile\Http\Controllers\AdminController")->putContacts($user, $ar["contacts"]);		
		return $user->profile;
	}
	
	public function postNotification(Request $request) {
		Notification::unguard();
		Notification::create($request->only([
				"user_id", "presentation", "priority"
		]));
		Notification::reguard();
	}
}