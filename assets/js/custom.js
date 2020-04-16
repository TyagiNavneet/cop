	$(document).ready(function(){
	  var widthWindow = $( window ).width();
	   if(widthWindow>=768){
	       $(".logo").click(function(){
	           $(".common-layout").toggleClass("is-folded");
	       });
	   }
	});


        jQuery (".close-graph").click (function () {
        if (jQuery (this).children (".material-icons").text() == "remove_circle") {
                jQuery (this).children (".material-icons").text("add_circle");
        }
        else {
             jQuery (this).children (".material-icons").text("remove_circle");        
        }
    });

	$(function() {


  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='login']").validate({
    // Specify validation rules
      rules: {

      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        validate_email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {

      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },

    submitHandler: function(form) {
      form.submit();
    },
	
	// errorPlacement: function () { },
    // set the errorClass as a random string to prevent label disappearing when valid
    errorClass : "error",
    // use highlight and unhighlight
	
    highlight: function (element, errorClass, validClass) {
		
        //$(element.form).find("label[for=" + element.id + "]")
		$('#'+element.id).parent()
        .addClass("has-danger is-focused");
       
    },
    unhighlight: function (element, errorClass, validClass) {
        //$(element.form).find("label[for=" + element.id + "]")
		$('#'+element.id).parent()
        .removeClass("has-danger is-focused");

    }
  });


// Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='signup']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        validate_email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      password_again: {
          required: true,
         equalTo: "#password"
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
       password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    },
  
  // errorPlacement: function () { },
    // set the errorClass as a random string to prevent label disappearing when valid
    errorClass : "error",
    // use highlight and unhighlight
  
    highlight: function (element, errorClass, validClass) {
    
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .addClass("has-danger is-focused");
       
    },
    unhighlight: function (element, errorClass, validClass) {
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .removeClass("has-danger is-focused");

    }
  });


  $("form[name='forgetform']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
       email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        validate_email: true
      }
    },
    // Specify validation error messages
    messages: {
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    },
  
  // errorPlacement: function () { },
    // set the errorClass as a random string to prevent label disappearing when valid
    errorClass : "error",
    // use highlight and unhighlight
  
    highlight: function (element, errorClass, validClass) {
    
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .addClass("has-danger is-focused");
       
    },
    unhighlight: function (element, errorClass, validClass) {
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .removeClass("has-danger is-focused");

    }
  });



 $("form[name='profile']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      company: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        validate_email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      password_again: {
          required: true,
         equalTo: "#password"
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
       password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    },
  
  // errorPlacement: function () { },
    // set the errorClass as a random string to prevent label disappearing when valid
    errorClass : "error",
    // use highlight and unhighlight
  
    highlight: function (element, errorClass, validClass) {
    
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .addClass("has-danger is-focused");
       
    },
    unhighlight: function (element, errorClass, validClass) {
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .removeClass("has-danger is-focused");

    }
  });



$("form[name='popup-form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      firstname: "required",
      company: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        validate_email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      password_again: {
          required: true,
         equalTo: "#password"
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
       password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    },
  
  // errorPlacement: function () { },
    // set the errorClass as a random string to prevent label disappearing when valid
    errorClass : "error",
    // use highlight and unhighlight
  
    highlight: function (element, errorClass, validClass) {
    
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .addClass("has-danger is-focused");
       
    },
    unhighlight: function (element, errorClass, validClass) {
        //$(element.form).find("label[for=" + element.id + "]")
    $('#'+element.id).parent()
        .removeClass("has-danger is-focused");

    }
  });





});


$("#popupform").click(function() {
     $("#profile_popupform").submit()
});

$("#profile_form").click(function() {
     $("#profileForm").submit()
});

  jQuery.validator.addMethod("validate_email", function(value, element) {

    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");