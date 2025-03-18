<?php
session_start();
if((isset($_SESSION['User_id'])) && (isset($_SESSION['status']) && $_SESSION['status'] == 'authorization')){
}else{
    header('location: ./');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./watch/css/index.css">
    <link rel="stylesheet" href="me.css">
    <script crossorigin src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.26.1/babel.min.js" integrity="sha512-PmbASBM+8fHu7Zc1RPIdunspostLnhBAjZkr2hZ7HNjfK2pITiGo/IvtZyEVSgB7XzFoTkyA9JTUDmwo8B+0YA=="></script>
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="./watch/media.js" defer></script>
    <script type="text/babel" src="adding.js"></script>
    <script type="text/babel" src="nav.js"></script>
    <script type="text/babel" src="settings-prof.js"></script>
    <script type="text/babel" src="app.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me</title>
</head>
<body>

    <nav>
        <div class="Welcome"><h1>Hi,</h1><h3><?php echo "&nbsp;".$_SESSION['Username']?></h3></div>
        <div class="private-shared"></div>
        <div class="clickFileAndOpenSetting">
            <div class="click-add-file">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h320v80H200v560h560v-320h80v320q0 33-23.5 56.5T760-120H200Zm40-160h480L570-480 450-320l-90-120-120 160Zm440-320v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
            </div>
            <div class="opensetting">
                <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M409.6 943.542857h-14.628571l-190.171429-109.714286c-7.314286 0-7.314286-7.314286-7.314286-7.314285l-14.628571-21.942857c-7.314286-7.314286-7.314286-21.942857 0-29.257143 7.314286-14.628571 14.628571-36.571429 14.628571-51.2 0-51.2-43.885714-95.085714-95.085714-95.085715-14.628571 0-29.257143-14.628571-29.257143-29.257142v-219.428572c0-7.314286 0-7.314286 7.314286-14.628571s14.628571-14.628571 21.942857-14.628572c51.2 0 95.085714-43.885714 95.085714-95.085714 0-14.628571-7.314286-29.257143-14.628571-43.885714-7.314286-7.314286-7.314286-21.942857 0-29.257143l7.314286-7.314286c0-7.314286 7.314286-7.314286 7.314285-7.314286L387.657143 58.514286c7.314286-7.314286 14.628571-7.314286 21.942857 0 14.628571-7.314286 21.942857 7.314286 21.942857 14.628571 7.314286 43.885714 51.2 80.457143 95.085714 80.457143 43.885714 0 87.771429-36.571429 95.085715-80.457143 0-7.314286 7.314286-14.628571 14.628571-21.942857 7.314286-7.314286 14.628571 0 21.942857 0l175.542857 102.4c7.314286 7.314286 14.628571 7.314286 14.628572 21.942857 0 7.314286 0 14.628571-7.314286 21.942857-14.628571 21.942857-21.942857 36.571429-21.942857 58.514286 0 51.2 43.885714 95.085714 95.085714 95.085714h14.628572c14.628571 0 21.942857 0 29.257143 14.628572h14.628571c0 7.314286 7.314286 7.314286 7.314286 14.628571v226.742857c0 7.314286-7.314286 14.628571-7.314286 21.942857-7.314286 7.314286-14.628571 7.314286-21.942857 7.314286H928.914286c-51.2 0-95.085714 43.885714-95.085715 95.085714 0 29.257143 14.628571 51.2 21.942858 65.828572 7.314286 7.314286 7.314286 14.628571 7.314285 21.942857s-7.314286 14.628571-14.628571 21.942857L658.285714 936.228571c-7.314286 7.314286-14.628571 7.314286-21.942857 0-7.314286 0-14.628571-7.314286-14.628571-14.628571-14.628571-43.885714-51.2-65.828571-87.771429-65.828571-43.885714 0-80.457143 29.257143-87.771428 65.828571 0 7.314286-7.314286 14.628571-14.628572 14.628571-14.628571 7.314286-21.942857 7.314286-21.942857 7.314286z m-168.228571-160.914286L394.971429 877.714286c29.257143-43.885714 73.142857-73.142857 131.657142-73.142857 51.2 0 102.4 29.257143 131.657143 73.142857l131.657143-80.457143c-14.628571-21.942857-21.942857-51.2-21.942857-73.142857 0-80.457143 65.828571-153.6 153.6-153.6V402.285714c-80.457143 0-153.6-65.828571-153.6-153.6 0-21.942857 7.314286-43.885714 14.628571-65.828571L658.285714 117.028571c-21.942857 51.2-73.142857 87.771429-131.657143 87.771429s-109.714286-36.571429-138.971428-87.771429l-146.285714 87.771429c7.314286 14.628571 14.628571 29.257143 14.628571 51.2 0 73.142857-51.2 131.657143-124.342857 146.285714v175.542857c73.142857 14.628571 124.342857 73.142857 124.342857 146.285715 0 21.942857-7.314286 43.885714-14.628571 58.514285z" fill="#000000"></path><path d="M526.628571 687.542857c-102.4 0-190.171429-87.771429-190.171428-190.171428 0-102.4 87.771429-190.171429 190.171428-190.171429 102.4 0 190.171429 87.771429 190.171429 190.171429 0 102.4-87.771429 190.171429-190.171429 190.171428z m0-329.142857c-73.142857 0-131.657143 58.514286-131.657142 131.657143s58.514286 131.657143 131.657142 131.657143S658.285714 570.514286 658.285714 497.371429s-58.514286-138.971429-131.657143-138.971429z" fill="#000000"></path></g></svg>
            </div>
        </div>
    <div class="main-window-setting"></div>
    <div class="main-setting">
        <div class="image-profil"><h3>image profile inaccessible</h3></div>
        <div class="setting"></div>
        <div class="buttons">
            <button name="Delete">Delete account</button>
            <button name="Logout">Logout</button>
        </div>
    </div>
    </nav>
    <div class="clickelement"></div>

    <div class="Main-content-media">
        <div class="video-of-users">
                    <div class="video-of-elements">
                    <div class="toelements">
                        <div class="speaker">
                        <i class="fa-solid fa-volume-xmark muted" style="color: #ffffff;"></i>
                        <i class="fa-solid fa-volume-low"></i>
                        <!-- <i class="fa-solid fa-volume-high"></i> -->
                            <!-- <i class="fa-solid fa-volume-high"></i> -->
                        </div>
                        <div class="element-to-video">
                            <div class="control-video">
        
                            <div class="time">
                                <input type="range" class="timevideo" min="0" max="100" value="0">
                            </div>
                            <div class="control-down">
                                <div class="reaction-people-of-video">
                                    <div class="active-reaction">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16l-97.5 0c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8l97.5 0c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32L0 448c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-64 0z"/></svg>
                                    </div>
                                    <div class="reaction-container">
                                        <span class="reaction" data-reaction="like">👍</span>
                                        <span class="reaction" data-reaction="love">❤️</span>
                                        <span class="reaction" data-reaction="laugh">😂</span>
                                        <span class="reaction" data-reaction="wow">😮</span>
                                        <span class="reaction" data-reaction="sad">😢</span>
                                        <span class="reaction" data-reaction="angry">😡</span>
                                </div>
                                    <!-- <img src="./assces/add_reaction_24dp_EFEFEF_FILL0_wght400_GRAD0_opsz24.svg"> -->
                                </div>
                                <div class="controlplaypause">
                                    <i class="fa-solid fa-play paused"></i>
                                    <i class="fa-solid fa-pause"></i>
                                </div>
                                <div class="controlscreen">
                                    <i class="fa-solid fa-up-right-and-down-left-from-center full" style="color: #ffffff;"></i>
                                </div>
                            </div>
                            
                            
                        </div>
                            <video loading="lazy" type="video/mp4" src=""></video>
                        </div>
                    </div>
                        <div class="more-info-video">
                            <!-- <div class="btn-info">
                                <i class="fa-solid fa-chevron-down fa-info1"></i>
                            </div> -->
                            <div class="addmore-info">
                                <div class="info">
                                    <h3>Name: unknown</h3>
                                    <h3>Added: unknown</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- <div class="annotations-users">
                            <h4>Comments</h4>
                            <h4>Comments of live</h4>
                        </div> -->
                </div>
         
    </div>
    </div>
</body>
</html>

<script type="text/javascript">
    const Logout = document.querySelectorAll('button')[1];
    Logout.addEventListener('click',function(){
        fetch("SignOut.php",{
            method: "POST",
            body:JSON.stringify({}),
            headers: {'Content-Type':'application/json'}
        }).then(Response=>{return Response.json()}).then(data=>{
            if(data.success){
                window.location.href = './';
            }
        })
    })
    const Delete = document.querySelectorAll('button')[0];
    Delete.addEventListener('click',function(){
        
    })
    document.addEventListener('DOMContentLoaded',function(){
        const addfiles = document.querySelector('.click-add-file')
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
        
    </script>
