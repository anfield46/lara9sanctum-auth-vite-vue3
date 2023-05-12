import { createWebHistory, createRouter } from 'vue-router'
import store from '../store'

/* Guest Component */
const Login = () => import('../components/Login.vue')
const Register = () => import('../components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('../components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('../components/Dashboard.vue')
const GasAlam = () => import('../components/ms_gasalam/GasAlam.vue')
const Coal = () => import('../components/ms_coal/Coal.vue')
const IPPU = () => import('../components/ms_ippu/Ippu.vue')
const LimbahCair = () => import('../components/ms_limbahcair/LimbahCair.vue')
const Fugitive = () => import('../components/ms_fugitive/Fugitive.vue')
const RefrigerantPabrik = () => import('../components/ms_refrigerantpabrik/RefrigerantPabrik.vue')
const RefrigerantNonPabrik = () => import('../components/ms_refrigerantnonpabrik/RefrigerantNonPabrik.vue')
const DaratGasoline = () => import('../components/ms_daratgasoline/DaratGasoline.vue')
const DaratSolar = () => import('../components/ms_daratsolar/DaratSolar.vue')
const IndirectEmissionKdm = () => import('../components/ms_indirectemissionkdm/IndirectEmissionKdm.vue')
const Penerbangan = () => import('../components/ms_penerbangan/Penerbangan.vue')
const Pergudangan = () => import('../components/ms_pergudangan/Pergudangan.vue')
const DistribusiKapal = () => import('../components/ms_distribusikapal/DistribusiKapal.vue')
const NpkUrea = () => import('../components/ms_npkurea/NpkUrea.vue')
const SampahDomestik = () => import('../components/ms_sampahdomestik/SampahDomestik.vue')
/* Authenticated Component */

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
            {
                name: "gasalam",
                path: '/gasalam',
                component: GasAlam,
                meta: {
                    title: `gasalam`
                }
            },
            {
                name: "coal",
                path: '/coal',
                component: Coal,
                meta: {
                    title: `coal`
                }
            },
            {
                name: "ippu",
                path: '/ippu',
                component: IPPU,
                meta: {
                    title: `ippu`
                }
            },
            {
                name: "limbahcair",
                path: '/limbahcair',
                component: LimbahCair,
                meta: {
                    title: `limbahcair`
                }
            },
            {
                name: "fugitive",
                path: '/fugitive',
                component: Fugitive,
                meta: {
                    title: `fugitive`
                }
            },
            {
                name: "refrigerantpabrik",
                path: '/refrigerantpabrik',
                component: RefrigerantPabrik,
                meta: {
                    title: `refrigerantpabrik`
                }
            },
            {
                name: "refrigerantnonpabrik",
                path: '/refrigerantnonpabrik',
                component: RefrigerantNonPabrik,
                meta: {
                    title: `refrigerantnonpabrik`
                }
            },
            {
                name: "daratgasoline",
                path: '/daratgasoline',
                component: DaratGasoline,
                meta: {
                    title: `daratgasoline`
                }
            },
            {
                name: "daratsolar",
                path: '/daratsolar',
                component: DaratSolar,
                meta: {
                    title: `daratsolar`
                }
            },
            {
                name: "indirectemissionkdm",
                path: '/indirectemissionkdm',
                component: IndirectEmissionKdm,
                meta: {
                    title: `indirectemissionkdm`
                }
            },
            {
                name: "penerbangan",
                path: '/penerbangan',
                component: Penerbangan,
                meta: {
                    title: `penerbangan`
                }
            },
            {
                name: "pergudangan",
                path: '/pergudangan',
                component: Pergudangan,
                meta: {
                    title: `pergudangan`
                }
            },
            {
                name: "distribusikapal",
                path: '/distribusikapal',
                component: DistribusiKapal,
                meta: {
                    title: `distribusikapal`
                }
            },
            {
                name: "npkurea",
                path: '/npkurea',
                component: NpkUrea,
                meta: {
                    title: `npkurea`
                }
            },
            {
                name: "sampahdomestik",
                path: '/sampahdomestik',
                component: SampahDomestik,
                meta: {
                    title: `sampahdomestik`
                }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router