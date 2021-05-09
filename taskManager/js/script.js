let successDiv;
let pSuccess;
let message;
successDiv = document.getElementById('success');
pSuccess = document.getElementById('pSuccess');
cheackSuccessDiv(false);
function cheackSuccessDiv(done) {
        if(done === false){
            message = "اطلاعات را تکمیل کنید";
            successDiv.classList.add("successFalse");
            if(successDiv.classList.contains("successTrue")){
                successDiv.classList.remove('successTrue');
            }
        }else if(done === true){
            message = "با موفقیت افزوده شد";
            successDiv.classList.add("successTrue");
            if(successDiv.classList.contains("successFalse")){
                successDiv.classList.remove('successFalse');
            }
        }
        pSuccess.textContent = message;
}