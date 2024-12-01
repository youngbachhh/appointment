import axios from "axios";

const axiosClient = axios.create({
	baseURL: import.meta.env.VITE_API_BASE_URL || "/api",
	headers: {
		"Content-Type": "application/json",
		Accept: "application/json",
	},
});

// Interceptor to handle request
axiosClient.interceptors.request.use(
	(config) => {
		const token = localStorage.getItem("token");
		if (token) config.headers.Authorization = `Bearer ${token}`;

		return config;
	},
	(error) => {
		return Promise.reject(error);
	}
);

// Interceptor to handle responses
axiosClient.interceptors.response.use(
	(response) => {
		return response.data;
	},
	(error) => {
		const { response } = error;
		const errorMessage = response?.data?.message || error.message;
		console.error("API call error:", errorMessage);

		return Promise.reject(new Error(errorMessage));
	}
);

export default axiosClient;