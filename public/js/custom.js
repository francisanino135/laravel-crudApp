

document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded');
    const alertBox = document.getElementById('flash-message');
    if (alertBox) {
        console.log('Flash message found, removing in 3 seconds');
        setTimeout(() => alertBox.remove(), 2000);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded');
    const alertBox = document.getElementById('error-message');
    if (alertBox) {
        console.log('Error message found, removing in 3 seconds');
        setTimeout(() => alertBox.remove(), 2000);
    }
});

document.getElementById('custom-image-upload').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission
    document.getElementById('file-upload').click();
});

document.getElementById('custom-video-upload').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission
    document.getElementById('file-upload').click();
});

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('file-upload');
    const previewContainer = document.getElementById('preview-container');

    // Show the preview container if there are preloaded media
    if (previewContainer.children.length > 0) {
        previewContainer.style.display = 'flex';
    }

    // Handle file input change event
    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;

        // Clear previous previews (new uploads only)
        previewContainer.innerHTML = '';

        if (files.length > 0) {
            // Show the preview container
            previewContainer.style.display = 'flex';

            for (const file of files) {
                const reader = new FileReader();

                if (file.type.startsWith('image/')) {
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '150px';
                        img.style.marginRight = '10px';
                        img.style.borderRadius = '5px';
                        img.style.border = '1px solid #ddd';
                        previewContainer.appendChild(img);
                    };
                } else if (file.type.startsWith('video/')) {
                    reader.onload = () => {
                        const video = document.createElement('video');
                        video.src = URL.createObjectURL(file);
                        video.controls = true;
                        video.style.maxWidth = '150px';
                        video.style.marginRight = '10px';
                        previewContainer.appendChild(video);
                    };
                }

                reader.readAsDataURL(file);
            }
        } else {
            previewContainer.style.display = 'none';
        }
    });
});



