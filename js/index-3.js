$(document).ready(function() {
  var contactForm = $("#contact-form");
  //We set our own custom submit function
  contactForm.on("submit", function(e) {
    //Prevent the default behavior of a form
    e.preventDefault();
    //Get the values from the form
    var name = $("#name").val();
    var lastName = $("#last-name").val();
    var company = $("#company").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var piecesNumber = $("#pieces-number").val();
    var captchaResponse = grecaptcha.getResponse();
    var poundsKilosSelect = $("#pounds-kilos-select").val();
    var weight = $("#pounds-kilos-number").val();

    if (name == '') {
      alert("Enter your name");
      return false;
    }

    if (lastName == '') {
      alert("Enter your last name");
      return false;
    }

    if (piecesNumber == '') {
      alert("Enter the number of pieces");
      return false;
    }

    if (poundsKilosSelect == '') {
      alert("Select Pounds or Kilos");
      return false;
    } else {
      if (weight == '') {
        alert("Insert Weight");
        return false;
      }
    }

    if (captchaResponse == '') {
      alert("Mark that you are not a robot")
      return false;
    }

    var data = {
      name: name,
      lastName: lastName,
      company: company,
      email: email,
      phone: phone,
      piecesNumber: piecesNumber,
      //THIS WILL TELL THE FORM IF THE USER IS CAPTCHA VERIFIED.
      captcha: captchaResponse
    };

    //Our AJAX POST
    $.ajax({
      type: "POST",
      url: "index-3.php",
      data: data,
      success: function() {
        alert("THE FORM WAS SUBMITTED CORRECTLY");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseJSON.message);
      }
    });
  });

  $("#pounds-kilos-select").change(function() {
    if ($(this).val() != '') {
      $(".pounds-kilos-container").removeClass('hide');
    } else {
      $(".pounds-kilos-container").addClass('hide');
    }
  });
});
