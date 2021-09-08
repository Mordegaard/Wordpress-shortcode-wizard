<?php

echo '<script>';
echo 'console.log("SHORTCODE IS LOADED")';
echo '</script>';

function wizard_shortcode($atts, $content) {
    $a = shortcode_atts( array(
		'title' => 'Title',
	), $atts );
    $shortcode .= '<div class="shortcode-container">
      <div class="wizard-container container">

        <div class="wizard-breadcrumbs row align-items-center">
          <span class="house col-sm-auto"><i class="bi bi-house-door-fill"></i></span>
          <div class="separator col"></div>
          <span class="title col selected">Contact Info</span>
          <div class="separator col"></div>
          <span class="title col">Quantity</span>
          <div class="separator col"></div>
          <span class="title col">Price</span>
          <div class="separator col"></div>
          <span class="title col">Done</span>
        </div>

        <div class="wizard-content">

          <div class="wizard-step step1 selected container">
            <div class="wizard-title">
              <h2>Contact Info</h2>
            </div>
            <div class="wizard-input row align-items-center">
              <span class="input-title col-3">Name</span>
              <input type="text" id="wizardInputName" class="col input-field">
            </div>
            <div class="wizard-input row align-items-center">
              <span class="input-title col-3">Email <sup>required</sup></span>
              <input type="email" id="wizardInputEmail" required class="col input-field">
            </div>
            <div class="wizard-input row align-items-center">
              <span class="input-title col-3">Phone</span>
              <input type="text" id="wizardInputPhone" class="col input-field">
            </div>
          </div>

          <div class="wizard-step step2 container">
            <div class="wizard-title">
              <h2>Quantity</h2>
            </div>
            <div class="wizard-input row align-items-center">
              <span class="input-title col-3">Quantity <sup>required</sup></span>
              <input type="number" id="wizardInputQuantity" min="1" max="1000" class="col input-field">
            </div>
          </div>

          <div class="wizard-step step3 container">
            <div class="wizard-title">
              <h2>Price</h2>
            </div>
            <h1 id="wizardPrice" class="row">100$</h1>
          </div>

          <div class="wizard-step step4 container">
            <div class="wizard-title">
              <h2>Done</h2>
            </div>
            <span id="wizardSendingResult" class="row"></span>
          </div>

        </div>

        <div class="wizard-buttons row">
          <button class="wizard-btn col" id="wizardBtn1">Continue</button>
          <button class="wizard-btn col" id="wizardBtn2"><i class="bi bi-arrow-left"></i>Back</button>
        </div>

      </div>
      
      <div class="wizard-description">
        <h2>' . $a['title'] . '</h2>
        <span>' . $content . '</span>
      </div>
      
    </div>
    <script>
    jQuery(function($){
  var step = 0;
  const btn1 = $("#wizardBtn1"); // first (purple) button
  const btn2 = $("#wizardBtn2"); // second (white) button
  const emailInput = $("#wizardInputEmail");
  const quantityInput = $("#wizardInputQuantity");
  const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const ENDPOINT = "https://jsonplaceholder.typicode.com/posts/";

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
      case 0:
        changeButtons("Continue", false);
        break;
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
        .then(res=>res.json())
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

    </script>';
    return $shortcode;
}
add_shortcode( 'r_test', 'wizard_shortcode' );

?>