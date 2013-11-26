require.config 
	paths:
		jquery: ['//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min', 'jquery'],
		bootstrap: ['//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min', 'bootstrap']
	shim:
		bootstrap: ['jquery']
		
require ['app'], (App) ->
	App.initialize()