/* Author:
Evgeny Smolovich
*/

$(document).ready(function() {
//				var interval;
//				$('#roundabout')
//                .roundabout({
//                    shape: 'lazySusan',
//                    easing: 'swing',
//                    minOpacity: 1,
//                    minScale: 1.2,
//                    duration: 500,
//                    clickToFocus: true
    //                    })


    //**********PAYMENT FRAME******************


     var payFrame = $("#frame").hide();
     var payButton=$("#btn_pay").hide();
     


    //************PAYMENT FRAME******************

    $("#carousel").featureCarousel({
        autoPlay: 5000,
        trackerIndividual: false,
        trackerSummation: false,
        topPadding: 50,
        smallFeatureWidth: .9,
        smallFeatureHeight: .9,
        sidePadding: 0,
        smallFeatureOffset: 0
    });


                var messageDelay = 2000;  // How long to display status messages (in milliseconds)

                // Init the form once the document is ready
                $(init);


                // Initialize the form

                function init() {

                    // Hide the form initially.
                    // Make submitForm() the form's submit handler.
                    // Position the form so it sits in the centre of the browser window.
                    $('#contactForm').hide().submit(submitForm).addClass('positioned');

                    // When the "Send us an email" link is clicked:
                    // 1. Fade the content out
                    // 2. Display the form
                    // 3. Move focus to the first field
                    // 4. Prevent the link being followed

                    $('a[href="#contactForm"]').click(function () {
                        $('#content').fadeTo('slow', .2);
                        $('#contactForm').fadeIn('slow', function () {
                            $('#senderName').focus();
                        })

                        return false;
                    });

                    // When the "Cancel" button is clicked, close the form
                    $('#cancel').click(function () {
                        $('#contactForm').fadeOut();
                        $('#content').fadeTo('slow', 1);
                    });

                    // When the "Escape" key is pressed, close the form
                    $('#contactForm').keydown(function (event) {
                        if (event.which == 27) {
                            $('#contactForm').fadeOut();
                            $('#content').fadeTo('slow', 1);
                        }
                    });

                }


                // Submit the form via Ajax

                function submitForm() {
                    var contactForm = $(this);

                    // Are all the fields filled in?

                    if (!$('#senderName').val() || !$('#senderEmail').val() || !$('#senderPhone').val()) {

                        // No; display a warning message and return to the form
                        $('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
                        contactForm.fadeOut().delay(messageDelay).fadeIn();

                    } else {

                        // Yes; submit the form to the PHP script via Ajax

                        $('#sendingMessage').fadeIn();
                        contactForm.fadeOut();

                        $.ajax({
                            url: contactForm.attr('action') + "?ajax=true",
                            type: contactForm.attr('method'),
                            data: contactForm.serialize(),
                            success: submitFinished
                        });
                    }

                    // Prevent the default form submission occurring
                    return false;
                }
                // Handle the Ajax response

                function submitFinished(response) {
                    response = $.trim(response);
                    $('#sendingMessage').fadeOut();

                    if (response == "success") {

                        // Form submitted successfully:
                        // 1. Display the success message
                        // 2. Clear the form fields
                        // 3. Fade the content back in

                        $('#successMessage').fadeIn().delay(messageDelay).fadeOut();
                        $('#senderName').val("");
                        $('#senderEmail').val("");
                        $('#message').val("");

                        $('#content').delay(messageDelay + 500).fadeTo('slow', 1);

                    } else {

                        // Form submission failed: Display the failure message,
                        // then redisplay the form
                        $('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
                        $('#contactForm').delay(messageDelay + 500).fadeIn();
                    }
                }
    
         function randomString(length){
        var characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var randomString="";
        for (var i = 0; i < length; i++) {
            var rnum = Math.floor(Math.random() * characters.length);
            randomString += characters.substring(rnum,rnum+1);
        }
        return randomString;        
    
    }
    
    
    $(".price,.reNew").click(function(){
        
        if($(this).hasClass("show")){
            $(this).removeClass("show");
            payButton.hide();    
        }
        else{
            $(".price,.reNew").removeClass("show");
            $(this).addClass("show");
            payButton.show();
        }
        $('input[name="total"]').val($(this).find(".price-price").data("price"));
        $('input[name="Parmx"]').val($(this).find(".price-price").data("details"));
        $('input[name="authNum"]').val(randomString(7));
    });
         
       $("#btn_pay").click(function () {
            payFrame.fadeIn(800);
            
        });

//Check email validation

function validateEmail() {

        var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var address = $("#email").val();
        if (reg.test(address) === false) {
            alert('Invalid Email Address');
            return false;
        }
        else{
            return true;
        }
    }

//Check Email inputs

$("#emailCheck").keyup(function(){
    var email=$("#email").val();
    $(this).next(".APformLabel").css("color","red");
    if($(this).val()===email){
        $(this).next(".APformLabel").css("color","green");
        $("#btn_send").removeAttr("disabled","disabled");
        validateEmail();
    }
    else{
        $(this).next(".APformLabel").css("color","red");
        $("#btn_send").attr("disabled","disabled");
    }
});


    
     function required(item) {
        var required = true;
        $(item).each(function () {
            if (!$(this).val()) {
                $(this).next(".APformLabel").css("color","red");
                required = false;
            }
            else {
                $(this).next(".APformLabel").css("color","#414042");
            }
        });
        return required;
        }   
//$("#APform").submit(function () {
//    if(!required($(".APformInput"))){
//        return false;
//    }
//    var fName = $("#fName").val();
//    var lName = $("#lName").val();
//    var userID = $("#userID").val();
//    var packageName = $("#packageName").val();
//    var email = $("#emailCheck").val();
//    var tel = $("#phone").val();
//    var dateTime = $("#orderTime").val();
//    var authNum=$("#authNum").val();
//    var token=$("#token").val();
//    var result=$("#result").val();
//    var dataString = {
//                    fName: fName,
//                    lName: lName,
//                    userID: userID,
//                    packageName: packageName,
//                    email: email,
//                    tel: tel,
//                    dateTime:dateTime,
//                    authNum:authNum,
//                    token:token,
//                    result:result
//    };
//    $.ajax({
//        type: "POST",
//        url: "ajaxSend.php",
//        data: dataString,
//        error: function () {
//            $("#userData").append("Malfunction has occoured. please try again later.");
//        },
//        success: function (msg) {
//            $("#APform").fadeOut(200, function () {
//				$("#APform").remove();
//                $("#userData").css("padding","40px 0 0 50px");
//                $("#userData").append(msg);
//            });
//        }
//    });
//    return false;
//});

//$("#APform_btn_send").hover(function(){
//    $("input").next(".APformLabel").css("color","red");
//});


    $("#middle-top, #middle-bottom").click(function(){ 
        $("#btn_pay").css("left","260px");
    });
    $("#left-top, #left-bottom").click(function(){
        $("#btn_pay").css("left","40px");
    });
    $("#right-top, #right-bottom").click(function(){ 
        $("#btn_pay").css("left","480px");      
    });

$("#closeFrame").click(function(){
    $("#frame").remove();
});



});








