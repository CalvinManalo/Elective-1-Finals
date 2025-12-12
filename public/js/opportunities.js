// Make functions globally accessible
window.openForm = function(position) {
    const form = document.getElementById("applicationForm");
    const positionField = document.getElementById("positionField");

    if(form && positionField){
        form.style.display = "flex"; // show modal
        form.style.justifyContent = "center";
        form.style.alignItems = "center";
        form.style.position = "fixed";
        form.style.top = "0";
        form.style.left = "0";
        form.style.width = "100%";
        form.style.height = "100%";
        form.style.backgroundColor = "rgba(0,0,0,0.5)";
        form.style.zIndex = "1000";

        positionField.value = position;
    }
}


window.closeForm = function() {
    const form = document.getElementById("applicationForm");
    if(form){
        form.style.display = "none";
    } else {
        console.warn("Modal not found!");
    }
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('internForm');
    if(form){
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedPosition = document.getElementById("positionField").value;
            alert(`Application submitted for: ${selectedPosition} (BSIT)`);
            closeForm();
        });
    }
});



