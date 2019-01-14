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
		foreach ( $ar as $contact ) {
			$join_id = false;
			if(isset($contact["id"]) && $contact["id"]>0)
				$join_id = $contact["id"];

			if($join_id && isset($contact["coord"]) && strlen($contact["coord"])==0)
				$contact["deleted"] = true;

			if($join_id && isset($contact["deleted"])) {
				$joinable->contacts()->where("id", "=", $join_id)->delete();
				continue;
			}
					
			if(!isset($contact ["contact_type"])) {
				if(!isset($contact ["ry_profile_contact_type"]))
					continue;
				
				if($contact ["ry_profile_contact_type"]==Phone::class)
					$contact ["contact_type"] = "phone";

				if($contact ["ry_profile_contact_type"]==Email::class)
					$contact ["contact_type"] = "email";
			}

			Contact::unguard();
						
			if ($contact ["contact_type"] == "phone") {
				if(!isset($contact ["coord"]))
					continue;
				
				$raw = preg_replace ( "/[^\d]+/i", "", $contact ["coord"] );
				if(strlen($raw)<7) {
					continue;
				}
				if(isset($contact ["contact"]["indicatif"]["id"])) {
					$indic = Indicatif::where( "id", "=", $contact ["contact"]["indicatif"]["id"] )->first ();
					if (! $indic) {
						continue;
					}
				}
				else {					
					$raw = preg_replace("/^0*261/i", "0", $raw);
					if(strlen($raw)<7) {
						continue;
					}
					
					$indicatif = substr ( $raw, 0, - 9 );
					if ($indicatif == "0")
						$indicatif = "261";
					
					$indic = Indicatif::where ( "code", "=", $indicatif )->first ();
					if (! $indic) {
						$indic = new Indicatif ();
						$indic->country_id = (isset($contact ["contact"]["indicatif"]["country"]["id"])) ? $contact ["contact"]["indicatif"]["country"]["id"] : 1;
						$indic->code = $indicatif;
						$indic->format = "\d{10}";
						$indic->save ();
					}
				}
				
				$operateur = substr ( $raw, - 9, - 7 );
				
				$op = Operateur::where ( "code", "=", $operateur )->first ();
				if (! $op) {
					$op = new Operateur ();
					$op->country_id = (isset($contact ["contact"]["indicatif"]["country"]["id"])) ? $contact ["contact"]["indicatif"]["country"]["id"] : 1;
					$op->code = $operateur;
					$op->name = '';
					$op->save ();
				}

				if(!$join_id) {
					$phone = new Phone();
				}
				else {
					$phone = Contact::where("id", "=", $join_id)->first()->ry_profile_contact;
				}
				
				if(!Phone::where("indicatif_id", "=", $indic->id)->where("operateur_id", "=", $op->id)->where("raw", "=", $raw)->exists()) {
					$phone->indicatif_id = $indic->id;
					$phone->operateur_id = $op->id;
					$phone->raw = $raw;
					$phone->save ();
					
					if(!$join_id) {
						$joinable->contacts ()->create ( [
						        "type" => isset($contact["type"]) ? $contact["type"] : "bureau",
								"ry_profile_contact_type" => Phone::class,
								"ry_profile_contact_id" => $phone->id
						] );
					}
				}
				elseif(!$join_id) {
					$phone = Phone::where("indicatif_id", "=", $indic->id)->where("operateur_id", "=", $op->id)->where("raw", "=", $raw)->first();
					$joinable->contacts ()->create ( [
						"type" => isset($contact["type"]) ? $contact["type"] : "bureau",
						"ry_profile_contact_type" => Phone::class,
						"ry_profile_contact_id" => $phone->id
					] );
				}
				else {
				    $phone->raw = $raw;
				    $phone->save();
				}
			}
					
			if ($contact ["contact_type"] == "email") {
				if(!isset($contact ["coord"]))
					continue;
				
				$email = Email::where ( "address", "=", $contact ["coord"] )->first ();
				if (! $email) {
					$email = new Email ();
					$email->address = $contact ["coord"];
					$email->save ();
				}
				
				if(!$joinable->contacts ()->where("ry_profile_contact_type", "LIKE", Email::class)
						->where("ry_profile_contact_id", "=", $email->id)->exists()) {
					if(!$join_id) {
						$joinable->contacts ()->create ( [
						    "type" => isset($contact["type"]) ? $contact["type"] : "bureau",
							"ry_profile_contact_type" => Email::class,
							"ry_profile_contact_id" => $email->id
						] );
					}
					else {
						$joint = $joinable->contacts()->where("id", "=", $join_id)->first();
						if(!$joint) {
							$joinable->contacts ()->create ( [
							    "type" => isset($contact["type"]) ? $contact["type"] : "bureau",
								"ry_profile_contact_type" => Email::class,
								"ry_profile_contact_id" => $email->id
							] );
						}
						else {
							$joint->ry_profile_contact_id = $email->id;
							$joint->save();
						}
					}
				}
				elseif(!$join_id) {
					$email = $joinable->contacts ()->where("ry_profile_contact_type", "LIKE", "%Email%")
					->where("ry_profile_contact_id", "=", $email->id)->first();
					$joinable->contacts ()->create ( [
					    "type" => isset($contact["type"]) ? $contact["type"] : "bureau",
						"ry_profile_contact_type" => Email::class,
						"ry_profile_contact_id" => $email->id
					] );
				}
			}

			Contact::reguard();
		}
	}
}