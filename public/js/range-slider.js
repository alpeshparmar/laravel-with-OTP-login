// // slider call

$('.range-slider').slider({
	range: true,
	min: 0,
	max: 60,
	values: [ 18, 30 ],
  step: 1,
	slide: function(event, ui) {
		
		$('.ui-slider-handle:eq(0) .range-min').html(ui.values[ 0 ]);
		$('.ui-slider-handle:eq(1) .range-max').html(ui.values[ 1 ]);
	}
});

$('.ui-slider-handle:eq(0)').append('<span class="range-min value">' + "18" + '</span>');

$('.ui-slider-handle:eq(1)').append('<span class="range-max value">' + "30" + '</span>');



//Distance
  $( function() {
    $( "#slider-miles" ).slider({
      range: "min",
      value: 10,
      min: 20,
      max: 500,
      slide: function( event, ui ) {
        $( "#amount" ).val( "Miles:" + ui.value );
      }
    });
    $( "#amount" ).val( "Miles:" + $( "#slider-miles" ).slider( "value" ) );
  } );