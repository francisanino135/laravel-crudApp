// Add click listeners to all dropdown buttons
document.querySelectorAll('button[id^="menu-button-"]').forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default button behavior
        event.stopPropagation(); // Stop event from propagating to the document

        // Get the associated dropdown menu directly
        const buttonId = button.id; // e.g., "menu-button-1"
        const dropdownId = buttonId.replace("menu-button-", "menu-"); // e.g., "menu-1"
        const dropdown = document.getElementById(dropdownId);

        // Log IDs for debugging
        console.log("Button ID:", buttonId, "Dropdown ID:", dropdownId);

        if (!dropdown) {
            console.error("Dropdown not found for button:", buttonId);
            return;
        }

        // Toggle visibility of the dropdown menu
        dropdown.classList.toggle("hidden");

        // Update ARIA-expanded attribute
        const isExpanded = button.getAttribute("aria-expanded") === "true";
        button.setAttribute("aria-expanded", !isExpanded);
    });
});

document.addEventListener("click", (event) => {
    document.querySelectorAll('[id^="menu-"]').forEach((dropdown) => {
        // Construct the button ID based on the dropdown ID
        const buttonId = `menu-button-${dropdown.id.split('-')[1]}`;
        const button = document.getElementById(buttonId);

        if (!dropdown || !button) {
            console.error("Dropdown or Button not found for:", dropdown.id, buttonId);
            return;
        }

        // Check if the click is outside both the dropdown and the button
        if (
            !dropdown.contains(event.target) &&
            !button.contains(event.target)
        ) {
            console.log("Closing dropdown:", dropdown.id);
            dropdown.classList.add("hidden"); // Hide the dropdown
            button.setAttribute("aria-expanded", false); // Reset ARIA state
        }
    });
});
