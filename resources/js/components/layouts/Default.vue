<template>
    <div id="kt_body" data-kt-app-header-stacked="true" data-kt-app-header-primary-enabled="true" data-kt-app-header-secondary-enabled="true" class="app-default">
		
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<!-- <div id="kt_app_header" class="app-header" style="height: max-content !important;">
					
					<div class="app-header-primary" data-kt-sticky="true" data-kt-sticky-name="app-header-primary-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}" style="border-bottom: var(--bs-app-header-secondary-base-border-bottom);">
						
						<div class="app-container container-xxl d-flex align-items-stretch justify-content-between">
							
							<div class="d-flex flex-grow-1 flex-lg-grow-0">
								
								<div class="d-flex align-items-center me-7" id="kt_app_header_logo_wrapper">
									
									<button class="d-lg-none btn btn-icon btn-flex btn-color-gray-600 btn-active-color-primary w-35px h-35px ms-n2 me-2" id="kt_app_header_menu_toggle">
										<i class="ki-outline ki-abstract-14 fs-2"></i>
									</button>
									
									
									<a href="/" class="d-flex align-items-center me-lg-20 me-5">
										<img alt="Logo" src="assets/media/logos/demo-35-small.svg" class="h-20px d-sm-none d-inline" />
										<img alt="Logo" src="assets/media/logos/demo-35.svg" class="h-20px h-lg-25px theme-light-show d-none d-sm-inline" />
										<img alt="Logo" src="assets/media/logos/demo-35-dark.png" class="h-20px h-lg-25px theme-dark-show d-none d-sm-inline" />
									</a>
									
								</div>
								
								
								<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
									
									<div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
										
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" @click="activate('dashboard')" :class="{active:active_el =='dashboard'}">
											
											<span class="menu-link py-3" >
                                                <router-link :to="{name:'dashboard'}" class="menu-title">Home <span class="sr-only">(current)</span></router-link>
											</span>
											
										</div>
										
										
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0" class="menu-item menu-lg-down-accordion me-0 me-lg-2" @click="activate('master')" :class="{active:active_el =='master'}">
											
											<span class="menu-link py-3">
												<router-link :to="{name:'gasalam'}" class="menu-title">Gas Alam</router-link>
											</span>
											
										</div>
										
										
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
											
											<span class="menu-link py-3">
												<span class="menu-title">Master Data</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											
											
											<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
												
												<div class="menu-item">
													
													<router-link :to="{name:'gasalam'}" class="menu-link py-3" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
														<span class="menu-icon">
															<i class="ki-outline ki-rocket fs-2"></i>
														</span>
														<span class="menu-title">Gas Alam</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'coal'}" class="menu-link py-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
														<span class="menu-icon">
															<i class="ki-outline ki-abstract-26 fs-2"></i>
														</span>
														<span class="menu-title">Coal</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'ippu'}" class="menu-link py-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
														<span class="menu-icon">
															<i class="ki-outline ki-switch fs-2"></i>
														</span>
														<span class="menu-title">IPPU</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'limbahcair'}" class="menu-link py-3">
														<span class="menu-icon">
															<i class="ki-outline ki-code fs-2"></i>
														</span>
														<span class="menu-title">Limbah Cair</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'fugitive'}" class="menu-link py-3">
														<span class="menu-icon">
															<i class="ki-outline ki-code fs-2"></i>
														</span>
														<span class="menu-title">Fugitive</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'refrigerantpabrik'}" class="menu-link py-3">
														<span class="menu-icon">
															<i class="ki-outline ki-code fs-2"></i>
														</span>
														<span class="menu-title">Refrigerant Pabrik</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'refrigerantnonpabrik'}" class="menu-link py-3">
														<span class="menu-icon">
															<i class="ki-outline ki-code fs-2"></i>
														</span>
														<span class="menu-title">Refrigerant Non Pabrik</span>
													</router-link>
													
												</div>
												
												
												<div class="menu-item">
													
													<router-link :to="{name:'daratgasoline'}" class="menu-link py-3">
														<span class="menu-icon">
															<i class="ki-outline ki-code fs-2"></i>
														</span>
														<span class="menu-title">Darat Gasoline</span>
													</router-link>
													
												</div>
												
											</div>
											
										</div>
										
									</div>
									
								</div>
								
							</div>
							
							
							
							<div class="app-navbar flex-shrink-0">
								
								<div class="app-navbar-item">
									
									<a href="../../demo35/dist/account/billing.html" class="d-flex flex-column bg-light text-end rounded px-4 py-1 ms-3 ms-lg-6">
										<span class="text-gray-800 fs-5 fw-bold">$32,084</span>
									</a>
									
								</div>
								
								
								<div class="app-navbar-item ms-3 ms-lg-9" id="kt_header_user_menu_toggle">
									
									<div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										
										<div class="text-end d-none d-sm-flex flex-column justify-content-center me-3">
											<span class="text-gray-500 fs-8 fw-bold">Hello</span>
											<a href="../../demo35/dist/pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-7 fw-bold d-block">Esther</a>
										</div>
										
										
										<div class="cursor-pointer symbol symbol symbol-circle symbol-35px symbol-md-40px">
											<img class="" src="assets/media/avatars/300-2.jpg" alt="user" />
											<div class="position-absolute translate-middle bottom-0 mb-1 start-100 ms-n1 bg-success rounded-circle h-8px w-8px"></div>
										</div>
										
									</div>
									
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="assets/media/avatars/300-2.jpg" />
												</div>
												
												
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">Jane Cooper
													<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
													<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">jane@kt.com</a>
												</div>
												
											</div>
										</div>
										
										
										<div class="separator my-2"></div>
										
										
										<div class="menu-item px-5 my-1">
											<a href="../../demo35/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
										</div>
										
										
										<div class="menu-item px-5">
											<a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
										</div>
										
									</div>
									
									
								</div>
								
								
								<div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
									<div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
										<i class="ki-outline ki-text-align-left fs-1"></i>
									</div>
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div> -->
				

				<el-menu
					:default-active="activeIndex"
					class="app-container"
					mode="horizontal"
					:ellipsis="false"
					@select="handleSelect"
				>
					
					<a href="/" class="d-flex align-items-center me-lg-20 me-5">
						<img alt="Logo" src="assets/media/logos/demo-35-small.svg" class="h-20px d-sm-none d-inline" />
						<img alt="Logo" src="assets/media/logos/demo-35.svg" class="h-20px h-lg-25px theme-light-show d-none d-sm-inline" />
						<img alt="Logo" src="assets/media/logos/demo-35-dark.png" class="h-20px h-lg-25px theme-dark-show d-none d-sm-inline" />
					</a>
					
					<el-menu-item index="1">
						<router-link :to="{name:'dashboard'}" class="menu-title">Dashboard</router-link>
					</el-menu-item>
					<el-sub-menu index="2">
						<template #title>Master Data</template>
						<el-menu-item index="2-1">
							<router-link :to="{name:'gasalam'}" class="menu-title">Gas Alam</router-link>
						</el-menu-item>
						<el-menu-item index="2-2">
							<router-link :to="{name:'coal'}" class="menu-title">Coal</router-link>
						</el-menu-item>
						<el-menu-item index="2-3">
							<router-link :to="{name:'ippu'}" class="menu-title">IPPU</router-link>
						</el-menu-item>
						<el-menu-item index="2-4">
							<router-link :to="{name:'limbahcair'}" class="menu-title">Limbah Cair</router-link>
						</el-menu-item>
						<el-menu-item index="2-5">
							<router-link :to="{name:'fugitive'}" class="menu-title">Fugitive</router-link>
						</el-menu-item>
						<el-menu-item index="2-6">
							<router-link :to="{name:'refrigerantpabrik'}" class="menu-title">Refrigerant Pabrik</router-link>
						</el-menu-item>
						<el-menu-item index="2-7">
							<router-link :to="{name:'refrigerantnonpabrik'}" class="menu-title">Refrigerant Non Pabrik</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'daratgasoline'}" class="menu-title">Darat Gasoline</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'daratsolar'}" class="menu-title">Darat Solar</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'indirectemissionkdm'}" class="menu-title">Indirect Emission KDM</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'penerbangan'}" class="menu-title">Penerbangan</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'pergudangan'}" class="menu-title">Pergudangan</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'distribusikapal'}" class="menu-title">Distribusi Kapal</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'npkurea'}" class="menu-title">Npk & Urea</router-link>
						</el-menu-item>
						<el-menu-item index="2-8">
							<router-link :to="{name:'sampahdomestik'}" class="menu-title">Sampah Domestik</router-link>
						</el-menu-item>
					</el-sub-menu>
					<el-menu-item index="4">Other</el-menu-item>
					<div class="flex-grow" />
					<!-- <el-menu-item index="5">Alamsyah</el-menu-item> -->
					<el-sub-menu index="5">
						<template #title>Alamsyah</template>
						<el-menu-item index="5-1">Profile</el-menu-item>
						<el-menu-item index="5-2">
							<a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
						</el-menu-item>
					</el-sub-menu>
				</el-menu>




				
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Wrapper container-->
					<div class="app-container container-xxl d-flex flex-row flex-column-fluid">
						<!--begin::Main-->
						<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
							<!--begin::Content wrapper-->
							<div class="d-flex flex-column flex-column-fluid">
								<!--begin::Content-->
								<div id="kt_app_content" class="app-content flex-column-fluid">
                                    <router-view></router-view>
                                </div>
								<!--end::Content-->
							</div>
							<!--end::Content wrapper-->
							<!--begin::Footer-->
							<div id="kt_app_footer" class="app-footer align-items-center justify-content-center justify-content-md-between flex-column flex-md-row py-3 py-lg-6">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2023&copy;</span>
									<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
									<li class="menu-item">
										<a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
									</li>
									<li class="menu-item">
										<a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
									</li>
									<li class="menu-item">
										<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
									</li>
								</ul>
								<!--end::Menu-->
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
