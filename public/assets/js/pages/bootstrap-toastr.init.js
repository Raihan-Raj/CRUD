var toastTrigger = document.getElementById("liveToastBtn"),
    toastLiveExample = document.getElementById("liveToast");
toastTrigger && toastTrigger.addEventListener("click", function() { new bootstrap.Toast(toastLiveExample).show() });