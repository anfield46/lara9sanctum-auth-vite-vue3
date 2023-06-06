<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="newImportRealisasiModalRef"
    id="kt_import_modal_realisasi"
    tabindex="0"
    aria-hidden="true"
  >
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
      <!--begin::Modal content-->
      <div class="modal-content">
          <!--begin::Modal header-->
          <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Import Data Realisasi</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
          </div>
          <!--end::Modal header-->

          <!--begin::Modal body-->
          <div class="modal-body py-10 px-lg-17">
            <!--begin::Scroll-->
            <div
              class="scroll-y me-n7 pe-7"
              id="kt_import_modal_realisasi_scroll"
            >
              <!--begin::Input group-->
              <div class="d-flex flex-column mb-5 fv-row">
                <!--begin::Label-->
                <label class="fs-5 fw-bold mb-2">Attachment</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="file" id="file" ref="file" accept="application/xlxs" v-on:change="handleFileUpload()" name="file" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Attachment"/>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
            </div>
            <!--end::Scroll-->
          </div>
          <!--end::Modal body-->

          <!--begin::Modal footer-->
          <div class="modal-footer">
            <!--begin::Button-->
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between container-fluid">
              <div>
                <button id="modal_dismiss" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                  <span><i class="cursor-pointer dx-icon-close"></i>cancel</span>
                </button>
              </div>
              <!--end::Button-->

              <!--begin::Button-->
              <div>
                <button type="button" :disabled="loading" class="btn btn-primary btn-block" @click="submit">
                  {{ loading ? "Please wait" : "Submit" }}
                </button>
              </div>
            </div>
            <!--end::Button-->
          </div>
          <!--end::Modal footer-->
      </div>
    </div>
  </div>
  <!--end::Modal - New Address-->
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
    components: {
    },
    data() {
        return {
            loading:false,
            realisasi: {
                file: ''
            },
        }
    },
    created() {
    },
    methods: {
        async submit() {
            this.loading = true;
            
            let formData = new FormData();
            formData.append('file', this.realisasi.file);

            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/realisasi/import',formData).then(response=>{
                  if(response.data['messageinput'] == 1){
                    Swal.fire({
                        text: response.data['message'],
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then(() => {
                        this.$emit('refreshGridParent')
                        $('#kt_import_modal_realisasi').modal('hide');

                        this.realisasi.file = '';
                    });
                  }else{
                    Swal.fire({
                        text: response.data['message'],
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-danger",
                        },
                    }).then(() => {
                        $('#kt_import_modal_realisasi').modal('hide');
                    });
                  }  
            }).catch(({response})=>{
                Swal.fire({
                        text: response.data['message'],
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-danger",
                        },
                    }).then(() => {
                        // $('#kt_import_modal_realisasi').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
        handleFileUpload(){
          this.realisasi.file = this.$refs.file.files[0];
        }
    }
}
</script>
