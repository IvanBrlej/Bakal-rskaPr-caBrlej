function toggleSignup(){
    if($('#loginButton').val() == 0){
        $('#firstnameDiv').show();
        $('#lastnameDiv').show();
        $('#confirmPasswordDiv').show();
        $('#loginButton').val('1');
        $('#loginButton').html('Sign up');
        $('#toggleMessage').html('<a href="#"> Click here to revert to Login if you are already registered</a>');
    }else{
        $('#firstnameDiv').hide();
        $('#lastnameDiv').hide();
        $('#confirmPasswordDiv').hide();
        $('#loginButton').val('0');
        $('#loginButton').html('Log in');
        $('#toggleMessage').html('<a href="#"> If you dont have already account, click for Sign Up</a>');
    }
}