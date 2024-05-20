import { isToday } from 'date-fns';
import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/pages/home-page/HomePage.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () =>
        import('@/pages/auth-pages/register-page/RegisterPage.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/pages/auth-pages/login-page/LoginPage.vue')
    },
    {
      path: '/plans',
      name: 'plans',
      component: () => import('@/pages/plans-page/PlansPage.vue'),
      redirect: '/plans/today',
      children: [
        {
          name: 'plans.today',
          path: 'today',
          component: () => import('@/components/plans/plans-day/PlansDay.vue')
        },
        {
          name: 'plans.day',
          path: ':year/:month/:day',
          component: () => import('@/components/plans/plans-day/PlansDay.vue')
        },
        {
          name: 'plans.weeks',
          path: 'weeks',
          component: () =>
            import('@/components/plans/plans-weeks/PlansWeeks.vue')
        },
        {
          name: 'plans.calendar',
          path: 'calendar',
          component: () =>
            import('@/components/plans/plans-calendar/PlansCalendar.vue')
        }
      ]
    },
    {
      path: '/achievements',
      name: 'achievements',
      component: () => import('@/pages/achievements-page/AchievementsPage.vue')
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (to.name === 'plans.day') {
    const { year, month, day } = to.params;

    if (isToday(`${year}-${month}-${day}`)) {
      next({ name: 'plans.today' });
    } else next();
  } else next();
});

export default router;
