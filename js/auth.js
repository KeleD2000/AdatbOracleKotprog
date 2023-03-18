window.onload = function(){
    const signinBtn = document.querySelector(".signinBtn");
    const signupBtn = document.querySelector(".signupBtn");
    const formBx = document.querySelector(".formBx");
    
    signupBtn.onclick = function(){
        formBx.classList.add('active');   
    }
    signinBtn.onclick = function(){
        formBx.classList.remove('active');
    }
}
