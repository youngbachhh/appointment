const Enum = {
    FORM_MODE: {
        VIEW: 0, //Mặc đinh
        ADD: 1, //Thêm mới
        UPDATE: 2, //Sửa
    },
    POPUP_TYPE: {
        DELETE: 0, //Xóa
        WARNING: 1, //Cảnh báo
        INFO: 2, //Thông tin
    },
    TOAST_TYPE: {
        SUCCESS: 0, //Thành công
        ERROR: 1, //Lỗi
        WARNING: 2, //Cảnh báo
        INFO: 3, //Thông tin
    },
    FORMAT_TYPE: {
        DATE: 0, //Định dạng ngày tháng
        POSITION: 1, //Định dạng vị trí
        STATUS: 2, //Định dạng trạng thái
    },
    STATUS_CODE: {
        OK: 200, // Thành công
        BAD_REQUEST: 400, // Lỗi dữ liệu đầu vào
        UNAUTHORIZED: 401, // Không có quyền truy cập
        FORBIDDEN: 403, // Không tìm thấy trang
        NOT_FOUND: 404, // Không tìm thấy trang
        INTERNAL_SERVER: 500, // Lỗi server
    },
};

export default Enum;
