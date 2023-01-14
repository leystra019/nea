var form = document.getElementById("your-form-id");
form.addEventListener("submit", function() {
    checkboxTicked();
});

function checkboxTicked() {
    var checkbox = document.getElementById("saveinfo");
    if (checkbox.checked) {
      // the checkbox is checked so save the data
      // create an object to hold the form data
      var formData = {
          'name': $('input[name=name]').val(),
          'email': $('input[name=email]').val(),
          'phone': $('input[name=phone]').val(),
          'residence': $('input[name=residence]').val(),
          'billingad': $('input[name=billingad]').val(),
          'shippingad': $('input[name=shippingad]').val(),
          'city': $('input[name=city]').val(),
          'postcode': $('input[name=postcode]').val()
      };
  
      // process the form
      $.ajax({
          type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
          url: '/neatest/html/shop/cookies.php',
          dataType: 'json', // what type of data do we expect back from the server
          encode: true
      })
      // using the done promise callback
    } else {
        // the checkbox is not checked so do not save the data
        alert("Your info will not be saved for next time, unless");
    }
}