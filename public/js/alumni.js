// Open and close modal functions
window.openAlumniModal = function() {
    const modalEl = document.getElementById("alumniModal");
    if (modalEl) {
        modalEl.style.display = "flex";
        modalEl.style.justifyContent = "center";
        modalEl.style.alignItems = "center";
        modalEl.style.position = "fixed";
        modalEl.style.top = "0";
        modalEl.style.left = "0";
        modalEl.style.width = "100%";
        modalEl.style.height = "100%";
        modalEl.style.backgroundColor = "rgba(0,0,0,0.5)";
        modalEl.style.zIndex = "1000";
    }
};

window.closeAlumniModal = function() {
    const modalEl = document.getElementById("alumniModal");
    const formEl = document.getElementById("alumniForm");
    if (modalEl) modalEl.style.display = "none";
    if (formEl) formEl.reset();
};

// Handle modal Register button submission via AJAX
document.addEventListener("DOMContentLoaded", function() {
    const formEl = document.getElementById("alumniForm");
    const registerBtn = document.getElementById("modalRegisterBtn");

    if (formEl && registerBtn) {
        registerBtn.addEventListener("click", function(e) {
            e.preventDefault(); // Prevent normal form submission
            const formData = new FormData(formEl);

            fetch(formEl.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    closeAlumniModal();

                    const alertContainer = document.getElementById("successAlertContainer");
                    if (alertContainer) {
                        alertContainer.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                                Alumni registered successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `;
                        setTimeout(() => {
                            const alert = alertContainer.querySelector(".alert");
                            if(alert){
                                alert.style.transition = "opacity 1s";
                                alert.style.opacity = "0";
                                alert.addEventListener("transitionend", () => alert.remove());
                            }
                        }, 3000);
                    }
                } else {
                    alert("Error registering alumni.");
                }
            })
            .catch(err => console.error(err));
        });
    }

    // NEW: Submit Only button logic
    const submitOnlyBtn = document.getElementById("modalSubmitOnlyBtn");
    if (formEl && submitOnlyBtn) {
        submitOnlyBtn.addEventListener("click", function(e){
            e.preventDefault();
            const formData = new FormData(formEl);

            fetch(formEl.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    formEl.reset();
                    const alertContainer = document.getElementById("successAlertContainer");
                    if(alertContainer){
                        alertContainer.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                                Alumni registered successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `;
                        setTimeout(()=>{
                            const alert = alertContainer.querySelector(".alert");
                            if(alert){
                                alert.style.transition = "opacity 1s";
                                alert.style.opacity = "0";
                                alert.addEventListener("transitionend", ()=>alert.remove());
                            }
                        }, 3000);
                    }
                } else {
                    alert("Error registering alumni.");
                }
            })
            .catch(err => console.error(err));
        });
    }

    // Connect the modal open button
    const openModalBtn = document.getElementById("openAlumniModalBtn");
    if (openModalBtn) {
        openModalBtn.addEventListener("click", function() {
            const alumniModalEl = document.getElementById("alumniModal");
            const bootstrapModal = new bootstrap.Modal(alumniModalEl);
            bootstrapModal.show();
            console.log("Alumni registration modal opened (inputs now editable).");
        });
    }
});



