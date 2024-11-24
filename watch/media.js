


// document.addEventListener("DOMContentLoaded",function(){
    const targetNode = document.querySelector('.Content-media');
    function media(){
    
        const selectvideo = document.querySelectorAll('.element-to-video');
        const video_of_user = document.querySelectorAll('.video-of-users');
        const displaytitlevideo = document.querySelectorAll('.title-of-video');
        const media = document.querySelectorAll('video');
        const infovideo = document.querySelectorAll('.more-info-video')
        const infoget = document.querySelectorAll('.btn-info');
        const addinfo = document.querySelectorAll('.addmore-info')
        const showcontrolvideo = document.querySelectorAll('.control-video'); 
        const playandpausevideo = document.querySelectorAll('.controlplaypause');
        const fullscreen = document.querySelectorAll('.controlscreen')
        const speaker = document.querySelectorAll('.speaker');
        const seebar = document.querySelectorAll('.timevideo');
        
            for(let e = 0, m = 0, v = 0, c = 0, s = 0, sp = 0, pl = 0, invi = 0, inget = 0, adinf = 0, con = 0, sebar= 0; e<selectvideo.length, m<media.length, v<video_of_user.length, c<showcontrolvideo.length, s<showcontrolvideo.length, sp<speaker.length, pl<playandpausevideo.length, invi<infovideo.length, inget<infoget.length, adinf<addinfo.length, con<fullscreen.length, sebar<seebar.length; e++, m++, v++, c++, s++, sp++, pl++, invi++, inget++, adinf++, con++, sebar++){
                selectvideo[e].addEventListener('mouseover', startvideo)
                selectvideo[e].addEventListener('touchstart',startvideo)
                selectvideo[e].addEventListener('mouseout', stopvideo)
                selectvideo[e].addEventListener('touchend', stopvideo)
                speaker[sp].addEventListener('mouseover',startvideo)
                speaker[sp].addEventListener('touchstart',startvideo)
    
                // infovideo[invi].style.display = 'none';
                media[m].muted = true;
                media[m].play()
                function startvideo(){
                    media[m].play()
                    video_of_user[v].classList.add('video-of-users-scale')
                    // selectvideo[e].style.height = '15em';
                    selectvideo[e].style.opacity = 1;
                    showcontrolvideo[c].classList.add('control-video-showing')
                }
                function stopvideo(){
                    media[m].pause()
                    // selectvideo[e].style.height = '12em';
                    video_of_user[v].classList.remove('video-of-users-scale')
                    selectvideo[e].style.opacity = 1;
                    showcontrolvideo[c].classList.remove('control-video-showing')
                }
                //while a clicked in elemenet to video 
                selectvideo[e].addEventListener('click', ()=>{
                    // for(let i = 0; i<video_of_user.length; i++){
                        // video_of_user[i].classList.remove('video-of-users-change')
                        // showcontrolvideo[i].classList.remove('control-video-showingbig')
                        // infovideo[i].style.display = 'none'
                        // }
                        // console.log('działa')
                        //media[m].play()
                        // speaker[sp].removeEventListener('mouseover',startvideo)
                        speaker[sp].removeEventListener('mouseover',startvideo)
                        
                        selectvideo[e].removeEventListener('mouseover', startvideo)
                        selectvideo[e].removeEventListener('mouseout', stopvideo)
                        // infovideo[invi].style.display = ''
                        showcontrolvideo[c].classList.add('control-video-showingbig')
                        video_of_user[v].classList.add('video-of-users-change')
                        selectvideo[e].style.height = '20em';
                        video_of_user[v].style.transition = 'all 0.25ms;';
                        // media[m].classList.add('video-enlarged');
                        // console.log(selectvideo[e])
    
                    media[m].addEventListener('click',videoplaying)
    
                    })
                    media[m].addEventListener('play',()=>{
                        playandpausevideo[pl].classList.add('paused')
                        // videoplaing()
                    })
                    media[m].addEventListener('pause',()=>{
                        playandpausevideo[pl].classList.remove('paused')
                        // videoplaing()
                    })
                    playandpausevideo[pl].addEventListener('click',function(){
                        videoplaying()
                    })
                    function videoplaying(){
                        media[m].paused ? media[m].play() : media[m].pause()
                    } 
                    videoplaying()
    
    
                function showandhiddenControl(){
                    showcontrolvideo[s].classList.toggle('control-video-showingbig')
                }
    
    
                
                
                // videoplaing()
                function fullscreenvideo (){
                    if (!document.fullscreenElement) {
                        media[m].requestFullscreen().catch(err => {
                          console.error('Nie można wejść w tryb pełnoekranowy:', err);
                        });
                        media[m].controls = false;
                      } else {
                        document.exitFullscreen();
                      }
                }
    
                seebar[sebar].addEventListener("input", function() {
                    let seekValue = seebar[sebar].value;
                    let videoTime = (seekValue / 100) * media[m].duration;
                    media[m].currentTime = videoTime;
                    updatSliderFill()
                    
                  });
    
    
                media[m].addEventListener("timeupdate", function() {
                    let value = (media[m].currentTime / media[m].duration) * 100;
                    seebar[sebar].value = value;
                    updatSliderFill()
                  });  
                  function updatSliderFill(){
                    const value = seebar[sebar].value;
                    const max = seebar[sebar].max;
                    const percentage = (value / max) * 100;
                    seebar[sebar].style.background = `linear-gradient(to right, #007bff ${percentage}%, transparent ${percentage}%)`;
                  }
                  updatSliderFill()
                  
            }
            speaker.forEach(element=>{
                element.addEventListener('click',function(){
                    toggleAllVideoMute()
                })
            })
            function reaction_video(){
                const reaction = document.querySelectorAll(".active-reaction");
                const reactionContent = document.querySelectorAll('.reaction-container')
                let isVisible = true
                // reactionContent.forEach(hide=>{
                //     hide.classList.remove("reaction-container-display")
                // })
                reaction.forEach(react=>{
                    react.addEventListener('click', function(){
                        reactionContent.forEach(reactions=>{
                            if(isVisible){
                                reactions.classList.add("reaction-container-display")
                            }else{
                                reactions.classList.remove("reaction-container-display")
                            }
                        })
                        isVisible = !isVisible
                        
                    })
                })
            }
            reaction_video()
            function toggleAllVideoMute(){
                media.forEach(video=>{
                    if(video.muted){
                        video.muted = false;
                        video.volume = 0.5
                        speaker.forEach(sp=>sp.classList.add('unmuted'))
                    }else{
                        video.muted = true;
                        speaker.forEach(sp=>sp.classList.remove('unmuted'))
                    }
                })
            }
            }
            const config = {childList: true, subtree: true};
            const callback = (MutationsList)=>{
                for(const mutation of MutationsList){
                    if(mutation.type === 'childList'){
                        media();
                    }
                }
            }
            const observer = new MutationObserver(callback);
            observer.observe(targetNode,config)
            media()