export type Lang = "ua" | "en";

export const translations = {
  ua: {
    nav: {
      services: "Послуги",
      contact: "Контакти",
    },
    hero: {
      tagline: "Цифрова студія",
      title: "Створюємо продукти",
      titleAccent: "за межами орбіти",
      subtitle:
        "Веб-сайти, Telegram-боти та програмне забезпечення під ключ. Поєднуємо інженерію з дизайном майбутнього.",
      cta: "Залишити заявку",
      ctaSecondary: "Наші послуги",
    },
    services: {
      label: "Що ми робимо",
      title: "Послуги",
      subtitle: "Повний цикл — від ідеї до запуску",
      items: [
        {
          title: "Веб-сайти",
          description:
            "Лендінги, корпоративні сайти, інтернет-магазини. Сучасні технології, швидкість завантаження та конверсійний дизайн.",
        },
        {
          title: "Telegram-боти",
          description:
            "Боти для бізнесу: продажі, бронювання, автоматизація, інтеграції з CRM та платіжними системами.",
        },
        {
          title: "Програмне забезпечення",
          description:
            "Веб-додатки, API, інтеграції, автоматизація процесів. MVP стартапів та системи під ключ.",
        },
      ],
    },
    contact: {
      label: "Зв'язатися",
      title: "Готові обговорити проєкт?",
      subtitle: "Напишіть нам — відповімо протягом дня",
      name: "Ваше ім'я",
      contactField: "Telegram або Email",
      message: "Опишіть задачу",
      send: "Надіслати",
      sending: "Надсилаємо...",
      success: "Дякуємо! Ми зв'яжемося з вами найближчим часом.",
      error: "Заповніть усі поля",
    },
    footer: {
      rights: "Всі права захищено",
    },
  },
  en: {
    nav: {
      services: "Services",
      contact: "Contact",
    },
    hero: {
      tagline: "Digital studio",
      title: "We craft products",
      titleAccent: "beyond the orbit",
      subtitle:
        "Websites, Telegram bots and custom software. Engineering meets the design of the future.",
      cta: "Get in touch",
      ctaSecondary: "Our services",
    },
    services: {
      label: "What we do",
      title: "Services",
      subtitle: "Full cycle — from idea to launch",
      items: [
        {
          title: "Websites",
          description:
            "Landing pages, corporate sites, e-commerce. Modern stack, blazing-fast load times and conversion-focused design.",
        },
        {
          title: "Telegram bots",
          description:
            "Bots for business: sales, bookings, automation, CRM and payment system integrations.",
        },
        {
          title: "Custom software",
          description:
            "Web apps, APIs, integrations, process automation. Startup MVPs and turn-key systems.",
        },
      ],
    },
    contact: {
      label: "Get in touch",
      title: "Ready to discuss your project?",
      subtitle: "Send us a message — we respond within a day",
      name: "Your name",
      contactField: "Telegram or Email",
      message: "Describe your task",
      send: "Send",
      sending: "Sending...",
      success: "Thank you! We will get in touch shortly.",
      error: "Please fill in all fields",
    },
    footer: {
      rights: "All rights reserved",
    },
  },
} as const;

export type Dict = (typeof translations)["ua"];
