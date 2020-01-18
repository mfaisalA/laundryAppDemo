// Ad-post form validation
var errors = 0; // Var to check when submiting form
$("#post_ad_form").validate({
            errorClass: "post-form-error-class",

            rules: {
                searchword: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                image: {
                    required: true
                },
                p_name: {
                    required: true
                },
                accept: "required"
            },
            messages: {
                searchword: {
                    required: "Please enter a Title / Searchword",
                    minlength: "Title  Searchword must consist of at least 3 characters"
                },
                image: "Please choose an image to upload",
                email: "Please enter a valid email address",
                p_name: "Please enter a your name",
                accept: "Please accept the terms & conditions"
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "searchword" ){
                    error.insertAfter($(element).parent('div').next('div').children($('.error-label')));
                }else if (element.attr("name") == "email" ){
                    error.insertAfter($(element).parent('div').next('div').children($('.error-label')));
                }else if (element.attr("name") == "image" ){
                    error.insertAfter($(element).parent('div').next('div').children($('.error-label')));
                }else if (element.attr("name") == "p_name" ){
                    error.insertAfter($(element).parent('div').next('div').children($('.error-label')));
                }else if (element.attr("name") == "accept" ){
                    error.insertAfter($(element).parent('div').next('div').children($('.error-label')));
                }
                    
            },

            invalidHandler: function(event, validator) {
            // 'this' refers to the form
            errors = validator.numberOfInvalids();    
          }
    });