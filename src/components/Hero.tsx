"use client";

import dynamic from "next/dynamic";
import { motion } from "framer-motion";
import { useLang } from "@/lib/LanguageContext";

const Scene = dynamic(() => import("./Scene"), { ssr: false });

export default function Hero() {
  const { t } = useLang();

  return (
    <section className="hero" id="top">
      <div className="hero-canvas">
        <Scene />
      </div>

      <motion.div
        className="hero-content"
        initial={{ opacity: 0, y: 30 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.9, ease: "easeOut" }}
      >
        <motion.span
          className="tagline"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.3, duration: 0.8 }}
        >
          {t.hero.tagline}
        </motion.span>
        <h1>
          {t.hero.title}{" "}
          <span className="accent">{t.hero.titleAccent}</span>
        </h1>
        <p>{t.hero.subtitle}</p>
        <div className="cta-row">
          <a href="#contact" className="btn btn-primary">
            {t.hero.cta}
          </a>
          <a href="#services" className="btn btn-ghost">
            {t.hero.ctaSecondary}
          </a>
        </div>
      </motion.div>

      <div className="scroll-hint">scroll</div>
    </section>
  );
}
