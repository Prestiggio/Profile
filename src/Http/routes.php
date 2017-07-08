<?php
Route::get("ry/profile/ngcontact", function(){
	return view("ryprofile::ngcontact");
});
Route::get("ry/profile/admincontact", function(){
	return view("ryprofile::admincontact");
});
Route::controller("/profile/email", "EmailController");
Route::controller("/profile", "ProfileController");
