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
	
	public function putContacts(&$joinable, $ar) {
		foreach ( $ar as $contact ) {
		    if(!$contact['coord'])
		        continue;
		    
	        $_contact = [
	            "value" => $contact["coord"],
	            "schedule" => isset($contact["type"]) ? $contact["type"] : "bureau"
	        ];
		    
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
			    $_contact["type"] = "phone";
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