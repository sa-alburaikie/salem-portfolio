import { createRouter,createWebHistory } from 'vue-router';
import Index from '../components/pages/Index.vue';
import NotFoundPage from '../components/NotFoundPage.vue';
import AdminHomeIndex from '../components/admin/home/index.vue'
import AdminAboutPage from '../components/admin/abouts/Edit.vue'
import AdminMediaIndex from '../components/admin/media/Index.vue'
import AdminServicesIndex from '../components/admin/services/Index.vue'
import AdminSkillsIndex from '../components/admin/skills/Index.vue'
import AdminEducationsIndex from '../components/admin/educations/index.vue'
import AdminExperiencesIndex from '../components/admin/experiences/Index.vue'
import AdminProjectsIndex from '../components/admin/projects/Index.vue'
import AdminProjectsForm from '../components/admin/projects/Form.vue'
import AdminTestmonialsIndex from '../components/admin/testmonials/Index.vue'
import AdminTestmonialsCreate from '../components/admin/testmonials/Form.vue'
import AdminMessagesIndex from '../components/admin/messages/Index.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Index,
    },
    {
        path: '/admin/dashboard',
        name: 'admin.home.index',
        component: AdminHomeIndex,
    },
    {
        path: '/admin/abouts',
        name: 'admin.abouts',
        component: AdminAboutPage,
    },
    {
        path: '/admin/media',
        name: 'admin.media.index',
        component: AdminMediaIndex,
    },
    {
        path: '/admin/services',
        name: 'admin.media.services',
        component: AdminServicesIndex,
    },
    {
        path: '/admin/skills',
        name: 'admin.skills.index',
        component: AdminSkillsIndex,
    },
    {
        path: '/admin/educations',
        name: 'admin.educations.index',
        component: AdminEducationsIndex,
    },
    {
        path: '/admin/experiences',
        name: 'admin.experiences.index',
        component: AdminExperiencesIndex,
    },
    {
        path: '/admin/projects',
        name: 'admin.projects.index',
        component: AdminProjectsIndex,
    },
    {
        path: '/admin/projects/create',
        name: 'admin.projects.create',
        component: AdminProjectsForm,
    },
    {
        path: '/admin/projects/:id/edit',
        name: 'admin.projects.edit',
        component: AdminProjectsForm,
    },
    {
        path: '/admin/testmonials',
        name: 'admin.testmonials',
        component: AdminTestmonialsIndex,
    },
    {
        path: '/admin/testmonials/create',
        name: 'admin.testmonials.create',
        component: AdminTestmonialsCreate,
    },
    {
        path: '/admin/testmonials/:id/edit',
        name: 'admin.testmonials.edit',
        component: AdminTestmonialsCreate,
    },
    {
        path: '/admin/messages',
        name: 'admin.messages',
        component: AdminMessagesIndex,
    },
    {
        path: '/:any(.*)*',
        name: 'notFoundPage',
        component: NotFoundPage,
    },
]
const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'nav-active',
    routes
})

export default router