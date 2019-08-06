<?php 
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $theme;
    
    public function setTheme($theme) {
        $this->theme = $theme;
        return $this;
    }
    
    public function list(Request $request) {
        return view("$this->theme::ldjson", [
            "page" => [
                "href" => "/notifications",
                "title" => __("Toutes les notifications")
            ]
        ]);
    }
}
?>