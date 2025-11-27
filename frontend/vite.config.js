import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  root: './', 

  plugins: [vue()],
  server: {
    port: 3000,
    proxy: {
      '/api': {
        target: 'http://localhost:8080', 
        changeOrigin: true,
      }
    }
  },
  

  build: {

    outDir: 'dist',

    rollupOptions: {
        input: 'index.html' 
    }
  }
})