<p>Bonjour {{$row["name"]}}</p>
<p><a href="{{action("\Ry\Profile\Http\Controllers\EmailController@getIndex")}}?hash={{$row["confirmation"]["hash"]}}">Clique ici pour confirmer ton email</a></p>
<p>Merci</p>
