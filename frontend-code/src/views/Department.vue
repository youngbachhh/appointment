<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { departmentService } from "@api/DepartmentService";
import router from "../router";

const value = ref(null);
const departments = ref([]);
const route = useRoute();

const registrationId = route.params.id;

const fetchDepartments = async () => {
	const response =
		await departmentService.getByRegistrationId(registrationId);
	departments.value = response.data.map((department) => ({
		value: department.id,
		label: department.name,
	}));
};

const filterOption = (input, option) => {
	return option.label.toLowerCase().includes(input.toLowerCase());
};

const goBack = () => {
	router.go(-1);
};

onMounted(fetchDepartments);
</script>

<template>
	<div class="w-4/5">
		<a-card title="Vui lòng chọn chuyên khoa" :bordered="false">
			<a-select
				v-model:value="value"
				style="width: 100%"
				placeholder="Tìm nhanh chuyên khoa"
				:options="departments"
				:showSearch="true"
				:filterOption="filterOption"
			></a-select>
		</a-card>

		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>

			<a-button type="primary" v-if="value">
				<RouterLink :to="{ name: 'services', params: value }">
					Tiếp tục
				</RouterLink>
			</a-button>
		</div>
	</div>
</template>
