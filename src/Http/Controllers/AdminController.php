<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Email;
use Ry\Profile\Models\Phone;
use Ry\Profile\Models\Indicatif;
use Ry\Profile\Models\Operateur;
use Ry\Profile\Models\Contact;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
	
	public function putContacts(&$joinable, $ar) {
		Model::unguard();
		
		foreach ( $ar as $contact ) {
			if(isset($contact["id"]) && isset($contact["deleted"])) {
				$joinable->contacts()->where("id", "=", $contact["id"])->delete();
				continue;
			}
					
			if(!isset($contact ["contact_type"])) {
				if($contact ["ry_profile_contact_type"]==Phone::class)
					$contact ["contact_type"] = "phone";

				if($contact ["ry_profile_contact_type"]==Email::class)
					$contact ["contact_type"] = "email";
			}
						
			if ($contact ["contact_type"] == "phone") {
				$raw = preg_replace ( "/[^\d]+/i", "", $contact ["coord"] );
				$raw = preg_replace("/^0*261/i", "0", $raw);
				$indicatif = substr ( $raw, 0, - 9 );
				$operateur = substr ( $raw, - 9, - 7 );
				if ($indicatif == "0")
					$indicatif = "261";

				$indic = Indicatif::where ( "code", "=", $indicatif )->first ();
				if (! $indic) {
					$indic = new Indicatif ();
					$indic->country_id = 1;
					$indic->code = $indicatif;
					$indic->save ();
				}

				$op = Operateur::where ( "code", "=", $operateur )->first ();
				if (! $op) {
					$op = new Operateur ();
					$op->country_id = 1;
					$op->code = $operateur;
					$op->save ();
				}

				if(!isset($contact["id"])) {
					$phone = new Phone();
				}
				else {
					$phone = Contact::where("id", "=", $contact["id"])->first()->ry_profile_contact;
				}
				
				if(!Phone::where("indicatif_id", "=", $indic->id)->where("operateur_id", "=", $op->id)->where("raw", "=", $raw)->exists()) {
					$phone->indicatif_id = $indic->id;
					$phone->operateur_id = $op->id;
					$phone->raw = $raw;
					$phone->save ();
					
					if(!isset($contact["id"])) {
						$joinable->contacts ()->create ( [
								"type" => "bureau",
								"ry_profile_contact_type" => Phone::class,
								"ry_profile_contact_id" => $phone->id
						] );
					}
				}
			}
					
			if ($contact ["contact_type"] == "email") {
				$email = Email::where ( "address", "=", $contact ["coord"] )->first ();
				if (! $email) {
					$email = new Email ();
					$email->address = $contact ["coord"];
					$email->save ();
				}
				$joinable->contacts ()->create ( [
						"type" => "bureau",
						"ry_profile_contact_type" => Email::class,
						"ry_profile_contact_id" => $email->id
				] );
			}
		}
		
		Model::reguard();
	}
}