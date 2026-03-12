"use client";

import { useEffect, useState } from "react";
import api from "@/lib/axios";
import { Episode } from "@/types/types";
import BannerImg from "@/app/img/banner.jpg";
import Banner from "@/components/Banner";

export default function EpisodesPage() {
  const [episodes, setEpisodes] = useState<Episode[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api
      .get("/episodes")
      .then((res) => setEpisodes(res.data))
      .catch((err) => console.error(err))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return <p className="py-20 text-center text-gray-500 text-lg">Loading...</p>;
  }

  return (
    <div className="w-full min-h-screen bg-gray-100">
      {/* ================= Banner ================= */}
      <Banner 
        src={BannerImg} 
        alt="Episodes Banner" 
        title="All Anime Episodes" 
      />

      {/* ================= Episodes Section ================= */}
      <div className="max-w-[1500px] mx-auto px-8 py-12">
        <h2 className="text-3xl font-bold mb-10 text-center text-indigo-600">
          Episode List
        </h2>

          {episodes.length === 0 ? (
            <p className="text-center text-gray-500 text-lg">
              No episodes available.
            </p>
          ) : (
            <div className="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
              {episodes.map((ep) => (
                <div
                  key={ep.id}
                  className="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:scale-105 transition duration-300"
                >
                  {/* Thumbnail */}
                  <div className="relative w-full h-48">
                    {ep.thumbnail ? (
                      <img
                        src={ep.thumbnail}
                        alt={ep.title}
                        className="w-full h-full object-cover"
                      />
                    ) : (
                      <div className="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600">
                        No Image
                      </div>
                    )}
                  </div>

                  {/* Content */}
                  <div className="p-4">
                    <h3 className="text-lg font-semibold truncate">{ep.title}</h3>
                    <div className="text-sm text-gray-500 mt-1">
                      <p>Anime: {ep.anime?.title || "N/A"}</p>
                      <p>Episode #: {ep.episode_number}</p>
                    </div>

                    <a
                      href={ep.video_url}
                      target="_blank"
                      className="inline-block mt-3 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-sm"
                    >
                      ▶ Watch Video
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