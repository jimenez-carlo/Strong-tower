(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('#go_up').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
})(jQuery);


var MessageFieldRequired = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please Enter Missing Fields.";
var MessagePasswordNotMatch = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Password Does Not Match.";

function clearErrors() {
  // Remove all error css
  // $('form>.alert-danger').hide();
  $(".is-invalid").removeClass("is-invalid");
}

function errorFields(strings) {
  $.each(strings.split(","), function (i,word) {
    var field = $("[name='"+word+"']");
      if (!$(field).hasClass("is-invalid")) {
        $(field).addClass("is-invalid");
      }
  });
}

function requireFields(strings) {
  var errors = 0;
  $.each(strings.split(","), function (i,word) {
    var field = $("[name='"+word+"']");
    if (field.val() == "" || field.val() == null || field.val().length == 0) {
      if (!$(field).hasClass("is-invalid")) {
        $(field).addClass("is-invalid");
      }
      errors++;
    }
  });
  return (errors == 0) ? true : false;
}

$(document).on("submit", 'form', function (e) {
  e.preventDefault();
  clearErrors();
  var form_raw = this;
  var form_name = this.name;
  var type = e.originalEvent.submitter.name;
  var type_value = e.originalEvent.submitter.value;
  if (this.name == 'logout') {
    window.location.href = base_url+'/logout.php';
  }
  
  formdata = new FormData(this);
  formdata.append('form', form_name);
  formdata.append(type, type_value);

  $.ajax({
    method: "POST",
    url: base_url + "/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
        var result = JSON.parse(res);
        if (form_name == 'landing_login') {
      $('#login_result').html(result.result);
        
        } else {
      $('#signup_result').html(result.result);
        
        }
      if (result.status == true) {
        $(form_raw).trigger('reset');
      }
      if (result.status == true && form_name =='landing_login') {
        window.location.reload();

      }
      if (result.items != '') {
        errorFields(result.items);
      }
    }
  });
});

$(document).ready(function() {
    $('.select').select2();
});