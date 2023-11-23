var name_error = document.getElementById('error-name');
var email_error = document.getElementById('error-email');
var pass_error = document.getElementById('error-pass');
var cpass_error = document.getElementById('error-cpass');
var submit_error = document.getElementById('error-submit');

function validateName(){
    var name = document.getElementById('name').value;
    if(name.length == 0){
        name_error.innerHTML = "Name is required";
        return false;
    }
    if(!name.match(/^[a-zA-Z ]+$/)){
        name_error.innerHTML = "Write name";
        return false;
    }
    name_error.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
    return true;
}

function validateEmail(){
    var email = document.getElementById('email').value;

    if(email.length == 0){
        email_error.innerHTML = 'Email cannot be empty';
        return false;
    }
    if(!email.match(/^\w+([\.]?\w+)*@\w([\.]?\w+)*(\.\w{2,3})+$/)){
        email_error.innerHTML = "Invalid Email";
        return false;
    }
    email_error.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
    return true;
}

function validatePass(){
    var pass = document.getElementById('pass').value;
    var cpass = document.getElementById('cpass').value;

    if(pass.length == 0){
        pass_error.innerHTML = "Password cannot be empty";
        return false;
    }
    if(pass.length <6){
        pass_error.innerHTML = "Password must be greater than 6 digits";
        return false;
    }
    if(cpass !== pass){
        cpass_error.innerHTML = "Password should match";
        return false;
    }
    if(!pass.match(/[A-Z]/)){
        pass_error.innerHTML = "At least one upper case is required";
        return false;
    }if(!pass.match(/[a-z]/)){
        pass_error.innerHTML = "At least one lower case is required";
        return false;
    }
    if(!pass.match(/[0-9]/)){
        pass_error.innerHTML = "At least one number is required";
        return false;
    }
    if(!pass.match(/[@#$%&*_!]/)){
        pass_error.innerHTML = "At least one special char is required";
        return false;
    }
    pass_error.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
    cpass_error.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
    return true;
}


function validateForm(){
    if(!validateName() || !validateEmail() || !validatePass()){
        submit_error.style.display = 'block';
        submit_error.innerHTML = 'Please fix the errors to submit';
        setTimeout(function(){submit_error.style.display = 'none';},3000);
        return false;
    }
}