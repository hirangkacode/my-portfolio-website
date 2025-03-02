document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("contact_backend.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log("Server Response:", data); // Logs the response for debugging
        if (data.includes("Success")) {
            alert("Message sent successfully!");
            document.getElementById("contactForm").reset();
        } else {
            alert("Error: " + data);
        }
    })
    .catch(error => console.error("Fetch Error:", error));
});
