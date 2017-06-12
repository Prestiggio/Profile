<?php
Route::get("ry/profile/ngcontact", function(){
	return view("ryprofile::ngcontact");
});
Route::controller("/profile/email", "EmailController");
Route::controller("/profile", "ProfileController");
