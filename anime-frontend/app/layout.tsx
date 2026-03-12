import './globals.css';
import Navbar from '@/components/Navbar';

export const metadata = {
  title: 'AnimeHub',
  description: 'Professional Anime Website',
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body className="bg-gray-100">
        <Navbar />
        <main>{children}</main>
      </body>
    </html>
  );
}