<template>
    <div id="kt_body" data-kt-app-header-stacked="true" data-kt-app-header-primary-enabled="true" data-kt-app-header-secondary-enabled="true" class="app-default">
		
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div class="">
					<el-menu
						:default-active="activeIndex"
						class="app-container custom-menu"
						mode="horizontal"
						:ellipsis="false"
						@select="handleSelect"
					>
						
						<a href="/" class="d-flex align-items-center me-lg-20 me-5">
							<img alt="Logo" src="assets/media/logos/demo-35-small.svg" class="h-20px d-sm-none d-inline" />
							<img alt="Logo" src="assets/media/logos/logo-pkt.png" class="h-20px h-lg-25px theme-light-show d-none d-sm-inline" />
							<img alt="Logo" src="assets/media/logos/logo-pkt.png" class="h-20px h-lg-25px theme-dark-show d-none d-sm-inline" />
						</a>
						
						<el-menu-item index="1">
							<router-link :to="{name:'dashboard'}" class="btn menu-title menu-text">Dashboard</router-link>
						</el-menu-item>
						<el-sub-menu index="2" v-if="user.role == 'admin'">
							<template #title><span class="menu-text">Baseline Data</span></template>
							<el-menu-item index="2-1">
								<router-link :to="{name:'gasalam'}" class="menu-title menu-text custom-menu">Gas Alam</router-link>
							</el-menu-item>
							<el-menu-item index="2-2">
								<router-link :to="{name:'coal'}" class="menu-title menu-text custom-menu">Coal</router-link>
							</el-menu-item>
							<el-menu-item index="2-3">
								<router-link :to="{name:'ippu'}" class="menu-title menu-text custom-menu">IPPU</router-link>
							</el-menu-item>
							<el-menu-item index="2-4">
								<router-link :to="{name:'limbahcair'}" class="menu-title menu-text custom-menu">Limbah Cair</router-link>
							</el-menu-item>
							<el-menu-item index="2-5">
								<router-link :to="{name:'fugitive'}" class="menu-title menu-text custom-menu">Fugitive</router-link>
							</el-menu-item>
							<el-menu-item index="2-6">
								<router-link :to="{name:'refrigerantpabrik'}" class="menu-title menu-text custom-menu">Refrigerant Pabrik</router-link>
							</el-menu-item>
							<el-menu-item index="2-7">
								<router-link :to="{name:'refrigerantnonpabrik'}" class="menu-title menu-text custom-menu">Refrigerant Non Pabrik</router-link>
							</el-menu-item>
							<el-menu-item index="2-8">
								<router-link :to="{name:'daratgasoline'}" class="menu-title menu-text custom-menu">Darat Gasoline</router-link>
							</el-menu-item>
							<el-menu-item index="2-9">
								<router-link :to="{name:'daratsolar'}" class="menu-title menu-text custom-menu">Darat Solar</router-link>
							</el-menu-item>
							<el-menu-item index="2-10">
								<router-link :to="{name:'indirectemissionkdm'}" class="menu-title menu-text custom-menu">Indirect Emission KDM</router-link>
							</el-menu-item>
							<el-menu-item index="2-11">
								<router-link :to="{name:'penerbangan'}" class="menu-title menu-text custom-menu">Penerbangan</router-link>
							</el-menu-item>
							<el-menu-item index="2-12">
								<router-link :to="{name:'pergudangan'}" class="menu-title menu-text custom-menu">Pergudangan</router-link>
							</el-menu-item>
							<el-menu-item index="2-13">
								<router-link :to="{name:'distribusikapal'}" class="menu-title menu-text custom-menu">Distribusi Kapal</router-link>
							</el-menu-item>
							<el-menu-item index="2-14">
								<router-link :to="{name:'npkurea'}" class="menu-title menu-text custom-menu">Npk & Urea</router-link>
							</el-menu-item>
							<el-menu-item index="2-15">
								<router-link :to="{name:'sampahdomestik'}" class="menu-title menu-text custom-menu">Sampah Domestik</router-link>
							</el-menu-item>
						</el-sub-menu>
						<el-sub-menu index="3" v-if="user.role == 'admin'">
							<template #title><span class="menu-text">Program Dekarbon</span></template>
							<el-menu-item index="3-1">
								<router-link :to="{name:'rencana'}" class="menu-title menu-text custom-menu">Rencana</router-link>
							</el-menu-item>
							<el-menu-item index="3-2">
								<router-link :to="{name:'realisasi'}" class="menu-title menu-text custom-menu">Realisasi</router-link>
							</el-menu-item>
						</el-sub-menu>
						<el-menu-item index="4" class="menu-text">Other</el-menu-item>
						<div class="flex-grow" />
						<!-- <el-menu-item index="5">Alamsyah</el-menu-item> -->
						<el-sub-menu index="5">
							<template #title><span class="menu-text">{{user.name}}</span></template>
							<el-menu-item index="5-1" class="menu-text">Profile</el-menu-item>
							<el-menu-item index="5-2" class="menu-text">
								<a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
							</el-menu-item>
						</el-sub-menu>
					</el-menu>
				</div>

				<div class="app-wrapper flex-column flex-row-fluid pattern_back-bg" id="kt_app_wrapper">
					<!--begin::Wrapper container-->
					<div class="container-xxl d-flex flex-row flex-column-fluid">
						<!--begin::Main-->
						<div class="app-main flex-column flex-row-fluid mx-5" id="kt_app_main">
							<!--begin::Content wrapper-->
							<div class="d-flex flex-column flex-column-fluid">
								<!--begin::Content-->
								<div id="pt-0" class="app-content flex-column-fluid py-3">
                                    <router-view></router-view>
                                </div>
								<!--end::Content-->
							</div>
							<!--end::Content wrapper-->
							<!--begin::Footer-->
							<div id="kt_app_footer" class="app-footer align-items-center justify-content-center flex-column flex-md-row py-3 py-lg-6" style="background: white;">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2023&copy;</span>
									<a href="/" target="_blank" class="text-gray-800 text-hover-primary">Tim Transformasi Digital PKT</a>
								</div>
								<!--end::Copyright-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end:::Main-->
					</div>
					<!--end::Wrapper container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->
	</div>
</template>

<style>
.flex-grow {
  flex-grow: 1;
}

.custom-menu {
  height: 40px; /* Custom width */
}

.menu-text {
  font-size: 10px; /* Custom small font size */
}

.menu-container {
  background-color: #f5f5f5;
  padding: 10px;
}
</style>

<script>
import {mapActions} from 'vuex'
export default {
    name:"default-layout",
    data(){
        return {
            user:this.$store.state.auth.user,
			active_el: "dashboard",
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
		activate: function (el) {
            this.active_el = el;
        },
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        }
    }
}
</script>
