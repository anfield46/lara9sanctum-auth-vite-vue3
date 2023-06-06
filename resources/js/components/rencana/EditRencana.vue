<template>
  <!--begin::Modal - New Address-->
  <div
    class="modal fade"
    ref="newRencanaModalRef"
    id="kt_edit_modal_rencana"
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
                <h2 class="fw-bold">Edit Data Rencana</h2>
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
              id="kt_edit_modal_rencana_scroll"
            >

                    <input :value="text" style="border:white;"/>
                
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <Field name="tahun" v-model="rencana.tahun" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Tahun" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable placeholder="Select">
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
                            <Field name="id_category" v-model="rencana.id_category" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Category" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable :fit-input-width="true" placeholder="Select">
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
                            <Field name="id_program_net_zero" v-model="rencana.id_program_net_zero" type="select" v-slot="{ value, field, errorMessage }">
                            <el-form-item :error="errorMessage" label="Program Net Zero" required>
                                <el-select v-bind="field" :validate-event="true" :model-value="value" filterable :fit-input-width="true" placeholder="Select">
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
                            <Field name="rencana_pengurangan_emisi" v-model="rencana.rencana_pengurangan_emisi" type="number" v-slot="{ value, field, errorMessage }">
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
                            <Field name="rencana_penambahan_emisi" v-model="rencana.rencana_penambahan_emisi" type="number" v-slot="{ value, field, errorMessage }">
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
    props: ["detailrencana"],
    data() {
        return {
            loading:false,
            rencana: {
                tahun: '',
                id_program_net_zero: '',
                id_category: '',
                rencana_pengurangan_emisi: '',
                rencana_penambahan_emisi: '',
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
            rencana_pengurangan_emisi: yup.number().required().label('Nilai Pengurangan Emisi'),
            rencana_penambahan_emisi: yup.number().required().label('Nilai Penambahan Emisi'),
            });
        return {
            schema,
        };
    },
    watch: {
        detailrencana: {
            handler(val, old) {
                this.rencana.id = val.id;
                this.rencana.tahun = val.tahun;
                this.rencana.id_category = val.id_category;
                this.rencana.id_program_net_zero = val.id_program_net_zero;
                this.rencana.rencana_pengurangan_emisi = val.rencana_pengurangan_emisi;
                this.rencana.rencana_penambahan_emisi = val.rencana_penambahan_emisi;
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
            await axios.post(`/api/rencana/update/${this.rencana.id}`,values).then(response=>{
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
                        $('#kt_edit_modal_rencana').modal('hide');
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
                        $('#kt_edit_modal_rencana').modal('hide');
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
                        // $('#kt_edit_modal_rencana').modal('hide');
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
