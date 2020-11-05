function validateForm() {

    //Receiver Registration
    //Mobile number will be 10 digits not starting with zero.
    var mobile = document.forms["receiverRegistration"]["inputPhone"].value;
    mob_length = mobile.length;
    if (mobile[0] == 0 && mob_length != 10) {
        alert("Mobile number must be of 10 digits and Not start with 0");
        return false;
    }
    //Password must be greater than 6
    var password = document.forms["receiverRegistration"]["inputPassword"].value;
    pass_length = password.length;
    if (pass_length < 8) {
        alert("Password must be greater than or equal to 8 characters");
        return false;
    }

    
}