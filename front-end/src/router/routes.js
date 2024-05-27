import LoginPage from '@/pages/LoginPage.vue'
import RegisterPage from '@/pages/RegisterPage.vue'
import TaskPage from '@/pages/TaskPage.vue'
import SummaryPage from '@/pages/SummaryPage.vue'
import NotFoundErrorPage from '@/pages/errors/NotFoundErrorPage.vue'

const routes = [
    {
        path: '/tasks',
        component: TaskPage,
        name: 'tasks'
    },
    {
        path: '/summary',
        component: SummaryPage,
        name: 'summary'
    },
    {
        path: '/login',
        component: LoginPage,
        name: 'login'
    },
    {
        path: '/register',
        component: RegisterPage,
        name: 'register'
    },
    {
        path: '/:notFound',
        component: NotFoundErrorPage,
        name: 'error.404'
    }
]

export default routes