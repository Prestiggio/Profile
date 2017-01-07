<p>Bonjour {{$row["name"]}}</p>
<p><a href="{{action("\Ry\Profile\Http\Controllers\EmailController@getIndex")}}?hash={{$confirmation["hash"]}}">Cliquez ici pour confirmer ton email</a></p>
<p>Merci</p>
