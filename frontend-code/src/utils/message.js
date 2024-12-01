import { message } from "ant-design-vue";

// alert message

const messageAnt = {
	success: (value) => {
		value ? message.success(value) : message.success("Thao tác thành công");
	},
	error: (value) => {
		value ? message.error(value) : message.error("Thao tác thất bại");
	},
	warning: (value) => {
		value ? message.warning(value) : message.warning("Cảnh báo!");
	},
};

export default messageAnt;
