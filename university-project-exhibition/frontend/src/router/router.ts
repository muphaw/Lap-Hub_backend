import { createRouter, createWebHistory } from "vue-router";

// Page Components
import UserDetail from "@/pages/users/UserDetail.vue";

import Home from "@/pages/home/Home.vue";
import ProjectDetail from "@/pages/home/ProjectDetail.vue";
import Users from "@/pages/users/Users.vue";

import Dashboard from "@/pages/dashboard/Dashboard.vue";
import CreateProject from "@/pages/home/CreateProject.vue";
import Login from "@/pages/auth/Login.vue";
import Register from "@/pages/auth/Register.vue";

const routes = [
  { path: "/", name: "Home", component: Home },
  { path: "/project/:id", name: "ProjectDeatil", component: ProjectDetail },
  { path: "/users", name: "Users", component: Users },
  { path: "/user/:username", name: "UserDetail", component: UserDetail },
  { path: "/dashboard", name: "Dashboard", component: Dashboard },
  { path: "/create", component: CreateProject },
  { path: "/login", component: Login },
  { path: "/register", component: Register },
  {
    path: "/users",
    name: "Users",
    component: Users,
  },
  {
    path: "/user/:id",
    name: "UserDetail",
    component: UserDetail,
    props: true, // Enables access to `route.params.id` as a prop
  },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/:pathMatch(.*)*",
    redirect: "/", // Optional fallback
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
