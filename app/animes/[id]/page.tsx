"use client";

import { useEffect, useState } from "react";
import { useParams, useRouter } from "next/navigation";
import api from "@/lib/axios";
import { Anime } from "@/types/types";
import BannerImg from "@/app/img/banner.jpg";
import { IoArrowBack } from "react-icons/io5";
import Banner from "@/components/Banner";

export default function AnimeDetailPage() {
  const params = useParams();
  const animeId = params?.id;
  const router = useRouter(); // Add router

  const [anime, setAnime] = useState<Anime | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!animeId) return;

    api
      .get(`/animes/${animeId}`)
      .then((res) => setAnime(res.data))
      .catch((err) => console.error(err))
      .finally(() => setLoading(false));
  }, [animeId]);

  if (loading)
    return (
      <p className="py-20 text-center text-gray-500 text-lg">Loading...</p>
    );

  if (!anime)
    return (
      <p className="py-20 text-center text-gray-500 text-lg">
        Anime not found.
      </p>
    );

  return (
    <div className="bg-gray-100 min-h-screen">
      {/* Back Button */}
     


      {/* ================= Banner ================= */}
      <Banner 
        src={BannerImg} 
        alt="Anime Banner" 
        title="Discover Your Favorite Anime" 
      />
       <div className="max-w-[1400px] mx-auto px-6 py-6">
        <button
          onClick={() => router.push("/animes")}
          className="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105"
        >
          <IoArrowBack size={18} />
          Back to Animes
        </button>
      </div>

      {/* ================= HERO SECTION ================= */}
      <div className="max-w-[1400px] mx-auto px-6 py-10 grid md:grid-cols-2 gap-10 items-center">
        {/* Poster */}
        <div className="relative w-full h-64">
          {anime.poster ? (
            <img
              src={anime.poster}
              alt={anime.title}
              className="w-full h-full object-cover rounded-lg"
            />
          ) : (
            <div className="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600 rounded-lg">
              No Image
            </div>
          )}
        </div>

        {/* Info */}
        <div>
          <h1 className="text-4xl font-bold mb-4">{anime.title}</h1>

          <p className="text-gray-700 mb-6 leading-relaxed">
            {anime.description || "No description available."}
          </p>

          <div className="grid grid-cols-2 gap-4 text-gray-600 text-sm">
            <p>
              <span className="font-semibold">Studio:</span> {anime.studio || "N/A"}
            </p>

            <p>
              <span className="font-semibold">Release Year:</span> {anime.release_year || "N/A"}
            </p>

            <p>
              <span className="font-semibold">Rating:</span> {anime.rating ? `${anime.rating}/10` : "N/A"}
            </p>

            <p>
              <span className="font-semibold">Episodes:</span> {anime.episodes?.length || 0}
            </p>
          </div>
        </div>
      </div>

      {/* ================= EPISODES ================= */}
      <div className="max-w-[1400px] mx-auto px-6 pb-16">
        <h2 className="text-3xl font-bold mb-8 text-indigo-600">Episodes</h2>

        {anime.episodes?.length === 0 ? (
          <p className="text-gray-500">No episodes available.</p>
        ) : (
          <div className="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            {anime.episodes.map((ep) => (
              <div
                key={ep.id}
                className="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
              >
                {/* Thumbnail */}
                <div className="relative w-full h-40">
                  {ep.thumbnail ? (
                    <img
                      src={ep.thumbnail}
                      alt={ep.title}
                      className="w-full h-full object-cover"
                    />
                  ) : (
                    <div className="w-full h-full flex items-center justify-center bg-gray-300 text-gray-500">
                      No Image
                    </div>
                  )}
                </div>

                {/* Content */}
                <div className="p-4">
                  <h3 className="font-semibold text-lg mb-1">
                    Episode {ep.episode_number}
                  </h3>
                  <p className="text-gray-600 text-sm mb-3">{ep.title}</p>

                  <a
                    href={ep.video_url}
                    target="_blank"
                    rel="noreferrer"
                    className="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-sm"
                  >
                    ▶ Watch Episode
                  </a>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}