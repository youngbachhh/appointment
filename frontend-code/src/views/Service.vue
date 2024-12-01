<script setup>
import { formatCurrency } from '@utils/format';
import { appointmentService } from '@api/AppointmentService';
import router from '../router';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const departmentId = route.params.id;

const appointmentServices = ref([]);

const fetchAppointmentServices = async () => {
    const response = await appointmentService.getByDepartmentId(departmentId);
    appointmentServices.value = response.data.map((service, index) => ({
        key: index,
        no: index + 1,
        id: service.id,
        name: service.name,
        amount: service.amount,
    }));
};

onMounted(fetchAppointmentServices);


const columns = [
	{
		title: "#",
		dataIndex: "no",
		key: "1",
		width: 50,
	},
	{
		title: "Tên dịch vụ",
		width: 250,
		dataIndex: "name",
		key: "name",
	},
	{
		title: "Giá tiền",
		width: 150,
		dataIndex: "amount",
		key: "amount",
	},
	{
		title: "",
		key: "operation",
		width: 80,
	},
];

function goBack() {
	router.go(-1);
}
</script>

<template>
	<div class="w-4/5">
		<a-card title="Vui lòng chọn dịch vụ" :bordered="false">
			<a-table :columns="columns" :data-source="appointmentServices">
				<template #bodyCell="{ column, record }">
					<template v-if="column.key === 'operation'">
						<a-button type="primary">
							<RouterLink :to="{ name: 'appointment-date', params: record.id }">
								Đặt khám ngay
							</RouterLink>
						</a-button>
					</template>
                    <template v-if="column.key === 'amount'">
						{{ formatCurrency(record[column.dataIndex]) }}
					</template>
				</template>
			</a-table>
		</a-card>
		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>
		</div>
	</div>
</template>
