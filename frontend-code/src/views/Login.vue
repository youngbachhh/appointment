<template>
    <div class="w-full mt-[200px]">
        <a-form
            :model="formState"
            name="normal_login"
            @finish="onFinish"
            @finishFailed="onFinishFailed"
            class="login-form w-1/2 mx-auto"
            labelAlign="left"
        >
            <a-form-item
                label="Username"
                name="username"
                :rules="[
                    { required: true, message: 'Không được bỏ trống tên đăng nhập!' },
                ]"
            >
                <a-input v-model:value="formState.username">
                    <template #prefix>
                        <UserOutlined class="site-form-item-icon" />
                    </template>
                </a-input>
            </a-form-item>

            <a-form-item
                label="Password"
                name="password"
                :rules="[
                    { required: true, message: 'Không được bỏ trống mật khẩu!' },
                ]"
            >
                <a-input-password v-model:value="formState.password">
                    <template #prefix>
                        <LockOutlined class="site-form-item-icon" />
                    </template>
                </a-input-password>
            </a-form-item>

            <a-form-item>
                <a-button
                    :disabled="disabled"
                    type="primary"
                    html-type="submit"
                    class="login-form-button"
                >
                    Login
                </a-button>
                Or
                <router-link to="/register">Register!</router-link>
            </a-form-item>
        </a-form>
    </div>
</template>

<script setup>
import { reactive, computed } from "vue";
import { UserOutlined, LockOutlined } from "@ant-design/icons-vue";
import { authService } from "@api/AuthService";
import auth from "../stores/auth";
import { useRouter, useRoute } from "vue-router";

const formState = reactive({
    username: "",
    password: "",
    remember: true,
});
const authStore = auth();
const router = useRouter();
const route = useRoute();

const onFinish = async (values) => {
    try {
        const { accessToken, user } = await authService.login(values.username, values.password);
        authStore.login(accessToken, user);
        const redirect = route.query.redirect || { name: 'profiles', params: { id: user.id } };
        router.push(redirect);
    } catch (error) {
        console.error("Login failed:", error);
    }
};

const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
};

const disabled = computed(() => {
    return !(formState.username && formState.password);
});
</script>

<style scoped>
#components-form-demo-normal-login .login-form {
    max-width: 300px;
}
#components-form-demo-normal-login .login-form-forgot {
    float: right;
}
#components-form-demo-normal-login .login-form-button {
    width: 100%;
}
</style>