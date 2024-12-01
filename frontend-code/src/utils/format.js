export function formatDate(dateTimeString) {
    const dateTime = new Date(dateTimeString);

    // Lấy thông tin ngày, tháng, năm
    const date = dateTime.toLocaleDateString("vi-VN", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });

    // Lấy thông tin giờ, phút, giây
    const time = dateTime.toLocaleTimeString("vi-VN", { hour12: false });

    return `${date} ${time}`;
}

export function formatCurrency(value) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(value);
}

