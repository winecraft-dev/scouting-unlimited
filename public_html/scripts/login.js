//this is going to be the worst code you'll see on the entire website, so don't look at it for reference, k?

window.onload = function() {
  $({blurRadius: 0}).animate({blurRadius: 100}, {
    duration: 1000,
    easing: 'swing', // or "linear"
                     // use jQuery UI or Easing plugin for more options
    step: function() {
      $('.login-form-container').css({
          "-webkit-filter": "opacity("+this.blurRadius+"%)",
          "filter": "opacity("+this.blurRadius+"%)"
      });
    }
  });
}

$(document).ready(function() {
  $("#login-form").on("submit", function(event){
    event.preventDefault()
  });
  $(document).on("click", "#login.login-button", function() {
    $('.login-button').replaceWith('<div class="login-pending"></div>');
    console.log("Button Pressed");
    var name = $("#name").val();
    var password = $("#password").val();
    
    if(name.length == 0 || password.length == 0)
    {
    	$('.login-pending').replaceWith('<button id="login" class="login-button">Login</button>');
      $(".login-form-message").text("Please enter a username and password");
      $({blurRadius: 0}).animate({blurRadius: 100}, {
        duration: 500,
        easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
        step: function() {
          $('.login-form-message').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
          });
        }
      });
      return;
    }
    else
    {
      $(".login-form-message").text("");
    }
    var values = {
            'name': name,
            'password': password
    };
    request = $.ajax({
        url: "/?p=login&do=login",
        type: "post",
        data: values
    });
    
    request.done(function (response, textStatus, jqXHR){
    	$('.login-pending').replaceWith('<button id="login" class="login-button">Login</button>');
      console.log(response + " " + textStatus + " " + jqXHR);
      if(response == "LACKING CREDENTIALS")
      {
        $(".login-form-message").text("Please enter a name and password");
        $({blurRadius: 0}).animate({blurRadius: 100}, {
          duration: 500,
          easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
          step: function() {
            $('.login-form-message').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
            });
          }
        });
        console.log("Lacking Credentials");
        return;
      }
      else if(response == "FALSE")
      {
        $(".login-form-message").text("Incorrect Name or Password");
        $({blurRadius: 0}).animate({blurRadius: 100}, {
          duration: 500,
          easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
          step: function() {
            $('.login-form-message').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
            });
          }
        });
        console.log("Wrong Credentials");
        return;
      }
      else if(response == "NOT ENOUGH PERMISSIONS")
      {
        $(".login-form-message").text("Your account is still pending approval");
        $({blurRadius: 0}).animate({blurRadius: 100}, {
          duration: 500,
          easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
          step: function() {
            $('.login-form-message').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
            });
          }
        });
        console.log("Not enough permissions");
        return;
      }
      else
      {
        $({blurRadius: 100}).animate({blurRadius: 0}, {
          duration: 500,
          easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
          step: function() {
            $('body').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
            });
          }
        });
        setTimeout(function() {
          window.location.replace(response);
        }, 500);
      }
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown) {
      // Log the error to the console
      console.error(
          "The following error occurred: "+
          textStatus, errorThrown
      );
    });
  }); 
  $("#register").click(function(evt) {
    evt.preventDefault();
    $({blurRadius: 100}).animate({blurRadius: 0}, {
      duration: 500,
      easing: 'swing', // or "linear"
                       // use jQuery UI or Easing plugin for more options
      step: function() {
        $('#login.login-button').css({
            "-webkit-filter": "opacity("+this.blurRadius+"%)",
            "filter": "opacity("+this.blurRadius+"%)"
        });
      }
    });
    setTimeout(function() {
      $('#login.login-button').replaceWith('<button id="register" class="login-button">Register</button>');
      $({blurRadius: 0}).animate({blurRadius: 100}, {
        duration: 500,
        easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
        step: function() {
          $('#register.login-button').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
          });
        }
      });
    }, 500);
    $({blurRadius: 100}).animate({blurRadius: 0}, {
      duration: 500,
      easing: 'swing', // or "linear"
                       // use jQuery UI or Easing plugin for more options
      step: function() {
        $('#register.login-link').css({
            "-webkit-filter": "opacity("+this.blurRadius+"%)",
            "filter": "opacity("+this.blurRadius+"%)"
        });
      }
    });
    setTimeout(function() {
      $('#register.login-link').replaceWith('<a href="/?p=login" class="login-link" id="login">Back to Login</a>');
      $({blurRadius: 0}).animate({blurRadius: 100}, {
        duration: 500,
        easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
        step: function() {
          $('#login.login-link').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
          });
        }
      });
    }, 500);
  });
  $(document).on('click', '#register.login-button', function() {
  	$("#register.login-button").replaceWith('<div class="login-pending"></div>');
  	
  	var values = {
  	  'name': $('#name.login-form-input').val(),
  	  'password': $('#password.login-form-input').val()
  	};
  	
  	request = $.ajax({
        url: "/?p=login&do=register",
        type: "post",
        data: values
    });
    request.done(function (response, textStatus, jqXHR){
    	$(".login-pending").replaceWith('<button id="register" class="login-button">Register</button>');
      console.log(response + " " + textStatus + " " + jqXHR);
      if(response == "REGISTERED")
      {
        window.location.replace("/?p=login&register=true");
      }
      else
      {
        $('.login-form-message').text(response);
        $({blurRadius: 0}).animate({blurRadius: 100}, {
          duration: 500,
          easing: 'swing', // or "linear"
                         // use jQuery UI or Easing plugin for more options
          step: function() {
            $('.login-form-message').css({
              "-webkit-filter": "opacity("+this.blurRadius+"%)",
              "filter": "opacity("+this.blurRadius+"%)"
            });
          }
        });
      }
    });
  });
});
