<script setup>
import {
	DeleteOutlined,
	EditOutlined,
	ArrowRightOutlined,
	ExclamationCircleOutlined,
} from "@ant-design/icons-vue";
import router from "../router";
import { ref, reactive, onMounted, createVNode } from "vue";
import { profileService } from "@api/ProfileService";
import auth from "../stores/auth";
import { Modal } from "ant-design-vue";
import { message } from 'ant-design-vue';

const labelCol = { style: { width: "150px" } };
const wrapperCol = { span: 14 };
const formItemLayout = {
	labelCol: {
		span: 6,
	},
	wrapperCol: {
		span: 14,
	},
};

const open = ref(false);
const openDelete = ref(false);
const authStore = auth();
const patients = ref(null);
const formRef = ref(null);

const hideModal = () => {
	openDelete.value = false;
};

const showMessage = (message, type) => {
  if(type === "success") {
    message.success(message);
  } else {
    message.error(message);
  }
};

const deletePatient = async (index) => {
	try {
		Modal.confirm({
			title: "Delete profile",
			icon: createVNode(ExclamationCircleOutlined),
			content: "Are you sure you want to delete this profile?",
			okText: "Confirm",
			cancelText: "Cancel",
			onOk: async () => {
				const response = await profileService.delete(
					patients.value[index].id
				);
        patients.value.splice(index, 1);
			},
		});
	} catch (error) {
		console.log("Failed to delete profile:", error);
	}
};

const fetchProfiles = async () => {
	patients.value = await profileService.getByUserId(authStore.user?.id);
	patients.value = patients.value.data;
};

onMounted(fetchProfiles);

const showModal = () => {
	open.value = true;
};

const handleOk = async () => {
	formRef.value
		.validate()
		.then(async () => {
			try {
				const response = await profileService.create(formState);
				profiles.value.push({ ...formState });
				open.value = false;
			} catch (error) {
				console.error("Failed to add profile:", error);
			}
		})
		.catch((error) => {
			console.error("Validation failed:", error);
		});
};

const formState = reactive({
	name: "",
	phone: "",
	birthdate: "",
	gender: null,
	job: null,
	ethnicity: null,
	national_id: "",
	email: "",
	province_id: null,
	address: "",
});

const rules = reactive({
	name: [{ required: true, message: "Họ và tên không được bỏ trống!" }],
	phone: [{ required: true, message: "Số điện thoại không được bỏ trống!" }],
	birthdate: [{ required: true, message: "Ngày sinh không được bỏ trống!" }],
	gender: [{ required: true, message: "Vui lòng chọn giới tính!" }],
	job: [{ required: true, message: "Vui lòng chọn nghề nghiệp!" }],
	province_id: [{ required: true, message: "Tỉnh thành không được bỏ trống!" }],
	address: [{ required: true, message: "Địa chỉ không được bỏ trống!" }],
});

function goBack() {
	router.go(-1);
}

// const patientsTest = [
// 	{
// 		id: 1,
// 		name: "Nguyễn Văn A",
// 		birthdate: "01/01/1990",
// 		phone: "0123456789",
// 		address: "Hà Nội",
// 		email: "testgmail@gmail.com",
// 	},
// 	{
// 		id: 2,
// 		name: "Nguyễn Văn B",
// 		birthdate: "01/01/1990",
// 		phone: "0123456789",
// 		address: "Hà Nội",
// 		email: "testgmail@gmai.com",
// 	},
// ];
</script>

