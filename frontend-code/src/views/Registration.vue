<script setup>
import { onMounted, ref } from "vue";
import { registrationService } from "@api/RegistrationService";
import { useRoute } from "vue-router";
import router from "../router";

const route = useRoute("registrations");
const clinicId = route.params.id;

const registrations = ref([]);

const fetchRegistrations = async () => {
	registrations.value = await registrationService.getByClinicId(clinicId);
};

function goBack() {
	router.go(-1);
}

onMounted(fetchRegistrations);
</script>

<template>
	<div class="w-4/5" style="background-color: #ececec; padding: 20px">
		<div class="title my-5">Các hình thức đặt khám</div>
		<a-row :gutter="12" class="gap-2">
			<a-col
				v-for="(registration, index) in registrations.data"
				:key="index"
				:span="11"
			>
				<a-card :bordered="false">
					<RouterLink
						:to="{
							name: 'departments',
							params: { id: registration.id },
						}"
					>
						<div slot="title">{{ registration.name }}</div>
					</RouterLink>
				</a-card>
			</a-col>
		</a-row>

		<div class="flex justify-between mt-5">
			<a-button @click="goBack"> Quay lại </a-button>
		</div>
	</div>
</template>
