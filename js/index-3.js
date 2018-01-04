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
    var cbmSelect = $("#cbm-select").val();
    var cbmQuantity = $("#cbm-number").val();
    var description = $("#description").val();
    var doorSelect = $("#door-select").val();
    var doorOrigin = $("#door-origin").val();
    var destinationPort = $("#destination-port").val();

    var length = $("#dimension-l").val();
    var width = $("#dimension-w").val();
    var height = $("#dimension-h").val();

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

    if (cbmSelect == '') {
      alert("Select CMB or CBF");
      return false;
    } else {
      if (cbmQuantity == '') {
        alert("Insert CMB or CBF Quantity");
        return false;
      }
    }

    if (doorSelect == '') {
      alert("Select Door to Port / Port to Port");
      return false;
    } else {
      if (doorOrigin == '' || destinationPort == '') {
        alert("Enter origin and destination");
        return false;
      }
    }

    if (description == '') {
      alert("Enter description");
      return false;
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
      weight: weight,
      weightType: poundsKilosSelect,
      cbm: cbmQuantity,
      cbmType: cbmSelect,
      origin: doorOrigin,
      destinationPort: destinationPort,
      originType: doorSelect,
      measures: length + 'x' + width + 'x' + height,

      //THIS WILL TELL THE FORM IF THE USER IS CAPTCHA VERIFIED.
      captcha: captchaResponse
    };

    console.log(data);

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
      $("#pounds-kilos-number").attr("placeholder", "Weight in " + $(this).val()).focus().blur();
    } else {
      $(".pounds-kilos-container").addClass('hide');
    }
  });

  $("#cbm-select").change(function() {
    console.log('pop');
    if ($(this).val() != '') {
      $(".cbm-container").removeClass('hide')
      $("#cbm-number").attr("placeholder", "Quantity " + $(this).val()).focus().blur();
    } else {
      $(".cbm-container").addClass('hide');
    }
  });

  $("#door-select").change(function() {
    if ($(this).val() != '') {
      $(".door-container").removeClass('hide');
    } else {
      $(".door-container").addClass('hide');
    }
  });
});
