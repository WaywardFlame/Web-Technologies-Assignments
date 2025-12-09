window.addEventListener("load", function() {
    const form = document.getElementById("hwTenForm") ;
    let formData = null ; 

    function isValid_email() {
        const email = formData.get('EmailBox') ; 
        console.log('checking email:', email) ; 
        if (!email.endsWith("@utsa.edu") && !email.endsWith("@my.utsa.edu")) {
            console.log('email not acceptable') ; 
            // const el = form.querySelector("input[name='EmailBox']") ; 

            // el.setCustomValidity("must be utsa email address");
            // el.reportValidity();

            // console.log(el) ; 
            return false ; 
        }
        return true ; 
    }

    function isValid_firstname(){
        const firstName = formData.get('firstName');
        console.log("checking first name:", firstName);
        let isAcceptable = /^[A-Za-z\-\']+$/.test(firstName) && (firstName.length >= 2);
        if(!isAcceptable){
            console.log("first name not acceptable");

            // const el = form.querySelector("input[name='firstName']");
            // el.setCustomValidity("not long enough or contains special characters");
            // el.reportValidity();
            // console.log(el);
            return false;
        }
        return true;
    }

    function isValid_phone(){
        if(document.getElementById("PhoneNum").disabled){
            return true;
        }
        const phone = formData.get('PhoneNum');
        console.log("checking phone number:", phone);
        let isAcceptable = /\([0-9]{3}\) [0-9]{3}\-[0-9]{4}/.test(phone);
        if(!isAcceptable){
            console.log("phone number is not acceptable");

            // const el = form.querySelector("input[name='PhoneNum']");
            // el.setCustomValidity("phone number does not match expected pattern");
            // el.reportValidity();
            // console.log(el);
            return false;
        }
        return true;
    }

    function isValid_message(){
        const message = formData.get('Message');
        console.log("ckecking message:", message);
        if(message.length === 0 || message === "" || message === null){
            console.log("empty message encountered, is not acceptable");

            // const el = form.querySelector("input[name='Message']");
            // el.setCustomValidity("message content is empty");
            // el.reportValidity();
            // console.log(el);
            return false;
        }
        return true;
    }

    function isFormValid() {
        // returns true if all form fields are valid
        formData = new FormData(form) ;
        return isValid_email() && isValid_firstname() && isValid_phone() && isValid_message(); 
    }
    
    form.addEventListener("submit" , function(event) {
        console.log('user is trying to submit') ; 
        if (!isFormValid()) {
            event.preventDefault();
            let client = document.getElementById("ClientValidation");
            client.innerHTML = "";
            if(!isValid_email()){
                client.innerHTML += "email not in valid format: must be utsa email address<br/>";
            }
            if(!isValid_firstname()){
                client.innerHTML += "first name not in valid format: must be 2 chars long, alphabet chars, hyphens and apostrophes only<br/>"
            }
            if(!isValid_phone()){
                client.innerHTML += "phone number not in valid format: (xxx) xxx-xxxx<br/>";
            }
            if(!isValid_message()){
                client.innerHTML += "message not in valid format: cannot be empty<br/>";
            }
        }
    })

    document.getElementById("PhoneNum").disabled = true;
    document.getElementById("EmailBox").disabled = false;
});

function enablePhone(){
    document.getElementById("PhoneNum").disabled = false;
    document.getElementById("EmailBox").disabled = true;
}

function enableEmail(){
    document.getElementById("PhoneNum").disabled = true;
    document.getElementById("EmailBox").disabled = false;
}