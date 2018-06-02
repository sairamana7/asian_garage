$("#first-choice").change(function() {
  $("#second-choice").load("bike_details.php?choice=" + $("#first-choice").val());
});
