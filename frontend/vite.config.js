import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  // Ajout de base: '/' pour être sûr du chemin absolu sur Amplify
  base: '/', 
  root: './', 
  plugins: [vue()],
  // ... (section server inchangée)
  
  build: {
    outDir: 'dist',
    // SUPPRIMER TOUTE LA SECTION rollupOptions
    // Vite détecte main.js automatiquement comme point d'entrée.
  }
})