const user = [
	{
		path: "/",
		name: "home",
        component: () => import("../views/Home.vue"),
	},
    {
        path: "/login",
        name: "login",
        component: () => import("../views/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../views/Register.vue"),
    },
    {
        path: "/registrations/clinics/:id",
        name: "registrations",
        component: () => import("../views/Registration.vue"),
    },    
    {
        path: "/departments/registrations/:id",
        name: "departments",
        component: () => import("../views/Department.vue"),
    },    
    {
        path: "/services/departments/:id",
        name: "services",
        component: () => import("../views/Service.vue"),
    },    
    {
        path: "/appointment-date/service/:id",
        name: "appointment-date",
        component: () => import("../views/AppointmentDate.vue"),
        meta: { requiresAuth: true },
    },    
    {
        path: "/profiles/user",
        name: "profiles",
        component: () => import("../views/Profile.vue"),
        meta: { requiresAuth: true },
    },    
    {
        path: "/confirm",
        name: "confirm",
        component: () => import("../views/Confirm.vue"),
    },    
    {
        path: "/payments",
        name: "payments",
        component: () => import("../views/Payment.vue"),
    },

];

export default user;
