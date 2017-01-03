<?php
namespace Ry\Profile\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Mail;

trait Emailconfirmable
{
	public function isEmailConfirmed() {
		if($this->confirmation)
			return $this->confirmation->id > 0 && $this->confirmation->valide;
		
		Model::unguard();
		
		$user = auth()->user();
		
		$user->confirmation()->create([
				"email" => $user->email,
				"hash" => str_random(),
				"valide" => false
		]);
		 
		Model::reguard();
		 
		Mail::queue('ryprofile::emails.confirm', ["row" => $user, "confirmation" => $user->confirmation], function($message) use ($user){
			$message->to($user->email, $user->name)->subject('Bienvenue sur aportax!');
		});
		
		return false;
	}
	
	public function confirmation() {
		return $this->hasOne("Ry\Profile\Models\Emailconfirmation", "user_id");
	}
}