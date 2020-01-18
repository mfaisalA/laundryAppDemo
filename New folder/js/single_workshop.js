(function($) {
    "use strict"; // Start of use strict

$(document).ready(function () {
  var contact = document.getElementById("customer_contact");

contact.addEventListener("input", function (event) {
  if (contact.validity.patternMismatch) {
    contact.setCustomValidity("Number should not start with 0 AND lenght must be equal to 8 digits!");
  } else {
    contact.setCustomValidity("");
  }
});

	$('#pref_date').datepicker({
		minDate:0
	});
	$('input[type=radio][name=pickup_options]').change(function() {
        if ($(this).attr('id') == 'option_yes') {
            var locationDiv = '<div id="location-div" class="form-group row">';
    			locationDiv +=	'<div class="col-sm-4">';
    			locationDiv +=	'<label for="pickup_location">Pickup Location</label>';
    			locationDiv +=	'</div>';
    			locationDiv +=	'<div class="col-sm-8">';
    			locationDiv +=	'<textarea class="form-control" id="pickup_location" name="pickup_location" required></textarea>';
    			locationDiv +=	'</div>';
    			locationDiv +=	'</div>';
            $('#radio_btn_div').after(locationDiv);
        }
        else if ($(this).attr('id') == 'option_no') {
            $('#location-div').remove();
        }
    });

    $("#errorDiv").delay(500).show(10, function() {
	      $(this).delay(3000).hide(10, function() {
	        $(this).remove();
	      });
	    }); // /.alert


        var brandId = $("#brand_id").val();
          getSubCategories(brandId);

        $('#brand_id').on('change', function(){
          var brandId = $(this).val();
          getSubCategories(brandId);
          
        });
});

 function getSubCategories(brandId){
        var jqxhr = $.get( "get_brand_models.php?brand_id="+brandId, function(data) {
              if(data.success == true){
                var selHtml = '<option value="">Select</option>';
                $.each(data.data, function(index, value){
                  selHtml += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('#model_name').html(selHtml);
              }
              
            }, "json");
      }

})(jQuery); // End of use strict

        

     
