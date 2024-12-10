import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    vue(),
    laravel(),
  ],
  build: {
    rollupOptions: {
      external: ['fsevents'], // Tentukan fsevents sebagai eksternal
    },
  },
});

