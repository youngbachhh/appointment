<template>
	<div class="w-full mt-[200px]">
		<a-form
			:model="formState"
			name="validate_other"
			v-bind="formItemLayout"
			@finishFailed="onFinishFailed"
			@finish="onFinish"
		>
			<a-form-item
				name="select"
				label="Đối tượng"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.select"
					placeholder="Hãy chọn đối tượng"
				>
					<a-select-option value="1">BHYT</a-select-option>
					<a-select-option value="2">Viện phí</a-select-option>
					<a-select-option value="3">Miễn phí</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item
				label="Họ và tên"
				name="username"
				:rules="[
					{ required: true, message: 'Please input your username!' },
				]"
			>
				<a-input v-model:value="formState.username" />
			</a-form-item>

			<a-form-item
				label="Điện thoại"
				name="phone"
				:rules="[
					{ required: true, message: 'Please input your username!' },
				]"
			>
				<a-input v-model:value="formState.username" />
			</a-form-item>

			<a-form-item
				label="Mã bệnh nhân"
				name="username"
				:rules="[
					{ required: true, message: 'Please input your username!' },
				]"
			>
				<a-input v-model:value="formState.username" />
			</a-form-item>

			<a-form-item
				label="Ngày sinh"
				name="birthdate"
				:rules="[
					{ required: true, message: 'Please input your username!' },
				]"
			>
				<a-input v-model:value="formState.username" />
			</a-form-item>

			<a-form-item
				label="Căn cước công dân"
				name="username"
				:rules="[
					{ required: true, message: 'Please input your username!' },
				]"
			>
				<a-input v-model:value="formState.username" />
			</a-form-item>

			<a-form-item
				name="gender"
				label="Giới tính"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.gender"
					placeholder="Hãy chọn giới tính"
				>
					<a-select-option value="1">Nam</a-select-option>
					<a-select-option value="2">Nữ</a-select-option>
					<a-select-option value="3">Khác</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item
				name="nationality"
				label="Quốc tịch"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.nationality"
					placeholder="Hãy chọn quốc tịch"
				>
					<a-select-option value="1">Việt Nam</a-select-option>
					<a-select-option value="2">Khác</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item
				name="ethnicity"
				label="Dân tộc"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.ethnicity"
					placeholder="Hãy chọn dân tộc"
				>
					<a-select-option value="1">Kinh</a-select-option>
					<a-select-option value="2">Tày</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item
				name="province"
				label="Tỉnh/Thành phố"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.province"
					placeholder="Hãy chọn Tỉnh/Thành phố"
				>
					<a-select-option value="1">Hà Nội</a-select-option>
					<a-select-option value="2">Bắc Ninh</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item name="job" label="Nghề nghiệp" has-feedback>
				<a-select
					v-model:value="formState.job"
					placeholder="Hãy chọn ngành nghề"
				>
					<a-select-option value="1">Nhân dân</a-select-option>
					<a-select-option value="2"
						>Nhân viên văn phòng</a-select-option
					>
				</a-select>
			</a-form-item>

			<a-form-item
				name="registrations"
				label="Đăng ký khám"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.registrations"
					placeholder="Các hình thức đặt khám"
				>
					<a-select-option value="1">Gói khám sức khỏe</a-select-option>
					<a-select-option value="2">Tư vấn trực tuyến</a-select-option>
					<a-select-option value="3">Đặt khám theo chuyên khoa</a-select-option>
					<a-select-option value="4">Đặt khám theo bác sĩ</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item label="Ngày khám">
				<a-date-picker />
			</a-form-item>

			<a-form-item label="Giờ khám">
				<a-time-picker
					v-model:value="value"
					:minute-step="60"
					:show-minute="false"
					:show-second="false"
				/>
			</a-form-item>

			<a-form-item label="Lý do khám" name="reason">
				<a-input v-model:value="formState.reason" />
			</a-form-item>

			<a-form-item
				name="service"
				label="Dịch vụ"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.service"
					placeholder="Hãy chọn dịch vụ"
				>
					<a-select-option value="1"
						>Khám lại cùng chuyên khoa (trong vòng 3 ngày kể từ lần
						khám liền trước theo lịch bác sĩ hẹn)</a-select-option
					>
					<a-select-option value="2">Cấp cứu</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item
				name="clinic"
				label="Phòng khám"
				has-feedback
				:rules="[{ required: true, message: 'Không được bỏ trống!' }]"
			>
				<a-select
					v-model:value="formState.clinic"
					placeholder="Hãy chọn dịch vụ"
				>
					<a-select-option value="1">Khám tổng quát</a-select-option>
					<a-select-option value="2"
						>Khám chuyên khoa</a-select-option
					>
					<a-select-option value="2">Khám phụ khoa</a-select-option>
					<a-select-option value="2">Khám nhi khoa</a-select-option>
					<a-select-option value="2">Khám cấp cứu</a-select-option>
					<a-select-option value="2"
						>Chuẩn đoạn hình ảnh</a-select-option
					>
				</a-select>
			</a-form-item>

			<a-form-item
				name="select-multiple"
				label="Select[multiple]"
				:rules="[
					{
						required: true,
						message: 'Please select your favourite colors!',
						type: 'array',
					},
				]"
			>
				<a-select
					v-model:value="formState['select-multiple']"
					mode="multiple"
					placeholder="Please select favourite colors"
				>
					<a-select-option value="red">Red</a-select-option>
					<a-select-option value="green">Green</a-select-option>
					<a-select-option value="blue">Blue</a-select-option>
				</a-select>
			</a-form-item>

			<a-form-item name="switch" label="Switch">
				<a-switch v-model:checked="formState.switch" />
			</a-form-item>

			<a-form-item name="radio-group" label="Radio.Group">
				<a-radio-group v-model:value="formState['radio-group']">
					<a-radio value="a">item 1</a-radio>
					<a-radio value="b">item 2</a-radio>
					<a-radio value="c">item 3</a-radio>
				</a-radio-group>
			</a-form-item>

			<a-form-item
				name="radio-button"
				label="Radio.Button"
				:rules="[{ required: true, message: 'Please pick an item!' }]"
			>
				<a-radio-group v-model:value="formState['radio-button']">
					<a-radio-button value="a">item 1</a-radio-button>
					<a-radio-button value="b">item 2</a-radio-button>
					<a-radio-button value="c">item 3</a-radio-button>
				</a-radio-group>
			</a-form-item>

			<a-form-item :wrapper-col="{ span: 12, offset: 6 }">
				<a-button type="primary" html-type="submit">Submit</a-button>
			</a-form-item>
		</a-form>
	</div>
</template>
<script setup>
import { reactive, ref } from "vue";

const value = ref(null);

const formItemLayout = {
	labelCol: {
		span: 6,
	},
	wrapperCol: {
		span: 14,
	},
};
const formState = reactive({
	"input-number": 3,
	"checkbox-group": ["A", "B"],
	rate: 3.5,
});
const onFinish = (values) => {
	console.log("Success:", values);
};
const onFinishFailed = (errorInfo) => {
	console.log("Failed:", errorInfo);
};
</script>
