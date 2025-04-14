document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".edit-comment").forEach((editButton) => {
        editButton.addEventListener("click", (event) => {
            event.preventDefault();
            
            const commentId = editButton.dataset.commentId;
            const updateForm = document.getElementById(`update-form-${commentId}`);
            
            if (updateForm) {
                // Hide all other forms
                document.querySelectorAll('[id^="update-form-"]').forEach((form) => {
                    if (form !== updateForm) form.classList.add("hidden");
                });

                // Toggle the visibility of the current form
                updateForm.classList.toggle("hidden");
            }
        });
    });
});
