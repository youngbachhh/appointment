<script setup>
import { appointmentService } from "@api/AppointmentService";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import auth from "../stores/auth";

const route = useRoute();
const router = useRouter();
const serviceId = route.params.id;

const store = auth();
const userId = store.getUser.id;

const selectedDate = ref(null);
const value = ref("1");

const disabledDate = (current) => {
	return current && current < new Date().setHours(24, 0, 0, 0);
};

function goBack() {
    // console.log(selectedDate.value.toISOString().split('T')[0]);
	router.go(-1);
}
</script>

<template>
	<div class="w-4/5">
		<a-card title="Vui lòng chọn ngày khám" :bordered="false">
			<div class="date">
				<a-space direction="vertical" :size="12">
					<a-date-picker
						v-model:value="selectedDate"
						:disabledDate="disabledDate"
					/>
				</a-space>
			</div>

			<div class="time mt-8" v-if="selectedDate">
				<div class="am-picker mb-2">Buổi sáng</div>
				<a-radio-group
					v-model:value="value"
					button-style="solid"
					class="space-x-3"
				>
					<a-radio-button value="8">08:00 - 09:00</a-radio-button>
					<a-radio-button value="9">09:00 - 10:00</a-radio-button>
					<a-radio-button value="10">10:00 - 11:00</a-radio-button>
					<a-radio-button value="11">11:00 - 12:00</a-radio-button>
				</a-radio-group>

				<a-divider></a-divider>

				<div class="pm-picker mb-2">Buổi chiều</div>
				<a-radio-group
					v-model:value="value"
					button-style="solid"
					class="space-x-3"
				>
					<a-radio-button value="12">12:00 - 13:00</a-radio-button>
					<a-radio-button value="13">13:00 - 14:00</a-radio-button>
					<a-radio-button value="14">14:00 - 15:00</a-radio-button>
					<a-radio-button value="15">15:00 - 16:00</a-radio-button>
					<a-radio-button value="16">16:00 - 17:00</a-radio-button>
				</a-radio-group>
			</div>
		</a-card>

		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>

			<a-button type="primary" v-if="value && selectedDate">
				<RouterLink
					:to="{
						name: 'profiles',
						query: {
							serviceId: serviceId,
							selectedDate: selectedDate.value ? selectedDate.value.toISOString().split('T')[0] : null,
							timeSlot: value,
						},
					}"
				>
					Tiếp tục
				</RouterLink>
			</a-button>
		</div>
	</div>
</template>
