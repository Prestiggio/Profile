<p>Bonjour,</p>
<p>Veuillez bien vouloir <a href="{{action("\Ry\Profile\Http\Controllers\EmailController@getIndex")}}?hash={{$confirmation["hash"]}}">cliquer ici</a> pour confirmer la reception de ce message.</p>
<p>Vous pouvez également recopier l'adresse ci-dessous dans la barre d'adresse de votre navigateur préféré.</p>
<blockquote>{{action("\Ry\Profile\Http\Controllers\EmailController@getIndex")}}?hash={{$confirmation["hash"]}}</blockquote>
<p>Merci.</p>
<p>{{env("COMPANY")}}</p>
