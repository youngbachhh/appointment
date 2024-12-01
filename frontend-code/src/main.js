import { createApp } from "vue";
import axios from "axios";
import App from "./App.vue";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import "./style.css";
import router from "./router/index.js";

// import "bootstrap/dist/css/bootstrap-grid.min.css";
// import "bootstrap/dist/css/bootstrap-utilities.min.css";

import Antd from "ant-design-vue";
import "ant-design-vue/dist/reset.css";

window.axios = axios;

router.beforeEach((to, from, next) => {
	window.scrollTo(0, 0);
	next();
});

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
const app = createApp(App);
app.use(Antd);
app.config.globalProperties.$apiURL = import.meta.env.VITE_API_BASE_URL;
app.use(pinia);
app.use(router);
app.mount("#app");
