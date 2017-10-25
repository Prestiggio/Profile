<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, Mail;
use Ry\Profile\Models\Emailconfirmation;
use Illuminate\Database\Eloquent\Model;

class PublicController extends Controller
{
	public function __construct() {
		$this->middleware("web");
	}
	
	public function verify($email, $session=null) {
		Model::unguard();
		
		$confirmation = Emailconfirmation::create([
				"email" => $email,
				"hash" => str_random(),
				"valide" => false,
				"session" => isset($session) ? serialize($session) : null
		]);
		
		Mail::queue('ryprofile::emails.preconfirm', ["confirmation" => $confirmation], function($message) use ($email){
			$message->to($email)->subject('Bienvenue sur '.env("APP_URL").'!');
		});
		
		Model::reguard();
		
		return $confirmation;
	}
}