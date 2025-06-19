let menu = document.querySelector('#menu-btn')
let navbar = document.querySelector('.header .flex .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
}

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
}

function placeOrder() {
  // Collect order details from the modal
  const item = document.getElementById("modalTitle").textContent;
  const price = document.getElementById("modalPrice").textContent;
  const quantity = document.getElementById("quantity").textContent;

  fetch('save_order.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `item=${encodeURIComponent(item)}&price=${encodeURIComponent(price)}&quantity=${encodeURIComponent(quantity)}`
  })
  .then(response => response.text())
  .then(result => {
    // Hide modal and show success
    const addItemModalEl = document.getElementById('addItemModal');
    const addItemModal = bootstrap.Modal.getInstance(addItemModalEl);
    addItemModal.hide();
    const successModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
    setTimeout(() => { successModal.show(); }, 500);
  })
  .catch(err => {
    alert("Order failed: " + err);
  });
}