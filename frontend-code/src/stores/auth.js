import { defineStore } from "pinia";

export const auth = defineStore({
	id: "auth",
    state: () => ({
        token: localStorage.getItem("token") || "",
        user: JSON.parse(localStorage.getItem("user")) || {},
    }),
	getters: {
		isLoggedIn: (state) => !!state.token,
		getUser: (state) => state.user,
	},
	actions: {
		login(token, user) {
			this.token = token;
			this.user = user;
			localStorage.setItem("token", token);
            localStorage.setItem("user", JSON.stringify(user));
		},
		logout() {
			this.token = "";
			this.user = {};
			localStorage.removeItem("token");
			localStorage.removeItem("user");
		},
	},
});

export default auth;
