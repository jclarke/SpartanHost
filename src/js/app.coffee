define [
	'jquery',
	'bootstrap'
], (Router, Socket) ->

	statsAjax = ->
		stats = $ 'js-stater'
		if stats.length isnt 1 then return false

		$.ajax
			url: '/stats'
			dataType: 'json'
			success: (data) ->
				for key, value of data
					$('[data-stat="' + key + '"]', stats).text value

	return {
		initialize: ->
			statsAjax()
	}