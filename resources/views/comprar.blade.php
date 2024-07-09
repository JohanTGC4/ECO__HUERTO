<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoHuerto</title>
  <link rel="icon" href="images/logoEcoHuerto.png" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/comprar.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  @laravelPWA
</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
      <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span>Mi Huerto</span><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Blog</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </nav>
  <br>
  <br>

  <main class="container">
    <section class="card-section">
      <div class="card">
        <img src="{{ asset('images/tierra.jpg') }}" alt="Imagen 1" class="card-img">
        <div class="card-content">
          <p>Tierra para su plantita</p>
          <p>$300.00</p>
          <div class="cart-controls">
            <select class="product-quantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <button class="add-to-cart-btn" data-name="Tierra para su plantita" data-price="300.00">Agregar al carrito</button>
          </div>
        </div>
      </div>
      <!-- Repetir para otros productos -->
      <div class="card">
        <img src="{{ asset('images/palitas.jpg') }}" alt="Imagen 1" class="card-img">
        <div class="card-content">
          <p>Pala para plantar</p>
          <p>$250.00</p>
          <div class="cart-controls">
            <select class="product-quantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <button class="add-to-cart-btn" data-name="Pala para plantar" data-price="250.00">Agregar al carrito</button>
          </div>
        </div>
      </div>
      <!-- Repetir para otros productos -->
      <div class="card">
        <img src="{{ asset('images/maceta.jpg') }}" alt="Imagen 1" class="card-img">
        <div class="card-content">
          <p>Maceta grande para plantas</p>
          <p>$500.00</p>
          <div class="cart-controls">
            <select class="product-quantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <button class="add-to-cart-btn" data-name="Maceta grande para plantas" data-price="500.00">Agregar al carrito</button>
          </div>
        </div>
      </div>
    </section>

    <aside class="cart-container">
      <h2>Carrito de Compras</h2>
      <ul id="cart-items">
        <!-- Aquí se agregarán los elementos del carrito dinámicamente -->
      </ul>
      <div class="cart-total">
        <p>Total: <span id="cart-total">$0.00</span></p>
        <button id="checkout-btn">Pagar</button>
      </div>
    </aside>
  </main>

  <script src="script.js"></script>
  <script>
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });

    document.addEventListener('DOMContentLoaded', function() {
      const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
      const productQuantityInputs = document.querySelectorAll('.product-quantity');

      addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCartClicked);
      });

      productQuantityInputs.forEach(input => {
        input.addEventListener('change', updateQuantity);
      });

      document.getElementById('checkout-btn').addEventListener('click', checkoutClicked);
    });

    function addToCartClicked(event) {
      const button = event.target;
      const card = button.closest('.card');
      const name = card.querySelector('.card-content p:first-child').innerText;
      const price = parseFloat(card.querySelector('.card-content p:nth-child(2)').innerText.replace('$', ''));
      const quantity = parseInt(card.querySelector('.product-quantity').value);

      addItemToCart(name, price, quantity);
      updateCartTotal();
    }

    function addItemToCart(name, price, quantity) {
      const cartRow = document.createElement('li');
      cartRow.classList.add('cart-item');
      cartRow.dataset.quantity = quantity;

      const cartItems = document.getElementById('cart-items');
      const cartItemNames = cartItems.getElementsByClassName('cart-item-name');

      for (let i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText === name) {
          let currentQuantity = parseInt(cartItemNames[i].parentElement.dataset.quantity);
          let newQuantity = currentQuantity + quantity;
          cartItemNames[i].parentElement.dataset.quantity = newQuantity;
          cartItemNames[i].parentElement.querySelector('.cart-item-quantity').innerText = `Cantidad: ${newQuantity}`;
          return;
        }
      }

      const cartRowContents = `
        <span class="cart-item-name">${name}</span>
        <span class="cart-item-price">$${price.toFixed(2)}</span>
        <span class="cart-item-quantity">Cantidad: ${quantity}</span>
        <button class="remove-btn" onclick="removeFromCart(this)">Quitar</button>
      `;
      cartRow.innerHTML = cartRowContents;
      cartItems.appendChild(cartRow);
    }

    function updateCartTotal() {
      const cartItemContainer = document.getElementById('cart-items');
      const cartRows = cartItemContainer.getElementsByClassName('cart-item');
      let total = 0;

      for (let i = 0; i < cartRows.length; i++) {
        const cartRow = cartRows[i];
        const priceElement = cartRow.getElementsByClassName('cart-item-price')[0];
        const quantityElement = cartRow.getElementsByClassName('cart-item-quantity')[0];
        const price = parseFloat(priceElement.innerText.replace('$', ''));
        const quantity = parseInt(cartRow.dataset.quantity);
        total += price * quantity;
      }

      document.getElementById('cart-total').innerText = `$${total.toFixed(2)}`;
    }

    function removeFromCart(button) {
      const cartItem = button.parentElement;
      cartItem.remove();
      updateCartTotal();
    }

    function updateQuantity(event) {
      const input = event.target;
      const card = input.closest('.card');
      const name = card.querySelector('.card-content p:first-child').innerText;
      const quantity = parseInt(input.value);
      const cartItems = document.getElementById('cart-items');
      const cartItemNames = cartItems.getElementsByClassName('cart-item-name');

      for (let i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText === name) {
          cartItemNames[i].parentElement.dataset.quantity = quantity;
          cartItemNames[i].parentElement.querySelector('.cart-item-quantity').innerText = `Cantidad: ${quantity}`;
          updateCartTotal();
          return;
        }
      }
    }

    function checkoutClicked() {
      alert('Gracias por su compra');
      const cartItems = document.getElementById('cart-items');
      while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild);
      }
      updateCartTotal();
    }
  </script>
</body>
</html>

