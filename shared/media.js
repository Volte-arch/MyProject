document.addEventListener("DOMContentLoaded",function(){
    // const targetNode = document.querySelector('.root');
    function media(){
        const selectvideo = document.querySelector('.element-to-video');
        const video_of_user = document.querySelector('.video-of-users');
        const media = document.querySelector('video');
        const showcontrolvideo = document.querySelector('.control-video');
        const playandpausevideo = document.querySelector('.controlplaypause');
        const fullscreen = document.querySelector('.controlscreen');
        const speaker = document.querySelector('.speaker');
        const seebar = document.querySelector('.timevideo');
        media.play()
    
            selectvideo.addEventListener('mouseover', startvideo);
            selectvideo.addEventListener('mouseout', stopvideo);
            speaker.addEventListener('mouseover',startvideo)
            speaker.addEventListener('mouseout',startvideo)
            fullscreen.addEventListener('click',FullScreen)
            playandpausevideo.addEventListener('click', toggleVideo);
            media.addEventListener('click',toggleVideo)
            media.muted = true;

            function startvideo() {
                selectvideo.style.opacity = 1;
                showcontrolvideo.classList.add('control-video-showing');
            }
        
            function stopvideo() {
                selectvideo.style.opacity = 1;
                showcontrolvideo.classList.remove('control-video-showing');
            }
            media.addEventListener('play', () => playandpausevideo.classList.add('paused'));
            media.addEventListener('pause', () => playandpausevideo.classList.remove('paused'));
            function toggleVideo() {
                media.paused ? media.play() : media.pause();
            }
            
            seebar.addEventListener('input', handleSeekbarInput);

            function handleSeekbarInput() {

                const videoTime = (seebar.value / 100) * media.duration;
                media.currentTime = videoTime;
                updateSliderFill(seebar, media);
            }
     
            media.addEventListener('timeupdate', () => {
                const value = (media.currentTime / media.duration) * 100;
                seebar.value = value;
                updateSliderFill(seebar, media);
            });

            function updateSliderFill(seebar) {
                
                const value = seebar.value;
                const max = seebar.max;
                const percentage = (value / max) * 100;
                seebar.style.background = `linear-gradient(to right, #007bff ${percentage}%, transparent ${percentage}%)`;
            }

        function FullScreen() {
            if (!document.fullscreenElement) {
              video_of_user.requestFullscreen();
              selectvideo.classList.add('element-to-video-fullscreen');
            }else{
                document.exitFullscreen()
                selectvideo.classList.remove('element-to-video-fullscreen');
            }
          }          
          function exitFullscreen() {
            if (!document.fullscreenElement) {
              selectvideo.classList.remove('element-to-video-fullscreen'); 
            }
          }
          document.addEventListener('fullscreenchange', exitFullscreen);
        //   document.addEventListener('webkitfullscreenchange', exitFullscreen); // Obsługa Safari
        //   document.addEventListener('msfullscreenchange', exitFullscreen);
        
        speaker.addEventListener('click',function(){
                toggleAllVideoMute()
            })
        function toggleAllVideoMute(){
                if(media.muted){
                    media.muted = false;
                    media.volume = 1
                    speaker.classList.add('unmuted')
                }else{
                    media.muted = true;
                    speaker.classList.remove('unmuted')
                }
        }
        
        function reaction_video() {
            const reaction = document.querySelector(".active-reaction");
            const reactionContent = document.querySelector('.reaction-container');
            let isVisible = true;
        
            reaction.addEventListener('click', () => {
                    reactionContent.classList.toggle("reaction-container-display", isVisible);
                    isVisible = !isVisible;
                });
        }
        reaction_video();
    }
setTimeout(function(){
    media()
},1000)
})
            // const config = {childList: true, subtree: true};
            // const callback = (MutationsList)=>{
            //     for(const mutation of MutationsList){
            //         if(mutation.type === 'childList'){
            //             media();
            //         }
            //     }
            // }
            // const observer = new MutationObserver(callback);
            // observer.observe(targetNode,config)