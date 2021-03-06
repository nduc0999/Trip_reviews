    // register desired plugins...
FilePond.registerPlugin(
    // validates the size of the file...
    FilePondPluginFileValidateSize,
    // validates the file type...
    FilePondPluginFileValidateType,

    // calculates & dds cropping info based on the input image dimensions and the set crop ratio...
    FilePondPluginImageCrop,
    // preview the image file type...
    FilePondPluginImagePreview,
    // filter the image file
    FilePondPluginImageFilter,
    // corrects mobile image orientation...
    FilePondPluginImageExifOrientation,
    // calculates & adds resize information...
    FilePondPluginImageResize,

    FilePondPluginFileMetadata,
);
    
FilePond.setOptions({
    fileMetadataObject: {
        hello: 'world',
    },
});

    // Filepond: Basic
    FilePond.create(document.querySelector('.basic-filepond'), {
        allowImagePreview: false,
        allowMultiple: false,
        allowFileEncode: false,
        required: false
    });

    // Filepond: Multiple Files
    FilePond.create(document.querySelector('.multiple-files-filepond'), {
        allowImagePreview: false,
        allowMultiple: true,
        allowFileEncode: false,
        required: false
    });

    // Filepond: With Validation
    FilePond.create(document.querySelector('.with-validation-filepond'), {
        allowImagePreview: false,
        allowMultiple: true,
        allowFileEncode: false,
        required: true,
        acceptedFileTypes: ['image/png'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type);
        })
    });

    // Filepond: ImgBB with server property
    FilePond.create(document.querySelector('.imgbb-filepond'), {
        allowImagePreview: false,
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort) => {
                // We ignore the metadata property and only send the file

                const formData = new FormData();
                formData.append(fieldName, file, file.name);

                const request = new XMLHttpRequest();
                // you can change it by your client api key
                request.open('POST', 'https://api.imgbb.com/1/upload?key=762894e2014f83c023b233b2f10395e2');

                request.upload.onprogress = (e) => {
                    progress(e.lengthComputable, e.loaded, e.total);
                };

                request.onload = function () {
                    if (request.status >= 200 && request.status < 300) {
                        load(request.responseText);
                    }
                    else {
                        error('oh no');
                    }
                };

                request.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            let response = JSON.parse(this.responseText);

                            Toastify({
                                text: "Success uploading to imgbb! see console f12",
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "right",
                                backgroundColor: "#4fbe87",
                            }).showToast();

                            console.log(response);
                        } else {
                            Toastify({
                                text: "Failed uploading to imgbb! see console f12",
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "right",
                                backgroundColor: "#ff0000",
                            }).showToast();

                            console.log("Error", this.statusText);
                        }
                    }
                };

                request.send(formData);
            }
        }
    });

    // Filepond: Image Preview
    FilePond.create(document.querySelector('.image-preview-filepond'), {
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type);
        })
    });

    // Filepond: Image Crop
    FilePond.create(document.querySelector('.image-crop-filepond'), {
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: true,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type);
        })
    });

    // Filepond: Image Exif Orientation
    FilePond.create(document.querySelector('.image-exif-filepond'), {
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: true,
        allowImageCrop: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            resolve(type);
        })
    });

    // Filepond: Image Filter
    FilePond.create(document.querySelector('.image-filter-filepond'), {
        allowImagePreview: true,
        allowImageFilter: true,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        imageFilterColorMatrix: [
            0.299, 0.587, 0.114, 0, 0,
            0.299, 0.587, 0.114, 0, 0,
            0.299, 0.587, 0.114, 0, 0,
            0.000, 0.000, 0.000, 1, 0
        ],
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise
            html += `<div class="form-group col-md-6 mt-3">
                        <label for="wall">Ghi ch?? ???nh ${source.name}</label>
                        <input type="text" class="form-control" name="note[]">
                    </div>`;

            $('#note').html(html);
            resolve(type);
        })
    });

html = '';
count = 0;
    // Filepond: Image Resize
    const pond = FilePond.create(document.querySelector('.image-resize-filepond'), {
        allowImagePreview: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        allowImageResize: true,
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        imageResizeMode: 'cover',
        imageResizeUpscale: true,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        storeAsFile: true,
        allowFileMetadata: true,
     
        // labelIdle:`<p>K??o v?? th??? file ???nh c???a b???n</p>`,
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            
            // html = `<input type="text" style="
            //             margin: 20px;
            //             z-index:4;
            //             position: relative;
            //             right: -500px;
            //             top: 50%;">`
                
            // $('.filepond--item').append(html);
            // html = '';
            count++;
            console.log(count);
              html += `<div class="form-group col-md-6 mt-3">
                        <label for="wall">Ghi ch?? ???nh ${source.name}</label>
                        <input type="text" class="form-control" name="note['${source.name}']">
                    </div>`;

            $('#note').html(html);
        
            
            resolve(type);
        })
    });

    // pond.onaddfile = (err, item) => {

    //         if (err) {
    //             console.warn(err);
    //             return;
    //         }
            
    //         // Get file item metadata
    //         const metadata = item.getMetadata();

    //         // Log the metadata to the console so we can verify it's there
    //         console.log(metadata);
    //     }
