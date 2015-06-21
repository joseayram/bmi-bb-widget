jQuery(document).ready(function($) {
  $("#bmi-bb-widget-form").submit(function(event) {
    event.preventDefault();
    var height_ft = $("#height_ft").val();
    var height_in = $("#height_in").val();
    var weight_lb = $("#weight_lb").val();

    if ($.isNumeric(height_ft) &&
        $.isNumeric(height_in) &&
        $.isNumeric(weight_lb)) {
      height_ft = parseFloat(height_ft);
      height_in = parseFloat(height_in);
      weight_lb = parseFloat(weight_lb);

      var feets = height_ft + (height_in / 12);
      var inches = feets / 0.0833333333;
      var bmi = (weight_lb * 703) / (Math.pow(inches, 2));

      $("#bmi-bb-widget-result").html("BMI RESULT: "+Number(bmi.toFixed(2)));
    } else {
      $("#bmi-bb-widget-result").html("ERROR");
    }
  });
});