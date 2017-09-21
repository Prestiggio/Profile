<?php
namespace Ry\Profile\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Mail;

trait Emailconfirmable
{
	public function isEmailConfirmed() {
		$this->load("confirmation");
		
		if($this->confirmation)
			return $this->confirmation->id > 0 && $this->confirmation->valide;
		
		Model::unguard();
		
		$this->confirmation()->create([
				"email" => $this->email,
				"hash" => str_random(),
				"valide" => false
		]);
		
		Model::reguard();
		
		$this->load("confirmation");
		
		$user = $this;
		
		if(method_exists($this, "sendConfirmationRequest")) {
			$this->sendConfirmationRequest();
		}
		else {
			Mail::queue('ryprofile::emails.confirm', ["row" => $this, "confirmation" => $this->confirmation], function($message) use ($user){
				$message->to($user->email, $user->name)->subject('Bienvenue sur '.env("APP_URL").'!');
			});
		}
		
		return false;
	}
	
	public function confirmation() {
		return $this->hasOne("Ry\Profile\Models\Emailconfirmation", "user_id");
	}
}