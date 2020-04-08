<?php 
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{   
    public function list(Request $request) {
        return view("ldjson", [
            "page" => [
                "href" => "/notifications",
                "title" => __("Toutes les notifications")
            ]
        ]);
    }
}
?>