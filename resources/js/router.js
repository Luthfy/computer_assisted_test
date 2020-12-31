import Vue from 'vue'
import VueRouter from 'vue-router'

// import Link from './pages/Theme.vue'
// import Display from './pages/Display.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/participant/app',
            component: () => import('./Layouts/MainLayout.vue'),
            children: [
                {
                    path: 'exam/:codeExam',
                    component: () => import('./Pages/Exam.vue'),
                    name: 'exam'
                },
                {
                    path: 'exam/:codeExam/:id',
                    component: () => import('./Pages/ExamQuestion.vue'),
                    name: 'exam-question'
                }
            ]
        }
    ]
})

export default router
