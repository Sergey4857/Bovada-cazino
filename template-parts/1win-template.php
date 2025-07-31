<header class="header header-1win">
  <nav class="container">
    <div class="logo">
      <img src="/src/icons/1win-logo.svg" alt="logo">
    </div>
  </nav>
</header>

<section id="home" class="hero hero-1win">
  <div class="container hero_cotent">
    <h1>Bonus <span class="highlight">+500%</span></h1>

    <p>Get a <span>500% bonus</span> on your first top up</p>


    <a class="hero_btn_link" href="<?php 
      if ($ip_info['country'] == 'Canada' && $ip_info['region'] != 'ON') {
        echo 'https://1wvlau.life/casino/list?open=register&p=df5s';
      } elseif ($ip_info['country'] == 'Brazil') {
        echo 'https://1wuafz.life/casino/list?open=register&p=g9vy';
      }
    ?>">SIGN UP</a>
  </div>

  <p class="description"><span>1win</span> is licensed and regulated by the Union of the Comoros and the Central
    Reserve Authority of
    Western Sahara.</p>

  <div class="payment_images">
    <img src="/src/icons/Visa.svg" alt="visa">
    <img src="/src/icons/Mastercard.svg" alt="mastercard">
    <img src="/src/icons/L.svg" alt="ethereum">
    <img src="/src/icons/t.svg" alt="bitcoin">
    <img src="/src/icons/Bitcoin.svg" alt="litecoin">
    <img src="/src/icons/Bitcoin_green.svg" alt="litecoin">
  </div>
</section> 