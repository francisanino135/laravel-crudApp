import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("fileUploadHandlerRegister", () => ({
    files: [], // Define the files array here
    previewUrl: "",

    handleFileUpload(event) {
        this.files = Array.from(event.target.files); // Store files

        if (this.files.length > 0) {
            const reader = new FileReader();
            reader.onload = () => {
                this.previewUrl = reader.result; // Store image preview
            };
            reader.readAsDataURL(this.files[0]); // Read first file only
        }
    },
}));


document.addEventListener('alpine:init', () => {
    Alpine.data('fileUploadHandlerCreate', () => ({
        previews: [],

        handleFileUpload(event) {
            const files = event.target.files;
            this.previews = [];

            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = () => {
                            this.previews.push({ type: 'image', url: reader.result });
                        };
                        reader.readAsDataURL(file);
                    } else if (file.type.startsWith('video/')) {
                        this.previews.push({ type: 'video', url: URL.createObjectURL(file) });
                    }
                });
            }
        }
    }));
});

Alpine.start();



