"use client";

import { motion } from "framer-motion";
import { useState, FormEvent } from "react";
import { useLang } from "@/lib/LanguageContext";

type Status = "idle" | "sending" | "success" | "error";

export default function Contact() {
  const { t } = useLang();
  const [status, setStatus] = useState<Status>("idle");
  const [form, setForm] = useState({ name: "", contact: "", message: "" });

  const onSubmit = (e: FormEvent) => {
    e.preventDefault();
    if (!form.name || !form.contact || !form.message) {
      setStatus("error");
      return;
    }
    setStatus("sending");
    setTimeout(() => {
      setStatus("success");
      setForm({ name: "", contact: "", message: "" });
    }, 800);
  };

  return (
    <div className="contact-wrap" id="contact">
      <motion.div
        className="contact-inner grain-glow"
        initial={{ opacity: 0, y: 40 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true, margin: "-100px" }}
        transition={{ duration: 0.7 }}
      >
        <div className="section-header" style={{ marginBottom: 0 }}>
          <span className="section-label">{t.contact.label}</span>
          <h2 className="section-title">{t.contact.title}</h2>
          <p className="section-subtitle">{t.contact.subtitle}</p>
        </div>

        <form className="form" onSubmit={onSubmit}>
          <div className="field">
            <label htmlFor="name">{t.contact.name}</label>
            <input
              id="name"
              type="text"
              value={form.name}
              onChange={(e) => setForm({ ...form, name: e.target.value })}
              autoComplete="name"
            />
          </div>
          <div className="field">
            <label htmlFor="contact">{t.contact.contactField}</label>
            <input
              id="contact"
              type="text"
              value={form.contact}
              onChange={(e) => setForm({ ...form, contact: e.target.value })}
              placeholder="@username / mail@example.com"
            />
          </div>
          <div className="field">
            <label htmlFor="message">{t.contact.message}</label>
            <textarea
              id="message"
              value={form.message}
              onChange={(e) => setForm({ ...form, message: e.target.value })}
            />
          </div>

          <button
            type="submit"
            className="btn btn-primary"
            disabled={status === "sending"}
            style={{ justifySelf: "center", minWidth: 200 }}
          >
            {status === "sending" ? t.contact.sending : t.contact.send}
          </button>

          {status === "success" && (
            <p className="form-status success">{t.contact.success}</p>
          )}
          {status === "error" && (
            <p className="form-status error">{t.contact.error}</p>
          )}
        </form>
      </motion.div>
    </div>
  );
}
