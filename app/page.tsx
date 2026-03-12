"use client";

import { useEffect, useState } from "react";
import Link from "next/link";
import api from "@/lib/axios";
import { Anime } from "@/types/types";
import BannerImg from "@/app/img/banner.jpg";
import Image from "next/image";

export default function AnimesPage() {
  const [animes, setAnimes] = useState<Anime[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api
      .get("/animes")
      .then((res) => setAnimes(res.data))
      .catch((err) => console.error(err))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <p className="py-20 text-center text-gray-500 text-lg">Loading...</p>
    );
  }

  return (
    <div className="w-full bg-gray-100">
      
      {/* ================= Banner ================= */}
      <div className="relative w-full h-64 md:h-170 flex items-center justify-center">
        <Image
          src={BannerImg}
          alt="Anime Banner"
          fill
          className="object-cover"
          priority
        />

        {/* Dark overlay */}
        <div className="absolute inset-0 bg-black/40"></div>

        <h1 className="relative z-10 text-3xl md:text-5xl font-bold text-white text-center px-4">
          Discover Your Favorite Anime
        </h1>
      </div>

      {/* ================= Anime Section ================= */}
      <div className="max-w-[1500px] mx-auto px-8 py-12">
        <h2 className="text-3xl font-bold mb-10 text-center text-indigo-600">
          Anime List
        </h2>

        {animes.length === 0 ? (
          <p className="text-center text-gray-500 text-lg">
            No anime available.
          </p>
        ) : (
          <div className="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            {animes.map((anime) => (
              <div
                key={anime.id}
                className="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:scale-105 transition duration-300"
              >
                {/* Poster */}
                <div className="relative w-full h-64">
                  {anime.poster ? (
                    <img
                      src={anime.poster}
                      alt={anime.title}
                      className="w-full h-full object-cover"
                    />
                  ) : (
                    <div className="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600">
                      No Image
                    </div>
                  )}

                  {/* Rating */}
                  {anime.rating && (
                    <span className="absolute top-2 right-2 bg-yellow-400 text-black font-bold px-2 py-1 text-sm rounded">
                      {anime.rating}/10
                    </span>
                  )}
                </div>

                {/* Content */}
                <div className="p-4">
                  <h3 className="text-lg font-semibold truncate">
                    {anime.title}
                  </h3>

                  <div className="text-sm text-gray-500 mt-1">
                    <p>Studio: {anime.studio || "N/A"}</p>
                    <p>Year: {anime.release_year || "N/A"}</p>
                  </div>

                  <Link
                    href={`/animes/${anime.id}`}
                    className="inline-block mt-3 text-indigo-600 text-sm font-medium hover:text-indigo-800"
                  >
                    View Details →
                  </Link>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}