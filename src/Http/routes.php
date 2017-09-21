<?php
Route::get("ry/profile/ngcontact", function(){
	return view("ryprofile::ngcontact");
});
Route::get("ry/profile/admincontact", function(){
	return view("ryprofile::admincontact");
});
Route::controller("ry/profile", "PublicController");
Route::controller("/profile/email", "EmailController");
Route::group(["middleware" => ["web", "auth"]], function(){
	Route::controller("/profile", "ProfileController");
});
