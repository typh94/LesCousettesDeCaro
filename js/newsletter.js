document.getElementById('newsletterForm').addEventListener('submit', function(event) {
  const email = document.getElementById('email').value.trim();
  const close = document.getElementById('closeSubscribeBox').value.trim();
  if(closeSubscribeBox){
    return false;
  }
  else{
  if (!email) {
    event.preventDefault();
    alert('Please enter your email address.');
  }   else {
    alert('Thank you for subscribing to our newsletter!');
  }
}
});

