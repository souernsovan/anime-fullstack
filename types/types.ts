export interface Episode {
  id: number;
  title: string;
  episode_number: number;
  video_url: string;
  thumbnail?: string | null;
  anime: Anime;
}

export interface Anime {
  id: number;
  title: string;
  description?: string;
  studio?: string;
  release_year?: number;
  rating?: number;
  poster?: string | null;
  episodes?: Episode[];
}