// ====== Button Radio ======//
function selectButton(buttonId) {
    // Dapatkan elemen radio button terkait dengan tombol yang diklik
    var radio = document.getElementById(buttonId);

    // Setel semua radio button dengan nama yang sama menjadi tidak terpilih
    var radios = document.getElementsByName(radio.name);
    for (var i = 0; i < radios.length; i++) {
        radios[i].checked = false;
    }

    // Setel radio button yang diklik menjadi terpilih
    radio.checked = true;
}


// ====== Alerts ======//
const alertPlaceholder = document.getElementById("liveAlertPlaceholder");
const appendAlert = (message, type) => {
    const wrapper = document.createElement("div");
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        "</div>",
    ].join("");

    alertPlaceholder.append(wrapper);
};

// Succes tambah lapangan
const alertTrigger = document.getElementById("liveAlertBtn");
if (alertTrigger) {
    alertTrigger.addEventListener("click", () => {
        appendAlert("Berhasil Menambah!", "success");
    });
}

// Succes Delete
const alertTrigger2 = document.getElementById("liveAlertBtn2");
if (alertTrigger2) {
    alertTrigger2.addEventListener("click", () => {
        appendAlert("Berhasil Menghapus!", "danger");
    });
}
