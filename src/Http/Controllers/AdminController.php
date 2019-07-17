<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Ry\Profile\Models\Indicatif;
use Ry\Profile\Models\Operateur;
use Ry\Profile\Models\Contact;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
	
	public function get_migration2019() {
	    $contacts = Contact::all();
	    foreach($contacts as $contact) {
	        if($contact->contact) {
	            $contact->detail = json_encode($contact->details);
	            $contact->save();
	        }
	    }
	}
	
	public function putContacts(&$joinable, $ar) {
		foreach ( $ar as $schedule => $contact ) {
		    if(!$contact["ndetail"]["value"])
		        continue;
		    
	        $_contact = [
	            "value" => $contact["ndetail"]["value"],
	            "schedule" => isset($contact["type"]) ? $contact["type"] : $schedule
	        ];
		    
			$join_id = false;
			if(isset($contact["id"]) && $contact["id"]>0)
				$join_id = $contact["id"];

			if($join_id && isset($contact["ndetail"]["value"]) && strlen($contact["ndetail"]["value"])==0)
				$contact["deleted"] = true;

			if($join_id && isset($contact["deleted"])) {
				$joinable->contacts()->where("id", "=", $join_id)->delete();
				continue;
			}
			
			if(!isset($contact ["contact_type"])) {
			    $contact["contact_type"] = "phone";
			}
			$_contact["type"] = $contact["contact_type"];

			Contact::unguard();
			
		    if(!$join_id) {
		        $joinable->contacts()->create ([
		            "detail" => json_encode($_contact)
		        ]);
		    }
		    else {
		        $joinable->contacts()->whereKey($join_id)->update([
		            "detail" => json_encode($_contact)
		        ]);
		    }

			Contact::reguard();
		}
	}
}