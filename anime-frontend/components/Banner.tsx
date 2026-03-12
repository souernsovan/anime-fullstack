import Image from "next/image";
import { StaticImageData } from "next/image";

interface BannerProps {
  src: StaticImageData | string;
  alt: string;
  title: string;
  height?: string;
}

export default function Banner({
  src,
  alt,
  title,
  height = "h-64 md:h-150",
}: BannerProps) {
  return (
    <div className={`relative w-full ${height} flex items-center justify-center`}>
      <Image
        src={src}
        alt={alt}
        fill
        className="object-cover"
        priority
      />

      {/* Dark overlay */}
      <div className="absolute inset-0 bg-black/40"></div>

      {/* Title */}
      <h1 className="relative z-10 text-3xl md:text-5xl font-bold text-white text-center px-4">
        {title}
      </h1>
    </div>
  );
}
