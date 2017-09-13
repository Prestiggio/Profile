<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ry\Profile\Models\Emailconfirmation;

class EmailController extends Controller
{	
	public function getIndex(Request $request) {
		$confirmation = Emailconfirmation::where("hash", "LIKE", $request->get("hash"))->first();
		if($confirmation) {
			$confirmation->valide = true;
			$confirmation->save();
			return view("ryprofile::emails.confirmed");
		}
		return redirect("/home");
	}
}