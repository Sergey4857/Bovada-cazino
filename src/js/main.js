// Импорт существующих стилей
import "../scss/main.scss";

// Здесь можно добавить JavaScript код
console.log("Webpack is working!");
// Плавная прокрутка для навигации
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Анимация появления элементов при прокрутке
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1";
      entry.target.style.transform = "translateY(0)";
    }
  });
}, observerOptions);

// Наблюдаем за карточками и другими элементами
document
  .querySelectorAll(".feature-card, .about-text, .about-image")
  .forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(30px)";
    el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(el);
  });

// Добавляем анимацию для кнопок при наведении
document.addEventListener("DOMContentLoaded", function () {
  // Анимация для кнопок
  const buttons = document.querySelectorAll(".cta-button, .submit-btn");
  buttons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-3px) scale(1.05)";
    });

    button.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)";
    });
  });

  // Анимация для карточек при клике
  const featureCards = document.querySelectorAll(".feature-card");
  featureCards.forEach((card) => {
    card.addEventListener("click", function () {
      this.style.transform = "translateY(-15px) scale(1.02)";
      setTimeout(() => {
        this.style.transform = "translateY(-10px)";
      }, 200);
    });
  });

  // Плавное появление страницы
  document.body.style.opacity = "0";
  document.body.style.transition = "opacity 0.5s ease";

  setTimeout(() => {
    document.body.style.opacity = "1";
  }, 100);
});
