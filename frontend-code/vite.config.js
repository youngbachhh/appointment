import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [vue()],
	resolve: {
		alias: {
			"@api": path.resolve(__dirname, "src/api"),
            "@views": path.resolve(__dirname, "src/views"),
            "@utils": path.resolve(__dirname, "src/utils"),
            "@stores": path.resolve(__dirname, "src/stores"),
		},
	},
});
