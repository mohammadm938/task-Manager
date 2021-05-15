// import Type from "js/index.min,js";
function deleteLoginAndSignUpWay() {
  let divVisible;
  let divHidden;
  let changeDiv;
  divVisible = document.getElementById("profile");
  divHidden = document.querySelectorAll(".profileButtons");
  changeDiv = document.getElementById("left");
  divHidden.forEach((element) => {
    element.style.visibility = "hidden";
  });
  divVisible.style.visibility = "visible";
  changeDiv.style.visibility = "visible";
  changeDiv.firstElementChild.textContent = "خارج شدن";
  changeDiv.firstElementChild.href = "index.php?logout=ok";
  changeDiv.classList.remove('profileButtons')
  changeDiv.removeAttribute('id')
  changeDiv.setAttribute('id','logout')

}
function justShowButtonsForNullUsers() {
  let hrs;
  let hrs2;


  // hrs style
  hrs = document.createElement("hr");
  hrs2 = document.createElement("hr");

  hrs.classList.add("hrs");
  hrs2.classList.add("hrs");
  hrs2.classList.add("hrs2");

  document.body.appendChild(hrs);
  document.body.appendChild(hrs2);
  return true;
}
