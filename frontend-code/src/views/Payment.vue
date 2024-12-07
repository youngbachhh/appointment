<script setup>
import { SmileTwoTone, QuestionCircleTwoTone } from "@ant-design/icons-vue";
import { appointmentPaymentService } from "@api/AppointmentPaymentService";
import { onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const fetchVnpayUrl = async () => {
  const response = await appointmentPaymentService.getVnpayUrl();
  console.log(response);
  router.push(response.data.url);
};

const onFinish = () => {
  router.push("/appointment");
};

onMounted(async () => {
  await fetchVnpayUrl();
});

</script>

<template>
	<div>
		<a-card hoverable style="width: 800px">
			<template #cover>
				<a-qrcode
					error-level="H"
					value="https://www.antdv.com"
					icon="https://www.antdv.com/assets/logo.1ef800a8.svg"
					:size="300"
				/>
			</template>
			<a-card-meta title="Quét QR thanh toán">
				<template #description>
					<a-row :gutter="16">
						<a-col :span="12">
							<a-statistic-countdown
								:value="deadline"
								style="margin-right: 50px"
								@finish="onFinish"
							>
								<template #title>
									<span>Thời gian còn lại</span>
									<a-tooltip placement="right">
										<template #title>
											<span>hurry up!</span>
										</template>
										<question-circle-two-tone
											style="margin-left: 5px"
										/>
									</a-tooltip>
								</template>
							</a-statistic-countdown>
						</a-col>
					</a-row>
				</template>
			</a-card-meta>
		</a-card>
		<a-result title="Tuyệt vời, bạn đã đăng ký lịch hẹn thành công!">
			<template #icon>
				<smile-twoTone />
			</template>
			<template #extra>
				<a-button type="primary">Hoàn tất</a-button>
			</template>
		</a-result>
	</div>
</template>
