<template>
	<a-config-provider
		:theme="{
			token: {
				colorPrimary: data.colorPrimary,
				borderRadius: `${data.borderRadius}px`,
				fontFamily: 'system-ui',
			},
		}"
	>
		<div class="flex items-center justify-center  mt-[150px]">
			<router-view></router-view>
		</div>
	</a-config-provider>

	<!-- begin::Back to top -->
	<div class="back-to-top">
		<a-back-top :style="{ right: '6px' }">
			<template #icon>
				<ArrowUpOutlined />
			</template>
		</a-back-top>
	</div>
	<!-- end::Back to top -->
</template>

<script setup>
import { ArrowUpOutlined } from "@ant-design/icons-vue";
import { ref } from "vue";
import { theme } from "ant-design-vue";
import router from "./router";

// color theme
const defaultData = {
	borderRadius: 6,
	colorPrimary: "#DCA8AB",
};
const data = ref(defaultData);
const { token } = theme.useToken();
</script>

<style></style>
