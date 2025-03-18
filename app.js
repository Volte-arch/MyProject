const App = ()=>{
    const [videoLinks, setVideoLinks] = React.useState([]);
    const [dataUser, setDataUser] = React.useState([]);
    const [Selection, setSelection] = React.useState([]);
    const [isMode, setIsMode] = React.useState(false);
    const [confirm,setConfirm] = React.useState([]);
    const [filter,setFilter] = React.useState("All");
      React.useEffect(() => {
          fetch('getInfoOfUser.php')
              .then(response => {
                  if (!response.ok) {
                      throw new Error('Błąd sieciowy');
                  }
                  return response.json();
              })
              .then(data => {
                  if (Array.isArray(data.videos)) {
                    setVideoLinks(data.videos);
                    setDataUser(data.InfoUser);
                }
                  })
                  .catch(error => console.error('Błąd przy pobieraniu danych:', error));
                }, []);

                const handlecheckbox = (video)=>{
                    setSelection((prev)=>
                    prev.includes(video)
                    ? prev.filter((id)=>id !== video)
                    :[...prev, video]
                )
            }
                const ToggleEditMode = ()=>{
                    setIsMode((prev)=>!prev);
                    setSelection([])
                }
                const Cancel = ()=>{
                    setConfirm([]);
                }
                const beforeDeleteAndSharePost = (action)=>{
                    setConfirm(<div className="Confirm" onClick={Cancel}>
                        <button onClick={()=>handleSelectAndDele(action)}>Confirm</button>
                    </div>)

                }
                const handleSelectAndDele = (action) =>{
                    fetch('DeletePostsAndComments.php',{
                        method: "POST",
                        headers: {'Content-Type':'application/json'},
                        body: JSON.stringify({Action: action, posts: Selection})
                    })
                    .then((response=>response.json()))
                    .then((data)=>{
                        if(data){
                            console.log(data)
                            setSelection([])
                        }else{
                            console.log('blad')
                        }
                    })
                    setSelection([])
                    setConfirm([])
                }
                const [isAllClick, setIsAllClick] = React.useState();
                const Navigaction =()=>{
                    const handleClick = (filterValue) => {
                            setIsAllClick(true)
                            setFilter(filterValue);
                    
                            if (filterValue === 'All') {
                                setIsAllClick(false);
                            } else {
                                setIsAllClick(true); 
                            }
                        };
                    
                        return (
                            <>
                            <div className="show-option">
                                {isAllClick && (
                                    <span onClick={() => handleClick('All')}>All</span>
                                )} 
                                <span onClick={() => handleClick('Private')}>Private</span>
                                <span onClick={() => handleClick('Public')}>Public</span>
                                <span onClick={() => handleClick('Shared')}>Shared</span>
                            </div>
                            </>
                        );
                }
                return (
                    <>
                    <Navigaction/>
                        {confirm}
                    <div className="Edit-mode">
                    <span>Here you see all your films and images </span>
                    <div className="Edit-file">
                        <button onClick={ToggleEditMode}>{isMode ?"Exit edit mode":"Turn on edit mode"}</button>
                        {Selection.length>0 &&(
                            <div className="DeleAndPublic">
                                <button className="Delete" onClick={()=>{beforeDeleteAndSharePost('delete')}}>Delete</button>
                                <button onClick={()=>{beforeDeleteAndSharePost('public')}}>Public</button>
                                <button onClick={()=>{beforeDeleteAndSharePost('Share')}}>Share</button>
                            </div>
                        )}
                    </div>
                    </div>
                    <div className="Content-media">
                    <div className="UnderContent-media">
                <div className="cover-video-image" style={{visibility: "hidden"}}></div>
                    <AddFile User={dataUser}/>
                    {videoLinks.length === 0 ? (
                <p>Brak dostępnych mediów.</p>
            ) : (
                videoLinks.map((video) => {
                    if (video.Type === "video/mp4") {
                        return (
                            <div key={video.Uniqid} className={`video-of-users ${filter !== "All" && video.access !== filter ? "video-of-users-hidden" : ""}`}>
                                {isMode &&(<div className="select">
                                        <label>
                                            <input type="checkbox" checked={Selection.includes(video.Uniqid)} onChange={()=>handlecheckbox(video.Uniqid)}/>
                                            <span class="checkbox"></span>
                                        </label>
                                    </div>)}
                                <div className="video-of-elements">
                                    <div className="toelements">
                                        <div className="speaker">
                                            <i className="fa-solid fa-volume-xmark muted" style={{ color: "#ffffff" }}></i>
                                            <i className="fa-solid fa-volume-low"></i>
                                        </div>
                                        <div className="time">
                                            <input type="range" className="timevideo" min="0" max="100" value="0"/>
                                            </div>
                                        <div className="element-to-video">
                                            <div className="control-video">
                                                <div className="control-down">
                                                    <div className="reaction-people-of-video">
                                                        <div className="active-reaction">
                                                            <svg xmlns="https://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512">
                                                                <path fill="#ffffff" d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16l-97.5 0c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8l97.5 0c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32L0 448c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-64 0z"/>
                                                            </svg>
                                                        </div>
                                                        <div className="reaction-container">
                                                            <span className="reaction" data-reaction="like">👍</span>
                                                            <span className="reaction" data-reaction="love">❤️</span>
                                                            <span className="reaction" data-reaction="laugh">😂</span>
                                                            <span className="reaction" data-reaction="wow">😮</span>
                                                            <span className="reaction" data-reaction="sad">😢</span>
                                                            <span className="reaction" data-reaction="angry">😡</span>
                                                        </div>
                                                    </div>
                                                    <div className="controlplaypause">
                                                        <i className="fa-solid fa-play paused"></i>
                                                        <i className="fa-solid fa-pause"></i>
                                                    </div>
                                                    <div className="controlscreen">
                                                        <i className="fa-solid fa-up-right-and-down-left-from-center full" style={{ color: "#ffffff" }}></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <video loading="lazy" control type="video/mp4" src={"./source/"+video.FileAttach}></video>
                                        </div>
                                    </div>
                                    <div className="message">
                                        <img src="./assets/comment_32dp_E8EAED_FILL0_wght400_GRAD0_opsz40.svg"></img>
                                        <img src="./assets/share_32dp_000000_FILL1_wght700_GRAD200_opsz40.svg"></img>
                                        </div>
                                    <div className="messages-of-users"></div>
                                </div>
                                </div>
                        );
                    } else if (video.Type === "image/jpeg"||"image/png") {
                        return (
                            <div key={video.Uniqid} className="image-of-users">
                                {isMode &&(<div className="select">
                                        <label>
                                            <input type="checkbox" checked={Selection.includes(video.Uniqid)} onChange={()=>handlecheckbox(video.Uniqid)}/>
                                            <span class="checkbox"></span>
                                        </label>
                                    </div>)}
                                <img src={"./source/"+video.FileAttach}></img>
                            </div>
                        );
                    }
                    return null;
                })
            )}

                    </div>
                </div>
  </>
      );
  }

  const Settings = ()=>{
    return(
        <>
        <Setting_prof/>
        </>
    )
  }
  const NavigactionTop = ()=>{
    return (
    <>
    <img src="./assets/house_28dp_000000_FILL0_wght300_GRAD0_opsz24.svg"></img>
    </>
    )
  }
  ReactDOM.render(<NavigactionTop />, document.querySelector('.private-shared'));
  ReactDOM.render(<App />, document.querySelector('.Main-content-media'));
  ReactDOM.render(<Settings />, document.querySelector('.setting'));