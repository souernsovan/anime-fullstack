"use client";

import Link from "next/link";
import { useState } from "react";
import { HiMenu, HiX } from "react-icons/hi";

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="bg-gray-900 text-white shadow-md sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between h-16 items-center">
          {/* Logo */}
          <Link href="/" className="text-2xl font-bold text-indigo-500">
            AnimeHub
          </Link>

          {/* Desktop Links */}
          <div className="hidden md:flex space-x-6">
            <Link href="/" className="hover:text-indigo-400 transition">
              Home
            </Link>
            <Link href="/animes" className="hover:text-indigo-400 transition">
              Anime List
            </Link>
            <Link href="/episodes" className="hover:text-indigo-400 transition">
              Episodes
            </Link>
          </div>

          {/* Mobile Menu Button */}
          <div className="md:hidden">
            <button
              onClick={() => setIsOpen(!isOpen)}
              className="focus:outline-none"
            >
              {isOpen ? (
                <HiX className="h-6 w-6" />
              ) : (
                <HiMenu className="h-6 w-6" />
              )}
            </button>
          </div>
        </div>
      </div>

      {/* Mobile Menu */}
      {isOpen && (
        <div className="md:hidden bg-gray-800">
          <Link
            href="/"
            className="block px-4 py-2 hover:bg-gray-700 transition"
            onClick={() => setIsOpen(false)}
          >
            Home
          </Link>
          <Link
            href="/animes"
            className="block px-4 py-2 hover:bg-gray-700 transition"
            onClick={() => setIsOpen(false)}
          >
            Anime List
          </Link>
          <Link
            href="/episodes"
            className="block px-4 py-2 hover:bg-gray-700 transition"
            onClick={() => setIsOpen(false)}
          >
            Episodes
          </Link>
        </div>
      )}
    </nav>
  );
}