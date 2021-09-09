jQuery(function($){
  var step = 0;
  const btn1 = $("#wizardBtn1"); // first (purple) button
  const btn2 = $("#wizardBtn2"); // second (white) button
  const emailInput = $("#wizardInputEmail");
  const quantityInput = $("#wizardInputQuantity");
  const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const ENDPOINT = "wp-admin/admin-ajax.php?action=send_email";

  var formValues = {
    name: undefined,
    email: undefined,
    phone: undefined,
    quantity: undefined,
    price: undefined,
  }

  invalidInputAnimation = {
    keyframes: [
      {transform: "none"},
      {transform: "translateX(-10px)"},
      {transform: "translateX(10px)"},
      {transform: "translateX(-10px)"},
      {transform: "translateX(10px)"},
      {transform: "none"},
    ],
    timing: {
      duration: 360
    }
  }

  btn1.click(function(){
    step++;
    changeStep();
  });

  btn2.click(function(){
    step--;
    changeStep(false);
  });

  emailInput.on("input", function() {
    $(this).removeClass("invalid");
  });
  quantityInput.on("input", function() {
    $(this).removeClass("invalid");
  });

  $(window).on("resize", function() {
    let paddingLeft = ( $(".wizard-container").outerWidth() - $(".wizard-content").width() ) / 2;
    $(".wizard-content").scrollLeft($(".wizard-step")[step].offsetLeft - paddingLeft);
  });

  function changeStep(forward = true) {
    switch (step) {
      case 1:
        if (forward && !emailRegex.test( emailInput.val() ) ) { // if email is not valid;
          processInvalidInput(emailInput);
          return;
        }
        formValues.name = $("#wizardInputName").val();
        formValues.email = emailInput.val();
        formValues.phone = $("#wizardInputPhone").val();
        changeButtons("Continue", true);
        break;
      case 2:
        let val = quantityInput.val();
        if (forward && val < 1 || val > 1000) { // if quantity is not valid;
          processInvalidInput(quantityInput);
          return;
        }

        formValues.quantity = val;
        if (val < 11) {
          formValues.price = 10;
        } else if (val < 101) {
          formValues.price = 100;
        } else if (val < 1001) {
          formValues.price = 1000;
        }
        $("#wizardPrice").text(formValues.price + "$");

        changeButtons("Send to Email", true);
        break;
      case 3:
        fetch(ENDPOINT, { // send JSON-data to endpoint. Endpoint should send email to receiver;
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(formValues)
        })
        .then(res=>{return res.text()})
        .then(res=>{
          console.log(res); // log sending results to console. For debug purposes only;
          $("#wizardSendingResult").text("✅ Your email was send successfully");
        })
        .catch(err=>{
          console.log(err); // log sending errors to console. For debug purposes only;
          $("#wizardSendingResult").text("⚠️ We cannot send you email right now. Use alternative way to contact us");
        })
        changeButtons("Start Again", false);
        break;
    }
    if (step !== 4) {
      let paddingLeft = ( $(".wizard-container").outerWidth() - $(".wizard-content").width() ) / 2;
      $(".wizard-content").animate({scrollLeft: $(".wizard-step")[step].offsetLeft - paddingLeft}, 500, "swing"); // animated scrolling between wizard steps;
    } else {
    changeButtons("Continue", false);
      step = 0;
      $(".wizard-content").scrollLeft(0);
      $("#wizardSendingResult").text("");
      [].forEach.call($(".wizard-content input"), input=>{
        input.value = "";
      });
    }
    $(".wizard-breadcrumbs .title").removeClass("selected");
    $(".wizard-breadcrumbs .title").eq(step).addClass("selected");

    $(".wizard-step").removeClass("selected");
    $(".wizard-step").eq(step).addClass("selected");
  }

  function changeButtons(purpleButtonString, isSecondButtonVisible = false) {
    btn1.text(purpleButtonString); // change first button inner text;
    isSecondButtonVisible ? btn2.addClass("visible") : btn2.removeClass("visible"); // change visibility of second button;
  }

  function processInvalidInput(input) {
    input.addClass("invalid");
    input[0].animate(invalidInputAnimation.keyframes, invalidInputAnimation.timing);
    --step;
  }

});