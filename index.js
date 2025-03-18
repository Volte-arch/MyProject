    const sign_in = document.querySelector('.sign-in').addEventListener('click',()=>{
        
    fetch('SignIn.php').then(response=>response.text()).then(data=>{
        document.querySelector('.PopupForm').innerHTML = data
        document.querySelector('.Lg').addEventListener('submit',(e)=>{
            e.preventDefault();
            const FormDataL = new FormData(e.currentTarget);
            const dataL = Object.fromEntries(FormDataL);
            const sendL = JSON.stringify(dataL);
            fetch('SignIn.php',{
                method: 'POST',
                body: sendL,
                headers:{'Content-Type':'application/json'}
            }).then(response=>{return response.json();}).then(data=>{
                if(data.status == 'authorization'){
                    window.location.href = 'me';
                }else if(data.Error == 'errorEmailorpass'){
                    document.querySelectorAll('input[type="text"]')[0].style.border = "1px solid red"
                    document.querySelectorAll('input[type="password"]')[0].style.border = "1px solid red"
                }else if(data.ErrorAccount == 'notAAccount'){
                    document.querySelectorAll('input[type="text"]')[0].style.border = "1px solid red"
                    document.querySelectorAll('input[type="password"]')[0].style.border = "1px solid red"
                }
            })
        })
}) 
        
        showForm()
    })
    const sign_up = document.querySelector('.sign-up').addEventListener('click',()=>{
    fetch('SignUp.php').then(response=>response.text()).then(data=>{
        document.querySelector('.PopupForm').innerHTML = data;

        // document.querySelector('input[type="text"]:nth-of-type(1)').addEventListener('input',function(){
        //     fetch('SearchEmail.php',{
        //         method: 'POST',
        //         body: new URLSearchParams('Email',this.value),
        //         headers:{'Conent-Type':'application/json'}
        //     }).then(response=>{
        //         return response.json();
        //     }).then(data=>{
                
        //     })
        // })
        document.querySelector('.Re').addEventListener('submit',(e)=>{
            e.preventDefault();
            const FormDataR = new FormData(e.currentTarget);
            
            const dataR = Object.fromEntries(FormDataR);
            const sendR = JSON.stringify(dataR);
            fetch('SignUp.php',{          
                method: 'POST',
                body: sendR,
                headers:{'Content-Type':'application/json'}
            }).then(response=>{return response.json();}).then(data=>{
                // console.log(data)
                const input = document.querySelectorAll('input');
                console.log(input)
                if(data.CheckEmail === "problem"){
                    document.querySelectorAll('input[type="text"]')[0].style.border = "1px solid red"
                }else{
                    document.querySelectorAll('input[type="text"]')[0].style.border = ""
                }
                if(data.CheckPassword === "problem"){
                    document.querySelectorAll('input[type="password"]')[0].style.border = "1px solid red"
                    document.querySelectorAll('input[type="password"]')[1].style.border = "1px solid red"
                }else{
                    document.querySelectorAll('input[type="password"]')[0].style.border = ""
                    document.querySelectorAll('input[type="password"]')[1].style.border = ""
                }
                if(data.CheckNickname === "problem"){
                    document.querySelectorAll('input[type="text"]')[2].style.border = "1px solid red"
                }else{
                    document.querySelectorAll('input[type="text"]')[2].style.border = ""
                }
                if(data.AcceptTerm === "RqAccept"){
                    document.querySelector('.checkboxs').style.border = "1px dashed red";
                }else{
                    document.querySelector('.checkboxs').style.border = "1px dashed black";
                }
                if(data.isStatus == true){
                    window.location.href = 'me';
                }else{
                    console.log("Oops! something don't it try later")
                }
            })
        })
    }) 
        
        showForm()
    })

    const PopupClose = document.querySelector('.Popup').addEventListener('click',CloseShowingForm)
    document.querySelector('.PopupForm').style.display = 'none';
    function showForm(){
        document.querySelector('.conteiner').style.display = 'none'
        document.querySelector('.PopupFormMain').classList.toggle('PopupFormMainActivity');
        document.querySelector('.Popup').classList.toggle('PopupFormCloseActivity');
        document.querySelector('.PopupForm').classList.toggle('PopupFormActivity');
        document.querySelector('.PopupForm').style.display = '';
    }
    function CloseShowingForm(){
        document.querySelector('.conteiner').style.display = ''
        document.querySelector('.PopupFormMain').classList.toggle('PopupFormMainActivity');
        document.querySelector('.Popup').classList.toggle('PopupFormCloseActivity');
        document.querySelector('.PopupForm').classList.toggle('PopupFormActivity');
        document.querySelector('.PopupForm').style.display = 'none';
    }
