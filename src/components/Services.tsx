"use client";

import { motion } from "framer-motion";
import { useLang } from "@/lib/LanguageContext";
import type { MouseEvent } from "react";

const icons = [
  // Website
  <svg key="web" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <rect x="3" y="4" width="18" height="14" rx="2" />
    <path d="M3 9h18M7 14h4" />
  </svg>,
  // Bot
  <svg key="bot" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <rect x="4" y="7" width="16" height="12" rx="3" />
    <path d="M12 3v4M9 13h.01M15 13h.01M8 19v2M16 19v2" />
  </svg>,
  // Code
  <svg key="code" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M8 6l-6 6 6 6M16 6l6 6-6 6M14 4l-4 16" />
  </svg>,
];

export default function Services() {
  const { t } = useLang();

  const handleMove = (e: MouseEvent<HTMLDivElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;
    e.currentTarget.style.setProperty("--mx", `${x}%`);
    e.currentTarget.style.setProperty("--my", `${y}%`);
  };

  return (
    <section className="section" id="services">
      <div className="section-header">
        <span className="section-label">{t.services.label}</span>
        <h2 className="section-title">{t.services.title}</h2>
        <p className="section-subtitle">{t.services.subtitle}</p>
      </div>

      <div className="services-grid">
        {t.services.items.map((item, i) => (
          <motion.div
            key={i}
            className="service-card"
            onMouseMove={handleMove}
            initial={{ opacity: 0, y: 40 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, margin: "-80px" }}
            transition={{ duration: 0.6, delay: i * 0.1 }}
          >
            <div className="service-icon">{icons[i]}</div>
            <h3>{item.title}</h3>
            <p>{item.description}</p>
          </motion.div>
        ))}
      </div>
    </section>
  );
}
