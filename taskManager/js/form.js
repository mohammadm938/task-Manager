// function changeBorder(id) {
//   let input = document.getElementById(id);
//   input.style.borderColor = "#726ee8";
// }
function wrongInfo() {
  alert("اطلاعات نادرست میباشد");
}
function validatePhoneNumber(PhoneId) {
  let number = document.getElementById(PhoneId).value;
  var phoneno = /^(?!98)(9[0-9][0-9])([0-9]{3})([0-9]{4})/;
  // console.log(phoneno.test(number));
  // console.log(phoneno);
  if (!phoneno.test(number)) {
    let btn = document.getElementById('btn');
    btn.value = "لطفا شماره موبایل معتبر وارد کنید";
    btn.disabled = 'True';
    btn.style.width='248px';
  }
}
