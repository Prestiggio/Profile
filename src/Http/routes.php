<?php
Route::get("ry/profile/ngcontact", function(){
	return view("ryprofile::ngcontact");
});
Route::get("ry/profile/admincontact", function(){
	return view("ryprofile::admincontact");
});
Route::get("/profile/email", "EmailController@getIndex");
Route::group(["middleware" => ["web", "auth"]], function(){
	Route::get("/profile/edit", "ProfileController@getEdit");
	Route::get("/profile/edit-pass", "ProfileController@getEditPass");
	Route::post("/profile/edit-pass", "ProfileController@postEditPass");
	Route::get("/profile/resend", "ProfileController@getResend");
	Route::post("/profile/edit", "ProfileController@postEdit");
	Route::post("/profile/notification", "ProfileController@postNotification");
});
