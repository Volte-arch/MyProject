// document.addEventListener("DOMContentLoaded",function(event){
// document.addEventListener('click',(event)=>{
    // if(event.target.dataset.processed === true){
        const targetNode = document.querySelector('.Main-content-media');
        // console.log('działa')
        // media()
// })
   function media(){
    
        const selectvideo = document.querySelectorAll('.element-to-video:not([data-processed])');
        const video_of_user = document.querySelectorAll('.video-of-users:not([data-processed])');
        const media = document.querySelectorAll('video:not([data-processed])');
        const message = document.querySelectorAll('.message:not([data-processed])');
        const coverVideoImage = document.querySelector('.cover-video-image');
        const showcontrolvideo = document.querySelectorAll('.control-video:not([data-processed])');
        const playandpausevideo = document.querySelectorAll('.controlplaypause:not([data-processed])');
        const fullscreen = document.querySelectorAll('.controlscreen:not([data-processed])');
        const speaker = document.querySelectorAll('.speaker:not([data-processed])');
        const seebar = document.querySelectorAll('.timevideo:not([data-processed])');
        
        media.forEach((video, i) => {
            const select = selectvideo[i];
            const user = video_of_user[i];
            const control = showcontrolvideo[i];
            const speakerButton = speaker[i];
            const seekbar = seebar[i];
            const playPause = playandpausevideo[i];
            const Fullscreen = fullscreen[i];
            const msg = message[i];
         
            select.dataset.processed = true;
            user.dataset.processed = true;
            video.dataset.processed = true;

            select.addEventListener('mouseover', startvideo);
            select.addEventListener('mouseout', stopvideo);
            select.addEventListener('click', showmedia);
            speakerButton.addEventListener('mouseover',startvideo)
            speakerButton.addEventListener('mouseout',startvideo)

            video.muted = true;

            function startvideo() {

                video.play();
                control.classList.remove('control-video-showingbig');
                user.classList.add('video-of-users-scale');
                control.classList.add('control-video-showing');
                select.style.opacity = 1;
            }
        
            function stopvideo() {

                video.pause();
                user.classList.remove('video-of-users-scale');
                select.style.opacity = 1;
                control.classList.remove('control-video-showing');
            }

            function showmedia() {
                
                control.classList.add('control-video-showingbig');
                user.classList.add('video-of-users-change');
                select.style.height = '30em';
                msg.style.width = '40px';
                coverVideoImage.style.visibility = '';
                user.style.transition = 'all 250ms';
                select.removeEventListener('mouseover', startvideo);
                select.removeEventListener('mouseout', stopvideo);
                select.removeEventListener('click', showmedia);
                speakerButton.addEventListener('mouseover',startvideo)
                speakerButton.addEventListener('mouseout',startvideo)
                coverVideoImage.addEventListener('click', coverMedia);
                video.addEventListener('click', toggleVideo);
                Fullscreen.addEventListener('click',FullScreen)
                select.addEventListener('mouseover',()=>{
                    control.classList.add('control-video-showingbig');
                })
                select.addEventListener('mouseout',()=>{
                    control.classList.remove('control-video-showingbig')
                })
            }
        
            function coverMedia() {

                control.classList.remove('control-video-showingbig', 'control-video-showing');
                user.classList.remove('video-of-users-change', 'video-of-users-scale');
                select.style.height = '';
                msg.style.width = '';
                user.style.transition = 'all 250ms';
                coverVideoImage.style.visibility = 'hidden';
                select.addEventListener('mouseover', startvideo);
                select.addEventListener('mouseout', stopvideo);
                select.addEventListener('click', showmedia);
                video.removeEventListener('click', toggleVideo);
                video.pause();
            }
            video.addEventListener('play', () => playPause.classList.add('paused'));
            video.addEventListener('pause', () => playPause.classList.remove('paused'));

            playPause.addEventListener('click', toggleVideo);

            function toggleVideo() {
                video.paused ? video.play() : video.pause();
            }
            
            let isSeeking = false;
            seekbar.addEventListener('input', handleSeekbarInput);

            function handleSeekbarInput() {
                isSeeking = true;
                const videoTime = (seekbar.value / 100) * video.duration;
                video.currentTime = videoTime;
                updateSliderFill(seekbar, video);
                video.pause()
            }

            seekbar.addEventListener('change', () => {
                isSeeking = false; 
                video.play()
            });
            
            video.addEventListener('timeupdate', () => {
                if (isSeeking){
                    return; 
                }else{
                    const value = (video.currentTime / video.duration) * 100;
                    seekbar.value = value;
                    updateSliderFill(seekbar, video);
                }
            });
            
            function updateSliderFill(seekbar) {
                const value = seekbar.value;
                const max = seekbar.max;
                const percentage = (value / max) * 100;
                seekbar.style.background = `linear-gradient(to right, #007bff ${percentage}%, transparent ${percentage}%)`;
            }

            function FullScreen(){
                if(!document.fullscreenElement){
                    user.requestFullscreen()
                }else{
                    document.exitFullscreen()
                }
            }
        
        });
        
        speaker.forEach(element=>{
            element.addEventListener('click',function(){
                toggleAllVideoMute()
            })
        })
        function toggleAllVideoMute(){
            media.forEach(video=>{
                if(video.muted){
                    video.muted = false;
                    video.volume = 0.05
                    speaker.forEach(sp=>sp.classList.add('unmuted'))
                }else{
                    video.muted = true;
                    speaker.forEach(sp=>sp.classList.remove('unmuted'))
                }
            })
        }
        
        function reaction_video() {
            const reaction = document.querySelectorAll(".active-reaction");
            const reactionContent = document.querySelectorAll('.reaction-container');
            let isVisible = true;
        
            reaction.forEach((react) => {
                react.addEventListener('click', () => {
                    reactionContent.forEach((reactions) => {
                        reactions.classList.toggle("reaction-container-display", isVisible);
                    });
                    isVisible = !isVisible;
                });
            });
        }
        reaction_video();
    }
    // media()
    // }
    // })
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