<template>
	<div class="w-4/5">
		<a-card title="Chọn hồ sơ bệnh nhân">
			<template #extra>
				<a-button type="primary" @click="showModal">Thêm mới</a-button>
				<a-modal
					v-model:open="open"
					title="Nhập thông tin bệnh nhân"
					@ok="handleOk"
					:width="800"
				>
					<a-form
						:model="formState"
						:rules="rules"
						ref="formRef"
						:label-col="labelCol"
						:wrapper-col="wrapperCol"
						layout="horizontal"
						style="max-width: 800px"
						class="mt-5"
						labelAlign="left"
					>
						<a-form-item label="Họ và tên (có dấu)" name="name">
							<a-input v-model:value="formState.name" />
						</a-form-item>
						<a-form-item label="Số diện thoại" name="phone">
							<a-input v-model:value="formState.phone" />
						</a-form-item>
						<a-form-item label="Ngày sinh" name="birthdate">
							<a-input v-model:value="formState.birthdate" />
						</a-form-item>
						<a-form-item label="Giới tính" name="gender">
							<a-select
								v-model:value="formState.gender"
								style="width: 100%"
							>
								<a-select-option value="1">Nam</a-select-option>
								<a-select-option value="2">Nữ</a-select-option>
							</a-select>
						</a-form-item>
						<a-form-item label="Nghề nghiệp" name="job">
							<a-select
								v-model:value="formState.job"
								style="width: 100%"
							>
								<a-select-option value="1"
									>Bác sĩ</a-select-option
								>
								<a-select-option value="2"
									>Điều dưỡng</a-select-option
								>
								<a-select-option value="3"
									>Y sĩ</a-select-option
								>
								<a-select-option value="4"
									>Dược sĩ</a-select-option
								>
								<a-select-option value="5"
									>Nha sĩ</a-select-option
								>
								<a-select-option value="6"
									>Nha công</a-select-option
								>
								<a-select-option value="7"
									>Dược sĩ trung cấp</a-select-option
								>
								<a-select-option value="8"
									>Cử nhân Điều dưỡng</a-select-option
								>
								<a-select-option value="9"
									>Hộ lý</a-select-option
								>
								<a-select-option value="10"
									>Kỹ sư điện</a-select-option
								>
							</a-select>
						</a-form-item>
						<a-form-item label="CCCD/Passport" name="national_id">
							<a-input v-model:value="formState.national_id" />
						</a-form-item>
						<a-form-item label="Email" name="email">
							<a-input v-model:value="formState.email" />
						</a-form-item>
						<a-form-item label="Dân tộc" name="ethnicity">
							<a-select
								v-model:value="formState.ethnicity"
								style="width: 100%"
							>
								<a-select-option value="Kinh"
									>Kinh</a-select-option
								>
								<a-select-option value="2">Hoa</a-select-option>
								<a-select-option value="Khơ-me"
									>Khơ-me</a-select-option
								>
								<a-select-option value="Chăm"
									>Chăm</a-select-option
								>
								<a-select-option value="Thái"
									>Thái</a-select-option
								>
								<a-select-option value="Mường"
									>Mường</a-select-option
								>
								<a-select-option value="Tày"
									>Tày</a-select-option
								>
								<a-select-option value="Ba-na"
									>Ba-na</a-select-option
								>
								<a-select-option value="Ê-đê"
									>Ê-đê</a-select-option
								>
								<a-select-option value="Gia-rai"
									>Gia-rai</a-select-option
								>
							</a-select>
						</a-form-item>
						<a-form-item label="Tỉnh thành" name="province_id">
							<a-select
								v-model:value="formState.province_id"
								style="width: 100%"
							>
								<a-select-option value="01"
									>Hà Nội</a-select-option
								>
								<a-select-option value="79"
									>TP Hồ Chí Minh</a-select-option
								>
								<a-select-option value="48"
									>Đà Nẵng</a-select-option
								>
								<a-select-option value="31"
									>Hải Phòng</a-select-option
								>
								<a-select-option value="92"
									>Cần Thơ</a-select-option
								>
								<a-select-option value="22"
									>Quảng Ninh</a-select-option
								>
								<a-select-option value="75"
									>Thừa Thiên Huế</a-select-option
								>
								<a-select-option value="56"
									>Khánh Hòa</a-select-option
								>
								<a-select-option value="74"
									>Bình Dương</a-select-option
								>
								<a-select-option value="75"
									>Đồng Nai</a-select-option
								>
								<a-select-option value="40"
									>Nghệ An</a-select-option
								>
								<a-select-option value="38"
									>Thanh Hóa</a-select-option
								>
								<a-select-option value="49"
									>Quảng Nam</a-select-option
								>
								<a-select-option value="68"
									>Lâm Đồng</a-select-option
								>
								<a-select-option value="91"
									>Kiên Giang</a-select-option
								>
								<a-select-option value="94"
									>Sóc Trăng</a-select-option
								>
							</a-select>
						</a-form-item>
						<a-form-item label="Địa chỉ hiện tại" name="address">
							<a-input v-model:value="formState.address" />
						</a-form-item>
					</a-form>
				</a-modal>
			</template>
			<a-row v-if="patients && patients.length" :gutter="24">
				<a-col
					v-for="(patient, index) in patients"
					:key="index"
					:span="12"
				>
					<a-card :title="patient.name">
						<a-form
							:model="formState"
							name="validate_other"
							v-bind="formItemLayout"
							labelAlign="left"
						>
							<a-form-item label="Ngày sinh">
								<span class="ant-form-text">{{
									patient.birthdate
								}}</span>
							</a-form-item>
							<a-form-item label="Số điện thoại">
								<span class="ant-form-text">{{
									patient.phone
								}}</span>
							</a-form-item>
							<a-form-item label="Địa chỉ">
								<span class="ant-form-text">{{
									patient.address
								}}</span>
							</a-form-item>
							<a-form-item label="Email">
								<span class="ant-form-text">{{
									patient.email
								}}</span>
							</a-form-item>
						</a-form>
						<template #actions>
							<DeleteOutlined
								key="delete"
								:style="{ color: 'red' }"
								@click="deletePatient(index)"
							/>
							<EditOutlined
								key="edit"
								:style="{ color: 'cyan' }"
								@click="editPatient(index)"
							/>
							<RouterLink
								:to="{
									name: 'confirm',
									query: {
										patientId: patient.id,
										serviceId: $route.query.serviceId,
										selectedDate: $route.query.selectedDate,
										timeSlot: $route.query.timeSlot,
									},
								}"
							>
								<ArrowRightOutlined
									key="ellipsis"
									:style="{ color: '#2563eb' }"
								/>
							</RouterLink>
						</template>
					</a-card>
				</a-col>
			</a-row>
		</a-card>

		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>
		</div>

		<a-modal
			v-model:open="openDelete"
			title="Are you sure you want to delete this profile?"
			ok-text="Confirm"
			cancel-text="Cancel"
			@ok="hideModal"
		>
		</a-modal>
	</div>
</template>
