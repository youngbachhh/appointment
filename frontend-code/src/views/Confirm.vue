<script setup>
import { ref, reactive, onMounted } from "vue";
import { formatCurrency } from "@utils/format";
import { appointmentService } from "@api/AppointmentService";
import { profileService } from "@api/ProfileService";
import { patientAppointmentService } from "@api/PatientAppointmentService";
import { useRoute, useRouter } from "vue-router";
import auth from "../stores/auth";
import crypto from "crypto-js";

const route = useRoute();
const router = useRouter();
const authStore = auth();

// table
const columns = [
	{
		title: "#",
		dataIndex: "no",
		key: "1",
		width: 50,
	},
	{
		title: "Chuyên khoa",
		width: 200,
		dataIndex: "department",
		key: "department",
	},
	{
		title: "Dịch vụ",
		width: 200,
		dataIndex: "service",
		key: "service",
	},
	{
		title: "Thời gian khám",
		width: 200,
		dataIndex: "time",
		key: "time",
	},
	{
		title: "Tiền khám",
		width: 200,
		dataIndex: "price",
		key: "price",
	},
];

const data = ref([]);
const patients = ref([]);
const serviceId = route.query.serviceId;
const timeSlot = route.query.timeSlot;
const selectedDate = route.query.selectedDate;

const fetchAppointmentServices = async () => {
	const response = await appointmentService.getById(serviceId);
	data.value.push({
		key: 0,
		no: 1,
		department: response.data.department.name,
		service: response.data.name,
		time: response.data.amount,
		price: formatCurrency(response.data.amount),
	});
};

const patientId = route.query.patientId;
const fetchProfiles = async () => {
	patients.value = await profileService.getById(patientId);
	patients.value = patients.value.data;
};

onMounted(async () => {
	await Promise.all([fetchAppointmentServices(), fetchProfiles()]);
});

// form
const formItemLayout = {
	labelCol: {
		span: 6,
	},
	wrapperCol: {
		span: 14,
	},
};

const formState = reactive({});

const onFinish = (values) => {
	console.log("Success:", values);
};
const onFinishFailed = (errorInfo) => {
	console.log("Failed:", errorInfo);
};

function goBack() {
	router.go(-1);
}

const submit = async () => {
	const response = await patientAppointmentService.create({
		profile_id: patientId,
		service_id: serviceId,
		time_slot: timeSlot,
		date: selectedDate,
		user_id: authStore.user.id,
	});

	console.log(response.data);

	router.push({
		name: "payments",
		query: {
			appointment: response.data.id,
		},
	});
};

const deadline = Date.now() + 12 * 60 * 60 * 20 * 2;
</script>

<template>
	<div class="w-4/5">
		<a-card title="Xác nhận thông tin khám">
			<a-table :columns="columns" :data-source="data">
				<template #bodyCell="{ column, record }">
					<template v-if="column.key === 'time'">
						<span v-html="record[column.dataIndex]"></span>
					</template>
				</template>
			</a-table>
		</a-card>

		<br />

		<a-card title="Thông tin bệnh nhân">
			<a-form
				:model="formState"
				name="validate_other"
				v-bind="formItemLayout"
				@finishFailed="onFinishFailed"
				@finish="onFinish"
				labelAlign="left"
			>
				<a-form-item label="Họ và tên">
					<span class="ant-form-text">{{ patients.name }}</span>
				</a-form-item>
				<a-form-item label="Ngày sinh">
					<span class="ant-form-text">{{ patients.birthdate }}</span>
				</a-form-item>
				<a-form-item label="Số điện thoại">
					<span class="ant-form-text">{{ patients.phone }}</span>
				</a-form-item>
				<a-form-item label="Địa chỉ">
					<span class="ant-form-text">{{ patients.address }}</span>
				</a-form-item>
				<a-form-item label="Email">
					<span class="ant-form-text">{{ patients.email }}</span>
				</a-form-item>
			</a-form>
		</a-card>

		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>

			<a-button type="primary" @click="submit"> Xác nhận </a-button>
		</div>
	</div>
</template>
