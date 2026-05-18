"use client";

import { useLang } from "@/lib/LanguageContext";

export default function Header() {
  const { lang, setLang, t } = useLang();

  return (
    <header className="header">
      <a href="#top" className="logo">
        <span className="logo-mark" aria-hidden />
        NOVA ORBIT
      </a>
      <div className="header-right">
        <nav className="nav">
          <a href="#services">{t.nav.services}</a>
          <a href="#contact">{t.nav.contact}</a>
        </nav>
        <div className="lang-switch" role="group" aria-label="Language">
          <button
            onClick={() => setLang("ua")}
            className={lang === "ua" ? "active" : ""}
            aria-pressed={lang === "ua"}
          >
            UA
          </button>
          <button
            onClick={() => setLang("en")}
            className={lang === "en" ? "active" : ""}
            aria-pressed={lang === "en"}
          >
            EN
          </button>
        </div>
      </div>
    </header>
  );
}
