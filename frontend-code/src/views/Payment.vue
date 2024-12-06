<script setup>
import { SmileTwoTone, QuestionCircleTwoTone } from "@ant-design/icons-vue";

const onFinish = () => {
	console.log("finished!");
};
const deadline = Date.now() + 12 * 60 * 60 * 20 * 2;

const endPoint = "https://test-payment.momo.vn/v2/gateway/api/create";
const partnerCode = "MOMOBKUN20180529";
const accessKey = "klm05TvNBzhg7h7j";
const secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
const orderInfo = "orderInfo";
const amount = "10000";
const orderId = now.getTime();
const redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
const ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
const extraData = "";

const rawSignature = `partnerCode=${partnerCode}&accessKey=${accessKey}&requestId=${orderId}&amount=${amount}&orderId=${orderId}&orderInfo=${orderInfo}&returnUrl=${redirectUrl}&notifyUrl=${ipnUrl}&extraData=${extraData}`;

const crypto = require("crypto");
const signature = crypto
  .createHmac("sha256", secretKey)
  .update(rawSignature)
  .digest("hex");

const data = {
  partnerCode,
  accessKey,
  requestId: orderId,
  amount,
  orderId,
  orderInfo,
  returnUrl: redirectUrl,
  notifyUrl: ipnUrl,
  extraData,
  requestType: "captureMoMoWallet",
  signature,
};

const fetchData = async () => {
  try {
    const response = await fetch(endPoint, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const result = await response.json();
    console.log(result);
  } catch (error) {
    console.error("Error:", error);
  }
};

fetchData();



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
