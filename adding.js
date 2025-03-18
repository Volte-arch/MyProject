const AddFile = ({User}) => {
    const InputFile = React.useRef(null);
    const selectaccess = React.useRef(null)
    const [image, setfile] = React.useState([]);
    const [filesToUpload, setFilesToUpload] = React.useState([]);
    const [errors, setErrors] = React.useState([])
    const [progress, setProgress] = React.useState(0)
    const [showProgress, setShowProgress] = React.useState(false)

    const handleFile = (e) => {
        const files = Array.from(e.target.files);
        const AllowedMimeTypes = ['video/mp4', 'image/jpeg', 'image/png'];
        const AllowedSizeMB = User === "Admin" ? Number.MAX_SAFE_INTEGER : 150;
        const newPreviews = [];
        const errors = [];
        const validFiles = [];
    
        if (files.length === 0) {
            errors.push({ error: 'Brak pliku wideo bądź zdjęcia' });
        } else {
            files.forEach((file) => {
                const fileSizeMB = file.size / (1024 * 1024);
                const fileType = file.type;
    
                if (!AllowedMimeTypes.includes(fileType)) {
                    errors.push({ error: 'Nieobsługiwany format pliku' });
                } else if (fileSizeMB > AllowedSizeMB) {
                    errors.push({ error: `Plik jest za duży (max: ${AllowedSizeMB}MB)` });
                } else {
                    validFiles.push(file);
                    const reader = new FileReader();
                    reader.onload = () => {
                        newPreviews.push({
                            name: file.name,
                            type: file.type.startsWith('video') ? 'video' : 'image',
                            src: reader.result,
                        });
    
                        if (newPreviews.length + errors.length === files.length) {
                            setfile([...errors, ...newPreviews]);
                            setFilesToUpload(validFiles);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    
        if (errors.length > 0) {
            setfile(errors);
        }
        setErrors(errors)

    
        e.target.value = "";
    };
    
    const handleclick = async (e) => {
    e.preventDefault();
        setErrors([])
        setProgress(0)
        setShowProgress(true)
    const formData = new FormData();
    if (filesToUpload.length === 0) {
        setErrors((prevErrors)=>[...prevErrors, {error: "Please select a file"}])
        return;
    } else {
        filesToUpload.forEach((file) => {
            if (!file.error) {
                formData.append('files[]', file);
            } else {
                console.log('Invalid file', file);
            }
        });
        const title = document.querySelectorAll('.Title input[name="title"]')[0];
        formData.append('title',title.value);
        formData.append('visibility',selectaccess.current.value);

        try {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./upload/upload.php",true);
            xhr.upload.addEventListener("progress",(event)=>{
                if(event.lengthComputable){
                    const procent = Math.round((event.loaded/event.total)*100)
                    setProgress(procent)
                }
            })
            xhr.onload = () => {
                if (xhr.status === 200) {
                    try {
                        const result = JSON.parse(xhr.responseText);
                        if (result.status === 'success') {
                            setProgress(100);
                        } else {
                            console.log('Error in response:', result.message);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                    }
                } else {
                    console.error('Error in upload:', xhr.statusText);
                }
            };
    
            xhr.onerror = () => {
                console.error('Request failed');
            };
            xhr.send(formData);
                
        } catch (error) {
            console.error('Error uploading file:', error);
        }
    }
}
    const remove = (id) => {
        setfile((prevItems) => prevItems.filter((item) => item.src !== id.src));
        setFilesToUpload((prevFiles)=>prevFiles.filter((file)=>file.name !==id.name))
    };
        return (
        <>
            <div className="Main-add-file" style={{ visibility: 'hidden' }}></div>
            <div className="conteiner-add-file" style={{ visibility: 'hidden' }}>
                <div className="add-file">
                    <form method="post" encType="multipart/form-data" >
                        <select name="visibility" ref={selectaccess}>
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
                        <label htmlFor="video-img">
                            <img src="./assets/add_photo_alternate_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Add file" />
                            {errors.map((error, index) => (
                                <div key={index}>
                                {error.error && <p>{error.error}</p>}
                                  </div>
                                  ))}
                                  {showProgress && <p>Postęp wysyłania: {progress}%</p>}
                        </label>
                        <input type="file" onChange={handleFile} ref={InputFile} className="video-img" id="video-img" name="video-imgfile" accept="video/*, image/*" multiple/>
                        <button type="submit" onClick={handleclick}>
                            <img src="./assets/send (1).png" alt="Send" />

                        </button>
                    </form>
                </div>
                {image.map((file,index)=>(
                    <div key={index} className="added-files">
                        <div className="Cancel-file">
                        <img onClick={()=>remove(file)} src={"../assets/cancel_32dp_EFEFEF_FILL1_wght700_GRAD200_opsz40.svg"}></img>
                        </div>
                        <div className="show-file">
                    {file.type === 'image'? (<img src={file.src}></img>) : 
                    (<video src={file.src} autoPlay controls></video>)}

                        </div>
                        <div className="Title">
                            <form method="post">
                                <input type="text" name="title" placeholder="Type title"/>
                            </form>
                        </div>
                    </div>
                ))}
            </div>
        </>
    );
};
window.AddFile = AddFile;