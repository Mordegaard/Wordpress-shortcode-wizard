<?php

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
    <script src="' . get_stylesheet_directory_uri() . '/scripts/shortcode.js' . '"></script>';
    return $shortcode;
}
add_shortcode( 'r_test', 'wizard_shortcode' );

?>