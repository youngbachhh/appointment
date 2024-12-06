const Resource = {
    VI: {
        LANGUAGE: "VI",
        ERROR: {
            ERROR_MSG: "Có lỗi xảy ra, vui lòng thử lại sau!",
            ERROR_VALIDATE: "Dữ liệu không hợp lệ!",
            ERROR_DOB: "Ngày sinh không được lớn hơn ngày hiện tại",
            UNDEFINED: "Lỗi không xác định",
        },
        STATUS_CODE: {
            OK: "200 OK",
            BAD_REQUEST: "400 BAD_REQUEST: Yêu cầu không hợp lệ",
            UNAUTHORIZED: "401 UNAUTHORIZED: Không có quyền truy cập",
            FORBIDDEN: "403 FORBIDDEN: Không được phép truy cập",
            NOT_FOUND: "404 NOT_FOUND: Không tìm thấy",
            INTERNAL_SERVER: "500 INTERNAL_SERVER: Lỗi máy chủ",
        },
        SUCCESS: {
            SUCCESS_SAVE: "Lưu thành công!",
            SUCCESS_DELETE: "Xóa thành công!",
        },
        DELETE: {
            DELETE_CONFIRM: "Bạn có chắc chắn muốn xóa?",
            DELETE_TITLE: "Xóa",
        },
        WARNING: {
            WARNING_CONFIRM: "Bạn chưa nhập đủ thông tin",
            WARNING_TITLE: "Hủy",
        },
        TITLE: {
            FORM_ADD: "THÔNG TIN NHÂN VIÊN",
            AVATAR_INFO: "Vui lòng chọn ảnh có định dạng .jpg .jpeg .png .gif",

        },
        NEWSTYPE: {
            ALL: "Tất cả",
            SELL: "Bán",
            RENT: "Thuê",
        },
        POSITION: {
            ALL: "Tất cả",
            ADMIN: "Admin",
            DISTRIBUTOR: "Đầu chủ",
            SALE: "Sales",
        },
        STATUS: {
            ALL: "Tất cả",
            SOLD: "Đã bán",
            UNSOLD: "Còn hàng",
            ONLINE: "Online",
            OFFLINE: "Offline",
        },
        BUTTON: {
            SAVE: "Lưu",
            CANCEL: "Hủy",
            ADD: "Thêm mới",
            UPDATE: "Sửa",
            DELETE: "Xóa",
            SEARCH: "Tìm kiếm",
            REFRESH: "Làm mới",
        },
    },
};

export default Resource;
