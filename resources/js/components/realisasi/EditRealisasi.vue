<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="newRealisasiModalRef"
    id="kt_edit_modal_realisasi"
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
                <h2 class="fw-bold">Edit Data Realisasi</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
          </div>
          <!--end::Modal header-->

          <Form as="el-form" class="el-form--label-top" :validation-schema="schema" @submit="onSubmit">
          <!--begin::Modal body-->
          <div class="modal-body py-7 px-lg-17">
            <!--begin::Scroll-->
            <div
              class="scroll-y me-n7 pe-7"
              id="kt_edit_modal_realisasi_scroll"
            >

                    <input :value="text" style="border:white;"/>
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" v-model="realisasi.tahun" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tahun" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" disabled filterable placeholder="Select">
                                <el-option
                                    v-for="item in tahun_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="id_category" v-model="realisasi.id_category" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Category" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" disabled filterable :fit-input-width="true" placeholder="Select">
                                <el-option
                                    v-for="item in category_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="id_program_net_zero" v-model="realisasi.id_program_net_zero" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Program Net Zero" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" disabled filterable :fit-input-width="true" placeholder="Select">
                                <el-option
                                    v-for="item in program_net_zero_options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                />
                                </el-select>
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="realisasi_pengurangan_emisi" v-model="realisasi.realisasi_pengurangan_emisi" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Nilai Pengurangan Emisi" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                        <el-col :span="12">
                            <Field name="realisasi_penambahan_emisi" v-model="realisasi.realisasi_penambahan_emisi" type="number" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Nilai Penambahan Emisi" required>
                                <el-input
                                placeholder="0"
                                v-bind="field"
                                :validate-event="false"
                                :model-value="value"
                                />
                            </el-form-item>
                            </Field>
                        </el-col>
                    </el-row>              
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
                    <el-button type="primary" :disabled="loading" native-type="submit">{{ loading ? "Please wait" : "Submit" }}</el-button>
                </div>
            </div>
            <!--end::Button-->
          </div>
          <!--end::Modal footer-->
          </Form>
      </div>
    </div>
  </div>
  <!--end::Modal - New Address-->
</template>

<script>

import Swal from "sweetalert2/dist/sweetalert2.js";
import { Field, Form } from 'vee-validate';
import * as yup from 'yup';

export default {
    components: {
        Field, Form
    },
    props: ["detailrealisasi"],
    data() {
        return {
            loading:false,
            realisasi: {
                tahun: '',
                id_category: '',
                id_program_net_zero: '',
                realisasi_pengurangan_emisi: '',
                realisasi_penambahan_emisi: '',
            },
            tahun_options: [],
            category_options: [],
            program_net_zero_options: [],
        }
    },
    setup() {
        const schema = yup.object({
            // tahun: yup.string().required().label('Tahun'),
            id_category: yup.string().required().label('Category'),
            id_program_net_zero: yup.string().required().label('Program Net Zero'),
            realisasi_pengurangan_emisi: yup.number().required().label('Nilai Pengurangan Emisi'),
            realisasi_penambahan_emisi: yup.number().required().label('Nilai Penambahan Emisi'),
            });
        return {
            schema,
        };
    },
    watch: {
        detailrealisasi: {
            handler(val, old) {
                this.realisasi.id = val.id;
                this.realisasi.tahun = val.tahun;
                this.realisasi.id_category = val.id_category;
                this.realisasi.id_program_net_zero = val.id_program_net_zero;
                this.realisasi.realisasi_pengurangan_emisi = val.realisasi_pengurangan_emisi;
                this.realisasi.realisasi_penambahan_emisi = val.realisasi_penambahan_emisi;
            },
        },
    },
    created() {
        this.fetchTahun();
        this.fetchCategory();
        this.fetchProgramNetZero();
    },
    methods: {
        async onSubmit(values, actions) {
            this.loading = true;
            // console.log(JSON.stringify(values, null, 2));

            await axios.get('/sanctum/csrf-cookie')
            await axios.post(`/api/realisasi/update/${this.realisasi.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_realisasi').modal('hide');
                        actions.resetForm();
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
                        $('#kt_edit_modal_realisasi').modal('hide');
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
                        // $('#kt_edit_modal_realisasi').modal('hide');
                        this.loading = false
                    });
            }).finally(()=>{
                this.loading = false
            })
        },
        fetchTahun() {
            axios.get(`/api/valuelist/gettahundata`)
                .then(response => {
                    this.tahun_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        fetchCategory() {
            axios.get(`/api/valuelist/getcategorydata`)
                .then(response => {
                    this.category_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        fetchProgramNetZero() {
            axios.get(`/api/valuelist/getprogramnetzerodata`)
                .then(response => {
                    this.program_net_zero_options = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    }
}
</script>
