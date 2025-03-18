const Logout = document.querySelectorAll('button')[1];
    Logout.addEventListener('click',function(){
        // fetch("SignOut.php",{
        //     method: "POST",
        //     body:JSON.stringify({}),
        //     headers: {'Content-Type':'application/json'}
        // }).then(Response=>{return Response.json()}).then(data=>{
        //     if(data.success){
        //         window.location.href = './';
        //     }
        // })
    })
const Delete = document.querySelectorAll('button')[0];
    Delete.addEventListener('click',function(){
        console.log(Delete)
    })
    document.addEventListener('DOMContentLoaded',()=>{
        const addfiles = document.querySelector('.click-add-file')
        const coverVideoImage = document.querySelectorAll('.video-of-users');
        coverVideoImage.forEach((cover,index)=>{
            cover.addEventListener('click',()=>{
                console.log(`działa`+index)

            })
        })
        let isShowFile = true;
        addfiles.addEventListener('click',()=>{
            const openfile = document.querySelector('.Main-add-file')
            const showaddfile = document.querySelector('.conteiner-add-file')
            if(isShowFile){
                showaddfile.style.visibility = ''
                openfile.style.visibility = ''
            }else{
                openfile.style.visibility = 'hidden'
                showaddfile.style.visibility = 'hidden'
            }
            openfile.addEventListener('click',function(){
                showaddfile.style.visibility = 'hidden'
                openfile.style.visibility = 'hidden'
                isShowFile = true
            })
            isShowFile =!isShowFile
        })
    })
    let mainshow = document.querySelector('.main-setting'); 
    const opensetting = document.querySelector('.opensetting');
    const main_show_setting = document.querySelector('.main-window-setting');
    const closesetting = document.querySelector('.closesetting');
    const rotate_setting = document.querySelectorAll('svg')[1];
    const colorchange = document.querySelectorAll('path')[1];
    const colorchange2 = document.querySelectorAll('path')[2];
    const nav = document.querySelector('nav');
    let isOpenSetting = false;
    mainshow.style.visibility = "hidden";
    main_show_setting.style.visibility = "hidden";
    rotate_setting.style.transform = "rotate(0deg)"
    document.querySelectorAll('svg')[1].addEventListener('click', () => {
        if(isOpenSetting){
            rotate_setting.style.transform = "rotate(0deg)"
            mainshow.style.visibility = "hidden";
            main_show_setting.style.visibility = "hidden"
            colorchange.style.fill = "black"
            colorchange2.style.fill = "black"
            opensetting.style.background = ""
        }else{
            rotate_setting.style.transform = "rotate(60deg)"
            colorchange.style.fill = "white"
            colorchange2.style.fill = "white"
            opensetting.style.background = "#2874a6"
            mainshow.style.visibility = "";
            main_show_setting.style.visibility = ""
        }
            isOpenSetting =!isOpenSetting;
        });
    main_show_setting.addEventListener('click',()=>{
        main_show_setting.style.visibility = "hidden";
        mainshow.style.visibility = "hidden";
        isOpenSetting = false;
    })