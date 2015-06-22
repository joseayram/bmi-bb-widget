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

      $("#height_ft").removeClass("border-error");
      $("#height_in").removeClass("border-error");
      $("#weight_lb").removeClass("border-error");

      $("#bmi-bb-widget-error").removeClass("show-message");
      $("#bmi-bb-widget-error").addClass("hide-message");
      $("#bmi-bb-widget-result").removeClass("hide-message");
      $("#bmi-bb-widget-result").addClass("show-message");
      $("#bmi-bb-widget-result").html("BMI RESULT: "+Number(bmi.toFixed(2)));
    } else {
      $("#bmi-bb-widget-result").removeClass("show-message");
      $("#bmi-bb-widget-result").addClass("hide-message");
      $("#bmi-bb-widget-error").removeClass("hide-message");
      $("#bmi-bb-widget-error").addClass("show-message");

      if (!$.isNumeric(height_ft)) $("#height_ft").addClass("border-error");
      if (!$.isNumeric(height_in)) $("#height_in").addClass("border-error");
      if (!$.isNumeric(weight_lb)) $("#weight_lb").addClass("border-error");
    }
  });
});