"use client";

import Header from "@/components/Header";
import Hero from "@/components/Hero";
import Services from "@/components/Services";
import Contact from "@/components/Contact";
import { useLang } from "@/lib/LanguageContext";

export default function Page() {
  const { t } = useLang();
  return (
    <main>
      <Header />
      <Hero />
      <Services />
      <Contact />
      <footer className="footer">
        © {new Date().getFullYear()} Nova Orbit. {t.footer.rights}.
      </footer>
    </main>
  );
}
