const AddFile = () => {
    const InputFile = React.useRef(null);
    const [image, setfile] = React.useState([]);
    const [filesToUpload, setFilesToUpload] = React.useState([]);

    const handleFile = (e) => {
        const files = Array.from(e.target.files);
        const AllowedMimeTypes = ['video/mp4', 'image/jpeg', 'image/png'];
        const AllowedSizeMB = 150;
        const newPreviews = [];
        const errors = [];
        const validFiles = [];
        
        if (files.length < 0) {
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

        if (errors.length > 0 && newPreviews.length === 0) {
            setfile(errors);
        }

        e.target.files.value = "";
    };
    

    
    const handleclick = async (e) => {
    e.preventDefault();

    const formData = new FormData();

    if (filesToUpload.length === 0) {
        console.log('Please select a file');
        return;
    } else {
        filesToUpload.forEach((file) => {
            if (!file.error) {
                formData.append('files[]', file);
            } else {
                console.log('Invalid file', file);
            }
        });

        try {
            const response = await fetch('./upload/upload.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Error while sending file');
            }

            const result = await response.json();

            if (result.status === 'success'){
                console.log(result.message);
            } else {
                console.log('Error in response:', result.message);
            }
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
                        <label htmlFor="video-img">
                            <img src="./assets/add_photo_alternate_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="Add file" />
                            {image.map((file, index) => file.error ? <p key={index}>{file.error}</p> : null)}
                        </label>
                        <input type="file" onChange={handleFile} ref={InputFile} className="video-img" id="video-img" name="video-imgfile" accept="video/*, image/*" multiple/>
                        <button type="submit" onClick={handleclick}>
                            <img src="./assets/send_32dp_E8EAED_FILL0_wght400_GRAD0_opsz40.svg" alt="Send" />
                        </button>
                    </form>
                </div>
                {image.map((file,index)=>(
                    <div key={index} className="added-files">
                        <button onClick={()=>remove(file)}><img src={"../assets/cancel_32dp_000000_FILL1_wght700_GRAD200_opsz40.svg"}></img></button>
                    {file.type === 'image'? (<img style={{width:'9em', height:'185px', borderRadius:'10px'}} src={file.src}></img>) : 
                    (<video src={file.src} autoPlay controls></video>)}
                        <div className="Title">
                            <form method="post">
                                <input type="text" placeholder="Type title"/>
                            </form>
                        </div>
                    </div>
                ))}
            </div>
        </>
    );
};
window.AddFile = AddFile;