import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  images: {
    remotePatterns: [
      {
        protocol: "https",
        hostname: "mediaproxy.tvtropes.org",
      },
      {
        protocol: "https",
        hostname: "static.tvtropes.org",
      },
    ],
  },
};

export default nextConfig;
