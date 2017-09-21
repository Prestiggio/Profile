<?php
namespace Ry\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PublicController extends Controller
{
	public function __construct() {
		$this->middleware("web");
	}
}