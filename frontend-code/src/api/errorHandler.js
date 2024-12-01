const handleApiError = (error) => {
	console.error("API call failed:", error.message);
	throw error;
};

export default handleApiError;
