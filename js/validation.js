document.getElementById('contactForm').addEventListener('submit', function(event) {
  const fname = document.getElementById('fname').value.trim();
  const lname = document.getElementById('lname').value.trim();
  const email = document.getElementById('email').value.trim();
  const message = document.getElementById('message').value.trim();

  if (!fname || !lname || !email || !message) {
    event.preventDefault();
    alert('Please fill out all fields before submitting.');
  } else {
    event.preventDefault(); // Temporarily prevent form submission
    alert('Thank you for reaching out! Your message has been submitted successfully.');
    setTimeout(() => {
      event.target.submit(); // Submit the form after a short delay
    }, 100); // Adjust the delay as needed (500ms in this case)
  }
});
