import "../scss/main.scss";

document.addEventListener("DOMContentLoaded", function () {
  //logo animation
  function animateElements() {
    const logo = document.querySelector(".logo");
    if (logo) {
      logo.classList.add(
        "animate-on-load",
        "animate-slide-in-top",
        "delay-100"
      );
    }

    //hero title animation
    const heroTitle = document.querySelector(".hero h1");
    if (heroTitle) {
      heroTitle.classList.add(
        "animate-on-load",
        "animate-fade-in-up",
        "delay-200"
      );
    }

    //hero subtitle animation
    const heroSubtitle = document.querySelector(".hero p");
    if (heroSubtitle) {
      heroSubtitle.classList.add(
        "animate-on-load",
        "animate-fade-in-up",
        "delay-300"
      );
    }

    //first deposit animation
    const firstDeposit = document.querySelector(".hero_first_deposit");
    if (firstDeposit) {
      firstDeposit.classList.add(
        "animate-on-load",
        "animate-fade-in-left",
        "delay-400"
      );
    }

    //second deposit animation
    const secondDeposit = document.querySelector(".hero_second_deposit");
    if (secondDeposit) {
      secondDeposit.classList.add(
        "animate-on-load",
        "animate-fade-in-right",
        "delay-500"
      );
    }

    //hero button animation
    const heroButton = document.querySelector(".hero_btn_link");
    if (heroButton) {
      console.log("Найдена кнопка hero_btn_link");
      heroButton.classList.add(
        "animate-on-load",
        "animate-scale-in",
        "delay-600"
      );

      setTimeout(() => {
        heroButton.classList.add("pulse");
      }, 1400);
    }

    //description animation
    const description = document.querySelector(".description");
    if (description) {
      description.classList.add(
        "animate-on-load",
        "animate-fade-in-up",
        "delay-700"
      );
    }

    //payment images animation
    const paymentImages = document.querySelectorAll(".payment_images img");

    paymentImages.forEach((img, index) => {
      const delayClass = `delay-${800 + index * 100}`;
      img.classList.add("animate-on-load", "animate-scale-in");
      img.classList.add(delayClass);
    });
  }

  //copy promo code function
  function initCopyButtons() {
    const copyButtons = document.querySelectorAll(".copy_btn");

    copyButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const depositWrap = this.closest(".deposit_wrap");
        const promoElement = depositWrap.querySelector(".deposit_promo");
        const promoText = promoElement.textContent;

        document.querySelectorAll(".deposit_wrap").forEach((wrap) => {
          wrap.classList.remove("copied");
          const button = wrap.querySelector(".copy_btn");
          if (button) {
            button.textContent = "copy";
          }
          const promo = wrap.querySelector(".deposit_promo");
          if (promo) {
            promo.classList.remove("copied");
          }
        });

        if (navigator.clipboard) {
          navigator.clipboard.writeText(promoText);
        }

        depositWrap.classList.add("copied");
        promoElement.classList.add("copied");
        this.textContent = "copied";
      });
    });
  }

  setTimeout(animateElements, 100);
  initCopyButtons();
});
