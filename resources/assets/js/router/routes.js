export default ({authGuard, guestGuard}) => [
    {path: '/', name: 'welcome', component: require('~/pages/welcome.vue')},

    // Authenticated routes.
    ...authGuard([
        {path: '/home', name: 'home', component: require('~/pages/home.vue')},
        {path: '/basic', name: 'basic', component: require('~/pages/auth/businessBasic.vue')},
        {path: '/success', name: 'success', component: require('~/pages/auth/success.vue')},

        {
            path     : '/settings',
            component: require('~/pages/settings/index.vue'),
            children : [
                {path: '', redirect: {name: 'settings.profile'}},
                {path: 'profile', name: 'settings.profile', component: require('~/pages/settings/profile.vue')},
                {path: 'merchant', name: 'settings.merchant', component: require('~/pages/settings/merchant.vue')},
                {path: 'password', name: 'settings.password', component: require('~/pages/settings/password.vue')}
            ]
        },
        {path: '/basic', name: 'basic', component: require('~/pages/auth/businessBasic.vue')},
        {path: '/info', name: 'info', component: require('~/pages/auth/businessInfo.vue')},
        {path: '/sale', name: 'sale', component: require('~/pages/auth/saleValidation.vue')},
        {path: '/success', name: 'success', component: require('~/pages/auth/success.vue')},
        {path: '/payCode', name: 'payCode', component: require('~/pages/auth/payCode.vue')},
    ]),

    // Guest routes.
    ...guestGuard([
        {path: '/login', name: 'login', component: require('~/pages/auth/login.vue')},
        {path: '/register', name: 'register', component: require('~/pages/auth/register.vue')},
        {path: '/password/reset', name: 'password.request', component: require('~/pages/auth/password/email.vue')},
        {path: '/password/reset/:token', name: 'password.reset', component: require('~/pages/auth/password/reset.vue')},
        {path: '/bind', name: 'bind', component: require('~/pages/auth/bind.vue')},
        {path: '/sale', name: 'sale', component: require('~/pages/auth/saleValidation.vue')},

    ]),

    {path: '*', component: require('~/pages/errors/404.vue')}
]
