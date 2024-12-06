<script setup>
import { ref, reactive, onMounted } from "vue";
import { clinicService } from "@api/ClinicService";

const clinics = ref([]);

const fetchClinics = async () => {
    clinics.value = await clinicService.getAll();
};

onMounted(fetchClinics);

</script>

<template>
	<div class="w-4/5" style="background-color: #ececec; padding: 20px">
		<a-row :gutter="16">
			<a-col :span="12" v-for="clinic in clinics.data" :key="clinic.title" class="my-2">
				<a-card :title="clinic.name" :bordered="false" class="h-[200px]">
					<div class="description">
                        <p class="leading-6 min-h-12">
							{{ clinic.address }}
						</p>
					</div>
					<div class="space-x-5">
						<a-button>Xem chi tiết</a-button>
						<a-button type="primary"
							><RouterLink :to="{ name: 'registrations', params: { id: clinic.id } }">
								Đặt khám ngay
							</RouterLink></a-button
						>
					</div>
				</a-card>
			</a-col>
		</a-row>
	</div>
</template>
