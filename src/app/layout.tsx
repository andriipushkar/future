import type { Metadata } from "next";
import { LanguageProvider } from "@/lib/LanguageContext";
import "./globals.css";

export const metadata: Metadata = {
  title: "Nova Orbit — Digital Studio | Веб-сайти, Telegram-боти, ПЗ",
  description:
    "Веб-сайти, Telegram-боти та програмне забезпечення під ключ. Студія повного циклу з фокусом на дизайн та інженерію.",
  openGraph: {
    title: "Nova Orbit — Digital Studio",
    description:
      "Веб-сайти, Telegram-боти та програмне забезпечення під ключ.",
    type: "website",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="uk">
      <body>
        <LanguageProvider>
          <div className="noise" />
          {children}
        </LanguageProvider>
      </body>
    </html>
  );
}
