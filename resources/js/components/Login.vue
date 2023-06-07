<template>
    <div id="kt_body" class="app-blank bgi-no-repeat" style="background-image: url(assets/media/auth/bg10.jpeg)">
		<!--begin::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root" style="height: 100%;">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Logo-->
				<a href="../../demo35/dist/index.html" class="d-block d-lg-none mx-auto py-20">
					<img alt="Logo" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
					<img alt="Logo" src="assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
				</a>
				<!--end::Logo-->
				<!--begin::Body-->
				<div class="d-none d-lg-flex flex-lg-row-fluid card flex-center w-50 bgi-no-repeat" style="background-image: url(assets/media/auth/19.png);height: 100vh;">
                    <!-- <div class="card shadow">
                        <div class="card-body p-0">
                            <div class="bgi-position-x-start bgi-no-repeat" style="background-image: url(assets/media/auth/19.png);height: 100vh;"></div>
                        </div>
                    </div> -->
                    <!--begin::Wrapper-->
					<div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
						<!--begin::Body-->
						<div class="py-20">
							<!--begin::Form-->
                            <form action="javascript:void(0)" class="row" method="post">
                                <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                        </ul>
                                    </div>
                                </div>
								<!--begin::Body-->
								<div class="card-body">
									<!--begin::Heading-->
									<div class="text-start mb-10">
										<!--begin::Title-->
                                        <img alt="Logo" src="assets/media/logos/logo-pkt.png" class="h-25px mb-4" />
										<h1 class="text-dark mb-3 fs-3x" data-kt-translate="sign-in-title">Welcome Back</h1>
										<!--end::Title-->
									</div>
									<!--begin::Heading-->
									<div class="form-group col-12">
                                        <label for="email" class="font-weight-bold">Username</label>
                                        <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group col-12 my-2">
                                        <label for="password" class="font-weight-bold">Password</label>
                                        <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-12 mb-2">
                                        <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                                            {{ processing ? "Please wait" : "Login" }}
                                        </button>
                                    </div>
								</div>
								<!--begin::Body-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Wrapper-->
                </div>
				<!--begin::Body-->
                
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
					<!--begin::Wrapper-->
					<div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
						<!--begin::Body-->
						<div class="py-20">
							<!--begin::Form-->
                            <form action="javascript:void(0)" class="row" method="post">
                                <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                        </ul>
                                    </div>
                                </div>
								<!--begin::Body-->
								<div class="card-body">
									<!--begin::Heading-->
									<div class="text-start mb-10">
										<!--begin::Title-->
                                        <img alt="Logo" src="assets/media/logos/logo-pkt.png" class="h-25px mb-4" />
										<h1 class="text-dark mb-3 fs-3x" data-kt-translate="sign-in-title">Welcome Back</h1>
										<!--end::Title-->
									</div>
									<!--begin::Heading-->
									<div class="form-group col-12">
                                        <label for="email" class="font-weight-bold">Username</label>
                                        <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group col-12 my-2">
                                        <label for="password" class="font-weight-bold">Password</label>
                                        <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-12 mb-2">
                                        <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                                            {{ processing ? "Please wait" : "Login" }}
                                        </button>
                                    </div>
								</div>
								<!--begin::Body-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
	</div>
</template>

<script>
import { ref } from 'vue'
import { mapActions } from 'vuex'
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            validationErrors:{},
            processing:false
        }
    },
    // setup() {
    //     const activeIndex = ref('1')
    //     const activeIndex2 = ref('1')
    //     // const handleSelect = (key: string, keyPath: string[]) => {
    //     //     console.log(key, keyPath)
    //     // }
    //     return {
    //         activeIndex,activeIndex2
    //     };
    // },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async login(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login',this.auth).then(({data})=>{
                this.signIn()
            }).catch(({response})=>{
                if(response.status===422){
                    this.validationErrors = response.data.errors
                }else{
                    this.validationErrors = {}
                    alert(response.data.message)
                }
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>